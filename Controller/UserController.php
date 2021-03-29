<?php

include_once "Model/User.php";

/**
 * Class UserController
 */
class UserController {

    public function update() {

        if(isset($_POST['btnEdit'])){
            $errors= [];

            $email = trim($_POST['email']);
            $id = trim($_POST['id']);
            $id_role = trim($_POST['role']);

            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

            if($email == '') {
                $_SESSION['error'] = 'Email and password are required';
            }elseif (!preg_match($regex, $email)) {
                $_SESSION['error'] = 'Invalid email format';
            }

            if(!isset($_SESSION['error']))
            {
                $users = new Users();

                if(trim($_POST['password']) !='') {
                    $editPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $result = $users->editUserWithPassword($email,$id,$editPassword,$id_role);
                } else {
                    $result = $users->editUserWithoutPassword($email,$id,$id_role);
                }
            }
        }
    }

    /**
     * @param $id
     */
    public function delete($id) {

        if( $id == $_SESSION['id']) {
            echo "You can't delete yourself";
        } elseif(isset($id)){
            $users = new Users();
            $result = $users->deleteUser($id);
        }
    }

}


?>