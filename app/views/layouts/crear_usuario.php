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
  <link rel="stylesheet" href="../public/css/usuariocrear.css">




</head>
<body>

  <form class="form-control" action="../../controllers/UsuarioController.php" method="POST">
    <p class="title">Agregar Usuario</p>

    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <div class="input-field">
      <input required name="usuario" class="input" type="text" />
      <label class="label">Usuario</label>
    </div>

    <div class="input-field">
      <input required name="password" class="input" type="password" />
      <label class="label">Contraseña</label>
    </div>

    <div class="input-field">
      <input required name="apellido_paterno" class="input" type="text" />
      <label class="label">Apellido Paterno</label>
    </div>

    <div class="input-field">
      <input required name="apellido_materno" class="input" type="text" />
      <label class="label">Apellido Materno</label>
    </div>

    <div class="input-field">
      <select required name="estado" class="input">
        <option value="" disabled selected>Seleccionar Estado</option>
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
      </select>
      
    </div>

    <div class="input-field">
      <select required name="rol" class="input">
        <option value="" disabled selected>Seleccionar Rol</option>
        <option value="1">Administrador</option>
        <option value="2">Encargado</option>
      </select>
      
    </div>

    <button class="submit-btn" type="submit">Registrar</button>
    <a href="../admin_usuarios.php">Volver</a>
  </form>

</body>

</html>
<style>
  * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background-color: #f1f5f9;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  padding: 1rem;
}

form.form-control {
  background-color: #ffffff;
  padding: 2rem 2.5rem;
  border-radius: 16px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
  width: 100%;
  max-width: 500px;
}

.title {
  font-size: 1.8rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  color: #2d3748;
  text-align: center;
}

.input-field {
  position: relative;
  margin-bottom: 1.5rem;
}

.input {
  width: 100%;
  padding: 1rem 0.75rem;
  border: 1px solid #cbd5e0;
  border-radius: 8px;
  outline: none;
  font-size: 1rem;
  background-color: #f9fafb;
  transition: all 0.3s ease;
}

.input:focus {
  border-color: #4299e1;
  background-color: #fff;
  box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
}

.label {
  position: absolute;
  top: -0.75rem;
  left: 0.75rem;
  background-color: #ffffff;
  padding: 0 0.25rem;
  font-size: 0.875rem;
  color: #4a5568;
  transition: all 0.3s ease;
}

select.input {
  appearance: none;
  background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20fill%3D'%236b7280'%20viewBox%3D'0%200%2024%2024'%20xmlns%3D'http%3A//www.w3.org/2000/svg'%3E%3Cpath%20d%3D'M7%2010l5%205%205-5z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 1rem;
  cursor: pointer;
}

.submit-btn {
  width: 100%;
  background-color: #4299e1;
  color: #fff;
  padding: 0.9rem;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 0.5rem;
}

.submit-btn:hover {
  background-color: #2b6cb0;
}

a {
  display: inline-block;
  margin-top: 1rem;
  text-align: center;
  color: #4a5568;
  text-decoration: none;
  font-size: 0.95rem;
}

a:hover {
  color: #2c5282;
  text-decoration: underline;
}

p[style*='color: red'] {
  margin-bottom: 1rem;
  text-align: center;
  font-weight: 500;
}

</style>

