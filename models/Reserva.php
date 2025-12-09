<?php
require_once __DIR__ . '/../config/db.php';

class Reserva
{

    // Obtener todas las reservas
    public static function obtenerTodas()
    {
        global $conn;
        $sql = "SELECT * FROM reserva ORDER BY fecha_reserva DESC, hora_inicio ASC";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener reservas por usuario
    public static function obtenerPorUsuario($usuario_id)
    {
        global $conn;
        $sql = "SELECT * FROM reserva WHERE usuario_id = ? ORDER BY fecha_reserva DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener reservas por pista
    public static function obtenerPorPista($pista_id)
    {
        global $conn;
        $sql = "SELECT * FROM reserva WHERE pista_id = ? ORDER BY fecha_reserva, hora_inicio";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $pista_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener reserva por ID
    public static function obtenerPorId($id_reserva)
    {
        global $conn;
        $sql = "SELECT * FROM reserva WHERE id_reserva = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_reserva);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Crear nueva reserva
    public static function crear($usuario_id, $pista_id, $fecha_reserva, $hora_inicio, $hora_fin, $estado = 'pendiente')
    {
        global $conn;
        $sql = "INSERT INTO reserva (usuario_id, pista_id, fecha_reserva, hora_inicio, hora_fin, estado)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissss", $usuario_id, $pista_id, $fecha_reserva, $hora_inicio, $hora_fin, $estado);
        return $stmt->execute();
    }

    // Actualizar reserva
    public static function actualizar($id_reserva, $fecha_reserva, $hora_inicio, $hora_fin, $estado)
    {
        global $conn;
        $sql = "UPDATE reserva 
                SET fecha_reserva = ?, hora_inicio = ?, hora_fin = ?, estado = ? 
                WHERE id_reserva = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fecha_reserva, $hora_inicio, $hora_fin, $estado, $id_reserva);
        return $stmt->execute();
    }

    // Eliminar reserva
    public static function eliminar($id_reserva)
    {
        global $conn;
        $sql = "DELETE FROM reserva WHERE id_reserva = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_reserva);
        return $stmt->execute();
    }

    // Comprobar solapamientos (ya existe reserva en ese horario)
    public static function existeReserva($pista_id, $fecha_reserva, $hora_inicio, $hora_fin)
    {
        global $conn;
        $sql = "SELECT COUNT(*) AS total 
                FROM reserva 
                WHERE pista_id = ? 
                  AND fecha_reserva = ?
                  AND (
                        (hora_inicio < ? AND hora_fin > ?) OR
                        (hora_inicio < ? AND hora_fin > ?)
                      )";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $pista_id, $fecha_reserva, $hora_fin, $hora_inicio, $hora_inicio, $hora_fin);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'] > 0;
    }
}
