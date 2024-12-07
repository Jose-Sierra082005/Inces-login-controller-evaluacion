<?php
// login.php
// Página de inicio de sesión

$page_title = "Iniciar sesión - Sistema INCES";
require_once "../includes/header.php";  // Incluir encabezado común

session_start();

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL . 'views/dashboard.php');
    exit();
}

$error_message = '';

// Procesar el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Llamamos al controlador de login
    require_once "../controllers/loginController.php";
    $loginController = new LoginController();
    $response = $loginController->login($username, $password);

    // Si la respuesta es exitosa, redirigir al dashboard
    if ($response['success']) {
        header('Location: ' . $response['data']['redirect']);
        exit();
    } else {
        $error_message = $response['mensaje'];
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Iniciar sesión</h3>
                </div>
                <div class="card-body">
                    <!-- Mostrar mensajes de error si los hay -->
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="username">Usuario</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../includes/footer.php"; ?>
