<?php
require_once __DIR__ . '/../models/Usuario.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $usuario = Usuario::obtenerPorEmail($email);

    if ($usuario && password_verify($password, $usuario['contrasena'])) {
        $_SESSION['user'] = [
            'id' => $usuario['id_usuario'],
            'nombre' => $usuario['nombre'],
            'email' => $usuario['email'],
            'rol' => $usuario['rol']
        ];

        // Redirigir según el rol
        if ($usuario['rol'] === 'administrador') {
            header("Location: ../public/admin/indexAdmin.php");
        } else {
            header("Location: ../public/index.php");
        }
        exit;
    } else {
        header("Location: ../public/login.php?error=1");
        exit;
    }
}
?>

