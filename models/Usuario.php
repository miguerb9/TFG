<?php
require_once __DIR__ . '/../config/db.php';

class Usuario {

    // Obtener todos los usuarios
    public static function obtenerTodos() {
        global $conn;
        $result = $conn->query("SELECT * FROM usuario");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener un usuario por su ID
    public static function obtenerPorId($id_usuario) {
        global $conn;
        $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Obtener un usuario por su email
    public static function obtenerPorEmail($email) {
        global $conn;
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Registrar un nuevo usuario
    public static function registrar($nombre, $email, $password, $rol = 'cliente') {
        global $conn;
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuario (nombre, email, contrasena, rol) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $email, $hash, $rol);
        return $stmt->execute();
    }

    // Actualizar usuario
    public static function actualizar($id_usuario, $nombre, $email, $rol) {
        global $conn;
        $sql = "UPDATE usuario SET nombre = ?, email = ?, rol = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $email, $rol, $id_usuario);
        return $stmt->execute();
    }

    // Eliminar usuario
    public static function eliminar($id_usuario) {
        global $conn;
        $sql = "DELETE FROM usuario WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        return $stmt->execute();
    }
}
?>
