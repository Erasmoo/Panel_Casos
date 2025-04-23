<?php
require_once '../config/database.php';
require_once '../controllers/CasosController.php';
require_once 'layouts/header.php';
require_once 'layouts/sidebar_admin.php';

$casosController = new CasosController();
$casosAsignados = $casosController->obtenerTodosLosCasosAsignados();
$casosController->manejarFormularioResolver();
?>

<style>
    .casos-container {
        background-color: #f8fafc;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
        max-width: 1100px;
        
    }

    .casos-container h2 {
        font-weight: 600;
        font-size: 1.7rem;
        margin-bottom: 30px;
        color: #2d3748;
        text-align: center;
    }

    .table-casos {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
    }

    .table-casos th {
        background-color: #edf2f7;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #4a5568;
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-casos td {
        padding: 15px;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
        font-size: 0.95rem;
    }

    .table-casos tr:hover {
        background-color: #f1f5f9;
    }

    .badge {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
    }

    .bg-success {
        background-color: #38a169;
        color: white;
    }

    .bg-warning {
        background-color: #f6ad55;
        color: #2d3748;
    }
</style>

<main class="casos-container">
    <h2>Lista de Casos Asignados</h2>
    <table class="table-casos">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Denunciante</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Encargado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($casosAsignados as $caso): ?>
                <tr>
                    <td><?= htmlspecialchars($caso['DNI_USUARIO']) ?></td>
                    <td><?= htmlspecialchars($caso['NOMBRE_USUARIO'] . ' ' . $caso['APELLIDOPA_USUARIO'] . ' ' . $caso['APELLIDOMA_USUARIO']) ?></td>
                    <td><?= htmlspecialchars($caso['descripcion']) ?></td>
                    <td>
                        <?php if ($caso['estado'] === 'resuelto'): ?>
                            <span class="badge bg-success">Resuelto</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Pendiente</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($caso['encargado_nombre'] . ' ' . $caso['apellidopa'] . ' ' . $caso['apellidoma']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require_once 'layouts/footer.php'; ?>
