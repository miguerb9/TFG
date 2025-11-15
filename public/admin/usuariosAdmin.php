<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../controllers/usuarioController.php';
require_once __DIR__ . '/../../models/Usuario.php';


include '../../includes/header.php';
include '../../includes/navbar.php';

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Editar usuario
    if (isset($_POST['editar'])) {
        $id = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $rol = $_POST['rol'];

        Usuario::actualizar($id, $nombre, $email, $rol);
        echo "<p style='color:green;'>✅ Usuario actualizado correctamente.</p>";
    }

    // Eliminar usuario
    if (isset($_POST['eliminar'])) {
        $id = $_POST['id_usuario'];
        UsuarioController::eliminar($id);
    }
}

// Obtener todos los usuarios
$usuarios = Usuario::obtenerTodos();
?>

<main class="container my-5">
  <h2 class="text-center mb-4">👥 Gestión de Usuarios</h2>

  <div class="table-responsive shadow-sm">
    <table class="table table-bordered table-hover align-middle bg-white">
      <thead class="table-primary">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Email</th>
          <th scope="col">Rol</th>
          <th scope="col" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $usuario): ?>
          <tr>
            <form method="POST">
              <td class="text-center"><?= $usuario['id_usuario'] ?></td>
              <td>
                <input type="text" name="nombre" class="form-control form-control-lg"
                       value="<?= htmlspecialchars($usuario['nombre']) ?>">
              </td>
              <td>
                <input type="email" name="email" class="form-control form-control-lg"
                       value="<?= htmlspecialchars($usuario['email']) ?>">
              </td>
              <td>
                <select name="rol" class="form-select form-select-lg">
                  <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                  <option value="cliente" <?= $usuario['rol'] === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                </select>
              </td>
              <td class="text-center">
                <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                <button type="submit" name="editar" class="btn btn-primary btn-lg me-2">
                  💾 Guardar
                </button>
                <button type="submit" name="eliminar" class="btn btn-danger btn-lg"
                        onclick="return confirm('¿Eliminar este usuario?');">
                  🗑️ Eliminar
                </button>
              </td>
            </form>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>


<?php include '../../includes/footer.php'; ?>


