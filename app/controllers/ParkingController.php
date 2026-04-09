<?php
require_once __DIR__ . "/../models/ParkingModel.php";

class ParkingController {
    private $model;

    public function __construct() {
        $this->model = new ParkingModel();
    }

    public function index() {
        $in  = $this->model->getIn();
        $out = $this->model->getOut();
        $log = $this->model->getLog();
        require __DIR__ . "/../views/parking/index.php";
    }

    public function checkout() {
        if (!isset($_GET['id'])) {
            die("ID Transaksi tidak ditemukan");
        }

        $id = $_GET['id'];
        $data = $this->model->getById($id);

        if (!$data) {
            die("Data parkir tidak ditemukan di database.");
        }

        $checkin  = strtotime($data['checkin_time']);
        $checkout = time();

        $durasiJam = ceil(($checkout - $checkin) / 2000);
        if ($durasiJam <= 0) $durasiJam = 1;

        $tarif = 2000; 
        $biaya = $durasiJam * $tarif;

        // Pastikan model mengubah status data menjadi 'KELUAR'
        $this->model->checkout($id, $durasiJam, $biaya);

        header("Location: index.php");
        exit;
    }

  public function openGate() {
    if (!isset($_GET['id'])) die("ID tidak ditemukan");

    require_once __DIR__ . "/../../mqtt/MqttPublisher.php";

    $publisher = new MqttPublisher();

    // ✅ buka palang exit
    $publisher->openExit();

    // update DB
    $this->model->openGate($_GET['id']);

    header("Location: index.php");
}

    public function struk() {
        if (!isset($_GET['id'])) die("ID tidak ditemukan");
        $id = $_GET['id'];
        $data = $this->model->getById($id);
        if (!$data) die("Data struk tidak ditemukan.");

        require __DIR__ . '/../views/parking/struk.php';
    }

    public function checkin() {
        if (!isset($_GET['card_id']) || $_GET['card_id'] == '0') {
            die("Error: RFID tidak terbaca atau bernilai 0");
        }
        $card_id = $_GET['card_id'];
        $this->model->checkin($card_id);
        header("Location: index.php");
        exit;
    }
}