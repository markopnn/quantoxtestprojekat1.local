<?php

class Users extends Database {

    public function registerUser($email,$password) {
        $stmt = $this->connect()->prepare("INSERT INTO users (email,password) VALUES (:email,:password);");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $result = $stmt->execute();

        $success = [];
        if($result == TRUE) {
            $success[] = "successful registration";
        }
        if(count($success) > 0) {
            foreach ($success as $msg)
            echo $msg;
        }
    }

    public function loginUser($email,$password)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email=? LIMIT 1 ");
        $stmt->execute(array($email));
        $result = $stmt->fetch();

        if($stmt->rowCount() >= 1) {
            $auth = password_verify($password, $result['password']);
            if ($auth == TRUE) {
                $_SESSION['email'] =  $result['email'];
                header('Location: index.php');
                exit;
             }
        }
    }
}
?>