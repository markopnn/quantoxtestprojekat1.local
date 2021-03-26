<?php

include ('Config/Database.php');

/**
 * Class Auth
 * The class use for login and register user.
 *
 * @package    quantoxtestprojekat1.local
 * @author     Marko Milojkovic <marko.milojkovic@quantox.com>
 *
 *
 */
class Auth extends Database {

    /**
     *
     * @param string $email
     * @param string $password
     *
     */
    public function RegisterUser($email,$password,$id_role) {
        $checkEmail = $this->getConnection()->prepare("SELECT email from users WHERE email=? LIMIT 1");
        $checkEmail->execute(array($email));
        $result = $checkEmail->fetch();
        if($result != TRUE) {
            $stmt = $this->getConnection()->prepare("INSERT INTO users (email,password,id_role) VALUES (:email,:password,:id_role);");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id_role', $id_role);
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

        $stmt = $this->getConnection()->prepare("SELECT * FROM users WHERE email=? LIMIT 1 ");
        $stmt->execute(array($email));
        $result = $stmt->fetch();

        if($stmt->rowCount() >= 1) {
            $auth = password_verify($password, $result['password']);
            if ($auth == TRUE) {

                $_SESSION['email'] =  $result['email'];
                $_SESSION['id'] =  $result['id'];
                $_SESSION['id_role'] =  $result['id_role'];
                header('Location: index.php?page=success');
                exit;
            }
        } else {
            Echo "Check email or password";
        }
    }
}
?>