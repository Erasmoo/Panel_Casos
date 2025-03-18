<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

require_once '../controllers/UsuarioController.php';
$usuarioController = new UsuarioController();
$usuarios = $usuarioController->listarUsuarios();
?>

<?php
require_once 'layouts/header.php';
require_once 'layouts/sidebar_admin.php';
?>
<main>
    <h2>Gestión de Usuarios</h2>

    <h3>Crear Usuario</h3>
    <form method="POST" action="../controllers/UsuarioController.php">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <select name="rol">
            <option value="admin">Administrador</option>
            <option value="encargado">Encargado</option>
        </select>
        <button type="submit" name="crear">Crear</button>
    </form>

    <h3>Lista de Usuarios</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario) : ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= $usuario['usuario'] ?></td>
                <td><?= $usuario['rol'] ?></td>
                <td>
                    <form method="POST" action="../controllers/UsuarioController.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                        <input type="text" name="usuario" value="<?= $usuario['usuario'] ?>" required>
                        <input type="password" name="password" placeholder="Nueva Contraseña (opcional)">
                        <select name="rol">
                            <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                            <option value="encargado" <?= $usuario['rol'] == 'encargado' ? 'selected' : '' ?>>Encargado</option>
                        </select>
                        <button type="submit" name="editar">Editar</button>
                    </form>
                    <form method="POST" action="../controllers/UsuarioController.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                        <button type="submit" name="eliminar" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

   
</main>
<?php require_once 'layouts/footer.php'; ?>
