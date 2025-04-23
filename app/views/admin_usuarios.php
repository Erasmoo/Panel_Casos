<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'administrador') {
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




<div class="content-wrapper">
  <main class="dashboard-table">
    <h3>Lista de Usuarios</h3>

    <?php if (isset($_GET['mensaje'])): ?>
        <div class="alert alert-success">
            <?= $_GET['mensaje'] === 'actualizado' ? 'Usuario actualizado correctamente.' : 'Usuario eliminado correctamente.' ?>
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Ocurrió un error.</div>
    <?php endif; ?>

    <a href="layouts/crear_usuario.php" class="btn btn-primary btn-rounded mb-3">
        <i class="fa-solid fa-plus"></i>&nbsp;AGREGAR USUARIO
    </a>

    

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Rol</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $dato) : ?>
            <tr>
                <td><?= $dato['id'] ?></td>
                <td>
                    <div class="user-info">
                        <img src="https://i.pravatar.cc/40?u=<?= $dato['id'] ?>" alt="avatar">
                        <div>
                            <strong><?= $dato['usuario'].' '.$dato['apellidopa'] ?></strong><br>
                            <small><?= $dato['apellidoma'] ?></small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge <?= $dato['estado'] == 'activo' ? 'badge-success' : 'badge-danger' ?>">
                        <?= strtoupper($dato['estado']) ?>
                    </span>
                </td>
                <td><?= $dato['rol'] ?></td>
                <td>
                    <a href="layouts/editar_usuario.php?id=<?= $dato['id'] ?>" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-edit"></i> Editar
                    </a>
                    <a class="btn btn-danger btn-sm" onclick="advertencia(event)" href="../controllers/editarController.php?eliminar=<?= $dato['id'] ?>">
                        <i class="fa-solid fa-trash"></i> Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </main>
</div>

<script>
function advertencia(event) {
    event.preventDefault(); // Previene que el enlace se dispare automáticamente

    const url = event.currentTarget.getAttribute('href');

    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Este usuario será eliminado permanentemente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>


<?php require_once 'layouts/footer.php'; ?>





