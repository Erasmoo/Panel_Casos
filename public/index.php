<?php
session_start();
require_once '/../config/database.php';

if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] === 'admin') {
        header('Location: views/admin.php');
    } else {
        header('Location: views/encargado.php');
    }
    exit();
}

header('Location: views/login.php');
?>
