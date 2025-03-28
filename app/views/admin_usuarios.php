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




<main>
    
    <h3>Lista de Usuarios</h3>

    <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success">
                <?= $_GET['mensaje'] === 'actualizado' ? 'Usuario actualizado correctamente.' : 'Usuario eliminado correctamente.' ?>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger">Ocurrió un error.</div>
        <?php endif; ?>

    <a href="layouts/crear_usuario.php" class="btn btn-primary btn-rounded" ><i class="fa-solid fa-plus"></i>&nbsp;AGREGAR USUARIO</a>
    <div class="container mt-4">

    <table id="miTabla" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Estado</th>
                <th>Rol</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $dato) : ?>
            <tr>
                <th><?= $dato['id'] ?></th>
                <td><?= $dato['usuario'].' '.$dato['apellidopa'].' '.$dato['apellidoma'] ?></td>
                <td><?= $dato['estado'] ?></td>
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
</div>


   
</main>
<?php require_once 'layouts/footer.php'; ?>


<script>
function advertencia(event) {
    event.preventDefault(); // Evita que se elimine de inmediato
    let url = event.currentTarget.href;

    if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
        window.location.href = url;
    }
}
</script>



