<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    

    public function editar($id) {
        return $this->usuarioModel->obtenerUsuarioPorId($id);
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $usuario = $_POST['usuario'];
            $apellidopa = $_POST['apellidopa'];
            $apellidoma = $_POST['apellidoma'];
            $estado = $_POST['estado'];
            $rol = $_POST['rol'];
            $password = !empty($_POST['password']) ? $_POST['password'] : null;

            if ($this->usuarioModel->actualizarUsuario($id, $usuario, $apellidopa, $apellidoma, $estado, $rol, $password)) {
                header('Location: ../views/admin_usuarios.php?mensaje=actualizado');
                exit;
            } else {
                header('Location: ../views/admin_usuarios.php?error=fallo');
                exit;
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['eliminar']) && !empty($_GET['eliminar'])) {
            $id = $_GET['eliminar'];
            
            if ($this->usuarioModel->eliminarUsuario($id)) {
                header('Location: ../views/admin_usuarios.php?mensaje=eliminado');
            } else {
                header('Location: ../views/admin_usuarios.php?error=fallo');
            }
            exit();
        } else {
            header('Location: ../views/admin_usuarios.php?error=id_invalido');
            exit();
        }
    }
    
}

if (isset($_POST['id'])) {
    $controller = new UsuarioController();
    $controller->actualizar();
} elseif (isset($_GET['eliminar'])) {
    $controller = new UsuarioController();
    $controller->eliminar();
}
?>
