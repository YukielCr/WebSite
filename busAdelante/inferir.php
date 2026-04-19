<?php
include("../connection/conexion.php"); // Asegúrate de que esta ruta sea la correcta para tu proyecto

$resultados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['sintomas_ids'])) {
    // 1. Obtener los IDs de los síntomas enviados (ej. "1,5,12")
    $sintomas_ids = $_POST['sintomas_ids'];
    
    // Sanitización básica para evitar inyección SQL (solo permitir números y comas)
    $sintomas_ids = preg_replace('/[^0-9,]/', '', $sintomas_ids);

    if(!empty($sintomas_ids)){
        /*
         * LÓGICA DE INFERENCIA DIRECTA (Basado en el PDF)
         * 1) Suma seleccionada = Suma de pesos de los síntomas que el usuario eligió y que pertenecen a la enfermedad.
         * 2) Suma total = Suma de todos los pesos registrados para esa enfermedad en la BD.
         * 3) Porcentaje = (Suma Seleccionada / Suma Total) * 100
         */
        $query = "
            SELECT 
                e.nombre AS enfermedad,
                SUM(CASE WHEN cp.id_sintoma IN ($sintomas_ids) THEN cp.peso ELSE 0 END) AS suma_seleccionada,
                (SELECT SUM(peso) FROM cuadro_Patologico WHERE id_enfermedad = e.id) AS suma_total
            FROM registro_enfermedades e
            JOIN cuadro_Patologico cp ON e.id = cp.id_enfermedad
            GROUP BY e.id, e.nombre
            HAVING suma_seleccionada > 0
            ORDER BY (suma_seleccionada / suma_total) DESC
        ";

        $resultado_bd = mysqli_query($conexion, $query);

        if ($resultado_bd) {
            while ($row = mysqli_fetch_assoc($resultado_bd)) {
                // Calcular el porcentaje (Regla de 3 del PDF)
                $porcentaje = round(($row['suma_seleccionada'] / $row['suma_total']) * 100);
                
                $resultados[] = [
                    'enfermedad' => $row['enfermedad'],
                    'porcentaje' => $porcentaje
                ];
            }

            // Ordenamos el arreglo de mayor a menor porcentaje
            usort($resultados, function($a, $b) {
                return $b['porcentaje'] <=> $a['porcentaje'];
            });

            // // DEFINE EL TAMAÑO DE LA LISTA DE RESULTADOS
            // Cambia el número '4' por la cantidad total de enfermedades que deseas mostrar.
            // (Ejemplo: '4' mostrará la principal destacada + 3 en la tabla de alternativas).
            $cantidad_resultados = 5;
            $resultados = array_slice($resultados, 0, $cantidad_resultados); 
        } // <--- ESTA ES LA LLAVE QUE FALTABA
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnóstico - Inferencia Directa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa; /* Un fondo gris muy suave */
        }
        .progress {
            height: 25px; /* Barras de progreso más gruesas */
            border-radius: 15px;
        }
        .resultado-principal {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 1px solid #bbf7d0;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="card shadow border-0 rounded-4">
                    
                    <div class="card-header bg-dark text-white text-center py-4 rounded-top-4">
                        <h2 class="mb-0 fs-4 fw-bold">
                            <i class="fa-solid fa-stethoscope me-2"></i> Reporte de Inferencia Diagnóstica
                        </h2>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        
                        <?php if (count($resultados) > 0): ?>
                            
                            <div class="resultado-principal rounded-4 p-4 text-center mb-5 shadow-sm">
                                <h4 class="text-success text-uppercase fw-bold mb-3">Diagnóstico Principal Sugerido</h4>
                                <h1 class="display-5 fw-bold text-dark mb-3">
                                    <?php echo $resultados[0]['enfermedad']; ?>
                                </h1>
                                
                                <div class="px-md-5">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fw-bold text-secondary">Nivel de Certeza</span>
                                        <span class="fw-bold text-success fs-5"><?php echo $resultados[0]['porcentaje']; ?>%</span>
                                    </div>
                                    <div class="progress shadow-sm">
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                                             role="progressbar" 
                                             style="width: <?php echo $resultados[0]['porcentaje']; ?>%;" 
                                             aria-valuenow="<?php echo $resultados[0]['porcentaje']; ?>" 
                                             aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (count($resultados) > 1): ?>
                                <h5 class="fw-bold text-secondary border-bottom pb-2 mb-4">
                                    <i class="fa-solid fa-list-ul me-2"></i> Otras Posibles Patologías Evaluadas
                                </h5>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle shadow-sm border">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" class="ps-4">Enfermedad</th>
                                                <th scope="col" class="text-center" style="width: 150px;">Probabilidad</th>
                                                <th scope="col" style="width: 40%;">Gráfico</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            // Empezamos desde el 1 porque el 0 es el principal
                                            for ($i = 1; $i < count($resultados); $i++): 
                                                // Definimos el color de la barra según el porcentaje
                                                $color_barra = 'bg-info';
                                                if ($resultados[$i]['porcentaje'] > 70) $color_barra = 'bg-warning';
                                                if ($resultados[$i]['porcentaje'] < 30) $color_barra = 'bg-secondary';
                                            ?>
                                                <tr>
                                                    <td class="ps-4 fw-bold text-dark">
                                                        <?php echo $resultados[$i]['enfermedad']; ?>
                                                    </td>
                                                    <td class="text-center fw-bold fs-5 text-secondary">
                                                        <?php echo $resultados[$i]['porcentaje']; ?>%
                                                    </td>
                                                    <td class="pe-4">
                                                        <div class="progress" style="height: 15px;">
                                                            <div class="progress-bar <?php echo $color_barra; ?>" 
                                                                 role="progressbar" 
                                                                 style="width: <?php echo $resultados[$i]['porcentaje']; ?>%;">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endfor; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>

                        <?php else: ?>
                            <div class="text-center py-5">
                                <div class="text-warning mb-3">
                                    <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
                                </div>
                                <h4 class="fw-bold text-dark">Sin Coincidencias Clínicas</h4>
                                <p class="text-muted fs-5">
                                    No se encontraron enfermedades en la base de datos que coincidan con el cuadro de síntomas seleccionado.
                                </p>
                            </div>
                        <?php endif; ?>

                        <hr class="my-5 text-muted">
                        
                        <div class="d-flex justify-content-center gap-3">
                            <button onclick="history.back()" class="btn btn-outline-secondary btn-lg px-5 rounded-pill shadow-sm">
                                <i class="fa-solid fa-arrow-rotate-left me-2"></i> Nueva Consulta
                            </button>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>