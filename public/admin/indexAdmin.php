<?php
session_start();

// Comprobamos que el usuario esté logueado y sea administrador
if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'administrador') {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];

include '../../includes/header.php';
include '../../includes/navbar.php';
?>
<div class="text-center mb-4">
  <a href="/TFG3/public/index.php"
     class="btn btn-light border border-2 rounded-4 px-4 py-3 fw-semibold shadow-sm sport-card"
     style="transition: all 0.3s ease;">
    🏠 Ir a la Vista de Cliente
  </a>
</div>

<main class="container text-center py-5" style="min-height: 80vh;">
  <h1 id="adminTitle" class="fw-bold mb-4">Bienvenido al panel de administración, <?= htmlspecialchars($user['nombre']) ?></h1>
  <p id="adminSub" class="text-muted mb-5">Cargando tus estadísticas...</p>

  <section id="adminCards" class="d-flex flex-wrap justify-content-center gap-4 mt-5" style="opacity:0;">
    <div class="card shadow-lg border-0 p-4 admin-card" data-link="usuariosAdmin.php" style="width: 230px; cursor:pointer; border-radius:15px;">
      <i class="fas fa-users fa-3x mb-3 text-primary"></i>
      <h5>Usuarios</h5>
      <p class="text-muted">Gestiona los clientes registrados</p>
    </div>
    <div class="card shadow-lg border-0 p-4 admin-card" data-link="pistasAdmin.php" style="width: 230px; cursor:pointer; border-radius:15px;">
      <i class="fas fa-table-tennis-paddle-ball fa-3x mb-3 text-success"></i>
      <h5>Pistas</h5>
      <p class="text-muted">Administra las pistas del club</p>
    </div>
    <div class="card shadow-lg border-0 p-4 admin-card" data-link="reservasAdmin.php" style="width: 230px; cursor:pointer; border-radius:15px;">
      <i class="fas fa-calendar-check fa-3x mb-3 text-warning"></i>
      <h5>Reservas</h5>
      <p class="text-muted">Consulta y modifica reservas</p>
    </div>
  </section>
</main>



<?php include '../../includes/footer.php'; ?>
<script src="js/admin.js"></script>
</body>
</html>
