<?php

include('Config/Database.php');

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
        $stmt = $this->getConnection()->prepare("SELECT u.id as id_user,u.email as user_email,r.id as role_id,r.name as role_name FROM users u INNER JOIN roles r ON u.id_role=r.id WHERE u.id=? LIMIT 1");
        $stmt->execute(array($id));
        return  $data = $stmt->fetch();
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

            //action_log
            $user = new Users();
            $row = $user->showUser($id);
            $profile =  $row['user_email'];
            $action = "Edit profile".$profile;
            $id_user = $_SESSION['id'];
            $created_at = date('Y/m/d H:i:s');
            $stmt = $this->getConnection()->prepare( "INSERT INTO action_log (action,id_user,created_at) VALUES (:action,:id_user,:created_at)");
            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':created_at', $created_at);
            $action_log = $stmt->execute();

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
           
            //action_log
            $user = new Users();
            $row = $user->showUser($id);
            $profile =  $row['user_email'];
            $action = "Edit profile: ".$profile;
            $id_user = $_SESSION['id'];
            $created_at = date('Y/m/d H:i:s');
            $stmt = $this->getConnection()->prepare( "INSERT INTO action_log (action,id_user,created_at) VALUES (:action,:id_user,:created_at)");
            $stmt->bindParam(':action', $action);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':created_at', $created_at);
            $action_log = $stmt->execute();
            
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

            //action_log
            $user = new Users();
            $row = $user->showUser($id);
            $profile =  $row['user_email'];
            $action = "Delete profile: ".$profile;
            $id_user = $_SESSION['id'];
            $created_at = date('Y/m/d H:i:s');

            $result = $stmt->execute();
            if ($result == TRUE) {

                //action log
                $stmt = $this->getConnection()->prepare( "INSERT INTO action_log (action,id_user,created_at) VALUES (:action,:id_user,:created_at)");
                $stmt->bindParam(':action', $action);
                $stmt->bindParam(':id_user', $id_user);
                $stmt->bindParam(':created_at', $created_at);
                $result = $stmt->execute();

                header('location: /admin');
            }
        }catch (Exception $e) {
            die("Oh noes! There's an error in the query!");
        }
    }
}
?>