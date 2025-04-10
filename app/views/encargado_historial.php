<?php
require_once 'layouts/header.php';
require_once 'layouts/sidebar_encargado.php';
require_once '../controllers/CasosController.php';

session_start();

$casosController = new CasosController();
$casosResueltos = $casosController->obtenerCasosResueltosPorEncargado($_SESSION['usuario']);

?>
<main>
    <h2>Historial de Casos Resueltos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($casosResueltos as $caso): ?>
            <tr>
                <td><?= htmlspecialchars($caso['id_caso']) ?></td>
                <td><?= htmlspecialchars($caso['descripcion']) ?></td>
                <td><?= htmlspecialchars($caso['fecha_inicio']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php require_once 'layouts/footer.php'; ?>
