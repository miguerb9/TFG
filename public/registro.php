<?php
// Incluir el header y navbar comunes
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
?>

<!--Imágenes de fondo-->
  <!-- 4 imágenes del fondo -->
  <div class="bg-img top-left"></div>
  <div class="bg-img top-right"></div>
  <div class="bg-img bottom-left"></div>
  <div class="bg-img bottom-right"></div>

<!-- Formulario de registro -->
<div class="mi-registro">
  <div class="container d-flex justify-content-center align-items-center h-100">
    <div class="col-md-6 col-lg-4">
      <form action="../controllers/registroController.php" method="POST" class="registroUsuarios p-4 shadow rounded bg-white">
        <h2 class="text-center mb-4">Registro de usuario</h2>

        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Tu nombre completo" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Correo electrónico</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="tuemail@ejemplo.com" required>
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Registrarse</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php

// Incluir el footer
require_once __DIR__ . '/../includes/footer.php';
?>

