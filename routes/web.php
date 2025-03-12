<?php
require_once 'app/controllers/AuthController.php';

$auth = new AuthController();

if ($_SERVER['REQUEST_URI'] == '/login') {
    $auth->login();
} elseif ($_SERVER['REQUEST_URI'] == '/logout') {
    $auth->logout();
} elseif ($_SERVER['REQUEST_URI'] == '/admin') {
    require 'app/views/admin.php';
} elseif ($_SERVER['REQUEST_URI'] == '/encargado') {
    require 'app/views/encargado.php';
} else {
    require 'app/views/login.php';
}
?>

