<?php 
include_once __DIR__ . '/../controllers/pistaController.php';
include_once __DIR__ . '/../includes/header.php';
include_once __DIR__ . '/../includes/navbar.php';
$controller = new pistaController();
$pistas = $controller->listarPorDeporte('padel');
?>

<main class="container mt-5">
  <h2 class="text-center mb-4">Selecciona tu pista de Pádel 🎾</h2>

  <?php if (empty($pistas)): ?>
    <p class="text-center">No hay pistas de pádel disponibles en este momento.</p>
  <?php else: ?>
    <div class="row justify-content-center g-4">
      <?php foreach ($pistas as $pista): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
              <h5 class="card-title"><?= htmlspecialchars($pista['nombre']) ?></h5>
              <p class="card-text mb-1">
                <strong>Precio:</strong> <?= htmlspecialchars($pista['precio_hora']) ?> €/hora
              </p>
              <p class="card-text mb-3">
                <strong>Disponibilidad:</strong>
                <?= htmlspecialchars($pista['disponibilidad']) ?>
              </p>
              <?php if (strtolower($pista['disponibilidad']) === 'disponible'): ?>
                <a href="reserva.php?id=<?= $pista['id_pista'] ?>" class="btn btn-success">
                  Reservar
                </a>
              <?php else: ?>
                <button class="btn btn-secondary" disabled>No disponible</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>

