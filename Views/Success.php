<?php
if($_SESSION['email'] == '') {
    header('location: index.php?page=login');
}
include_once "./Model/User.php";

?>
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
            <h1>List of users</h1>
        </div>
    </div>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
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
        <th scope="row"> <?php echo $row['id']; ?></th>
        <td> <?php echo $row['email']; ?></td>
        <td><a href="index.php?page=user&id=<?php echo $row['id'] ?>" type="button" class="btn btn-outline-success">Show</a>
            <a href="index.php?page=edit&id=<?php echo $row['id'] ?>" class="btn btn-outline-primary">Edit</a>
            <a href="index.php?page=delete&id=<?php echo $row['id'] ?>" class="btn btn-outline-danger">Delete</a>
        </td>
    </tr>
    <?php }} ?>
    </tbody>
</table>


