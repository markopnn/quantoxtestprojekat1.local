<?php

include_once "Model/User.php";


if( $_GET['id'] == $_SESSION['id']) {
    echo "You can't delete yourself";
} elseif(isset($_GET['id'])){
        $id = $_GET['id'];
        $users = new Users();
        $result = $users->DeleteUser($id);
}
?>