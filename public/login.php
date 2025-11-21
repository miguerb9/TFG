<?php
session_start();

// Si el usuario ya está logueado, lo mandamos al index
if (isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

include_once __DIR__ . '/../includes/header.php';
include_once __DIR__ . '/../includes/navbar.php';
?>
<main class="login-container">

  <!-- 4 imágenes del fondo -->
  <div class="bg-img top-left"></div>
  <div class="bg-img top-right"></div>
  <div class="bg-img bottom-left"></div>
  <div class="bg-img bottom-right"></div>

  <!-- Formulario de login -->
  <div class="login-form-container d-flex align-items-center justify-content-center">
    <div class="login-card bg-white p-4 rounded shadow text-center">
      <h2 class="mb-4">Iniciar sesión</h2>
      <form action="../controllers/procesarLogin.php" method="POST">
        <div class="mb-3 text-start">
          <label for="email" class="form-label">Correo Electrónico</label>
          <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3 text-start">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
      </form>
      <p class="mt-3">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
    </div>
  </div>
</main>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>