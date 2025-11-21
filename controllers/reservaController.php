<?php
require_once __DIR__ . '/../models/Reserva.php';

class ReservaController
{

    // Listar todas las reservas (solo admin o para depuración)
    public static function listarTodas()
    {
        return Reserva::obtenerTodas();
    }

    // Listar reservas por usuario
    public static function listarPorUsuario($usuario_id)
    {
        return Reserva::obtenerPorUsuario($usuario_id);
    }

    // Listar reservas por pista
    public static function listarPorPista($pista_id)
    {
        return Reserva::obtenerPorPista($pista_id);
    }

    // Obtener una reserva por su ID
    public static function verReserva($id_reserva)
    {
        return Reserva::obtenerPorId($id_reserva);
    }

    // Crear una nueva reserva (con comprobación de solapamientos)
    public static function crearReserva($usuario_id, $pista_id, $fecha_reserva, $hora_inicio, $hora_fin, $estado = 'pendiente')
    {
        if (Reserva::existeReserva($pista_id, $fecha_reserva, $hora_inicio, $hora_fin)) {
            return [
                'success' => false,
                'message' => '⛔ Ya existe una reserva en ese horario para esta pista.'
            ];
        }

        $resultado = Reserva::crear($usuario_id, $pista_id, $fecha_reserva, $hora_inicio, $hora_fin, $estado);

        return $resultado
            ? ['success' => true, 'message' => '✅ Reserva creada correctamente.']
            : ['success' => false, 'message' => '❌ Error al crear la reserva.'];
    }

    // Actualizar una reserva existente
    public static function actualizarReserva($id_reserva, $fecha_reserva, $hora_inicio, $hora_fin, $estado)
    {
        $resultado = Reserva::actualizar($id_reserva, $fecha_reserva, $hora_inicio, $hora_fin, $estado);

        return $resultado
            ? ['success' => true, 'message' => '✅ Reserva actualizada correctamente.']
            : ['success' => false, 'message' => '❌ Error al actualizar la reserva.'];
    }

    // Eliminar una reserva
    public static function eliminar($id_reserva)
    {
        $resultado = Reserva::eliminar($id_reserva);

        return $resultado
            ? ['success' => true, 'message' => '✅ Reserva eliminada correctamente.']
            : ['success' => false, 'message' => '❌ Error al eliminar la reserva.'];
    }
}
