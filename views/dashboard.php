<?php
// dashboard.php
// Página principal después de iniciar sesión

$page_title = "Panel de Administración - Sistema INCES";
require_once "../includes/header.php";  // Incluir el encabezado común

// Iniciar la sesión y verificar si el usuario está logueado
session_start();
if (!isset($_SESSION['usuario_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está logueado
    header('Location: ' . BASE_URL . 'views/login.php');
    exit();
}

// Opcional: Obtener información adicional del usuario si es necesario
// Aquí podrías hacer una consulta a la base de datos para obtener detalles del usuario logueado, como su nombre o rol
// Ejemplo:
// $usuarioController = new UsuarioController();
// $usuario = $usuarioController->obtener($_SESSION['usuario_id']);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Bienvenido al Sistema INCES</h3>
                </div>
                <div class="card-body">
                    <p>Selecciona una opción en el menú de navegación para comenzar.</p>

                    <!-- Información adicional del usuario -->
                    <div class="user-info mb-4">
                        <p><strong>Usuario:</strong> <?= isset($usuario) ? htmlspecialchars($usuario['nombre']) : 'No disponible'; ?></p>
                        <p><strong>Rol:</strong> <?= isset($usuario) ? htmlspecialchars($usuario['rol']) : 'No disponible'; ?></p>
                    </div>

                    <!-- Opciones principales del panel -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Gestión de Participantes</h5>
                                    <p class="card-text">Administra los participantes del sistema.</p>
                                    <a href="<?= BASE_URL ?>views/participante/listar.php" class="btn btn-primary">Ver Participantes</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Gestión de Cursos</h5>
                                    <p class="card-text">Crea y administra los cursos disponibles.</p>
                                    <a href="<?= BASE_URL ?>views/curso/listar.php" class="btn btn-primary">Ver Cursos</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Gestión de Usuarios</h5>
                                    <p class="card-text">Administra los usuarios del sistema.</p>
                                    <a href="<?= BASE_URL ?>views/usuario/listar.php" class="btn btn-primary">Ver Usuarios</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../includes/footer.php";  // Incluir el pie de página ?>
