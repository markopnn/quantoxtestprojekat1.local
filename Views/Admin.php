<?php

if($_SESSION['email'] == '' || $_SESSION['id_role'] == 2) {
    header('location: index.php?page=login');
}

include_once "./Model/User.php";
?>
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
            <h1>Admin panel</h1>
        </div>
    </div>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $users = new Users();
    $rows = $users->ListUser();
        if($rows != NULL){
            foreach ($rows as $row) {
    ?>
    <tr>
        <td scope="row"> <?php echo $row['id_user']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <th scope="row"><?php echo $row['role_name']; ?></th>
        <td><a href="index.php?page=user&id=<?php echo $row['id_user'] ?>" type="button" class="btn btn-outline-success">Show</a>
            <a href="index.php?page=edit&id=<?php echo $row['id_user'] ?>" class="btn btn-outline-primary">Edit</a>
            <a href="index.php?page=delete&id=<?php echo $row['id_user'] ?>" class="btn btn-outline-danger">Delete</a>
        </td>
    </tr>
    <?php }} ?>
    </tbody>
</table>


