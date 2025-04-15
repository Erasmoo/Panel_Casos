<?php
require_once 'layouts/header.php';
require_once 'layouts/sidebar_encargado.php';
session_start();
require '../config/database.php';


require_once '../controllers/CasosController.php';



$usuario_id = $_SESSION['usuario'];
$conn = Database::connect();

$sql = "SELECT * FROM casos_denuncias WHERE encargado_id = ? AND estado = 'pendiente'";
$stmt = $conn->prepare($sql);
$stmt->execute([$usuario_id]);
$casos = $stmt->fetchAll();
?>

<main>
    <h2>Casos Asignados</h2>
    <p>Aquí puedes ver los casos que te han sido asignados.</p>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Descripción</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($casos as $caso): ?>
            <tr>
                <td><?= htmlspecialchars($caso['id_caso']) ?></td>
                <td><?= htmlspecialchars($caso['dni_usuario']) ?></td>
                <td><?= htmlspecialchars($caso['descripcion']) ?></td>
                <td>
                    <form action="../controllers/CasosController.php" method="POST" style="display: flex; align-items: center;">
                        <input type="hidden" name="accion" value="cerrar">
                        <input type="hidden" name="caso_id" value="<?= htmlspecialchars($caso['id_caso']) ?>">
                        <label style="margin-right: 10px;">En pendiente</label>
                        <input type="checkbox" class="check-resolver" name="resuelto" value="1" title="Marcar como resuelto" style="transform: scale(1.5);">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<script>
    // Seleccionar todos los checkboxes
    document.querySelectorAll('.check-resolver').forEach(function(checkbox) {
        checkbox.addEventListener('change', function(e) {
            if (confirm('¿Estás seguro de que este caso ha sido resuelto?')) {
                this.closest('form').submit();
            } else {
                this.checked = false; // Desmarca si el usuario cancela
            }
        });
    });
</script>
<?php require_once 'layouts/footer.php'; ?>
