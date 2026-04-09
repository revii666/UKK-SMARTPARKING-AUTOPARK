<?php
session_start();

require_once "../app/controllers/ParkingController.php";
require_once "../app/controllers/AuthController.php";

$action = $_GET['action'] ?? 'home';

/*
========================
ROUTE LOGIN
========================
*/

if($action == "login"){
    $auth = new AuthController();
    $auth->login();
    exit;
}

if($action == "logout"){
    $auth = new AuthController();
    $auth->logout();
    exit;
}

/*
========================
CEK LOGIN
========================
*/

if(!isset($_SESSION['login'])){
    header("Location: index.php?action=login");
    exit;
}

/*
========================
PARKING CONTROLLER
========================
*/

$controller = new ParkingController();

switch ($action) {

    case 'checkin':
        $controller->checkin();
        break;

    case 'checkout':
        $controller->checkout();
        break;

    case 'open':
        $controller->openGate();
        break;

    case 'struk':
        $controller->struk();
        break;

    default:
        $controller->index();
        break;
}