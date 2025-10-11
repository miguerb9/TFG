<?php
// Mostrar errores para depurar (solo mientras desarrollas)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $rol = 'cliente'; // 👈 por defecto, todos los usuarios nuevos son clientes

    // 🔹 Validar campos vacíos
    if (empty($nombre) || empty($email) || empty($password)) {
        echo "❌ Todos los campos son obligatorios.";
        exit;
    }

    // 🔹 Validar formato del email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "⚠️ El correo no tiene un formato válido.";
        exit;
    }

    // 🔹 Comprobar si el correo ya existe
    $usuarioExistente = Usuario::obtenerPorEmail($email);
    if ($usuarioExistente) {
        echo "⚠️ Ya existe un usuario registrado con ese correo.";
        exit;
    }

    // 🔹 Registrar el usuario
    if (Usuario::registrar($nombre, $email, $password, $rol)) {
    // Iniciar sesión automáticamente
    session_start();
    $_SESSION['user'] = [
        'nombre' => $nombre,
        'email' => $email,
        'rol' => $rol
    ];
    
    echo "✅ Registro exitoso. Redirigiendo...";
    header("Location: ../public/index.php");
    exit;
    } else {
    global $conn;
    echo "❌ Error al registrar el usuario: " . mysqli_error($conn);
}
} else {
    echo "⚠️ Acceso no permitido.";
}
?>
