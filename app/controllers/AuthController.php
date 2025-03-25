<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $userModel = new Usuario();
    $user = $userModel->verificarUsuario($usuario, $password);


    if ($user) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = $user['rol'];

        if ($user['rol'] == 'administrador') {
            header("Location: ../views/admin.php");
        } else {
            header("Location: ../views/encargado.php");
        }
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='../views/login.php';</script>";
    }
}


?>
