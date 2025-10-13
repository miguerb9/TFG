<?php
require_once __DIR__ . '/../models/Pista.php';

class PistaController {

    // 🔹 Listar todas las pistas
    public static function listarTodas() {
        return Pista::obtenerTodas();
    }

    // 🔹 Listar pistas por deporte
    public static function listarPorDeporte($deporte) {
        return Pista::obtenerPorDeporte($deporte);
    }

    // 🔹 Obtener detalles de una pista concreta
    public static function verPista($id_pista) {
        return Pista::obtenerPorId($id_pista);
    }
}
?>
