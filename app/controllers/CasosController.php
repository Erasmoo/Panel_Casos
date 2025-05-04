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

    public function obtenerCasosResueltosPorEncargado($id_encargado) {
        return $this->casosModel->obtenerCasosResueltosPorEncargado($id_encargado);
    }
    
    
    
    
    public function asignarCaso() {
        session_start(); // Asegúrate de iniciar la sesión aquí si aún no está
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $caso_id = $_POST['caso_id'];
            $encargado_id = $_POST['encargado_id'];
    
            if ($this->casosModel->asignarCaso($caso_id, $encargado_id)) {
                $_SESSION['mensaje'] = 'El caso fue asignado correctamente al encargado.';
                $_SESSION['tipo_mensaje'] = 'success';
            } else {
                $_SESSION['mensaje'] = 'Hubo un error al asignar el caso. Inténtelo nuevamente.';
                $_SESSION['tipo_mensaje'] = 'danger';
            }
    
            header('Location: ../views/admin_casos.php');
            exit();
        }
    }
    
    
    

    public function eliminarCaso() {
        session_start(); // Asegúrate de que la sesión esté iniciada aquí también
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $caso_id = $_POST['caso_id'];
    
            if ($this->casosModel->eliminarCaso($caso_id)) {
                $_SESSION['mensaje'] = 'El caso ha sido eliminado correctamente.';
                $_SESSION['tipo_mensaje'] = 'success';
            } else {
                $_SESSION['mensaje'] = 'No se pudo eliminar el caso. Intente nuevamente.';
                $_SESSION['tipo_mensaje'] = 'danger';
            }
    
            header('Location: ../views/admin_casos.php');
            exit();
        }
    }
    
    

    public function cerrarCaso() {
        session_start();
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $caso_id = $_POST['caso_id'];
    
            require_once '../config/database.php';
            $conn = Database::connect();
    
            $sql = "UPDATE casos_denuncias SET estado = 'resuelto', fecha_fin = NOW() WHERE id_caso = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$caso_id])) {
                $_SESSION['mensaje'] = 'El caso ha sido marcado como resuelto correctamente.';
                $_SESSION['tipo_mensaje'] = 'success';
            } else {
                $_SESSION['mensaje'] = 'No se pudo actualizar el estado del caso.';
                $_SESSION['tipo_mensaje'] = 'danger';
            }
    
            header('Location: ../views/encargado_casos.php');
            exit();
        }
    }
    
    
    

public function manejarFormularioResolver() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se trata de una acción para resolver un caso
        if (isset($_POST['accion']) && $_POST['accion'] == 'resolver') {
            $caso_id = $_POST['caso_id'];

            // Llamar a la función para resolver el caso
            if ($this->resolverCaso($caso_id)) {
                echo "<script>alert('Caso marcado como resuelto'); window.location.href='../views/encargado_casos.php';</script>";
            } else {
                echo "<script>alert('Error al marcar el caso como resuelto'); window.location.href='../views/encargado_casos.php';</script>";
            }
        }
    }
}

    



    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new CasosController();

    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == 'asignar') {
            $controller->asignarCaso();
        } elseif ($_POST['accion'] == 'cerrar') {
            $controller->cerrarCaso();
        } elseif ($_POST['accion'] == 'eliminar') {
            $controller->eliminarCaso();
        }
    }
}

?>
