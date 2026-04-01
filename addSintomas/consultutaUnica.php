<?php
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');

// Incluimos tu conexión
require "../connection/conexion.php";

$respuesta = array(); 

if (isset($_GET['nombre']) && !empty(trim($_GET['nombre']))) {
    $nombre_buscado = trim($_GET['nombre']);
    
    // Buscamos la enfermedad
    $sql = "SELECT * FROM registro_Sintomas WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $nombre_buscado);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        

        if ($fila = mysqli_fetch_assoc($resultado)) {
            $respuesta['error'] = false;
            $respuesta['id'] = $fila['id'];
            $respuesta['nombre'] = $fila['nombre'];
            $respuesta['descripcion'] = $fila['descripcion'];
            $respuesta['ruta_imagen'] = $fila['ruta_imagen'];
        } else {
            $respuesta['error'] = true;
            $respuesta['mensaje'] = "No se encontró ninguna enfermedad llamada '$nombre_buscado'.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $respuesta['error'] = true;
        $respuesta['mensaje'] = "Error conectando con la base de datos.";
    }
} else {
    $respuesta['error'] = true;
    $respuesta['mensaje'] = "El campo de nombre está vacío.";
}
echo json_encode($respuesta);
?>