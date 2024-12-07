<?php
// db.php
// Archivo para gestionar la conexión a la base de datos

require_once __DIR__ . '/../config.php'; // Configuración de la base de datos

class Database {
    private static $pdo;

    // Método para obtener la conexión a la base de datos
    public static function getConnection() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                    DB_USER,
                    DB_PASSWORD
                );
                // Configurar atributos de PDO
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar excepciones
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Modo de obtención por defecto
            } catch (PDOException $e) {
                // Log del error y mensaje genérico en producción
                error_log("Error de conexión: " . $e->getMessage());
                die("No se pudo conectar a la base de datos. Inténtalo más tarde.");
            }
        }
        return self::$pdo;
    }
}

?>
