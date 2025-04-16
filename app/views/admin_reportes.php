<?php
require_once '../config/database.php';
require_once '../controllers/CasosController.php';
require_once 'layouts/header.php';
require_once 'layouts/sidebar_admin.php';



$casosController = new CasosController();
$casosAsignados = $casosController->obtenerTodosLosCasosAsignados();

$casosController->manejarFormularioResolver();


?>

<main>
    <h2>Lista de Casos Asignados</h2>
    <table border="1">
    <tr>
        <th>ID Caso</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Encargado</th>
    </tr>
    <?php foreach ($casosAsignados as $caso): ?>
        <tr>
            <td><?= htmlspecialchars($caso['id_caso']) ?></td>
            <td><?= htmlspecialchars($caso['descripcion']) ?></td>
            <td>
                <?php if ($caso['estado'] === 'resuelto'): ?>
                    <span class="badge bg-success">Resuelto</span>
                <?php else: ?>
                    <span class="badge bg-warning text-dark">Pendiente</span>
                <?php endif; ?>
            </td>

            <td><?= htmlspecialchars($caso['encargado_nombre'] . ' ' . $caso['apellidopa'] . ' ' . $caso['apellidoma']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>


</main>
<?php require_once 'layouts/footer.php'; ?>
