<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <?php if(isset($_SESSION['email'])=='') { ?>
            <li class="nav-item">
                <a class="nav-link" href="/">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Register</a>
            </li>
            <?php } ?>
            <?php if(!isset($_SESSION['id_role'])=='') {
                if($_SESSION['id_role'] == 1) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/tickets">Tickets</a>
                </li>
            <?php }} ?>
            <?php if(!isset($_SESSION['email'])=='') { ?>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>