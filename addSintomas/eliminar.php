<?php
if(!empty($_GET["id"])){
    $id=$_GET["id"];

    $buscar_imagen=$conexion->query("SELECT ruta_imagen FROM registro_Sintomas WHERE id=$id");

    if ($fila = $buscar_imagen->fetch_object()) {
        $ruta_actual = $fila->ruta_imagen;
        try {   
            if (file_exists($ruta_actual)) {
                unlink($ruta_actual);
            }
        } catch (Throwable $th) {   
        }
    }
    $eliminar = $conexion->query("DELETE FROM registro_Sintomas WHERE id=$id");
    if ($eliminar) {
        $mensaje = "Correcto, el registro y la imagen fueron eliminados.";
        $clase = "alert-success";
    } else {
        $mensaje = "Error al eliminar de la base de datos.";
        $clase = "alert-danger";
    }
    echo "
    <div id='alertaFlotante' class='alert $clase text-center' style='position: fixed; top: 20px; right: 20px; z-index: 9999; box-shadow: 0 4px 8px rgba(0,0,0,0.2); transition: opacity 0.5s ease;'>
        $mensaje
    </div>";
?>

    <script>
        // Limpiar la URL para evitar que se reenvíe la eliminación al recargar la página
        history.replaceState(null, null, location.pathname);

        // Ocultar la alerta flotante después de 3 segundos (3000 ms)
        setTimeout(function() {
            let alerta = document.getElementById('alertaFlotante');
            if (alerta) {
                alerta.style.opacity = '0'; // Aplica el efecto de transición
                setTimeout(() => alerta.remove(), 500); // Lo borra del HTML al terminar el efecto
            }
        }, 3000);
    </script>

<?php
}
?>