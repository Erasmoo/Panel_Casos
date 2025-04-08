<?php
require_once '../config/database.php';
require_once '../controllers/CasosController.php';
require_once 'layouts/header.php';
require_once 'layouts/sidebar_admin.php';



$casosController = new CasosController();
$casosAsignados = $casosController->obtenerTodosLosCasosAsignados();
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
            <td><?= htmlspecialchars($caso['estado']) ?></td>
            <td><?= htmlspecialchars($caso['encargado_nombre'] . ' ' . $caso['apellido_pa'] . ' ' . $caso['apellido_ma']) ?></td>
            </tr>
    <?php endforeach; ?>
</table>

</main>
<?php require_once 'layouts/footer.php'; ?>
