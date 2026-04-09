<?php

require_once __DIR__ . "/../../config/database.php";

class UserModel {

    private $conn;

    public function __construct(){
        global $conn;
        $this->conn = $conn;
    }

    public function login($username,$password){

        $query = mysqli_query($this->conn,
            "SELECT * FROM users 
             WHERE username='$username'
             AND password='$password'
             AND role='petugas'"
        );

        return mysqli_fetch_assoc($query);
    }

}