<?php
$host = 'localhost';
$db   = 'daw_reservas';
$user = 'root';
$pass = '';

// Crear conexión
$conn = mysqli_connect($host, $user, $pass, $db);

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
echo "Conexión exitosa.";
?>  