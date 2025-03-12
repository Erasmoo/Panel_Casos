<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'encargado') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Encargado</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?> (Encargado)</h2>
    <a href="../controllers/logout.php">Cerrar sesión</a>
</body>
</html>
