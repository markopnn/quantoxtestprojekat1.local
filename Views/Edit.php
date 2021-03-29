<?php
include("Controller/UserController.php");
include_once "./Model/User.php";
include_once "./Model/Role.php";

    if(isset($id))
    {
        $user = new Users();
        $row = $user->ShowUser($id);

        $update = new UserController();
        $update->update();
    }
?>
<?php
include "Views/Components/Header.php";
include "Views/Components/Nav.php";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
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
                    <input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php echo $row['user_email'] ?>">
                </div>
                <div class="form-group">
                    <label for="password">Select role:</label>
                    <select class="form-control selectpicker" name="role" data-live-search="true" required>
                        <?php
                        $roles = new Role();
                        $rows = $roles->ListRoles();
                        if($rows != NULL){
                            foreach ($rows as $role) {
                                ?>
                                <option value="<?php echo $role['id'];?>" <?php if($role['id'] == $row['role_id']) { echo "selected";} ?>><?php echo $role['name'];?></option>
                            <?php }} ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter new password">
                </div>
                <input type="hidden" class="form-control" name="id" value="<?php echo $row['id_user'] ?>">
                <button type="submit" name="btnEdit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>
<?php
include "Views/Components/Footer.php";
?>
