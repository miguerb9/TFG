<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../controllers/pistaController.php';
require_once __DIR__ . '/../../models/Pista.php';

include '../../includes/header.php';
include '../../includes/navbar.php';


// Procesar acciones del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Crear nueva pista
    if (isset($_POST['crear'])) {
        $nombre = $_POST['nombre'];
        $deporte = $_POST['deporte'];
        $precio_hora = $_POST['precio_hora'];

        if (Pista::crear($nombre, $deporte, $precio_hora)) {
            echo "<p style='color:green;'>✅ Pista creada correctamente.</p>";
        } else {
            echo "<p style='color:red;'>❌ Error al crear la pista.</p>";
        }
    }

    // Editar pista existente
    if (isset($_POST['editar'])) {
        $id = $_POST['id_pista'];
        $nombre = $_POST['nombre'];
        $deporte = $_POST['deporte'];
        $precio_hora = $_POST['precio_hora'];

        if (Pista::actualizar($id, $nombre, $deporte, $precio_hora)) {
            echo "<p style='color:green;'>✅ Pista actualizada correctamente.</p>";
        } else {
            echo "<p style='color:red;'>❌ Error al actualizar la pista.</p>";
        }
    }

    // Eliminar pista
    if (isset($_POST['eliminar'])) {
        $id = $_POST['id_pista'];

        if (Pista::eliminar($id)) {
            echo "<p style='color:green;'>🗑️ Pista eliminada correctamente.</p>";
        } else {
            echo "<p style='color:red;'>❌ Error al eliminar la pista.</p>";
        }
    }
}

// Obtener todas las pistas
$pistas = PistaController::listarTodas();

// Desplegable deporte
$deportes = ['padel', 'futbol', 'baloncesto', 'tenis'];
?>

<main class="container my-5">
  <h2 class="text-center mb-4">🏟️ Gestión de Pistas</h2>

  <!-- 🔹 Formulario para crear nueva pista -->
  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-success text-white">
      ➕ Añadir Nueva Pista
    </div>
    <div class="card-body">
      <form method="POST" class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control form-control-lg" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Deporte</label>
          <select name="deporte" class="form-select form-select-lg" required>
            <option value="">Seleccionar deporte...</option>
            <?php foreach ($deportes as $dep): ?>
              <option value="<?= $dep ?>"><?= ucfirst($dep) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Precio por hora (€)</label>
          <input type="number" step="0.01" name="precio_hora" class="form-control form-control-lg" required>
        </div>
        <div class="col-md-1 d-flex align-items-end">
          <button type="submit" name="crear" class="btn btn-success btn-lg w-100">💾</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Tabla de gestión de pistas -->
  <div class="table-responsive shadow-sm">
    <table class="table table-bordered table-hover align-middle bg-white">
      <thead class="table-primary">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Deporte</th>
          <th scope="col">Precio/Hora (€)</th>
          <th scope="col" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pistas as $pista): ?>
          <tr>
            <form method="POST">
              <td class="text-center"><?= $pista['id_pista'] ?></td>
              <td>
                <input type="text" name="nombre" class="form-control form-control-lg"
                       value="<?= htmlspecialchars($pista['nombre']) ?>">
              </td>
              <td>
                <select name="deporte" class="form-select form-select-lg">
                  <?php foreach ($deportes as $dep): ?>
                    <option value="<?= $dep ?>" <?= $pista['deporte'] === $dep ? 'selected' : '' ?>>
                      <?= ucfirst($dep) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
              <td>
                <input type="number" step="0.01" name="precio_hora" class="form-control form-control-lg"
                       value="<?= htmlspecialchars($pista['precio_hora']) ?>">
              </td>
              <td class="text-center">
                <input type="hidden" name="id_pista" value="<?= $pista['id_pista'] ?>">
                <button type="submit" name="editar" class="btn btn-primary btn-lg me-2">
                  💾 Guardar
                </button>
                <button type="submit" name="eliminar" class="btn btn-danger btn-lg"
                        onclick="return confirm('¿Eliminar esta pista?');">
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


