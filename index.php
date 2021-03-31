<?php

session_start();

require_once  'vendor/autoload.php';
function __autoload($class) {
    require_once "Config/$class.php";
}

// Include router class
include('route.php');

// Add base route (startpage) - login page
Route::add('/',function(){
   include_once 'Views/Login.php';
}, 'get');
Route::add('/',function(){
    include_once 'Views/Login.php';
},'post');

// Logout session
Route::add('/logout',function(){
    include_once 'Controller/AuthController.php';
    $logout = new AuthController();
    $logout->logout();
}, 'get');


// Register page
Route::add('/register',function(){
    include_once 'Views/Register.php';
}, 'get');
Route::add('/register',function(){
    include_once 'Views/Register.php';
},'post');

// Admin page
Route::add('/admin',function(){
    include_once 'Views/Admin.php';
}, 'get');

// Get profile of user
Route::add('/admin/([0-9]*)',function($id){
    include "Views/User.php";
});

// Edit profile page
Route::add('/admin/([0-9]*)/edit',function($id){
    include "Views/Edit.php";
},'get');
Route::add('/admin/([0-9]*)/edit',function($id){
    include "Views/Edit.php";
},'post');

// Delete user
Route::add('/admin/([0-9]*)/delete',function($id){
    include_once 'Controller/UserController.php';
    $delete = new UserController();
    $delete->delete($id);
}, 'get');

// Manager page
Route::add('/manager',function(){
    include_once 'Views/Manager.php';
}, 'get');

//tickets
Route::add('/tickets',function(){
    include_once 'Views/Tickets.php';
}, 'get');
Route::add('/tickets',function(){
    include_once 'Controller/TicketController.php';
    $create = new TicketController();
    $create->create();
},'post');
Route::add('/tickets/([0-9]*)/delete',function($id){
    include_once 'Controller/TicketController.php';
    $delete = new TicketController();
    $delete->delete($id);
}, 'get');
Route::add('/tickets/edit',function(){
    include_once 'Controller/TicketController.php';
    $delete = new TicketController();
    $delete->update();
}, 'post');

Route::run('/');
?>