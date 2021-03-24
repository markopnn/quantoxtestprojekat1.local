<?php

include_once "Model/Users.php";


if(isset($_POST['btnRegister'])){
        $email = trim($_POST['email']);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

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
            $result = $users->registerUser($email,$password);
        }
    }
?>