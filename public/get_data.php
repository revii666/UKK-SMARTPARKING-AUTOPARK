<?php

require_once "../app/models/ParkingModel.php";

$model = new ParkingModel();

$data = [
    "in" => $model->getIn(),
    "out" => $model->getOut(),
    "log" => $model->getLog()
];

header('Content-Type: application/json');

echo json_encode($data);