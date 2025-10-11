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
?>

<div class="text-center mt-5">
  <h1 class="mb-4">Bienvenido, <?= htmlspecialchars($user['nombre']) ?> 👋</h1>
  <p class="lead">Selecciona el deporte que quieres reservar:</p>
</div>

  <div class="container text-center mt-4">
    <h1 class="mb-4">Reserva tu pista</h1>
    <p class="lead">Selecciona el deporte que deseas practicar</p>

    <div class="sports-grid">
      <!-- Pádel -->
      <a href="reserva_padel.php" class="sport-card">
        <img src="img/padel.png" alt="Pádel">
        <div class="sport-title">Pádel</div>
      </a>

      <!-- Fútbol -->
      <a href="reserva_futbol.php" class="sport-card">
        <img src="img/futbol.png" alt="Fútbol">
        <div class="sport-title">Fútbol</div>
      </a>

      <!-- Tenis -->
      <a href="reserva_tenis.php" class="sport-card">
        <img src="img/tenis.png" alt="Tenis">
        <div class="sport-title">Tenis</div>
      </a>

      <!-- Baloncesto -->
      <a href="reserva_baloncesto.php" class="sport-card">
        <img src="img/baloncesto.png" alt="Baloncesto">
        <div class="sport-title">Baloncesto</div>
      </a>
    </div>
  </div>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
