<?php
// editar.php
// Editar información de un usuario

$page_title = "Editar Usuario";
require_once "../../includes/header.php";
require_once '../../controllers/usuarioController.php';

$usuarioController = new UsuarioController();

// Verificar que el ID de usuario esté presente en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de usuario inválido.";
    require_once "../../includes/footer.php";
    exit();
}

// Obtener datos del usuario
$usuario = $usuarioController->obtener($_GET['id']);
if (!$usuario) {
    echo "Usuario no encontrado.";
    require_once "../../includes/footer.php";
    exit();
}

// Procesar formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validación de datos
    $nombre_usuario = trim($_POST['nombre_usuario']);
    $tipo_usuario = $_POST['tipo_usuario'];
    $contrasena = $_POST['contrasena'];

    // Validación simple
    if (empty($nombre_usuario) || empty($tipo_usuario)) {
        $error_message = "Todos los campos son obligatorios.";
    } elseif (strlen($nombre_usuario) < 3) {
        $error_message = "El nombre de usuario debe tener al menos 3 caracteres.";
    } else {
        // Validación de contraseña (solo si se proporciona una nueva)
        if (!empty($contrasena) && strlen($contrasena) < 6) {
            $error_message = "La contraseña debe tener al menos 6 caracteres.";
        } else {
            // Si no se proporciona una nueva contraseña, se conserva la actual
            $datos = [
                'nombre_usuario' => $nombre_usuario,
                'tipo_usuario' => $tipo_usuario,
                'contrasena' => !empty($contrasena) ? password_hash($contrasena, PASSWORD_DEFAULT) : $usuario['contrasena']
            ];

            if ($usuarioController->editar($_GET['id'], $datos)) {
                $success_message = "Usuario actualizado exitosamente.";
                // Obtener los datos actualizados del usuario
                $usuario = $usuarioController->obtener($_GET['id']);
            } else {
                $error_message = "Error al actualizar el usuario.";
            }
        }
    }
}

?>
<div class="container mt-5">
    <h2 class="mb-4">Editar Usuario</h2>

    <!-- Mostrar mensajes de éxito y error -->
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
            <input type="text" name="nombre_usuario" class="form-control" value="<?= htmlspecialchars($usuario['nombre_usuario']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" name="contrasena" class="form-control" placeholder="Dejar en blanco si no desea cambiarla">
        </div>

        <div class="mb-3">
            <label for="tipo_usuario" class="form-label">Rol</label>
            <select name="tipo_usuario" class="form-select" required>
                <option value="admin" <?= $usuario['tipo_usuario'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                <option value="usuario" <?= $usuario['tipo_usuario'] == 'usuario' ? 'selected' : '' ?>>Usuario</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php require_once "../../includes/footer.php"; ?>

