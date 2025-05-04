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
        <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
        <?php unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']); ?>
    <?php endif; ?>

    


    <table id="miTabla" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                
                <th>Nombre</th>
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
                
                <td><?= htmlspecialchars($caso['NOMBRE_USUARIO'] . ' ' . $caso['APELLIDOPA_USUARIO'] . ' ' . $caso['APELLIDOMA_USUARIO']) ?></td>
                <td><?= htmlspecialchars($caso['TELEFONO_USUARIO']) ?></td>
                <td><?= htmlspecialchars($caso['DIRECCION_USUARIO']) ?></td>
                <td><?= htmlspecialchars($caso['descripcion']) ?></td>
                <td><?= htmlspecialchars($caso['fecha_inicio']) ?></td>
                <td>
                    <form class="asignación" action="../controllers/CasosController.php" method="POST">
                        <input type="hidden" name="accion" value="asignar">
                        <input type="hidden" name="caso_id" value="<?= $caso['id_caso'] ?>">
                        <select name="encargado_id" required>
                            <option value="">Seleccionar...</option>
                            <?php foreach ($encargados as $encargado): ?>
                                <option value="<?= htmlspecialchars($encargado['usuario']) ?>">
                                    <?= htmlspecialchars($encargado['nombre']) ?>
                                </option>
                                
                            <?php endforeach; ?>
                        </select>
                        <button type="submit">Asignar</button>
                    </form>

                    <form class="eliminacion" action="../controllers/CasosController.php" method="POST" style="display:inline;">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="caso_id" value="<?= htmlspecialchars($caso['id_caso']) ?>">
                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Estás seguro de eliminar este caso?');">Eliminar</button>
                    </form>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include 'layouts/footer.php'; ?>