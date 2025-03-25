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

    public function crearUsuario($usuario, $password, $apellido_paterno, $apellido_materno, $estado, $rol) {
        return $this->usuarioModel->crearUsuario($usuario, $password, $apellido_paterno, $apellido_materno, $estado, $rol);
    }

    public function obtenerUsuario($id) {
        return $this->usuarioModel->obtenerUsuarioPorId($id);
    }

    public function actualizarUsuario($id, $usuario, $password, $rol) {
        return $this->usuarioModel->actualizarUsuario($id, $usuario, $password, $rol);
    }

    public function eliminarUsuario($id) {
        return $this->usuarioModel->eliminarUsuario($id);
    }


    public function procesarFormulario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = trim($_POST['usuario'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $apellido_paterno = trim($_POST['apellido_paterno'] ?? '');
            $apellido_materno = trim($_POST['apellido_materno'] ?? '');
            $estado = trim($_POST['estado'] ?? '');
            $rol = trim($_POST['rol'] ?? '');

            if (!empty($usuario) && !empty($password) && !empty($apellido_paterno) && !empty($apellido_materno) && !empty($estado) && !empty($rol)) {
                if ($this->crearUsuario($usuario, $password, $apellido_paterno, $apellido_materno, $estado, $rol)) {
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
$usuarioController->procesarFormulario();
?>
