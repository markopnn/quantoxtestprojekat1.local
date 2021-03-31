<?php

include ('Config/Database.php');

/**
 * Class Auth
 * The class use for login and register user.
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
    public function registerUser($email,$password,$id_role) {
        $checkEmail = $this->getConnection()->prepare("SELECT email from users WHERE email=? LIMIT 1");
        $checkEmail->execute(array($email));
        $result = $checkEmail->fetch();
        if($result != TRUE) {
            $stmt = $this->getConnection()->prepare("INSERT INTO users (email,password,id_role) VALUES (:email,:password,:id_role);");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id_role', $id_role);
            $result = $stmt->execute();

            if ($result == TRUE) {
                $_SESSION['success'] = 'Successful registration';
            }
        }else {
            $_SESSION['error'] = 'Email exists';
        }
    }

    /**
     * @param string $email
     * @param string $password
     */
    public function loginUser($email,$password)
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

                //action_log
                $action = "Login to site";
                $id_user = $_SESSION['id'];
                $created_at = date('Y/m/d H:i:s');
                $stmt = $this->getConnection()->prepare( "INSERT INTO action_log (action,id_user,created_at) VALUES (:action,:id_user,:created_at)");
                $stmt->bindParam(':action', $action);
                $stmt->bindParam(':id_user', $id_user);
                $stmt->bindParam(':created_at', $created_at);
                $result = $stmt->execute();

                header('location: /');
                die;
            }
        } else {
            $_SESSION['error'] = 'Invalid email or password';
        }
    }
}
?>