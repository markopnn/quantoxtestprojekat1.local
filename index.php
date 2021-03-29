<?php
session_start();

require_once  'vendor/autoload.php';
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
    case "admin":
        include "Views/Admin.php";
        break;
    case "user":
        include "Views/User.php";
        break;
    case "edit":
        include "Views/Edit.php";
        break;
    case "delete":
        include "Views/Delete.php";
        break;
    case "manager":
        include "Views/Manager.php";
        break;
    default:
        include "Views/Login.php";
        break;
}
include "Views/Components/Footer.php";
?>