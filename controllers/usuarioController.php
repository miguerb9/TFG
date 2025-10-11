<?php
// Mostrar errores (para depurar)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluimos el modelo Usuario
require_once __DIR__ . '/../models/Usuario.php';

// Iniciamos sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Controlador básico de usuarios
class UsuarioController {

    // 🔹 Listar todos los usuarios (solo admin)
    public static function listarUsuarios() {
        // Verificar si el usuario tiene rol admin
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            echo "❌ Acceso denegado. Solo los administradores pueden ver esta sección.";
            return;
        }

        $usuarios = Usuario::obtenerTodos();

        if (empty($usuarios)) {
            echo "⚠️ No hay usuarios registrados.";
            return;
        }

        echo "<h2>Lista de Usuarios</h2>";
        echo "<table border='1' cellpadding='8'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th></tr>";

        foreach ($usuarios as $usuario) {
            echo "<tr>
                    <td>{$usuario['id_usuario']}</td>
                    <td>{$usuario['nombre']}</td>
                    <td>{$usuario['email']}</td>
                    <td>{$usuario['rol']}</td>
                  </tr>";
        }

        echo "</table>";
    }

    // 🔹 Ver perfil de un usuario (cliente o admin)
    public static function verPerfil($id) {
        $usuario = Usuario::obtenerPorId($id);

        if (!$usuario) {
            echo "❌ Usuario no encontrado.";
            return;
        }

        echo "<h2>Perfil de {$usuario['nombre']}</h2>";
        echo "<p><b>Email:</b> {$usuario['email']}</p>";
        echo "<p><b>Rol:</b> {$usuario['rol']}</p>";
    }

    // 🔹 Eliminar un usuario (solo admin)
    public static function eliminar($id) {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            echo "❌ No tienes permiso para eliminar usuarios.";
            return;
        }

        global $conn;
        $sql = "DELETE FROM usuario WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "✅ Usuario eliminado correctamente.";
        } else {
            echo "❌ Error al eliminar el usuario: " . mysqli_error($conn);
        }
    }
}

// 🔹 Ejemplo de uso directo (para pruebas)
if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'listar':
            UsuarioController::listarUsuarios();
            break;
        case 'ver':
            if (isset($_GET['id'])) {
                UsuarioController::verPerfil($_GET['id']);
            } else {
                echo "⚠️ Falta el parámetro ID.";
            }
            break;
        case 'eliminar':
            if (isset($_GET['id'])) {
                UsuarioController::eliminar($_GET['id']);
            } else {
                echo "⚠️ Falta el parámetro ID.";
            }
            break;
        default:
            echo "⚠️ Acción no válida.";
            break;
    }
}
?>
