<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController
{

    // Listar todos los usuarios
    public static function listarTodos()
    {
        return Usuario::obtenerTodos();
    }

    // Ver un usuario concreto
    public static function verUsuario($id_usuario)
    {
        return Usuario::obtenerPorId($id_usuario);
    }

    // Eliminar usuario
    public static function eliminar($id_usuario)
    {
        return Usuario::eliminar($id_usuario);
    }

    // Actualizar usuario
    public static function actualizar($id_usuario, $nombre, $email, $rol)
    {
        return Usuario::actualizar($id_usuario, $nombre, $email, $rol);
    }

    // Registro de usuario
    public static function registro()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $rol = 'cliente';

            // Validar campos vacíos
            if (empty($nombre) || empty($email) || empty($password)) {
                echo "❌ Todos los campos son obligatorios.";
                exit;
            }

            // Validar formato del email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "⚠️ El correo no tiene un formato válido.";
                exit;
            }

            // Comprobar si el correo ya existe
            $usuarioExistente = Usuario::obtenerPorEmail($email);
            if ($usuarioExistente) {
                echo "⚠️ Ya existe un usuario registrado con ese correo.";
                exit;
            }

            // Registrar el usuario
            $idNuevoUsuario = Usuario::registrar($nombre, $email, $password, $rol);

            if ($idNuevoUsuario) {
                session_start();
                $_SESSION['user'] = [
                    'id' => $idNuevoUsuario,     //  ✔ ID correcto en la sesión
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
    }

    // Login de usuario
    public static function login()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $usuario = Usuario::obtenerPorEmail($email);

            if ($usuario && password_verify($password, $usuario['contrasena'])) {
                $_SESSION['user'] = [
                    'id' => $usuario['id_usuario'],  // ✔ también correcto
                    'nombre' => $usuario['nombre'],
                    'email' => $usuario['email'],
                    'rol' => $usuario['rol']
                ];

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
    }
}
