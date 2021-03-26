<?php

if($_SESSION['email'] == '') {
    header('location: index.php?page=login');
}

?>

<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
             <h1>Welcome <?= $_SESSION['email'] ?></h1>
        </div>
    </div>
</div>
