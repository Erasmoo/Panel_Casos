<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function listarUsuarios() {
        return $this->usuarioModel->obtenerUsuarios();
    }

    

    public function obtenerUsuario($id) {
        return $this->usuarioModel->obtenerUsuarioPorId($id);
    }

    

    public function eliminarUsuario() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $resultado = $this->usuarioModel->eliminarUsuario($id);

            if ($resultado) {
                header('Location: admin_usuarios.php?mensaje=eliminado');
                exit;
            } else {
                header('Location: usuarios.php?error=fallo');
                exit;
            }
        }
    }


    public function CrearUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = trim($_POST['usuario'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $apellido_paterno = trim($_POST['apellido_paterno'] ?? '');
            $apellido_materno = trim($_POST['apellido_materno'] ?? '');
            $estado = trim($_POST['estado'] ?? '');
            $rol = trim($_POST['rol'] ?? '');

            if (!empty($usuario) && !empty($password) && !empty($apellido_paterno) && !empty($apellido_materno) && !empty($estado) && !empty($rol)) {
                if ($this->usuarioModel->crearUsuario($usuario, $password, $apellido_paterno, $apellido_materno, $estado, $rol)) {
                    header("Location: ../views/admin_usuarios.php");
                    exit();
                } else {
                    header("Location: crear_usuario.php?error=" . urlencode("Error al registrar el usuario."));
                    exit();
                }
            } else {
                header("Location: crear_usuario.php?error=" . urlencode("Todos los campos son obligatorios."));
                exit();
            }
        }
        }

        
    }

// Ejecutar el controlador si se accede directamente
$usuarioController = new UsuarioController();
$usuarioController->CrearUsuario();


?>
