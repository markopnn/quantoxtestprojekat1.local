<?php

include_once "Model/User.php";


if(isset($_POST['btnEdit'])){
    $errors= [];

    $email = trim($_POST['email']);
    $id = trim($_POST['id']);

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

        if(trim($_POST['password']) !='') {
            $editPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $result = $users->EditUserWithPassword($email,$id,$editPassword);
        } else {
            $result = $users->EditUserWithoutPassword($email,$id);
        }
    }
}
?>