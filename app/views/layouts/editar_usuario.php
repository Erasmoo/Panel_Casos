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
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            min-height: 100vh;
            
        }

        .card {
            border: none;
            border-radius: 1.5rem;
        }

        .card-header {
            background: #0d6efd;
            border-radius: 1.5rem 1.5rem 0 0;
        }

        .card-header h2 {
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-success {
            background-color: #198754;
            border: none;
        }

        .btn-success:hover {
            background-color: #157347;
        }

        a {
            display: inline-block;
            margin-top: 1rem;
            text-decoration: none;
            color: #0d6efd;
        }

        a:hover {
            text-decoration: underline;
            
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card shadow-lg mx-auto" style="max-width: 800px;">
        <div class="card-header text-white text-center py-3">
            <h2>Editar Usuario</h2>
        </div>
        <div class="card-body p-4">
            <form action="../../controllers/editarController.php" method="POST" class="row g-4">
                <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

                <div class="col-md-6">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Apellido Paterno</label>
                    <input type="text" name="apellidopa" value="<?= htmlspecialchars($usuario['apellidopa']) ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Apellido Materno</label>
                    <input type="text" name="apellidoma" value="<?= htmlspecialchars($usuario['apellidoma']) ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="activo" <?= $usuario['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="inactivo" <?= $usuario['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Rol</label>
                    <input type="number" name="rol" value="<?= htmlspecialchars($usuario['rol_id']) ?>" required class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nueva Contraseña (Opcional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="col-12 d-flex justify-content-between align-items-center mt-3">
                    <a href="../admin_usuarios.php" class="btn btn-outline-primary">← Volver</a>
                    <button type="submit" class="btn btn-success px-4">Actualizar</button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
