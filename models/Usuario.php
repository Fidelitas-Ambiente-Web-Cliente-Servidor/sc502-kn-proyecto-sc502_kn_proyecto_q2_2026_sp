<?php
require_once __DIR__ . '/../config/database.php';

class Usuario
{
    private $conn;
    private $table_name = "usuarios";

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    // obtener un usuario por su correo
    public function getByCorreo($correo)
    {
        $query = "SELECT u.*, r.nombre_rol 
                  FROM " . $this->table_name . " u
                  LEFT JOIN roles r ON u.rol_id = r.id
                  WHERE u.correo = :correo";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();
        return $stmt->fetch();
    }

    // crear un nuevo usuario
    public function create($datos)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (rol_id, nombre, apellido, correo, contrasena, telefono) 
                  VALUES (:rol_id, :nombre, :apellido, :correo, :contrasena, :telefono)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":rol_id", $datos['rol_id']);
        $stmt->bindParam(":nombre", $datos['nombre']);
        $stmt->bindParam(":apellido", $datos['apellido']);
        $stmt->bindParam(":correo", $datos['correo']);
        $stmt->bindParam(":contrasena", $datos['contrasena']);
        $stmt->bindParam(":telefono", $datos['telefono']);

        return $stmt->execute();
    }

    // obtener usuario por id
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // actualizar perfil de usuario
    public function update($id, $datos)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, apellido = :apellido, telefono = :telefono";

        if (isset($datos['contrasena'])) {
            $query .= ", contrasena = :contrasena";
        }

        $query .= " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $datos['nombre']);
        $stmt->bindParam(":apellido", $datos['apellido']);
        $stmt->bindParam(":telefono", $datos['telefono']);
        $stmt->bindParam(":id", $id);

        if (isset($datos['contrasena'])) {
            $stmt->bindParam(":contrasena", $datos['contrasena']);
        }

        return $stmt->execute();
    }
}
?>