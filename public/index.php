<?php
session_start();

// Si el usuario NO está logueado → lo mandamos al login
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

$user = $_SESSION['user'];

// Incluir cabecera (con Bootstrap y navbar)
include_once __DIR__ . '/../includes/header.php';
include_once __DIR__ . '/../includes/navbar.php';

if ($user['rol'] === 'administrador'): ?>
  <div class="text-center mb-4">
    <a href="admin/indexAdmin.php"
      class="btn btn-light border border-2 rounded-4 px-4 py-3 fw-semibold shadow-sm sport-card"
      style="transition: all 0.3s ease;">
      ⚙️ Volver al Panel de Administrador
    </a>
  </div>
<?php endif;
?>

<main>
  <div class="text-center mt-5">
    <h1 class="mb-4">Bienvenido, <?= htmlspecialchars($user['nombre']) ?> 👋</h1>
    <p class="lead">Selecciona el deporte que quieres reservar:</p>
  </div>

  <div class="container text-center mt-4">
    <h1 class="mb-4">Reserva tu pista</h1>
    <p class="lead">Selecciona el deporte que deseas practicar</p>
    <div class="row g-4 justify-content-center">

      <!-- Pádel -->
      <div class="col-6 col-md-3">
        <a href="pistasPadel.php" class="sport-card">
          <img src="img/padel.png" alt="Pádel" class="img-fluid">
          <div class="sport-overlay">
            <span>Pádel</span>
          </div>
        </a>
      </div>

      <!-- Fútbol -->
      <div class="col-6 col-md-3">
        <a href="pistasFutbol.php" class="sport-card">
          <img src="img/futbol.png" alt="Fútbol" class="img-fluid">
          <div class="sport-overlay">
            <span>Fútbol</span>
          </div>
        </a>
      </div>

      <!-- Tenis -->
      <div class="col-6 col-md-3">
        <a href="pistasTenis.php" class="sport-card">
          <img src="img/tenis.png" alt="Tenis" class="img-fluid">
          <div class="sport-overlay">
            <span>Tenis</span>
          </div>
        </a>
      </div>

      <!-- Baloncesto -->
      <div class="col-6 col-md-3">
        <a href="pistasBaloncesto.php" class="sport-card">
          <img src="img/baloncesto.png" alt="Baloncesto" class="img-fluid">
          <div class="sport-overlay">
            <span>Baloncesto</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</main>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>