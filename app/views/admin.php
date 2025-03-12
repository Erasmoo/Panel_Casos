<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?> (Administrador)</h2>
    <a href="../controllers/logout.php">Cerrar sesión</a>
</body>
</html>
