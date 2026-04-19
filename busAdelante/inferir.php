<?php
// ESTO VA EN LA LÍNEA 1, ANTES DE CUALQUIER HTML
session_start();

// Si no existe la sesión, mandarlo de regreso al index
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: ../index.php");
    exit();
}






include("../connection/conexion.php"); // Asegúrate de que esta ruta sea la correcta para tu proyecto

$resultados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['sintomas_ids'])) {
    // 1. Obtener los IDs de los síntomas enviados (ej. "1,5,12")
    $sintomas_ids = $_POST['sintomas_ids'];

    // Sanitización básica para evitar inyección SQL (solo permitir números y comas)
    $sintomas_ids = preg_replace('/[^0-9,]/', '', $sintomas_ids);

    if (!empty($sintomas_ids)) {
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
            usort($resultados, function ($a, $b) {
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patologico</title>
    <link rel="icon" href="../img/logoindex.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sidebars.css">

    <style>
        /* CSS Crítico para el layout */
        html,
        body {
            height: 100%;
            /* Obligatorio */
            margin: 0;
            /* overflow: hidden; */
            /* Evita scroll doble */
        }

        .main-wrapper {
            display: flex;
            height: calc(100vh - 56px);
            /* Altura total menos el header (aprox 56px) */
        }

        .content-area {
            flex-grow: 1;
            /* Ocupa todo el ancho restante */
            overflow-y: auto;
            /* Solo el contenido tiene scroll */
            padding: 20px;
        }
    </style>

    <style>
        body {
            background-color: #f8f9fa;
            /* Un fondo gris muy suave */
        }

        .progress {
            height: 25px;
            /* Barras de progreso más gruesas */
            border-radius: 15px;
        }

        .resultado-principal {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 1px solid #bbf7d0;
        }
    </style>
</head>

<body class="bg-secondary text-bg-primary">
    <?php
    ?>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../login/busAdelante.php">
                    <img src="../img/logoindex.png" alt="Logo" width="39" height="39" class="d-inline-block">
                    Mi pagina Web
                </a>
                <!--Boton de mas opciones-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../login/intExperto.php">Interfas Experto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../login/busAdelante.php">Interfas Usuario</a>
                        </li>
                    </ul>
                    <div class="d-block ms-auto">
                        <a href="../includes/cerrar.php" class="btn btn-danger " style="width: 150px;">Cerrar
                            Sesión</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>



    <main class="main-wrapper">
        <!--Barra de navegacion lateral-->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px ">
            <a href="../login/menuUsuario.php "
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">MENÚ I.E.</span>
            </a>
            <hr />
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="../login/busAdelante.php" class="nav-link active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-return-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5" />
                        </svg>
                        Busqueda hacia Adelante
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                        </svg>
                        Busqueda hacia Atrás
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clipboard-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                            <path
                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                        </svg>
                        Modulo de Explicacion
                    </a>
                </li>
            </ul>
            <hr />
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../img/logoindex.png" alt="" width="32" height="32" class="rounded-circle me-2" />
                    <strong>Opciones</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <div class="b-example-divider b-example-vr"></div>


        <!--Informacion del contenedor-->

        <section class="content-area">
            <div class="card shadow-sm p-4">


               <div class="card shadow border-0 rounded-4">

                            <div class="card-header bg-dark text-white text-center py-4 rounded-top-4">
                                <h2 class="mb-0 fs-4 fw-bold">
                                    <i class="fa-solid fa-stethoscope me-2"></i> Reporte de Inferencia Diagnóstica
                                </h2>
                            </div>

                            <div class="card-body p-4 p-md-5">

                                <?php if (count($resultados) > 0): ?>

                                    <div class="resultado-principal rounded-4 p-4 text-center mb-5 shadow-sm">
                                        <h4 class="text-success text-uppercase fw-bold mb-3">Diagnóstico Principal Sugerido
                                        </h4>
                                        <h1 class="display-5 fw-bold text-dark mb-3">
                                            <?php echo $resultados[0]['enfermedad']; ?>
                                        </h1>

                                        <div class="px-md-5">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span class="fw-bold text-secondary">Nivel de Certeza</span>
                                                <span
                                                    class="fw-bold text-success fs-5"><?php echo $resultados[0]['porcentaje']; ?>%</span>
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
                                                        <th scope="col" class="text-center" style="width: 150px;">Probabilidad
                                                        </th>
                                                        <th scope="col" style="width: 40%;">Gráfico</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Empezamos desde el 1 porque el 0 es el principal
                                                    for ($i = 1; $i < count($resultados); $i++):
                                                        // Definimos el color de la barra según el porcentaje
                                                        $color_barra = 'bg-info';
                                                        if ($resultados[$i]['porcentaje'] > 70)
                                                            $color_barra = 'bg-warning';
                                                        if ($resultados[$i]['porcentaje'] < 30)
                                                            $color_barra = 'bg-secondary';
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
                                            No se encontraron enfermedades en la base de datos que coincidan con el cuadro
                                            de síntomas seleccionado.
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <hr class="my-5 text-muted">

                                <div class="d-flex justify-content-center gap-3">
                                    <button onclick="history.back()"
                                        class="btn btn-outline-secondary btn-lg px-5 rounded-pill shadow-sm">
                                        <i class="fa-solid fa-arrow-rotate-left me-2"></i> Nueva Consulta
                                    </button>
                                </div>

                            </div>
                        </div>


            </div>
            </div>


        </section>


    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="js/sidebars.js" class="astro-vvvwv3sm"></script>



</body>

</html>