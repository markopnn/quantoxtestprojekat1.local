<?php
include("Controller/RegisterController.php");
if(isset($_SESSION['email'])) {
    if ($_SESSION['email'] != '') {
        header('Location: index.php?page=success');
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
            <form method="post" action="index.php?page=register">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
                <button type="submit" name="btnRegister" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
  </div>
</div>