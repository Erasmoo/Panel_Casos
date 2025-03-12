<?php
require_once '../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function listarUsuarios() {
        return $this->usuarioModel->obtenerUsuarios();
    }

    public function crearUsuario($usuario, $password, $rol) {
        return $this->usuarioModel->crearUsuario($usuario, $password, $rol);
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
}

$usuarioController = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear'])) {
        $usuarioController->crearUsuario($_POST['usuario'], $_POST['password'], $_POST['rol']);
    } elseif (isset($_POST['editar'])) {
        $usuarioController->actualizarUsuario($_POST['id'], $_POST['usuario'], $_POST['password'], $_POST['rol']);
    } elseif (isset($_POST['eliminar'])) {
        $usuarioController->eliminarUsuario($_POST['id']);
    }
    header("Location: ../views/admin_usuarios.php");
    exit();
}
?>
