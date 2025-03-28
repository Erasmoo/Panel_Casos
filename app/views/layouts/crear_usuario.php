<?php
require_once '../../config/database.php';
require_once '../../controllers/UsuarioController.php';

$error = $_GET['error'] ?? '';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="../public/css/usuario.css">
</head>
<body>
    <h2>Agregar Usuario</h2>
    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form action="../../controllers/UsuarioController.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <input type="text" name="apellido_paterno" placeholder="Apellido Paterno" required>
        <input type="text" name="apellido_materno" placeholder="Apellido Materno" required>
        <select name="estado" required>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>
        <select name="rol" required>
            <option value="1">Administrador</option>
            <option value="2">Encargado</option>
        </select>
        <button type="submit">Registrar</button>
    </form>

    <a href="../admin_usuarios.php">Volver</a>
</body>
</html>
