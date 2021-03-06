<?php

if(isset($_SESSION['id_role'])) {
    if ($_SESSION['id_role'] == 1) {
        header('location: admin');
    } elseif ($_SESSION['id_role'] == 2) {
        header('location: manager');
    }
}

include("Controller/AuthController.php");
include("Model/Role.php");

$register = new AuthController();
$register->register();
?>

<?php
include "Views/Components/Header.php";
include "Views/Components/Nav.php";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
            <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
              <?php
              echo $_SESSION['success'];
              unset($_SESSION['success']);
              ?>
            </div>
            <?php } ?>
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="password">Select role:</label>
                     <select class="form-control selectpicker" name="role" data-live-search="true" required>
                         <?php
                            $roles = new Role();
                            $rows = $roles->ListRoles();
                                if($rows != NULL){
                                  foreach ($rows as $row) {
                         ?>
                              <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                         <?php }} ?>
                     </select>
                </div>
                <button type="submit" name="btnRegister" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
  </div>
</div>
<?php
include "Views/Components/Footer.php";
?>