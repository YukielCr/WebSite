<?php
if (!empty($_POST["btneditar2"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $ruta_actual = $_POST["ruta_actual"];

    $ejecutar = false;

    if (!empty($_FILES["imagen"]["name"])) {
        $imagen = $_FILES["imagen"]["tmp_name"];
        $nombreimagen = $_FILES["imagen"]["name"];
        $tipoimagen = strtolower(pathinfo($nombreimagen, PATHINFO_EXTENSION));
        $directorio = "../images/";

        if ($tipoimagen == "jpg" or $tipoimagen == "jpeg" or $tipoimagen == "png") {
            try {
                if (file_exists($ruta_actual)) {
                    unlink($ruta_actual);
                }
            } catch (\Throwable $th) {
            }
            $ruta_destino = $directorio . time() . "_" . basename($nombreimagen);

            if (move_uploaded_file($imagen, $ruta_destino)) {
                $sql = "UPDATE registro_Sintomas SET nombre=?, descripcion=?, ruta_imagen=? WHERE id=?";
                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "sssi", $nombre, $descripcion, $ruta_destino, $id);
                $ejecutar = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                echo "<div class='alert alert-danger mt-2 text-center'>Error al subir la nueva imagen.</div>";
            }
        } else {
            //echo "<div class='alert alert-warning mt-2 text-center'>Solo se aceptan formatos de imagen JPG, JPEG o PNG.</div>";
            $mensaje = "Solo se aceptan formatos de imagen JPG, JPEG o PNG. 😔.";
            $clase = "alert-danger";
        }
    } else {
        $sql = "UPDATE registro_Sintomas SET nombre=?, descripcion=? WHERE id=?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $nombre, $descripcion, $id);
        $ejecutar = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($ejecutar) {
        $mensaje = "Registro modificado correctamente 😎.";
        $clase = "alert-success";
    } else {
        $mensaje = "Error al actualizar la base de datos 😔.";
        $clase = "alert-danger";
    }
    echo "
    <div id='alertaFlotante' class='alert $clase text-center' style='position: fixed; top: 20px; right: 20px; z-index: 9999; box-shadow: 0 4px 8px rgba(0,0,0,0.2); transition: opacity 0.5s ease;'>
        $mensaje
    </div>";
    ?>

    <script>
        history.replaceState(null, null, location.pathname);
        setTimeout(function () {
            let alerta = document.getElementById('alertaFlotante');
            if (alerta) {
                alerta.style.opacity = '0';
                setTimeout(() => alerta.remove(), 500);
            }
        }, 3000);
    </script>

    <?php
}
?>