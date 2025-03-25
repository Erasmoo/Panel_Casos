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

    <a href="layouts/crear_usuario.php" class="btn btn-primary btn-rounded" ><i class="fa-solid fa-plus"></i>&nbsp;AGREGAR USUARIO</a>
    <div class="container mt-4">

    <table id="miTabla" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido ma</th>
                <th>Apellido PA</th>
                <th>Estado</th>
                <th>Rol</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $dato) : ?>
            <tr>
                <th><?= $dato['id'] ?></th>
                <td><?= $dato['usuario'] ?></td>
                <td><?= $dato['apellidopa'] ?></td>
                <td><?= $dato['apellidoma'] ?></td>
                <td><?= $dato['estado'] ?></td>
                <td><?= $dato['rol'] ?></td>
                
                <td>
                    <a href="" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="btn btn-danger btn-sm" onclick="advertencia(event)" href="usuario.php?id=<?= $dato['id'] ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>              
            </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>
</div>


   
</main>
<?php require_once 'layouts/footer.php'; ?>

