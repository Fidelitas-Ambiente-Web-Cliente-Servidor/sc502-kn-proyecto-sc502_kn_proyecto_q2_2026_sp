<?php
require_once __DIR__ . '/../config/database.php';

class Mascota
{
    private $conn;
    private $table_name = "mascotas";

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    // obtener todas las mascotas
    public function getAll()
    {
        $query = "SELECT m.*, 
                         e.nombre_especie, 
                         r.nombre_raza, 
                         t.descripcion as tamano, 
                         n.descripcion as energia
                  FROM " . $this->table_name . " m
                  LEFT JOIN especies e ON m.especie_id = e.id
                  LEFT JOIN razas r ON m.raza_id = r.id
                  LEFT JOIN tamanos t ON m.tamano_id = t.id
                  LEFT JOIN niveles_energia n ON m.energia_id = n.id
                  ORDER BY m.fecha_publicacion DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // obtener una mascota por id
    public function getById($id)
    {
        $query = "SELECT m.*, 
                         e.nombre_especie, 
                         r.nombre_raza, 
                         t.descripcion as tamano, 
                         n.descripcion as energia,
                         u.nombre as rescatista_nombre,
                         u.telefono as rescatista_telefono
                  FROM " . $this->table_name . " m
                  LEFT JOIN especies e ON m.especie_id = e.id
                  LEFT JOIN razas r ON m.raza_id = r.id
                  LEFT JOIN tamanos t ON m.tamano_id = t.id
                  LEFT JOIN niveles_energia n ON m.energia_id = n.id
                  LEFT JOIN usuarios u ON m.usuario_id = u.id
                  WHERE m.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>