<?php 
// index.php
// Página principal de la aplicación que redirige al login o al dashboard

session_start();

// Verificar si el usuario está logueado
if (isset($_SESSION['usuario_id'])) {
    // Verificar si la sesión ha expirado (si se ha configurado un timeout en config.php)
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
        // Si la sesión ha expirado, destruirla y redirigir al login
        session_unset();     // Destruir todas las variables de sesión
        session_destroy();   // Destruir la sesión
        header("Location: views/login.php");
        exit();
    }
    
    // Actualizar el tiempo de la última actividad
    $_SESSION['last_activity'] = time();
    
    // Si ya está logueado, redirigir al dashboard
    header("Location: views/dashboard.php");
    exit();
} else {
    // Si no está logueado, redirigir al login
    header("Location: views/login.php");
    exit();
}
?>


