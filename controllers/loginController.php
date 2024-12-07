<?php
// loginController.php
// Controlador para gestionar el inicio de sesión de los usuarios

require_once '../models/Usuario.php';

class LoginController
{
    public function login($nombre_usuario, $password)
    {
        // Verificar si la sesión ya está activa antes de llamarla
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Aseguramos que la sesión esté activa
        }

        // Validar entradas
        if (empty($nombre_usuario) || empty($password)) {
            return $this->respuestaJson(false, "Nombre de usuario y contraseña son requeridos.");
        }

        try {
            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->obtenerPorNombreUsuario($nombre_usuario);

            // Verificar si el usuario existe y si la contraseña es correcta
            if ($usuario && password_verify($password, $usuario['contrasena'])) {
                // Iniciar sesión
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

                return $this->respuestaJson(true, "Login exitoso.", ['redirect' => '../views/dashboard.php']);
            } else {
                // Usuario o contraseña incorrectos
                return $this->respuestaJson(false, "Usuario o contraseña incorrectos.");
            }
        } catch (Exception $e) {
            return $this->respuestaJson(false, "Error de servidor. Por favor, inténtelo más tarde.");
        }
    }

    // Función auxiliar para generar respuestas JSON
    private function respuestaJson($success, $mensaje, $data = [])
    {
        return [
            'success' => $success,
            'mensaje' => $mensaje,
            'data' => $data
        ];
    }
}


