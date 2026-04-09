<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/ParkingModel.php';

$config = require __DIR__ . '/mqtt_config.php';

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

// ================= CONFIG TOPIC =================
$prefix = "parking/" . $config['nama_kelompok'];

$topics = [
    'entry_rfid'  => $prefix . "/entry/rfid",
    'exit_rfid'   => $prefix . "/exit/rfid",
    'entry_servo' => $prefix . "/entry/servo",
    'exit_servo'  => $prefix . "/exit/servo",
    'lcd'         => $prefix . "/lcd",
];

// ================= INIT MODEL =================
try {
    $transaksi = new ParkingModel();
    echo "[✓] Database connected\n";
} catch (Exception $e) {
    echo "[✗] Database error: " . $e->getMessage() . "\n";
    exit(1);
}

// ================= INIT MQTT =================
try {
    $settings = (new ConnectionSettings())
        ->setConnectTimeout(10)
        ->setKeepAliveInterval(60);

    $clientId = 'worker-' . $config['nama_kelompok'] . '-' . uniqid();

    $mqtt = new MqttClient(
        $config['broker'],
        $config['port'],
        $clientId
    );

    $mqtt->connect($settings, true);

    echo "[✓] MQTT connected\n";
} catch (Exception $e) {
    echo "[✗] MQTT error: " . $e->getMessage() . "\n";
    exit(1);
}

// ================= STATUS =================
echo "[✓] Worker running...\n";
echo "[✓] Listening:\n";
echo "    - {$topics['entry_rfid']}\n";
echo "    - {$topics['exit_rfid']}\n\n";

// ================= ENTRY RFID =================
$mqtt->subscribe($topics['entry_rfid'], function ($topic, $message) use ($transaksi, $mqtt, $topics) {

    $cardId = trim($message);

    if ($cardId == "") {
        echo "[ERROR] UID kosong!\n";
        return;
    }

    echo "[ENTRY] Card ID: $cardId\n";

    // Cek sudah parkir
    if ($transaksi->isParking($cardId)) {
        echo "[!] Sudah parkir\n";
        $mqtt->publish($topics['lcd'], 'Sudah Parkir', 0, true);
        return;
    }

    // Insert ke DB (IN)
    if ($transaksi->checkin($cardId)) {

        echo "[✓] Check-in berhasil (IN)\n";

        // Buka palang masuk
        $mqtt->publish($topics['entry_servo'], 'OPEN', 0);

        // Tampilkan ke OLED
        $mqtt->publish($topics['lcd'], 'Silakan Masuk', 0, true);

    } else {
        echo "[✗] Gagal insert DB\n";
    }

}, 0);


// ================= EXIT RFID =================
$mqtt->subscribe($topics['exit_rfid'], function ($topic, $message) use ($transaksi, $mqtt, $topics) {

    $cardId = trim($message);

    if ($cardId == "") {
        echo "[ERROR] UID kosong!\n";
        return;
    }

    echo "[EXIT] Card ID: $cardId\n";

    // Ambil data parkir aktif
    $active = $transaksi->getActiveByCard($cardId);

    if (!$active) {
        echo "[!] Tidak ditemukan (belum parkir)\n";
        $mqtt->publish($topics['lcd'], 'Tidak Terdaftar', 0, true);
        return;
    }

    $id = $active['id'];

    // Hitung durasi
    $checkin = strtotime($active['checkin_time']);
    $checkout = time();

    $durasi = ceil(($checkout - $checkin) / 3600);
    if ($durasi <= 0) $durasi = 1;

    $tarif = 2000;
    $biaya = $durasi * $tarif;

    // Update ke OUT
    if ($transaksi->checkout($id, $durasi, $biaya)) {

        echo "[✓] Checkout berhasil | Durasi: {$durasi} jam | Rp $biaya\n";

        // Tampilkan biaya ke OLED
        $mqtt->publish($topics['lcd'], 'Bayar: Rp ' . $biaya, 0, true);

        // ❗ Servo keluar tidak otomatis (sesuai sistem kamu)

    } else {
        echo "[✗] Gagal update DB\n";
    }

}, 0);


// ================= LOOP =================
while (true) {
    try {
        $mqtt->loop(true);
        usleep(100000);
    } catch (Exception $e) {
        echo "[ERROR] " . $e->getMessage() . "\n";
        sleep(5);
    }
}