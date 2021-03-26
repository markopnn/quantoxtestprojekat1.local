<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <?php if(isset($_SESSION['email'])=='') { ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=register">Register</a>
            </li>
            <?php } ?>
            <?php if(!isset($_SESSION['email'])=='') { ?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>