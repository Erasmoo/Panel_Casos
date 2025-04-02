<?php
require_once '../models/Casos.php';

class CasosController {
    private $casosModel;

    public function __construct() {
        $this->casosModel = new Casos();
    }

    // Obtener los casos pendientes
    public function obtenerCasosPendientes() {
        return $this->casosModel->obtenerCasosPendientes();
    }

    // Obtener encargados disponibles
    public function obtenerEncargados() {
        return $this->casosModel->obtenerEncargados();
    }

    public function obtenerTodosLosCasosAsignados() {
        return $this->casosModel->obtenerTodosLosCasosAsignados();
    }
    
    
    
    public function asignarCaso() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $caso_id = $_POST['caso_id'];
            $encargado_id = $_POST['encargado_id'];
    
            if ($this->casosModel->asignarCaso($caso_id, $encargado_id)) {
                echo "<script>alert('Caso asignado correctamente'); window.location.href='../views/admin_casos.php';</script>";
            } else {
                echo "<script>alert('Error al asignar el caso'); window.location.href='../views/admin_casos.php';</script>";
            }
        }
    }
    
    
    
    

    public function eliminarCaso() {
        if (isset($_POST['caso_id'])) {
        
            
            $caso_id = $_POST['caso_id'];
    
            if ($this->casosModel->eliminarCaso($caso_id)) {
                $_SESSION['mensaje'] = "Caso eliminado correctamente.";
            } else {
                $_SESSION['error'] = "Error al eliminar el caso.";
            }
        }
        header('Location: ../views/admin_casos.php');
        exit();
    }
    

    // Cerrar un caso
    public function cerrarCaso() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $caso_id = $_POST['caso_id'];

            if ($this->casosModel->cerrarCaso($caso_id)) {
                echo "<script>alert('Caso cerrado correctamente'); window.location.href='../views/admin.php';</script>";
            } else {
                echo "<script>alert('Error al cerrar el caso'); window.location.href='../views/admin.php';</script>";
            }
        }
    }
}

// Manejo de solicitudes POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new CasosController();

    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == 'asignar') {
            $controller->asignarCaso();
        } elseif ($_POST['accion'] == 'cerrar') {
            $controller->cerrarCaso();
        } elseif ($_POST['accion'] == 'eliminar') { // Nueva acción para eliminar
            $controller->eliminarCaso();
        }
    }
}
?>
