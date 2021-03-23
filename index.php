
<?php
session_start();
function __autoload($class) {
    require_once "class/$class.php";
}
include('class/Login.php');
?>
<html>
	<head>
		<title>Login page</title></head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<body>
        <div class="container">
            <h1>Hello world</h1>
            <div class="main">
                <div class="col-md-6 col-sm-12">
                    <div class="login-form pt-6">
                        <form method="post" action="http://quantoxtestprojekat1.local/">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="User Name" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                            <?php if (isset($_SESSION['error']))  { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_SESSION['error'] ;?>
                                </div>
                            <?php }?>
                            <button type="submit" class="btn btn-secondary" name="btnLogin">Login</button>
                        </form>
                    </div>
                </div>
              </div>
            <div>
	</body>
</html>
