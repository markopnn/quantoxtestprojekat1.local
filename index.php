<?php
session_start();
if(!isset($_SESSION['email'])=='') {
    echo "Hello world";
}

function __autoload($class) {
    require_once "Config/$class.php";
}

$page = "";
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
include "Views/Components/Header.php";
include "Views/Components/Nav.php";
switch($page){
    case "register":
        include "Views/Register.php";
        break;
    case "logout":
        include "Views/Logout.php";
        break;
    default:
        include "Views/Login.php";
        break;
}
include "Views/Components/Footer.php";
?>