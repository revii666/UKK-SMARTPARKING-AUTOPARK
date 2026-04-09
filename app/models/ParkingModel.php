<?php
require_once __DIR__ . '/../../config/database.php';

class ParkingModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getIn() {
        return $this->conn->query("SELECT * FROM transaksi WHERE status='IN'")->fetch_all(MYSQLI_ASSOC);
    }

    public function getOut() {
        return $this->conn->query("SELECT * FROM transaksi WHERE status='OUT'")->fetch_all(MYSQLI_ASSOC);
    }

    public function getLog() {
        return $this->conn->query("SELECT * FROM transaksi WHERE status='DONE'")->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        return $this->conn->query("SELECT * FROM transaksi WHERE id=".(int)$id)->fetch_assoc();
    }

    public function checkin($card_id) {
        return $this->conn->query(
            "INSERT INTO transaksi (card_id, checkin_time, status)
             VALUES ('$card_id', NOW(), 'IN')"
        );
    }

    public function checkout($id, $durasi, $biaya) {
        return $this->conn->query(
            "UPDATE transaksi SET
                checkout_time=NOW(),
                duration=$durasi,
                fee=$biaya,
                status='OUT'
             WHERE id=$id"
        );
    }

    public function openGate($id) {
        return $this->conn->query(
            "UPDATE transaksi SET status='DONE' WHERE id=".(int)$id
        );
    }
}