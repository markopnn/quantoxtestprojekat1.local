<?php
    include_once "./Model/User.php";
?>

<?php
    $id = $_GET['id'];
    $user = new Users();
    $row = $user->ShowUser($id);
?>
<div class="container mt-5 d-flex justify-content-center">
    <div class="card p-3">
        <div class="d-flex align-items-center">
            <div class="image"> <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" class="rounded" width="155"> </div>
            <div class="ml-3 w-100">
                <h4 class="mb-0 mt-0"><?php echo $row['user_email'] ?></h4>
                <?php echo $row['role_name'] ?></p>
            </div>
        </div>
    </div>
</div>
