<?php
// Database.php
// Clase para gestionar la conexión con la base de datos

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private static $instance = null; // Para el patrón Singleton
    private $conn;

    // Constructor privado para evitar instanciación directa
    private function __construct()
    {
        // Puedes usar variables de entorno o un archivo de configuración
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->db_name = getenv('DB_NAME') ?: 'inces_sistema';
        $this->username = getenv('DB_USER') ?: 'root';
        $this->password = getenv('DB_PASS') ?: '';
    }

    // Obtener la instancia única (Singleton)
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Obtener conexión a la base de datos
    public function getConnection()
    {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log("Error de conexión: " . $exception->getMessage());
                die("No se pudo conectar a la base de datos. Revisa la configuración del sistema.");
            }
        }
        return $this->conn;
    }

    // Método para cerrar la conexión (opcional)
    public function closeConnection()
    {
        $this->conn = null;
    }
}
?>


