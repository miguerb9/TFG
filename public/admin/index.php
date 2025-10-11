<?php
session_start();

// Comprobamos que el usuario esté logueado y sea administrador
if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'administrador') {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];
include '../../includes/header.php';
include 'navbarAdmin.php';
?>
<main>
  <h1>Bienvenido al panel de administración, <?= htmlspecialchars($user['nombre']) ?></h1>
</main>
  


<?php
include '../../includes/footer.php';
?>
</body>
</html>