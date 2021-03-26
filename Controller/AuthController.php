<?php

include_once "Model/User.php";

class AuthController {

    public function LoginController() {
        if(isset($_POST['btnLogin'])){
            $email = trim($_POST['email']);
            $password = trim($_POST["password"]);

            $errors= [];
            if($email == '') {
                $errors[] = "Check email";
            }

            if(count($errors) > 0) {
                foreach($errors as $error) {
                    echo $error;
                }
            }else{
                $users = new Users();
                $result = $users->loginUser($email,$password);
            }
        }
    }

    public function RegisterController() {
        if(isset($_POST['btnRegister'])){
            $errors= [];

            $email = trim($_POST['email']);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

            if($email == '') {
                $errors[] = "Check email";
            }elseif (!preg_match($regex, $email)) {
                $errors[] = "Invalid email format";
            }

            if(count($errors) > 0) {
                foreach($errors as $error) {
                    echo $error;
                }
            }else{
                $users = new Users();
                $result = $users->registerUser($email,$password);
            }
        }
    }

}