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
                  WHERE m.estado != 'Adoptado'
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

    // obtener mascotas por rescatista
    public function getByRescatista($usuario_id)
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
                  WHERE m.usuario_id = :usuario_id
                  ORDER BY m.fecha_publicacion DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // crear una nueva mascota
    public function create($datos)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (usuario_id, especie_id, raza_id, tamano_id, energia_id, nombre, edad, historia, foto_path, estado) 
                  VALUES (:usuario_id, :especie_id, :raza_id, :tamano_id, :energia_id, :nombre, :edad, :historia, :foto_path, :estado)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usuario_id", $datos['usuario_id']);
        $stmt->bindParam(":especie_id", $datos['especie_id']);
        $stmt->bindParam(":raza_id", $datos['raza_id']);
        $stmt->bindParam(":tamano_id", $datos['tamano_id']);
        $stmt->bindParam(":energia_id", $datos['energia_id']);
        $stmt->bindParam(":nombre", $datos['nombre']);
        $stmt->bindParam(":edad", $datos['edad']);
        $stmt->bindParam(":historia", $datos['historia']);
        $stmt->bindParam(":foto_path", $datos['foto_path']);
        $stmt->bindParam(":estado", $datos['estado']);

        return $stmt->execute();
    }

    // actualizar mascota
    public function update($id, $datos)
    {
        $query = "UPDATE " . $this->table_name . " SET 
                    especie_id = :especie_id,
                    raza_id = :raza_id,
                    tamano_id = :tamano_id,
                    energia_id = :energia_id,
                    nombre = :nombre,
                    edad = :edad,
                    historia = :historia,
                    foto_path = :foto_path,
                    estado = :estado
                  WHERE id = :id AND usuario_id = :usuario_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":especie_id", $datos['especie_id']);
        $stmt->bindParam(":raza_id", $datos['raza_id']);
        $stmt->bindParam(":tamano_id", $datos['tamano_id']);
        $stmt->bindParam(":energia_id", $datos['energia_id']);
        $stmt->bindParam(":nombre", $datos['nombre']);
        $stmt->bindParam(":edad", $datos['edad']);
        $stmt->bindParam(":historia", $datos['historia']);
        $stmt->bindParam(":foto_path", $datos['foto_path']);
        $stmt->bindParam(":estado", $datos['estado']);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":usuario_id", $datos['usuario_id']); // verificacion de seguridad

        return $stmt->execute();
    }

    // cambiar estado de mascota
    public function cambiarEstado($id, $estado)
    {
        $query = "UPDATE " . $this->table_name . " SET estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        //bindparam lo que hace es evitar inyeccion sql para que no puedan alterar la consulta
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // eliminar mascota
    public function delete($id, $usuario_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":usuario_id", $usuario_id);
        return $stmt->execute();
    }

    // metodos auxiliares para los selects
    public function getEspecies()
    {
        $stmt = $this->conn->query("SELECT * FROM especies ORDER BY nombre_especie");
        return $stmt->fetchAll();
    }

    public function getRazas()
    {
        $stmt = $this->conn->query("SELECT * FROM razas ORDER BY nombre_raza");
        return $stmt->fetchAll();
    }

    public function getTamanos()
    {
        $stmt = $this->conn->query("SELECT * FROM tamanos ORDER BY id");
        return $stmt->fetchAll();
    }

    public function getEnergias()
    {
        $stmt = $this->conn->query("SELECT * FROM niveles_energia ORDER BY id");
        return $stmt->fetchAll();
    }

    // metodos de admin
    public function getAllAdmin()
    {
        $query = "SELECT m.*, 
                         e.nombre_especie, 
                         r.nombre_raza, 
                         t.descripcion as tamano, 
                         n.descripcion as energia,
                         u.correo as rescatista_correo
                  FROM " . $this->table_name . " m
                  LEFT JOIN especies e ON m.especie_id = e.id
                  LEFT JOIN razas r ON m.raza_id = r.id
                  LEFT JOIN tamanos t ON m.tamano_id = t.id
                  LEFT JOIN niveles_energia n ON m.energia_id = n.id
                  LEFT JOIN usuarios u ON m.usuario_id = u.id
                  ORDER BY m.fecha_publicacion DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countTotal()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM " . $this->table_name);
        return $stmt->fetch()['total'];
    }

    public function countAdoptadas()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE estado = 'Adoptado'");
        return $stmt->fetch()['total'];
    }

    // contar mascotas por rescatista y estado
    public function countByRescatistaAndEstado($usuario_id, $estado)
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE usuario_id = :usuario_id AND estado = :estado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":estado", $estado);
        $stmt->execute();
        return $stmt->fetch()['total'];
    }
}
?>