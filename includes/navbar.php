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
      <li>
        <a href="<?= (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'administrador') 
        ? '/TFG3/public/admin/indexAdmin.php' 
        : '/TFG3/public/index.php' ?>">
        Inicio
        </a>
      </li>
      <li><a href="/TFG3/public/contacto.php">Contacto</a></li>

      <?php if (isset($_SESSION['user'])): ?>
        <li><a href="/TFG3/public/logout.php">Cerrar sesión</a></li>
      <?php else: ?>
        <li><a href="/TFG3/public/login.php">Iniciar sesión</a></li>
      <?php endif; ?> 
    </ul>
  </div>
</nav>


