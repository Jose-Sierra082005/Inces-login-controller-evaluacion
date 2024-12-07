<?php
// listar.php
// Listar usuarios

$page_title = "Listado de Usuarios";
require_once "../../includes/header.php";

require_once '../../controllers/usuarioController.php';

// Verificar si la clase existe antes de instanciarla
if (class_exists('UsuarioController')) {
    $usuarioController = new UsuarioController();
    $usuarios = $usuarioController->listar();
} else {
    echo "Error: La clase UsuarioController no fue encontrada.";
    require_once "../../includes/footer.php";
    exit();
}

?>
<div class="container mt-4">
    <h2 class="mb-4">Listado de Usuarios</h2>
    <a href="registrar.php" class="btn btn-primary mb-3">Registrar nuevo usuario</a>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Nombre de Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($usuarios)): ?>
                <tr><td colspan="3" class="text-center">No hay usuarios registrados.</td></tr>
            <?php else: ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['nombre_usuario']) ?></td>
                        <td><?= htmlspecialchars($usuario['tipo_usuario']) ?></td>
                        <td>
                            <a href="editar.php?id=<?= urlencode($usuario['id_usuario']) ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="eliminar.php?id=<?= urlencode($usuario['id_usuario']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once "../../includes/footer.php"; ?>



