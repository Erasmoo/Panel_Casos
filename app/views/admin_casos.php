<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'administrador') {
    header("Location: login.php");
    exit();
}
?>



<?php
require_once '../controllers/CasosController.php';
$casosController = new CasosController(); // ✅ Ahora debería conectarse bien
$casos = $casosController->obtenerCasosPendientes();
$encargados = $casosController->obtenerEncargados();


// EN PROCESO

?>


    <?php include 'layouts/header.php'; ?>
    <?php include 'layouts/sidebar_admin.php'; ?>

    <main>
        <h2>Casos Pendientes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Facultad</th>
                    <th>Tipo de Incidente</th>
                    <th>Fecha</th>
                    <th>Asignar Encargado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($casos as $caso): ?>
                <tr>
                    <td><?= $caso['id'] ?></td>
                    <td><?= htmlspecialchars($caso['descripcion']) ?></td>
                    <td><?= htmlspecialchars($caso['facultad']) ?></td>
                    <td><?= htmlspecialchars($caso['tipo_incidente']) ?></td>
                    <td><?= $caso['fecha'] ?></td>
                    <td>
                        <form action="../controllers/asignar_caso.php" method="POST">
                            <input type="hidden" name="caso_id" value="<?= $caso['id'] ?>">
                            <select name="encargado_id" required>
                                <option value="">Seleccionar...</option>
                                <?php foreach ($encargados as $encargado): ?>
                                    <option value="<?= $encargado['id'] ?>"><?= htmlspecialchars($encargado['nombre']) ?></option>
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