<?php
session_start();
require_once __DIR__ . '/../controllers/PistaController.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

// Obtener todas las pistas de pádel
$pistas = PistaController::listarPorDeporte('futbol');
?>
<main>
  <div class="container text-center mt-4">
    <h1 class="mb-4">Reserva tu pista de Fútbol</h1>
    <p class="lead mb-5">Selecciona una pista para continuar con la reserva</p>

    <div class="row g-4 justify-content-center">
      <?php foreach ($pistas as $pista): ?>
        <div class="col-6 col-md-3">
          <div class="card h-100 shadow-sm border-0">
            <img src="img/<?= strtolower(str_replace(' ', '_', $pista['nombre'])) ?>.png"
                 class="card-img-top"
                 alt="<?= htmlspecialchars($pista['nombre']) ?>">

            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($pista['nombre']) ?></h5>
              <p class="card-text mb-2">💶 <strong><?= htmlspecialchars($pista['precio_hora']) ?> €/hora</strong></p>

              <a href="calendario.php?pista_id=<?= $pista['id_pista'] ?>"
                 class="btn btn-success w-100">
                Reservar
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
