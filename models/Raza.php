<?php
require_once __DIR__ . '/../config/database.php';

class Raza
{
    private $conn;
    private $table_name = "razas";

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    // obtener todas las razas
    public function getAll()
    {
        $query = "SELECT r.*, e.nombre_especie FROM " . $this->table_name . " r 
                  LEFT JOIN especies e ON r.especie_id = e.id 
                  ORDER BY r.nombre_raza ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // obtener razas por especie para utilizarla en ajax
    public function getByEspecie($especie_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE especie_id = :especie_id ORDER BY nombre_raza ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":especie_id", $especie_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // crear una nueva raza
    public function create($nombre_raza, $especie_id)
    {
        $query = "INSERT INTO " . $this->table_name . " (nombre_raza, especie_id) VALUES (:nombre_raza, :especie_id)";
        $stmt = $this->conn->prepare($query);

        $nombre_raza = htmlspecialchars(strip_tags($nombre_raza));
        $stmt->bindParam(":nombre_raza", $nombre_raza);
        $stmt->bindParam(":especie_id", $especie_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update($id, $nombre_raza, $especie_id)
    {
        $query = "UPDATE " . $this->table_name . " SET nombre_raza = :nombre_raza, especie_id = :especie_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $nombre_raza = htmlspecialchars(strip_tags($nombre_raza));

        $stmt->bindParam(":nombre_raza", $nombre_raza);
        $stmt->bindParam(":especie_id", $especie_id);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>