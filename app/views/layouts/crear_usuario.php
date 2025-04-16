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

