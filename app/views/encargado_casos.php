<?php
require_once 'layouts/header.php';
require_once 'layouts/sidebar_encargado.php';

session_start();
require '../config/database.php';

$usuario_id = $_SESSION['usuario'];

$conn = Database::connect();

$sql = "SELECT * FROM casos_denuncias WHERE encargado_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$usuario_id]);
$casos = $stmt->fetchAll();
?>

<main>
    <h2>Casos Asignados</h2>
    <p>Aquí puedes ver los casos que te han sido asignados.</p>
<table>
    <tr>
        <th>ID</th>
        <th>Dni</th>
        <th>Descripción</th>
        <th>Estado</th>
    </tr>
    <?php foreach ($casos as $caso): ?>
    <tr>
        <td><?= htmlspecialchars($caso['id_caso']) ?></td>
        <td><?= htmlspecialchars($caso['dni_usuario']) ?></td>
        <td><?= htmlspecialchars($caso['descripcion']) ?></td>
        <td><?php if ($caso['estado'] == 'pendiente'): ?>
                    <form action="../controllers/CasosController.php" method="POST" style="display:inline;">
                        <input type="hidden" name="accion" value="cerrar">
                        <input type="hidden" name="caso_id" value="<?= htmlspecialchars($caso['id_caso']) ?>">
                        <button class="btn btn-success btn-sm" type="submit" onclick="return confirm('¿Estás seguro de que resolviste este caso?');">Marcar como Resuelto</button>
                    </form>
                <?php else: ?>
                    <span class="badge bg-success">Resuelto</span>
                <?php endif; ?>
            </td>    
        </tr>
    <?php endforeach; ?>
</table>
</main>

<?php require_once 'layouts/footer.php'; ?>
