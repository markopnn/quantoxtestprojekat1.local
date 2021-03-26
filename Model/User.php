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
    public function ListUser() {
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
    public function ShowUser($id) {
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
    public function EditUserWithPassword($email,$id,$editPassword,$id_role) {
        $stmt = $this->getConnection()->prepare( "UPDATE users SET email= :email, password = :editPassword, id_role= :id_role WHERE id= :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_role', $id_role);
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
    public function EditUserWithoutPassword($email,$id,$id_role) {
        $stmt = $this->getConnection()->prepare( "UPDATE users SET email= :email, id_role= :id_role WHERE id= :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_role', $id_role);
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
        $stmt = $this->getConnection()->prepare( "DELETE FROM users WHERE id= :id");
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