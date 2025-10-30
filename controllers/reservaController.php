<?php
require_once __DIR__ . '/../models/Reserva.php';

class ReservaController {

    // 🔹 Mostrar todas las reservas (admin o para pruebas)
    public static function listarTodas() {
        return Reserva::obtenerTodas();
    }

    // 🔹 Listar reservas de un usuario
    public static function listarPorUsuario($usuario_id) {
        return Reserva::obtenerPorUsuario($usuario_id);
    }

    // 🔹 Listar reservas de una pista específica
    public static function listarPorPista($pista_id) {
        return Reserva::obtenerPorPista($pista_id);
    }

    // 🔹 Obtener detalles de una reserva concreta
    public static function obtenerPorId($id_reserva) {
        return Reserva::obtenerPorId($id_reserva);
    }

    // 🔹 Crear una reserva (con comprobación de solapamiento)
    public static function crearReserva($usuario_id, $pista_id, $fecha_reserva, $hora_inicio, $hora_fin, $estado = 'pendiente') {
        // Comprobamos si ya hay una reserva en ese horario
        if (Reserva::existeReserva($pista_id, $fecha_reserva, $hora_inicio, $hora_fin)) {
            return [
                'success' => false,
                'message' => '⛔ Ya existe una reserva en ese horario para esta pista.'
            ];
        }

        $resultado = Reserva::crear($usuario_id, $pista_id, $fecha_reserva, $hora_inicio, $hora_fin, $estado);

        if ($resultado) {
            return [
                'success' => true,
                'message' => '✅ Reserva creada correctamente.'
            ];
        } else {
            global $conn;
            return [
                'success' => false,
                'message' => '❌ Error al crear la reserva: ' . $conn->error
            ];
        }
    }

    // 🔹 Actualizar una reserva existente
    public static function actualizarReserva($id_reserva, $fecha_reserva, $hora_inicio, $hora_fin, $estado) {
        $resultado = Reserva::actualizar($id_reserva, $fecha_reserva, $hora_inicio, $hora_fin, $estado);

        return $resultado
            ? ['success' => true, 'message' => '✅ Reserva actualizada correctamente.']
            : ['success' => false, 'message' => '❌ Error al actualizar la reserva.'];
    }

    // 🔹 Eliminar una reserva
    public static function eliminarReserva($id_reserva) {
        $resultado = Reserva::eliminar($id_reserva);

        return $resultado
            ? ['success' => true, 'message' => '✅ Reserva eliminada correctamente.']
            : ['success' => false, 'message' => '❌ Error al eliminar la reserva.'];
    }
}
?>
