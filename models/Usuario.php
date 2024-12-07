<?php
// Usuario.php
// Clase para gestionar los usuarios

require_once 'Database.php';

class Usuario
{
    private $conn;
    private $table_name = "usuario";

    public $id_usuario;
    public $nombre_usuario;
    public $contrasena;
    public $tipo_usuario;
    public $correo_electronico;

    public function __construct($dbConnection = null)
    {
        // Si no se pasa una conexión, obtener la instancia de la clase Database (Singleton)
        if ($dbConnection === null) {
            $database = Database::getInstance();  // Obtener la instancia de Database usando el Singleton
            $this->conn = $database->getConnection();  // Obtener la conexión
        } else {
            $this->conn = $dbConnection;
        }
    }

   
    // Validar nombre de usuario
    private function validarNombreUsuario($nombre_usuario)
    {
        if (preg_match('/[^a-zA-Z0-9_]/', $nombre_usuario)) {
            return false; // Nombre de usuario contiene caracteres inválidos
        }
        return true;
    }

    // Validar correo electrónico
    private function validarCorreo($correo_electronico)
    {
        return filter_var($correo_electronico, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Registrar un nuevo usuario
    public function registrar($nombre_usuario, $contrasena, $tipo_usuario, $correo_electronico)
    {
        // Validar nombre de usuario
        if (!$this->validarNombreUsuario($nombre_usuario)) {
            return ["success" => false, "mensaje" => "Nombre de usuario no válido. Sólo se permiten letras, números y guiones bajos."];
        }

        // Validar correo electrónico
        if (!$this->validarCorreo($correo_electronico)) {
            return ["success" => false, "mensaje" => "Correo electrónico no válido."];
        }

        // Encriptar la contraseña
        $contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

        try {
            // Comprobar si el usuario ya existe
            if ($this->existeUsuario($nombre_usuario)) {
                return ["success" => false, "mensaje" => "El nombre de usuario ya está registrado."];
            }

            // Insertar nuevo usuario en la base de datos
            $query = "INSERT INTO " . $this->table_name . " (nombre_usuario, contrasena, tipo_usuario, correo_electronico) 
                      VALUES (:nombre_usuario, :contrasena, :tipo_usuario, :correo_electronico)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre_usuario', $nombre_usuario);
            $stmt->bindParam(':contrasena', $contrasena_encriptada);
            $stmt->bindParam(':tipo_usuario', $tipo_usuario);
            $stmt->bindParam(':correo_electronico', $correo_electronico);

            if ($stmt->execute()) {
                return ["success" => true, "mensaje" => "Usuario registrado exitosamente."];
            } else {
                return ["success" => false, "mensaje" => "Error al registrar el usuario. Intente nuevamente."];
            }
        } catch (PDOException $e) {
            error_log("Error al registrar el usuario: " . $e->getMessage());
            return ["success" => false, "mensaje" => "Error al registrar el usuario. Por favor, inténtelo más tarde."];
        }
    }

    // Verificar si el usuario existe por nombre de usuario
    public function existeUsuario($nombre_usuario)
    {
        $query = "SELECT id_usuario FROM " . $this->table_name . " WHERE nombre_usuario = :nombre_usuario LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Obtener un usuario por ID
    public function obtenerPorId($id_usuario)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id_usuario = :id_usuario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener usuario por ID: " . $e->getMessage());
            return false;
        }
    }

    // Obtener un usuario por nombre de usuario
    public function obtenerPorNombreUsuario($nombre_usuario)
    {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE nombre_usuario = :nombre_usuario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre_usuario', $nombre_usuario);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener usuario por nombre de usuario: " . $e->getMessage());
            return false;
        }
    }

    // Editar los datos de un usuario
    public function editar($id_usuario, $nombre_usuario, $contrasena, $tipo_usuario, $correo_electronico)
    {
        // Validar nombre de usuario y correo electrónico
        if (!$this->validarNombreUsuario($nombre_usuario)) {
            return ["success" => false, "mensaje" => "Nombre de usuario no válido. Sólo se permiten letras, números y guiones bajos."];
        }
        if (!$this->validarCorreo($correo_electronico)) {
            return ["success" => false, "mensaje" => "Correo electrónico no válido."];
        }

        // Encriptar la nueva contraseña
        $contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

        try {
            $query = "UPDATE " . $this->table_name . " 
                      SET nombre_usuario = :nombre_usuario, contrasena = :contrasena, tipo_usuario = :tipo_usuario, correo_electronico = :correo_electronico
                      WHERE id_usuario = :id_usuario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre_usuario', $nombre_usuario);
            $stmt->bindParam(':contrasena', $contrasena_encriptada);
            $stmt->bindParam(':tipo_usuario', $tipo_usuario);
            $stmt->bindParam(':correo_electronico', $correo_electronico);
            $stmt->bindParam(':id_usuario', $id_usuario);

            if ($stmt->execute()) {
                return ["success" => true, "mensaje" => "Usuario actualizado exitosamente."];
            } else {
                return ["success" => false, "mensaje" => "Error al actualizar el usuario. Intente nuevamente."];
            }
        } catch (PDOException $e) {
            error_log("Error al editar el usuario: " . $e->getMessage());
            return ["success" => false, "mensaje" => "Error al editar el usuario. Por favor, inténtelo más tarde."];
        }
    }

    // Listar todos los usuarios
    public function listar()
    {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al listar usuarios: " . $e->getMessage());
            return [];
        }
    }
}
