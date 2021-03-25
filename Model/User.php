<?php

include ('Config/Database.php');

/**
 * Class Users
 * The class use for login and register user.
 *
 * @package    quantoxtestprojekat1.local
 * @author     Marko Milojkovic <marko.milojkovic@quantox.com>
 *
 *
 */
class Users extends Database {

    /**
     *
     * @param string $email
     * @param string $password
     *
     */
    public function RegisterUser($email,$password) {
        $checkEmail = $this->connect()->prepare("SELECT email from users WHERE email=? LIMIT 1");
        $checkEmail->execute(array($email));
        $result = $checkEmail->fetch();
        if($result != TRUE) {
            $stmt = $this->connect()->prepare("INSERT INTO users (email,password) VALUES (:email,:password);");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $result = $stmt->execute();

            $success = [];
            if ($result == TRUE) {
                $success[] = "successful registration";
            }
            if (count($success) > 0) {
                foreach ($success as $msg)
                    echo $msg;
            }
        }else {
            echo "Email exists";
        }
    }

    /**
     * @param string $email
     * @param string $password
     */
    public function LoginUser($email,$password)
    {

        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email=? LIMIT 1 ");
        $stmt->execute(array($email));
        $result = $stmt->fetch();

        if($stmt->rowCount() >= 1) {
            $auth = password_verify($password, $result['password']);
            if ($auth == TRUE) {
                $_SESSION['email'] =  $result['email'];
                header('Location: index.php?page=success');
                exit;
             }
        } else {
            Echo "Check email or password";
        }
    }
}
?>