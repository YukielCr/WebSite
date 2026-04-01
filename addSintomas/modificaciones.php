<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../connection/conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $sql_buscar = "SELECT id, ruta_imagen FROM registro_Sintomas WHERE nombre = ?";
    if ($stmt_buscar = mysqli_prepare($conexion, $sql_buscar)) {
        mysqli_stmt_bind_param($stmt_buscar, "s", $nombre);
        mysqli_stmt_execute($stmt_buscar);
        $resultado = mysqli_stmt_get_result($stmt_buscar);
        

        if ($fila = mysqli_fetch_assoc($resultado)) {
            $id = $fila['id'];
            $ruta_actual = $fila['ruta_imagen'];
            $ruta_destino = $ruta_actual; 
            
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $carpeta_destino = "../images/";
                $nombre_archivo = time() . "_" . basename($_FILES["imagen"]["name"]);
                $ruta_nueva = $carpeta_destino . $nombre_archivo;
                
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_nueva)) {
                    if (!empty($ruta_actual) && file_exists($ruta_actual)) {
                        unlink($ruta_actual);
                    }
                    $ruta_destino = $ruta_nueva; 
                }
            }

            $sql_update = "UPDATE registro_Sintomas SET descripcion=?, ruta_imagen=? WHERE id=?";
            if ($stmt_update = mysqli_prepare($conexion, $sql_update)) {
                mysqli_stmt_bind_param($stmt_update, "ssi", $descripcion, $ruta_destino, $id);
                if (mysqli_stmt_execute($stmt_update)) {
                    echo "<script>
                            alert('¡Los datos de \"$nombre\" fueron modificados con éxito!'); 
                            window.location.href='../login/intExpertoSintomas.php';
                          </script>";
                } else {
                    echo "<script>alert('Error al modificar en la base de datos.'); window.location.href='../login/intExpertoSintomas.php';</script>";
                }
                mysqli_stmt_close($stmt_update);
            } 
        } else {
            echo "<script>
                    alert('No se encontró ningún sintoma llamado \"$nombre\". Asegúrate de escribir el nombre exacto.'); 
                    window.location.href='../login/intExpertoSintomas.php';
                  </script>";
        }
        mysqli_stmt_close($stmt_buscar);
    }
}else {
    header("Location: ../login/intExpertoSintomas.php");
}
?>