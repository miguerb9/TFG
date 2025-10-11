<?php
require_once __DIR__ . '/../models/Usuario.php';
global $conn;

// Datos del administrador
$nombre = "Admin";
$email = "admin@miapp.com";
$password = "1234";
$rol = "administrador";

// Registrar el admin
if (Usuario::registrar($nombre, $email, $password, $rol)) {
    echo "✅ Administrador creado exitosamente.";
} else {
    echo "❌ Error al crear el administrador: " . mysqli_error($conn);
}
?>