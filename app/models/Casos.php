<?php
require_once '../config/database.php';

class Casos {
    private $db;

    public function __construct() {
        $db = new Database();
        $this->db = $db->connect();
    }

    // Obtener todos los casos pendientes con la información del denunciante
    public function obtenerCasosPendientes() {
        $sql = "SELECT c.id_caso, p.NOMBRE_USUARIO, p.APELLIDOPA_USUARIO, p.APELLIDOMA_USUARIO, 
                       p.TELEFONO_USUARIO, p.DIRECCION_USUARIO, c.descripcion, 
                       c.fecha_inicio, c.fecha_fin, c.estado, c.encargado_id 
                FROM casos_denuncias c
                JOIN personas_completado p ON c.dni_usuario = p.DNI_USUARIO
                WHERE c.estado = 'pendiente'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener lista de encargados disponibles
    public function obtenerEncargados() {
        $sql = "SELECT DNI_USUARIO, CONCAT(NOMBRE_USUARIO, ' ', APELLIDOPA_USUARIO) AS nombre 
                FROM personas_completado"; // Asumiendo que los encargados están en esta tabla
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Asignar un caso a un encargado
    public function asignarCaso($caso_id, $encargado_id) {
        $sql = "UPDATE casos_denuncias SET encargado_id = ?, estado = 'en proceso' WHERE id_caso = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$encargado_id, $caso_id]);
    }

    // Cerrar un caso estableciendo la fecha de finalización
    public function cerrarCaso($caso_id) {
        $sql = "UPDATE casos_denuncias SET estado = 'cerrado', fecha_fin = NOW() WHERE id_caso = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$caso_id]);
    }
}
?>
