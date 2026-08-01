<?php
require_once __DIR__ . '/../config/database.php';

class Solicitud
{
    private $conn;
    private $table_name = "solicitudes";

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function create($datos)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (mascota_id, nombre_adoptante, correo_adoptante, mensaje, estado) 
                  VALUES (:mascota_id, :nombre_adoptante, :correo_adoptante, :mensaje, 'Pendiente')";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":mascota_id", $datos['mascota_id']);
        $stmt->bindParam(":nombre_adoptante", $datos['nombre_adoptante']);
        $stmt->bindParam(":correo_adoptante", $datos['correo_adoptante']);
        $stmt->bindParam(":mensaje", $datos['mensaje']);

        if (!$stmt->execute()) {
            die("<strong>Error de Base de Datos al crear solicitud:</strong><br><pre>" . print_r($stmt->errorInfo(), true) . "</pre><br>Asegúrate de que la tabla 'solicitudes' esté actualizada con el ALTER TABLE de schema.sql.");
        }
        return true;
    }

    public function getByRescatista($rescatista_id)
    {
        //join con mascotas para asegurar que le pertenece al rescatista
        $query = "SELECT s.id as solicitud_id, 
                         s.mensaje, 
                         s.estado as estado_solicitud, 
                         s.created_at as fecha_envio,
                         s.nombre_adoptante as adoptante_nombre,
                         '' as adoptante_apellido,
                         s.correo_adoptante as adoptante_correo,
                         '' as adoptante_telefono,
                         m.id as mascota_id,
                         m.nombre as mascota_nombre,
                         m.foto_path
                  FROM " . $this->table_name . " s
                  INNER JOIN mascotas m ON s.mascota_id = m.id
                  WHERE m.usuario_id = :rescatista_id
                  ORDER BY s.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":rescatista_id", $rescatista_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function updateEstado($solicitud_id, $estado, $rescatista_id)
    {
        // se verifica en la consulta que la solicitud pertenezca a una mascota del rescatista
        $query = "UPDATE " . $this->table_name . " s
                  INNER JOIN mascotas m ON s.mascota_id = m.id
                  SET s.estado = :estado
                  WHERE s.id = :solicitud_id 
                  AND m.usuario_id = :rescatista_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":solicitud_id", $solicitud_id);
        $stmt->bindParam(":rescatista_id", $rescatista_id);

        return $stmt->execute();
    }

    public function getByAdoptanteCorreo($correo)
    {
        $query = "SELECT s.id as solicitud_id, 
                         s.mensaje, 
                         s.estado as estado_solicitud, 
                         s.created_at as fecha_envio,
                         m.id as mascota_id,
                         m.nombre as mascota_nombre,
                         m.foto_path,
                         e.nombre_especie as especie,
                         r.nombre_raza as raza,
                         u.nombre as rescatista_nombre,
                         u.correo as rescatista_correo
                  FROM " . $this->table_name . " s
                  INNER JOIN mascotas m ON s.mascota_id = m.id
                  LEFT JOIN especies e ON m.especie_id = e.id
                  LEFT JOIN razas r ON m.raza_id = r.id
                  INNER JOIN usuarios u ON m.usuario_id = u.id
                  WHERE s.correo_adoptante = :correo
                  ORDER BY s.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":correo", $correo);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // obtener solicitud por id
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // rechazar automaticamente las demas solicitudes
    public function rechazarOtrasSolicitudes($mascota_id, $solicitud_id_aprobada)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET estado = 'Rechazada' 
                  WHERE mascota_id = :mascota_id 
                  AND id != :solicitud_id_aprobada 
                  AND estado = 'Pendiente'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":mascota_id", $mascota_id);
        $stmt->bindParam(":solicitud_id_aprobada", $solicitud_id_aprobada);
        return $stmt->execute();
    }

    // contar solicitudes pendientes para el dashboard de admin
    public function countPendientes()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE estado = 'Pendiente'");
        return $stmt->fetch()['total'];
    }
}
?>