<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../connection/conexion.php";

if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    $nombre = trim($_GET['nombre']);
    $sql_buscar = "SELECT id, ruta_imagen FROM registro_enfermedades WHERE nombre = ?";
    
    if ($stmt_buscar = mysqli_prepare($conexion, $sql_buscar)) {
        mysqli_stmt_bind_param($stmt_buscar, "s", $nombre);
        mysqli_stmt_execute($stmt_buscar);
        $resultado = mysqli_stmt_get_result($stmt_buscar);

        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $ruta_actual = $fila['ruta_imagen'];

                if (!empty($ruta_actual) && file_exists($ruta_actual)) {
                    unlink($ruta_actual);
                }
            }

            $sql_borrar = "DELETE FROM registro_enfermedades WHERE nombre = ?";
            
            if ($stmt_borrar = mysqli_prepare($conexion, $sql_borrar)) {
                mysqli_stmt_bind_param($stmt_borrar, "s", $nombre);
                
                if (mysqli_stmt_execute($stmt_borrar)) {
                    // Éxito
                    echo "<script>
                            alert('La enfermedad \"$nombre\" fue dada de baja exitosamente.');
                            window.location.href = '../login/intExperto.php';
                          </script>";
                } else {
                    echo "<script>alert('Error al intentar borrar de la base de datos.'); window.location.href = '../login/intExperto.php';</script>";
                }
                mysqli_stmt_close($stmt_borrar);
            }
            
        } else {
            echo "<script>
                    alert('No se encontró ninguna enfermedad registrada con el nombre \"$nombre\".');
                    window.location.href = '../login/intExperto.php';
                  </script>";
        }
        mysqli_stmt_close($stmt_buscar);
    }
    
} else {
    header("Location: ../login/intExperto.php");
    exit();
}
?>