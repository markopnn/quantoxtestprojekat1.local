<?php

include ('Config/Database.php');

/**
 * Class Users
 * The class use for user information.
 *
 * @package    quantoxtestprojekat1.local
 * @author     Marko Milojkovic <marko.milojkovic@quantox.com>
 *
 *
 */
class Users extends Database {

    /**
     * @return array
     */
    public function listUser() {
        $stmt = "SELECT u.id as id_user,u.email,r.name as role_name FROM users u INNER JOIN roles r ON u.id_role=r.id";
        $result = $this->getConnection()->query($stmt);

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
    public function showUser($id) {
        $stmt = "SELECT u.id as id_user,u.email as user_email,r.id as role_id,r.name as role_name FROM users u INNER JOIN roles r ON u.id_role=r.id WHERE u.id=$id LIMIT 1";
        $result = $this->getConnection()->query($stmt);

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
    public function editUserWithPassword($email,$id,$editPassword,$id_role) {
        $stmt = $this->getConnection()->prepare( "UPDATE users SET email= :email, password = :editPassword, id_role= :id_role WHERE id= :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_role', $id_role);
        $stmt->bindParam(':editPassword', $editPassword);
        $result = $stmt->execute();

        // if user edit own profile , create new session
        if($_SESSION['id'] == $id) {
            unset($_SESSION['email']);
            $_SESSION['email'] =  $email;
        }

        if ($result == TRUE) {
            header('location: /admin');
        }
    }

    /**
     * @param $email
     * @param $id
     */
    public function editUserWithoutPassword($email,$id,$id_role) {
        $stmt = $this->getConnection()->prepare( "UPDATE users SET email= :email, id_role= :id_role WHERE id= :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_role', $id_role);
        $result = $stmt->execute();

        // if user edit own profile , create new session
        if($_SESSION['id'] == $id) {
            unset($_SESSION['email']);
            $_SESSION['email'] =  $email;
        }

        if ($result == TRUE) {
            header('location: /admin');
        }
    }

    /**
     * @param $id
     */
    public function deleteUser($id) {
        $stmt = $this->getConnection()->prepare( "DELETE FROM users WHERE id= :id");
        $stmt->bindParam(':id', $id);
        try{
            $result = $stmt->execute();
            if ($result == TRUE) {
                header('location: /admin');
            }
        }catch (Exception $e) {
            die("Oh noes! There's an error in the query!");
        }
    }
}
?>