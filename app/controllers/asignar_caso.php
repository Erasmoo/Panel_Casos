<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../views/login.php");
    exit();
}

require_once 'CasosController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['caso_id'], $_POST['encargado_id'])) {
    $caso_id = intval($_POST['caso_id']);
    $encargado_id = intval($_POST['encargado_id']);

    $casosController = new CasosController();
    if ($casosController->asignarCaso($caso_id, $encargado_id)) {
        header("Location: ../views/admin.php?success=1");
    } else {
        header("Location: ../views/admin.php?error=1");
    }
} else {
    header("Location: ../views/admin.php");
}

// EN PROCESO
?>


