<?php
session_start();
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
?>

<main class="container mt-5">
  <h1 class="text-center mb-4">🏟️ Sobre Nosotros</h1>
  <p class="lead text-center mb-5">
    Conoce más sobre <strong>MatchPoint</strong>, la plataforma líder en reservas de pistas deportivas.
  </p>

  <!-- Botones interactivos -->
  <div class="text-center mb-4">
    <button class="btn btn-outline-success mx-2 info-btn" data-section="quienes">Quiénes somos</button>
    <button class="btn btn-outline-success mx-2 info-btn" data-section="donde">Dónde encontrarnos</button>
    <button class="btn btn-outline-success mx-2 info-btn" data-section="equipo">Nuestro equipo</button>
  </div>

  <!-- Contenedor dinámico donde JS cambiará el contenido -->
  <div id="infoSection" class="card shadow-sm p-4 text-center">
    <h3>Haz clic en una sección para saber más 👇</h3>
  </div>

  
</main>



<?php require_once __DIR__ . '/../includes/footer.php'; ?>
