<?php
include("class/Database.php");
?>
<?php
$msg = "";
if(isset($_POST['btnLogin'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if($email != "" && $password != "") {
        try {
            $query = "select * from `users` where `email`=:email and `password`=:password";
            $stmt = $conn->prepare($query);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if($count == 1 && !empty($row)) {
                $_SESSION['sess_user_id']   = $row['id'];
                $_SESSION['sess_user_email'] = $row['email'];
            } else {
                $_SESSION['error'] = "Check email or password";
            }

        } catch (PDOException $e) {
            echo "Error : ".$e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Check email or password";
    }
}

?>