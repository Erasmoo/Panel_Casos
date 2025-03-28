<?php
require_once '../../controllers/editarController.php';

$usuarioController = new UsuarioController();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../admin_usuarios.php?error=missing_id");
    exit();
}

$usuario = $usuarioController->editar($_GET['id']);

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form action="../../controllers/editarController.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

    <label>Usuario:</label>
    <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required>

    <label>Apellido Paterno:</label>
    <input type="text" name="apellidopa" value="<?= htmlspecialchars($usuario['apellidopa']) ?>" required>

    <label>Apellido Materno:</label>
    <input type="text" name="apellidoma" value="<?= htmlspecialchars($usuario['apellidoma']) ?>" required>

    <label>Estado:</label>
    <select name="estado">
        <option value="activo" <?= $usuario['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
        <option value="inactivo" <?= $usuario['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
    </select>

    <label>Rol:</label>
    <input type="number" name="rol" value="<?= htmlspecialchars($usuario['rol_id']) ?>" required>

    <label>Nueva Contraseña (Opcional):</label>
    <input type="password" name="password">

    <button type="submit">Actualizar</button>
</form>

</body>
</html>
