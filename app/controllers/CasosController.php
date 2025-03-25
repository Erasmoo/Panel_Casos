<?php
require_once '../config/database.php';

class CasosController {
    private $db;

    public function __construct() {
        $this->db = Database::connect(); // ✅ Llamado correcto a la conexión
    }

    public function obtenerCasosPendientes() {
        $sql = "SELECT * FROM casos WHERE estado = 'Pendiente'";
        $resultado = $this->db->query($sql);
        return $resultado ? $resultado->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function obtenerEncargados() {
        $sql = "SELECT usuarios.id, usuarios.usuario 
                FROM usuarios 
                JOIN roles ON usuarios.rol_id = roles.id
                WHERE roles.nombre = 'encargado'";
        $resultado = $this->db->query($sql);
        return $resultado ? $resultado->fetchAll(PDO::FETCH_ASSOC) : [];
    }
    

    public function asignarCaso($caso_id, $encargado_id) {
        $fecha_inicio = date('Y-m-d H:i:s');
        $sql = "UPDATE casos SET encargado_id = ?, estado = 'Pendiente de Resolución', fecha_inicio = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $encargado_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(3, $caso_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}


// EN PROCESO

?>