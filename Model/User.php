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
                $_SESSION['id'] =  $result['id'];
                header('Location: index.php?page=success');
                exit;
             }
        } else {
            Echo "Check email or password";
        }
    }

    /**
     * @return array
     */
    public function ListUser() {
        $stmt = "SELECT * FROM users";
        $result = $this->connect()->query($stmt);

        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function ShowUser($id) {
        $stmt = "SELECT * FROM users WHERE id=$id LIMIT 1";
        $result = $this->connect()->query($stmt);

        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data = $row;
            }
            return $data;
        }
    }

    /**
     * @param $email
     * @param $id
     * @param $editPassword
     */
    public function EditUserWithPassword($email,$id,$editPassword) {
        $stmt = $this->connect()->prepare( "UPDATE users SET email= :email, password = :editPassword WHERE id= :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':editPassword', $editPassword);
        $result = $stmt->execute();

        $success = [];
        if ($result == TRUE) {
            $success[] = "successful edit information";
        }
        if (count($success) > 0) {
            foreach ($success as $msg)
                echo $msg;
        }
    }

    /**
     * @param $email
     * @param $id
     */
    public function EditUserWithoutPassword($email,$id) {
        $stmt = $this->connect()->prepare( "UPDATE users SET email= :email WHERE id= :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();

        $success = [];
        if ($result == TRUE) {
            $success[] = "successful edit information";
        }
        if (count($success) > 0) {
            foreach ($success as $msg)
                echo $msg;
        }
    }

    /**
     * @param $id
     */
    public function DeleteUser($id) {
        $stmt = $this->connect()->prepare( "DELETE FROM users WHERE id= :id");
        $stmt->bindParam(':id', $id);
        try{
            $result = $stmt->execute();
            if ($result == TRUE) {
                header('Location: index.php?page=success');
            }
        }catch (Exception $e) {
            die("Oh noes! There's an error in the query!");
        }
    }
}
?>