<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'administrador') {
    header("Location: login.php");
    exit();
}
?>

<?php
require_once '../config/database.php';

require_once 'layouts/header.php';
require_once 'layouts/sidebar_admin.php';

$conn = Database::connect();

// Obtener la cantidad de casos pendientes
$stmt = $conn->query("SELECT COUNT(*) AS total FROM casos WHERE estado = 'Pendiente'");
$casos_pendientes = $stmt->fetch()['total'];

// Obtener la cantidad de usuarios (administradores y encargados)
$stmt = $conn->query("SELECT 
    SUM(CASE WHEN roles.nombre = 'administrador' THEN 1 ELSE 0 END) AS total_admins, 
    SUM(CASE WHEN roles.nombre = 'encargado' THEN 1 ELSE 0 END) AS total_encargados 
    FROM usuarios
    JOIN roles ON usuarios.rol_id = roles.id");

$usuarios = $stmt->fetch();
$total_admins = $usuarios['total_admins'];
$total_encargados = $usuarios['total_encargados'];

// Obtener la cantidad de reportes
$stmt = $conn->query("SELECT COUNT(*) AS total FROM reportes");
$reportes_totales = $stmt->fetch()['total'];
?>

<main>
    <h2>Panel de Administrador</h2>
    <p>Bienvenido al panel de administrador, donde puedes gestionar usuarios, reportes y más.</p>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .dashboard-container {
            margin-top: 40px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
        }

        .card .icon {
            font-size: 40px;
            color: white;
            background: linear-gradient(45deg, #007bff, #00d4ff);
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
        }

        .card-value {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .bg-blue { background: linear-gradient(45deg, #007bff, #00d4ff); }
        .bg-red { background: linear-gradient(45deg, #dc3545, #ff6b6b); }
        .bg-green { background: linear-gradient(45deg, #28a745, #6fe372); }
    </style>
</head>
<body>

<div class="container dashboard-container">
    <div class="row g-4">
        <!-- Casos Pendientes -->
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center">
                    <div class="icon bg-red">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="card-title">Casos Pendientes</h5>
                        <p class="card-value"><?php echo $casos_pendientes; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Usuarios Administradores y Encargados -->
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center">
                    <div class="icon bg-blue">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="card-title">Usuarios <?php echo $total_admins + $total_encargados; ?></h5>
                        <p class="card-value"> <small>Admins: <?php echo $total_admins; ?> <br> Encargados: <?php echo $total_encargados; ?></small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reportes -->
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex align-items-center">
                    <div class="icon bg-green">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-value"><?php echo $reportes_totales; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layouts/footer.php'; ?>

