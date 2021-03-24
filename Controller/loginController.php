<?php

include_once "Model/Users.php";

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
?>