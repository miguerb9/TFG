<?php
require_once __DIR__ . '/../models/Pista.php';
global $conn;

// Datos de las pistas a insertar
$pistas = [
    ['Pista Cristal 1', 'padel', 15.00],
    ['Pista Cristal 2', 'padel', 15.00],
    ['Pista Muro 1', 'padel', 12.00],
    ['Pista Muro 2', 'padel', 12.00],
];

// Recorremos el array e insertamos cada pista
foreach ($pistas as $p) {
    [$nombre, $deporte, $precio_hora] = $p;

    if (Pista::crear($nombre, $deporte, $precio_hora)) {
        echo "✅ Pista '$nombre' insertada correctamente.<br>";
    } else {
        echo "❌ Error al insertar '$nombre': " . $conn->error . "<br>";
    }
}
?>
