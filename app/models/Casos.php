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
        $sql = "SELECT c.id_caso, p.DNI_USUARIO, p.NOMBRE_USUARIO, p.APELLIDOPA_USUARIO, p.APELLIDOMA_USUARIO, 
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
        $sql = "SELECT usuario, CONCAT(usuario, ' ', apellidopa, ' ', apellidoma) AS nombre, roles.nombre AS rol 
                FROM usuarios u
                JOIN roles ON u.rol_id = roles.id
                WHERE roles.nombre = 'encargado'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Asignar un caso a un encargado
    public function asignarCaso($caso_id, $encargado_id) {
        $sql = "UPDATE casos_denuncias SET encargado_id = ?, estado = 'pendiente' WHERE id_caso = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$encargado_id, $caso_id]);
    }

    public function obtenerTodosLosCasosAsignados() {
        $sql = "SELECT c.id_caso, c.descripcion, c.estado, c.encargado_id, 
                       u.usuario AS encargado_nombre, u.apellidopa AS apellido_pa, 
                   u.apellidoma AS apellido_ma
                FROM casos_denuncias c
                LEFT JOIN usuarios u ON c.encargado_id = u.usuario
                WHERE c.estado = 'pendiente'";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerCasosResueltosPorEncargado($id_encargado) {
        $sql = "SELECT * FROM casos_denuncias WHERE estado = 'resuelto' AND encargado_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_encargado]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function resolverCaso($caso_id) {
        $sql = "UPDATE casos SET estado = 'resuelto' WHERE id_caso = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$caso_id]);
    }
    

    

    public function eliminarCaso($id) {
        $sql = "DELETE FROM casos_denuncias WHERE id_caso = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
    

    public function cerrarCaso($caso_id) {
        
        $sql = "UPDATE casos_denuncias SET estado = 'resuelto' WHERE id_caso = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$caso_id]);
    }
    
    
}
?>
