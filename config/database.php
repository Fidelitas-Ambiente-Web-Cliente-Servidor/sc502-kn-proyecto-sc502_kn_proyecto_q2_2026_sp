<?php
class Database
{
    private static $instance = null;
    private $connection;

    private $host = 'db';
    private $db_name = 'huellas_felices';
    private $username = 'root';
    private $password = 'root';

    private function __construct()
    {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    // obtener la unica instancia de la conexion
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // obtener el objeto pdo
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    // evita clonacion del objeto
    private function __clone()
    {
    }
}
?>