<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/reservaController.php';
require_once __DIR__ . '/../models/Pista.php';
require_once __DIR__ . '/../models/Reserva.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user'])) {
    header('Location: /TFG3/public/login.php');
    exit();
}

$usuario_id = $_SESSION['user']['id'];

// Obtener el ID de la pista desde la URL
$pista_id = $_GET['pista_id'] ?? null;
$pista = Pista::obtenerporId($pista_id);
$pista_nombre = $pista['nombre'] ?? 'Desconocida';

if (!$pista_id) {
    header('Location: /TFG3/public/pistasPadel.php');
    exit();
} 

// Variables iniciales
$mensaje = '';
$fechaSeleccionada = $_POST['fecha_reserva'] ?? null;
$horaSeleccionada = $_POST['hora_inicio'] ?? null;

// Acción al reservar
if (isset($_POST['reservar'])) {
  if ($fechaSeleccionada && $horaSeleccionada) {
    $hora_fin = date('H:i:s', strtotime($horaSeleccionada) + 3600); // 1 hora después
    $resultado = ReservaController::crearReserva(
      $usuario_id,
      $pista_id,
      $fechaSeleccionada,
      $horaSeleccionada,
      $hora_fin,
      'confirmada'
    );

    $mensaje = $resultado['success'] 
      ? '<div class="alert alert-success">Reserva realizada con éxito para el ' . htmlspecialchars($fechaSeleccionada) . ' a las ' . htmlspecialchars(substr($horaSeleccionada, 0, 5)) . '.</div>'
      : '<div class="alert alert-danger">' . htmlspecialchars($resultado['message']) . '</div>';
  }
}

//Mostrar reservas existentes
$todasLasReservas = reservaController::listarPorPista($pista_id);

//Generar las horas disponibles (08:00 a 22:00)
$reservasDia = [];
$todasLasHoras = [];
for ($i = 8; $i < 22; $i++) {
    $hora = sprintf('%02d:00:00', $i);
    $ocupada = false;

    foreach ($reservasDia as $r) {
        if ($hora >= $r['hora_inicio'] && $hora < $r['hora_fin']) {
            $ocupada = true;
            break;
        }
    }

    if (!$ocupada) {
        $todasLasHoras[] = $hora;
    }
}

// Cancelar una reserva
if (isset($_POST['cancelar_reserva'])) {
    $id_reserva = $_POST['cancelar_reserva'];
    $resultado = ReservaController::eliminar($id_reserva);

    $mensaje = $resultado['success']
        ? "<div class='alert alert-warning text-center'>🗑️ {$resultado['message']}</div>"
        : "<div class='alert alert-danger text-center'>{$resultado['message']}</div>";
}
?>



<main>
    <div class="container text-center mt-4">
        <h1 class="mb-4">Calendario de Reservas - Pista <?= htmlspecialchars($pista_nombre) ?></h1>
        <p class="lead mb-5">Aquí podrás ver y gestionar tus reservas para la pista seleccionada.</p>
        <div class="container mt-5">
    <div class="text-center mb-4">
      <h2>📅 Reserva - <?= htmlspecialchars($pista['nombre']) ?></h2>
      <p class="text-muted">Precio: <strong><?= htmlspecialchars($pista['precio_hora']) ?> €/hora</strong></p>
    </div>

    <?= $mensaje ?>

    <!-- 🟢 FORMULARIO PARA ELEGIR FECHA -->
    <form method="POST" class="mb-4 text-center">
      <label for="fecha_reserva" class="form-label fw-bold">📆 Selecciona una fecha</label><br>
      <input type="date" name="fecha_reserva" id="fecha_reserva"
             min="<?= date('Y-m-d') ?>"
             value="<?= htmlspecialchars($fechaSeleccionada ?? '') ?>"
             required>
      <button type="submit" name="ver_disponibilidad" class="btn btn-primary btn-sm ms-2">Ver disponibilidad</button>
    </form>

    <!-- 🟢 FORMULARIO PARA ELEGIR HORA (solo si ya se eligió una fecha) -->
    <?php if ($fechaSeleccionada): ?>
      <form method="POST" class="text-center">
        <input type="hidden" name="fecha_reserva" value="<?= htmlspecialchars($fechaSeleccionada) ?>">
        <label for="hora_inicio" class="form-label fw-bold">🕒 Horas disponibles (1h)</label><br>
        <select name="hora_inicio" id="hora_inicio" required>
          <option value="">Selecciona una hora...</option>
          <?php foreach ($todasLasHoras as $h): ?>
            <option value="<?= htmlspecialchars($h) ?>"><?= substr($h, 0, 5) ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit" name="reservar" class="btn btn-success btn-sm ms-2">Reservar</button>
      </form>
    <?php endif; ?>

    <!-- 🟢 TABLA DE RESERVAS EXISTENTES -->
    <div class="mt-5">
      <h4 class="mb-3 text-center">📋 Reservas existentes</h4>
      <?php if (empty($todasLasReservas)): ?>
        <p class="text-muted text-center">No hay reservas para esta pista.</p>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-bordered table-striped text-center">
            <thead class="table-light">
              <tr>
                <th>Fecha</th>
                <th>Hora inicio</th>
                <th>Hora fin</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
  <?php foreach ($todasLasReservas as $r): ?>
    <tr>
      <td><?= htmlspecialchars($r['fecha_reserva']) ?></td>
      <td><?= substr($r['hora_inicio'], 0, 5) ?></td>
      <td><?= substr($r['hora_fin'], 0, 5) ?></td>
      <td>
        <span class="badge bg-success"><?= htmlspecialchars(ucfirst($r['estado'])) ?></span>
      </td>

      <td>
        <?php if ($r['usuario_id'] == $usuario_id): ?>
          <form method="POST" style="display:inline;">
            <input type="hidden" name="cancelar_reserva" value="<?= $r['id_reserva'] ?>">
            <button type="submit" class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('¿Seguro que quieres cancelar esta reserva?');">
              Cancelar
            </button>
          </form>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
        
    
        <!-- Aquí iría el código para mostrar el calendario y las reservas -->
    
    </div>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>

