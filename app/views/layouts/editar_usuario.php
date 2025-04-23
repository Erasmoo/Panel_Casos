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
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Editar Usuario</h2>
        </div>
        <div class="card-body">
            <form action="../../controllers/editarController.php" method="POST" class="row g-3">
                <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

                <div class="col-md-6">
                    <label class="form-label">Usuario:</label>
                    <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Apellido Paterno:</label>
                    <input type="text" name="apellidopa" value="<?= htmlspecialchars($usuario['apellidopa']) ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Apellido Materno:</label>
                    <input type="text" name="apellidoma" value="<?= htmlspecialchars($usuario['apellidoma']) ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Estado:</label>
                    <select name="estado" class="form-select">
                        <option value="activo" <?= $usuario['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="inactivo" <?= $usuario['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Rol:</label>
                    <input type="number" name="rol" value="<?= htmlspecialchars($usuario['rol_id']) ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nueva Contraseña (Opcional):</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">Actualizar</button>
                </div>
                <a href="../admin_usuarios.php">Volver</a>

            </form>
        </div>
    </div>
</div>

</body>
</html>

