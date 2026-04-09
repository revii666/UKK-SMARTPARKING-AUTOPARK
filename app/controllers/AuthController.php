<?php

require_once __DIR__ . "/../models/UserModel.php";

class AuthController {

    public function login(){

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $username = $_POST['username'];
            $password = $_POST['password'];

            $model = new UserModel();
            $user = $model->login($username,$password);

            if($user){

                session_start();
                $_SESSION['login'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: index.php");
                exit;

            }else{
                $error = "Username atau password salah";
                require "../app/views/auth/login.php";
            }

        }else{

            require "../app/views/auth/login.php";

        }

    }

    public function logout(){

        session_start();
        session_destroy();

        header("Location: login");
    }

}