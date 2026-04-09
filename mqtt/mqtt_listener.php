<?php
require_once(__DIR__ . "/phpMQTT.php");
require_once(__DIR__ . "/config/database.php");

/* MQTT */
$server = "broker.hivemq.com";
$port = 1883;
$client_id = "smartpark_" . rand();

$mqtt = new \Bluerhinos\phpMQTT($server, $port, $client_id);

if (!$mqtt->connect()) {
    exit("MQTT FAILED\n");
}

echo "MQTT CONNECTED\n";
echo "MENUNGGU DATA...\n";

/* TOPIC */
$topics['parking/REVICANTIK123/entry/rfid'] = ["qos"=>0, "function"=>"entryHandler"];
$topics['parking/REVICANTIK123/exit/rfid']  = ["qos"=>0, "function"=>"exitHandler"];

$mqtt->subscribe($topics, 0);

while ($mqtt->proc()) {
    usleep(100000);
}

$mqtt->close();

/* ================= ENTRY ================= */
function entryHandler($topic, $msg){
    global $conn, $mqtt;

    $data = json_decode($msg, true);
    $card_id = strtoupper($data['rfid']);

    $cek = mysqli_query($conn,"SELECT id FROM transaksi WHERE card_id='$card_id' AND status='IN'");

    if(mysqli_num_rows($cek)==0){

        mysqli_query($conn,"INSERT INTO transaksi(card_id,checkin_time,status) VALUES('$card_id',NOW(),'IN')");

        echo "MASUK $card_id\n";

        // ✅ buka palang masuk
        $mqtt->publish("parking/REVICANTIK123/entry/servo","OPEN",0);
    }
}

/* ================= EXIT ================= */
// EXIT (FINAL)
function exitHandler($topic, $msg){
    global $conn;

    $data = json_decode($msg, true);
    $card_id = strtoupper($data['rfid']);

    $q = mysqli_query($conn,"SELECT * FROM transaksi 
        WHERE card_id='$card_id' AND status='IN' 
        ORDER BY id DESC LIMIT 1");

    if(mysqli_num_rows($q)>0){

        $d = mysqli_fetch_assoc($q);

        $durasi = ceil((time()-strtotime($d['checkin_time']))/3600);
        if($durasi<1) $durasi=1;

        $biaya = $durasi*2000;

        mysqli_query($conn,"UPDATE transaksi 
            SET checkout_time=NOW(),
                duration=$durasi,
                fee=$biaya,
                status='OUT' 
            WHERE id=".$d['id']);

        echo "KELUAR $card_id\n";

        // ❌ TIDAK ADA OPEN DI SINI
    }
}