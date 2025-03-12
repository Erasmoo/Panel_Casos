<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<?php
require_once 'layouts/header.php';
require_once 'layouts/sidebar_admin.php';
?>
<main>
    <h2>Panel de Administrador</h2>
    <p>Bienvenido al panel de administrador, donde puedes gestionar usuarios, reportes y más.</p>
</main>
<?php require_once 'layouts/footer.php'; ?>

