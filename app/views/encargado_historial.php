<?php
require_once 'layouts/header.php';
require_once 'layouts/sidebar_encargado.php';
require_once '../controllers/CasosController.php';

session_start();

$casosController = new CasosController();
$casosResueltos = $casosController->obtenerCasosResueltosPorEncargado($_SESSION['usuario']);

?>

<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .table th {
        background-color: #4CAF50;
        color: white;
        text-align: center;
    }
    .table td {
        text-align: center;
    }
    .table td .btn {
        font-size: 14px;
        padding: 5px 10px;
    }
    .btn-ver {
        background-color: #17a2b8;
        color: white;
        border-radius: 5px;
    }
    .btn-ver:hover {
        background-color: #138496;
    }
    .table-container {
        margin-top: 20px;
    }
    .table-container h2 {
        font-size: 1.75rem;
        margin-bottom: 15px;
    }
    .table-container .alert {
        font-size: 1.1rem;
        padding: 15px;
        background-color: #f8f9fa;
        color: #333;
        border: 1px solid #ddd;
    }
</style>

<main>
    <div class="table-container">
        <h2>Historial de Casos Resueltos</h2>
        
        <!-- Mensaje de alerta si no hay casos -->
        <?php if (empty($casosResueltos)): ?>
            <div class="alert alert-warning" role="alert">
                No hay casos resueltos por el encargado.
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Denunciante</th>
                    <th>Descripción</th>
                    <th>Fecha Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($casosResueltos as $caso): ?>
                    <tr>
                        <td><?= htmlspecialchars($caso['dni_usuario']) ?></td>
                        <td><?= htmlspecialchars($caso['nombre'] . ' ' . $caso['apellido_paterno'] . ' ' . $caso['apellido_materno']) ?></td>
                        <td><?= htmlspecialchars($caso['descripcion']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($caso['fecha_fin'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php require_once 'layouts/footer.php'; ?>
