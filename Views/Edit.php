<?php
include_once "./Model/User.php";
include("Controller/UserController.php");
?>

<?php
$id = $_GET['id'];
$user = new Users();
$row = $user->ShowUser($id);

$update = new UserController();
$update->update();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
            <form method="post" action="index.php?page=edit&id=<?php echo $row['id'] ?>">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php echo $row['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter new password">
                </div>
                <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                <button type="submit" name="btnEdit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>

