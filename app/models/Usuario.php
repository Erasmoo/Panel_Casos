<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function obtenerUsuarios() {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function obtenerUsuarioPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($id, $usuario, $password, $rol) {
        if ($password) {
            $hashedPassword = hash('sha256', $password); // 🔹 SHA-256 en vez de password_hash()
            $stmt = $this->conn->prepare("UPDATE usuarios SET usuario = :usuario, password = :password, rol = :rol WHERE id = :id");
            $stmt->bindParam(':password', $hashedPassword);
        } else {
            $stmt = $this->conn->prepare("UPDATE usuarios SET usuario = :usuario, rol = :rol WHERE id = :id");
        }
    
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    

    public function eliminarUsuario($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    
    

    public function findUserByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function crearUsuario($usuario, $password, $rol) {
        $hashedPassword = hash('sha256', $password); // 🔹 Encriptación SHA-256
        $sql = "INSERT INTO usuarios (usuario, password, rol) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // 🔹 Usa $this->conn en lugar de $this->db
        return $stmt->execute([$usuario, $hashedPassword, $rol]); // 🔹 Corrección de la ejecución
    }
    

}
?>

