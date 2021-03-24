<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if(isset($_SESSION['email'])=='') { ?>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=login">Login <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=register">Register <span class="sr-only">(current)</span></a>
            </li>
            <?php } ?>
            <?php if(!isset($_SESSION['email'])=='') { ?>
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>