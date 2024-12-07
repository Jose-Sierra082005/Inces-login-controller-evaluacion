<?php
// registrar.php
// Formulario para registrar un nuevo usuario

$page_title = "Registrar Usuario";
require_once "../../includes/header.php";

require_once '../../controllers/usuarioController.php';
$usuarioController = new UsuarioController();

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar campos del formulario
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['rol'])) {
        $error_message = "Todos los campos son requeridos.";
    } else {
        // Validar que la contraseña tenga al menos 6 caracteres
        if (strlen($_POST['password']) < 6) {
            $error_message = "La contraseña debe tener al menos 6 caracteres.";
        } else {
            // Encriptar la contraseña antes de guardarla
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            if ($usuarioController->registrar($_POST)) {
                $success_message = "Usuario registrado exitosamente.";
                header("Location: listar.php"); // Redirigir después de un registro exitoso
                exit();
            } else {
                $error_message = "Error al registrar el usuario. Intenta nuevamente.";
            }
        }
    }
}

?>

<div class="container mt-4">
    <h2 class="mb-4">Registrar Usuario</h2>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Nombre de Usuario</label>
            <input type="text" class="form-control" name="username" required placeholder="Usuario" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" name="password" required placeholder="Contraseña">
        </div>

        <div class="form-group">
            <label for="rol">Rol</label>
            <select name="rol" class="form-control" required>
                <option value="admin" <?= isset($_POST['rol']) && $_POST['rol'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                <option value="usuario" <?= isset($_POST['rol']) && $_POST['rol'] == 'usuario' ? 'selected' : '' ?>>Usuario</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<?php require_once "../../includes/footer.php"; ?>



