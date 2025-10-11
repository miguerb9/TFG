<?php
require_once __DIR__ . '/../config/db.php';

class Usuario {

    // 🔹 Obtener un usuario por su email
    public static function obtenerPorEmail($email) {
        global $conn;
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 🔹 Registrar un nuevo usuario
    public static function registrar($nombre, $email, $password, $rol = 'cliente') {
        global $conn;
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuario (nombre, email, contrasena, rol) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $email, $hash, $rol);
        return $stmt->execute();
    }

    // 🔹 Obtener todos los usuarios
    public static function obtenerTodos() {
        global $conn;
        $result = $conn->query("SELECT * FROM usuario");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
