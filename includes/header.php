<?php
// header.php
// Archivo para gestionar el encabezado común de todas las páginas
require_once __DIR__ . '/../config.php';  // Asegura que la constante BASE_URL esté disponible
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Sistema INCES'; ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">
    <!-- Agregar meta etiquetas de accesibilidad y SEO -->
    <meta name="description" content="Sistema de gestión de participantes y cursos del INCES.">

    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= BASE_URL ?>views/dashboard.php">Sistema INCES</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>views/dashboard.php" aria-label="Ir a la página de inicio">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>views/participante/listar.php" aria-label="Ver lista de participantes">Participantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>views/curso/listar.php" aria-label="Ver lista de cursos">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>views/usuario/listar.php" aria-label="Ver lista de usuarios">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>views/login.php?logout=true" aria-label="Cerrar sesión">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Incluir Bootstrap JS (Opcional si necesitas funcionalidad de interactividad) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
