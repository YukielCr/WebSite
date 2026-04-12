<?php
session_start();
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: ../index.php");
    exit();
}
require_once('../connection/conexion.php'); 

// Detectamos si la URL trae la orden de descargar directamente
$descargaDirecta = isset($_GET['descargar']) && $_GET['descargar'] == '1';

// TRUCO PRO: Convertir la imagen a Base64 para que el PDF NUNCA falle al dibujarla
$ruta_logo = '../img/logoindex.png';
$logo_base64 = '';
if (file_exists($ruta_logo)) {
    $tipo = pathinfo($ruta_logo, PATHINFO_EXTENSION);
    $datos_imagen = file_get_contents($ruta_logo);
    $logo_base64 = 'data:image/' . $tipo . ';base64,' . base64_encode($datos_imagen);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Enfermedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <style>
        /* Evita que las filas se partan a la mitad entre páginas */
        tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
        
        /* Opcional: Asegura que el encabezado de la tabla se repita si quieres */
        thead {
            display: table-header-group;
        }
    </style>
</head>
<body class="p-5">

    <<div id="contenido-a-descargar">
        
        <div class="row align-items-center mb-3">
            <div class="col-3"></div> 
            
            <div class="col-6 text-center">
                <h2 class="mb-1">Sistema Experto</h2>
                <h5 class="text-muted">Reporte General de Enfermedades</h5>
            </div>
            
            <div class="col-3 text-end">
                <?php if($logo_base64 != ''): ?>
                    <img src="<?php echo $logo_base64; ?>" alt="Logo del Sistema" style="max-width: 75px; height: auto;">
                <?php else: ?>
                    <small class="text-danger">Logo no encontrado</small>
                <?php endif; ?>
            </div>
        </div>
        <hr class="mb-4" style="border: 1px solid #333;">

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Suma Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM registro_enfermedades";
                $res = mysqli_query($conexion, $query);
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['descripcion']}</td>
                            <td>{$row['suma_total']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php if ($descargaDirecta): ?>
        <script>
            // Si entramos en modo descarga, generamos el PDF automáticamente
            window.onload = function () {
                const elemento = document.getElementById('contenido-a-descargar');
                const opciones = {
                    margin: 10,
                    filename: 'Listado_Enfermedades.pdf',
                    image: { type: 'jpeg', quality: 1.0 },
                    html2canvas: { scale: 3, useCORS: true }, // Escala 3 es más nítida
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };

                // Genera el PDF y fuerza la descarga
                html2pdf().set(opciones).from(elemento).save();
            };
        </script>
    <?php endif; ?>

</body>

</html>