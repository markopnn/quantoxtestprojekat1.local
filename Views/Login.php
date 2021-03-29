<?php

if(isset($_SESSION['id_role'])) {
    if ($_SESSION['id_role'] == 1) {
        header('location: admin');
    } elseif ($_SESSION['id_role'] == 2) {
        header('location: manager');
    }
}

include("Controller/AuthController.php");

$login = new AuthController();
$login->login();
?>

<?php
include "Views/Components/Header.php";
include "Views/Components/Nav.php";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
            <form method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
                <button type="submit" name="btnLogin" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
<?php
include "Views/Components/Footer.php";
?>