<?php
$user = $_SESSION['user'] ?? null;
?>

<!-- Barra de navegación -->
<nav class="mi-navbar">
  <div class="navbar-container">
    <!-- LOGO -->
     <a href="/TFG3/public/index.php" class="navbar-logo">
      <img src="/TFG3/public/img/logo.png" alt="MatchPoint Logo">
    </a>

    <!-- Enlaces del menú -->
    <ul class="navbar-links">
      <li><a href="/TFG3/public//admin/index.php">Inicio</a></li>
      <li><a href="/TFG3/public/admin/usuarios.php">Usuarios</a></li>
      <li><a href="/TFG3/public/admin/pistas.php">Ver pistas</a></li>
      <li><a href="/TFG3/public/admin/reservas.php">Ver reservas</a></li> 
      

      <?php if (isset($_SESSION['user'])): ?>
        <li><a href="/TFG3/public/logout.php">Cerrar sesión</a></li>
      <?php else: ?>
        <li><a href="/TFG3/public/login.php">Iniciar sesión</a></li>
      <?php endif; ?> 
    </ul>
  </div>
</nav>