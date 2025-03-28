<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function obtenerUsuarios() {
        $stmt = $this->conn->prepare("
            SELECT usuarios.id, usuarios.usuario,
            usuarios.apellidopa, usuarios.apellidoma, usuarios.estado,
            usuarios.password, roles.nombre AS rol
            FROM usuarios
            JOIN roles ON usuarios.rol_id = roles.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    
    public function obtenerUsuarioPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($id, $usuario, $apellidopa, $apellidoma, $estado, $rol, $password = null) {
        if ($password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET usuario = :usuario, apellidopa = :apellidopa, apellidoma = :apellidoma, 
                    estado = :estado, rol_id = :rol, password = :password WHERE id = :id";
            $params = compact('id', 'usuario', 'apellidopa', 'apellidoma', 'estado', 'rol', 'password');
        } else {
            $sql = "UPDATE usuarios SET usuario = :usuario, apellidopa = :apellidopa, apellidoma = :apellidoma, 
                    estado = :estado, rol_id = :rol WHERE id = :id";
            $params = compact('id', 'usuario', 'apellidopa', 'apellidoma', 'estado', 'rol');
        }

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function eliminarUsuario($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    



    

    public function verificarUsuario($usuario, $password) {
        $stmt = $this->conn->prepare("SELECT usuarios.id, usuarios.password, roles.nombre as rol 
                                     FROM usuarios 
                                     JOIN roles ON usuarios.rol_id = roles.id 
                                     WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user !== false) {
            echo "Usuario encontrado en la BD.<br>";
            echo "Hash en BD: " . $user['password'] . "<br>";
            echo "Hash ingresado: " . hash('sha256', $password) . "<br>";
        
            if (hash('sha256', $password) === $user['password']) {
                echo "¡Las contraseñas coinciden!<br>";
                return $user;
            } else {
                echo "❌ ERROR: Las contraseñas no coinciden.<br>";
                return false;
            }
        }
        
    }
    

    public function crearUsuario($usuario, $password, $apellido_paterno, $apellido_materno, $estado, $rol) {
        $hashedPassword = hash('sha256', $password); 
    
        $sql = "INSERT INTO usuarios (usuario, password, apellidopa, apellidoma, estado, rol_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$usuario, $hashedPassword, $apellido_paterno, $apellido_materno, $estado, $rol]);
    }
    

    

}
?>

