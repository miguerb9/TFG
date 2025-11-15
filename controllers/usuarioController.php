<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {

    // 🔹 Listar todos los usuarios
    public static function listarTodos() {
        return Usuario::obtenerTodos();
    }

    // 🔹 Ver un usuario concreto
    public static function verUsuario($id_usuario) {
        return Usuario::obtenerPorId($id_usuario);
    }

    // 🔹 Eliminar usuario
    public static function eliminar($id_usuario) {
        return Usuario::eliminar($id_usuario);
    }

    // 🔹 Actualizar usuario
    public static function actualizar($id_usuario, $nombre, $email, $rol) {
        return Usuario::actualizar($id_usuario, $nombre, $email, $rol);
    }

    // 🔹 Registrar usuario (opcional)
    public static function registrar($nombre, $email, $password, $rol = 'cliente') {
        return Usuario::registrar($nombre, $email, $password, $rol);
    }
}
?>
