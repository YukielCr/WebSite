<?php
// Comprueba que se haya enviado el ID y el Peso
if (!empty($_POST["id"]) && isset($_POST["peso"])) {
    
    // intval() por seguridad para el ID y floatval() para el peso (por si admite decimales)
    $id = intval($_POST["id"]);
    $peso = $_POST["peso"]; // Si es texto dejar así, si es decimal usa floatval($_POST["peso"])

    // Solo actualizamos la columna "peso" en la tabla "cuadro_Patologico"
    $sql = "UPDATE cuadro_Patologico SET peso=? WHERE id=?";
    
    $stmt = mysqli_prepare($conexion, $sql);
    
    // La "s" es por si el peso es un string/decimal, la "i" es por el ID entero
    mysqli_stmt_bind_param($stmt, "si", $peso, $id);
    
    $ejecutar = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($ejecutar) {
        $mensaje = "Peso patológico modificado correctamente 😎.";
        $clase = "alert-success";
    } else {
        $mensaje = "Error al actualizar la base de datos 😔. " . mysqli_error($conexion);
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