<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Importar controladores y modelos
require_once __DIR__ . '/../../controllers/ReservaController.php';
require_once __DIR__ . '/../../models/Reserva.php';
require_once __DIR__ . '/../../models/Pista.php';
require_once __DIR__ . '/../../models/Usuario.php';

include '../../includes/header.php';
include '../../includes/navbar.php';

// 🔹 Procesar acciones del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ✅ Eliminar reserva
    if (isset($_POST['eliminar'])) {
        $id = $_POST['id_reserva'];
        $resultado = ReservaController::eliminar($id);

        echo $resultado['success']
            ? "<p style='color:green;'>🗑️ {$resultado['message']}</p>"
            : "<p style='color:red;'>❌ {$resultado['message']}</p>";
    }

    // ✅ Actualizar reserva (por ejemplo, cambiar estado)
    if (isset($_POST['editar'])) {
        $id_reserva = $_POST['id_reserva'];
        $fecha = $_POST['fecha_reserva'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $estado = $_POST['estado'];

        $resultado = ReservaController::actualizarReserva($id_reserva, $fecha, $hora_inicio, $hora_fin, $estado);

        echo $resultado['success']
            ? "<p style='color:green;'>✅ {$resultado['message']}</p>"
            : "<p style='color:red;'>❌ {$resultado['message']}</p>";
    }
}

// 🔹 Obtener todas las reservas
$reservas = ReservaController::listarTodas();

// 🔹 Posibles estados
$estados = ['pendiente', 'confirmada', 'cancelada'];
?>

<main class="container my-5">
  <h2 class="text-center mb-4">📅 Gestión de Reservas</h2>

  <div class="table-responsive shadow-sm">
    <table class="table table-bordered table-hover align-middle bg-white">
      <thead class="table-primary text-center">
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Pista</th>
          <th>Fecha</th>
          <th>Hora inicio</th>
          <th>Hora fin</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($reservas as $reserva): 
          $usuario = Usuario::obtenerPorId($reserva['usuario_id']) ?? ['nombre' => 'Desconocido'];
          $pista = Pista::obtenerPorId($reserva['pista_id']) ?? ['nombre' => 'Eliminada'];
        ?>
          <tr>
            <form method="POST">
              <td class="text-center"><?= $reserva['id_reserva'] ?></td>
              <td><?= htmlspecialchars($usuario['nombre']) ?></td>
              <td><?= htmlspecialchars($pista['nombre']) ?></td>
              <td>
                <input type="date" name="fecha_reserva" class="form-control form-control-lg"
                       value="<?= htmlspecialchars($reserva['fecha_reserva']) ?>">
              </td>
              <td>
                <input type="time" name="hora_inicio" class="form-control form-control-lg"
                       value="<?= htmlspecialchars($reserva['hora_inicio']) ?>">
              </td>
              <td>
                <input type="time" name="hora_fin" class="form-control form-control-lg"
                       value="<?= htmlspecialchars($reserva['hora_fin']) ?>">
              </td>
              <td>
                <select name="estado" class="form-select form-select-lg">
                  <?php foreach ($estados as $estado): ?>
                    <option value="<?= $estado ?>" <?= $reserva['estado'] === $estado ? 'selected' : '' ?>>
                      <?= ucfirst($estado) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
              <td class="text-center">
                <input type="hidden" name="id_reserva" value="<?= $reserva['id_reserva'] ?>">
                <button type="submit" name="editar" class="btn btn-primary btn-lg me-2">💾 Guardar</button>
                <button type="submit" name="eliminar" class="btn btn-danger btn-lg"
                        onclick="return confirm('¿Eliminar esta reserva?');">🗑️ Eliminar</button>
              </td>
            </form>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>

<?php include '../../includes/footer.php'; ?>
