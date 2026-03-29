<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../connection/conexion.php"); 

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $nombre=$_POST['nombre'];
    $telefono=$_POST['telefono'];
    $email=$_POST['email'];
    $mensaje=$_POST['mensaje'];


    // 1. Usamos 'email' correctamente en el INSERT
$sql="INSERT INTO mensajes (nombre, telefono, email, mensaje) values (?,?,?,?)";

if ($stmt = mysqli_prepare($conexion, $sql)) {
    mysqli_stmt_bind_param($stmt, "ssss", $nombre, $telefono, $email, $mensaje); 

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Meensaje enviado de manera exitosa 🗃️!');
                    window.location.href = '../contactanos.php'; 
                  </script>";
        } else {
            echo "Error al guardar en la base de datos: ‼️" . mysqli_error($conexion);
        }
        mysqli_stmt_close($stmt);
    }else {
        echo "Error preparando la consulta: ❗" . mysqli_error($conexion);
    }
    mysqli_close($conexion);
}
?>