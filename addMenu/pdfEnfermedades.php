<?php
// Validar sesión (Seguridad)
session_start();
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: ../index.php");
    exit();
}
require_once('../connection/conexion.php'); 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Enfermedades</title>
    <link rel="icon" href="../img/logoindex.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body class="p-5">
    <div class="text-center mb-4">
        <h2>Sistema Experto - Reporte General</h2>
        <h4>Listado de Enfermedades</h4>
        <hr>
    </div>

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
            while($row = mysqli_fetch_assoc($res)) {
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

    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-success">Confirmar Impresión / Guardar PDF</button>
    </div>
</body>
</html>