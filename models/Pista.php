<?php
require_once __DIR__ . '/../config/db.php';

class Pista {

    // 🔹 Obtener todas las pistas
    public static function obtenerTodas() {
        global $conn;
        $sql = "SELECT * FROM pista";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 🔹 Obtener pistas por deporte (p.ej. 'padel')
    public static function obtenerPorDeporte($deporte) {
        global $conn;
        $sql = "SELECT * FROM pista WHERE deporte = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $deporte);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 🔹 Obtener una pista por su ID
    public static function obtenerPorId($id_pista) {
        global $conn;
        $sql = "SELECT * FROM pista WHERE id_pista = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_pista);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 🔹 Crear una nueva pista (opcional, para admin)
    public static function crear($nombre, $deporte, $precio_hora, $disponibilidad) {
        global $conn;
        $sql = "INSERT INTO pista (nombre, deporte, precio_hora, disponibilidad)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $nombre, $deporte, $precio_hora, $disponibilidad);
        return $stmt->execute();
    }

    // 🔹 Actualizar una pista (opcional)
    public static function actualizar($id_pista, $nombre, $deporte, $precio_hora, $disponibilidad) {
        global $conn;
        $sql = "UPDATE pista SET nombre=?, deporte=?, precio_hora=?, disponibilidad=? WHERE id_pista=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdii", $nombre, $deporte, $precio_hora, $disponibilidad, $id_pista);
        return $stmt->execute();
    }

    // 🔹 Eliminar pista (opcional)
    public static function eliminar($id_pista) {
        global $conn;
        $sql = "DELETE FROM pista WHERE id_pista = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_pista);
        return $stmt->execute();
    }
}
?>
