<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../connection/conexion.php"); 

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $usuario=$_POST['usuario'];
    $contrasena=$_POST['contrasena'];


$sql="INSERT INTO usuarios (usuario, contrasena) values (?,?)";

if ($stmt = mysqli_prepare($conexion, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $contrasena); 

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Usuario Registrado Exitosamente 🗃️!');
                    window.location.href = '../index.php'; 
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