<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'administrador') {
    header("Location: login.php");
    exit();
}

require_once '../controllers/CasosController.php';
$casosController = new CasosController();
$casos = $casosController->obtenerCasosPendientes();
$encargados = $casosController->obtenerEncargados();
?>

<?php include 'layouts/header.php'; ?>
<?php include 'layouts/sidebar_admin.php'; ?>

<main>
    <h2>Casos Pendientes</h2>
    <table id="miTabla" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Denunciante</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Descripción</th>
                <th>Fecha de Inicio</th>
                <th>Asignar Encargado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($casos as $caso): ?>
            <tr>
                <td><?= htmlspecialchars($caso['id_caso']) ?></td>
                <td><?= htmlspecialchars($caso['NOMBRE_USUARIO'] . ' ' . $caso['APELLIDOPA_USUARIO'] . ' ' . $caso['APELLIDOMA_USUARIO']) ?></td>
                <td><?= htmlspecialchars($caso['TELEFONO_USUARIO']) ?></td>
                <td><?= htmlspecialchars($caso['DIRECCION_USUARIO']) ?></td>
                <td><?= htmlspecialchars($caso['descripcion']) ?></td>
                <td><?= htmlspecialchars($caso['fecha_inicio']) ?></td>
                <td>
                    <form action="../controllers/CasosController.php" method="POST">
                        <input type="hidden" name="accion" value="asignar">
                        <input type="hidden" name="caso_id" value="<?= $caso['id_caso'] ?>">
                        <select name="encargado_id" required>
                            <option value="">Seleccionar...</option>
                            <?php foreach ($encargados as $encargado): ?>
                                <option value="<?= htmlspecialchars($encargado['DNI_USUARIO']) ?>">
                                    <?= htmlspecialchars($encargado['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit">Asignar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include 'layouts/footer.php'; ?>