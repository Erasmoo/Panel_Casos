<?php
require_once '../../config/database.php';
require_once '../../controllers/UsuarioController.php';

$error = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Agregar Usuario</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }

    body {
      background-color: #f0f2f5;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .form-container {
      background-color: #fff;
      padding: 2.5rem 3rem;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
      width: 100%;
      max-width: 480px;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      font-size: 1.75rem;
      color: #1a202c;
    }

    .input-group {
      margin-bottom: 1.25rem;
      position: relative;
    }

    .input-group input,
    .input-group select {
      width: 100%;
      padding: 1rem 0.75rem;
      border: 1px solid #cbd5e0;
      border-radius: 8px;
      background-color: #f9fafb;
      font-size: 1rem;
      transition: 0.3s;
    }

    .input-group input:focus,
    .input-group select:focus {
      border-color: #3182ce;
      background-color: #fff;
      box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
      outline: none;
    }

    .input-group label {
      position: absolute;
      top: -10px;
      left: 12px;
      background: white;
      padding: 0 5px;
      font-size: 0.85rem;
      color: #4a5568;
    }

    .btn-group {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
    }

    .btn-outline {
      padding: 0.75rem 1rem;
      border: 1px solid #cbd5e0;
      border-radius: 6px;
      background: none;
      text-decoration: none;
      color: #4a5568;
      font-weight: 500;
      transition: 0.3s;
    }

    .btn-outline:hover {
      background-color: #edf2f7;
    }

    .submit-btn {
      flex: 1;
      padding: 0.75rem 1rem;
      background-color: #3182ce;
      border: none;
      border-radius: 6px;
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #2b6cb0;
    }

    .error-message {
      color: #e53e3e;
      text-align: center;
      margin-bottom: 1rem;
      font-weight: 500;
    }

    @media (max-width: 480px) {
      .form-container {
        padding: 2rem;
      }
    }
  </style>
</head>
<body>
  <form class="form-container" action="../../controllers/UsuarioController.php" method="POST">
    <h2>Agregar Usuario</h2>

    <?php if (!empty($error)) echo "<div class='error-message'>$error</div>"; ?>

    <div class="input-group">
      <label for="usuario">Usuario</label>
      <input id="usuario" name="usuario" type="text" required />
    </div>

    <div class="input-group">
      <label for="password">Contraseña</label>
      <input id="password" name="password" type="password" required />
    </div>

    <div class="input-group">
      <label for="apellido_paterno">Apellido Paterno</label>
      <input id="apellido_paterno" name="apellido_paterno" type="text" required />
    </div>

    <div class="input-group">
      <label for="apellido_materno">Apellido Materno</label>
      <input id="apellido_materno" name="apellido_materno" type="text" required />
    </div>

    <div class="input-group">
      <label for="estado">Estado</label>
      <select id="estado" name="estado" required>
        <option value="" disabled selected>Seleccionar Estado</option>
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
      </select>
    </div>

    <div class="input-group">
      <label for="rol">Rol</label>
      <select id="rol" name="rol" required>
        <option value="" disabled selected>Seleccionar Rol</option>
        <option value="1">Administrador</option>
        <option value="2">Encargado</option>
      </select>
    </div>

    <div class="btn-group">
      <a href="../admin_usuarios.php" class="btn-outline">← Volver</a>
      <button class="submit-btn" type="submit">Registrar</button>
    </div>
  </form>
</body>
</html>
