<?php
include("../connection/conexion.php");

header('Content-Type: application/json');

// Recibimos el ID de la enfermedad
$id_enfermedad = isset($_GET['id_enfermedad']) ? $_GET['id_enfermedad'] : '';

if ($id_enfermedad != '') {
    $id_enf_limpio = mysqli_real_escape_string($conexion, $id_enfermedad);

    // Hacemos un JOIN para que nos dé el nombre del síntoma además del peso
    $query = "SELECT cp.id_sintoma, cp.peso, s.nombre as nombre_sintoma 
              FROM cuadro_Patologico cp
              INNER JOIN registro_Sintomas s ON cp.id_sintoma = s.id
              WHERE cp.id_enfermedad = '$id_enf_limpio'";

    $resultado = mysqli_query($conexion, $query);
    $datos = array();

    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $datos[] = $fila;
        }
        echo json_encode(['success' => true, 'data' => $datos]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conexion)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No se envió ID']);
}
?>