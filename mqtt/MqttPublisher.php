<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpMqtt\Client\MqttClient;

class MqttPublisher {

    private $mqtt;

    public function __construct() {

        $this->mqtt = new MqttClient(
            "broker.hivemq.com",
            1883,
            "publisher_" . rand()
        );

        $this->mqtt->connect();

        // 🔥 PENTING BANGET (BIAR CONNECT STABIL)
        usleep(300000); // 0.3 detik
    }

    // ================= ENTRY =================
    public function openEntry() {

        echo "KIRIM OPEN ENTRY\n";

        $this->mqtt->publish(
            "parking/REVICANTIK123/entry/servo",
            "OPEN",
            1 // 🔥 QoS 1 WAJIB
        );

        usleep(300000);
    }

    // ================= EXIT =================
    public function openExit() {

        echo "KIRIM OPEN EXIT\n";

        $this->mqtt->publish(
            "parking/REVICANTIK123/exit/servo",
            "OPEN",
            1 // 🔥 WAJIB QoS 1
        );

        usleep(300000);
    }

    public function __destruct() {
        $this->mqtt->disconnect();
    }
}