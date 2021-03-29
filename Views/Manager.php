<?php

if($_SESSION['email'] == '') {
    header('location: index.php?page=login');
}

?>
<?php
include "Views/Components/Header.php";
include "Views/Components/Nav.php";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
             <h1>Welcome <?= $_SESSION['email'] ?></h1>
        </div>
    </div>
</div>
<?php
include "Views/Components/Footer.php";
?>