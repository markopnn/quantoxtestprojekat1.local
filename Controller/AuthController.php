<?php

include_once "Model/Auth.php";

class AuthController {

    public function login() {
        if(isset($_POST['btnLogin'])){
            $email = trim($_POST['email']);
            $password = trim($_POST["password"]);

            $users = new Auth();
            $result = $users->loginUser($email,$password);

        }
    }

    public function register() {
        if(isset($_POST['btnRegister'])){
            $errors= [];

            $email = trim($_POST['email']);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $id_role = $_POST['role'];

            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

            if($email == '' || trim($_POST['password']) == '') {
                $_SESSION['error'] = 'Email and password are required';
            }elseif (!preg_match($regex, $email)) {
                $_SESSION['error'] = 'Invalid email format';
            }

            if(!isset($_SESSION['error']))
            {
            $users = new Auth();
            $result = $users->registerUser($email,$password,$id_role);
            }

        }
    }

    public function logout() {
        session_start();
        session_destroy();

        header("location: /");
    }

}