<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'encargado') {
    header("Location: login.php");
    exit();
}
?>


<?php
require_once 'layouts/header.php';
require_once 'layouts/sidebar_encargado.php';
?>
<main>
    <h2>Panel de Encargado</h2>
    <p>Bienvenido al panel de encargado, donde puedes gestionar casos y reportes.</p>
</main>
<?php require_once 'layouts/footer.php'; ?>


