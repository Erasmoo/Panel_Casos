<?php
require_once '../models/Usuario.php';

$usuarioModel = new Usuario();
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: admin_usuarios.php?error=" . urlencode("ID de usuario no válido."));
    exit();
}

$usuario = $usuarioModel->obtenerUsuarioPorId($id);

if (!$usuario) {
    header("Location: admin_usuarios.php?error=" . urlencode("Usuario no encontrado."));
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h2>Editar Usuario</h2>

    <form action="../controllers/UsuarioController.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required>

        <label>Contraseña (dejar en blanco para no cambiar):</label>
        <input type="password" name="password">

        <label>Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" value="<?= htmlspecialchars($usuario['apellidopa']) ?>" required>

        <label>Apellido Materno:</label>
        <input type="text" name="apellido_materno" value="<?= htmlspecialchars($usuario['apellidoma']) ?>" required>

        <label>Estado:</label>
        <select name="estado">
            <option value="activo" <?= $usuario['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
            <option value="inactivo" <?= $usuario['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
        </select>

        <label>Rol:</label>
        <select name="rol">
            <option value="1" <?= $usuario['rol_id'] == 1 ? 'selected' : '' ?>>Administrador</option>
            <option value="2" <?= $usuario['rol_id'] == 2 ? 'selected' : '' ?>>Usuario</option>
        </select>

        <button type="submit" name="actualizar">Actualizar Usuario</button>
    </form>
</body>
</html>
