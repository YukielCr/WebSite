<?php
// ESTO VA EN LA LÍNEA 1, ANTES DE CUALQUIER HTML
session_start();

// Si no existe la sesión, mandarlo de regreso al index
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: ../index.php");
    exit();
}

include("../connection/conexion.php"); 
// Consultas a la Base de Datos
// Tabla de Enfermedades
$queryEnfermedades = "SELECT id, nombre, ruta_imagen FROM registro_enfermedades";
$resultadoEnfermedades = mysqli_query($conexion, $queryEnfermedades);

//Sintomas
$querySintomas = "SELECT id, nombre, ruta_imagen FROM registro_Sintomas";
$resultadoSintomas = mysqli_query($conexion, $querySintomas);




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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



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

        /* Estilos para el placeholder de imagen */
        .image-placeholder {
            min-height: 220px;
            background-color: white;
            border: 2px solid #c7c7c786;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-style: italic;
            overflow: hidden;
            /* Para que las imágenes no se salgan del cuadro */
        }
    </style>
</head>

<body class="bg-secondary text-bg-primary">
    <?php
    require "../connection/conexion.php";
    require "../addPatologico/eliminar.php";
    require "../addPatologico/editar.php";
    ?>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="intExperto.php">
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
                            <a class="nav-link active" href="intExperto.php">Interfas Experto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="busAdelante.php">Interfas Usuario</a>
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
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px ">
            <a href="menu.php"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">MENÚ I.E.</span>
            </a>
            <hr />
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="intExperto.php" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bandaid" viewBox="0 0 16 16">
                            <path
                                d="M14.121 1.879a3 3 0 0 0-4.242 0L8.733 3.026l4.261 4.26 1.127-1.165a3 3 0 0 0 0-4.242M12.293 8 8.027 3.734 3.738 8.031 8 12.293zm-5.006 4.994L3.03 8.737 1.879 9.88a3 3 0 0 0 4.241 4.24l.006-.006 1.16-1.121ZM2.679 7.676l6.492-6.504a4 4 0 0 1 5.66 5.653l-1.477 1.529-5.006 5.006-1.523 1.472a4 4 0 0 1-5.653-5.66l.001-.002 1.505-1.492z" />
                            <path
                                d="M5.56 7.646a.5.5 0 1 1-.706.708.5.5 0 0 1 .707-.708Zm1.415-1.414a.5.5 0 1 1-.707.707.5.5 0 0 1 .707-.707M8.39 4.818a.5.5 0 1 1-.708.707.5.5 0 0 1 .707-.707Zm0 5.657a.5.5 0 1 1-.708.707.5.5 0 0 1 .707-.707ZM9.803 9.06a.5.5 0 1 1-.707.708.5.5 0 0 1 .707-.707Zm1.414-1.414a.5.5 0 1 1-.706.708.5.5 0 0 1 .707-.708ZM6.975 9.06a.5.5 0 1 1-.707.708.5.5 0 0 1 .707-.707ZM8.39 7.646a.5.5 0 1 1-.708.708.5.5 0 0 1 .707-.708Zm1.413-1.414a.5.5 0 1 1-.707.707.5.5 0 0 1 .707-.707" />
                        </svg>
                        Agregar Enfermedad
                    </a>
                </li>
                <li>
                    <a href="intExpertoSintomas.php" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-lungs-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 1a.5.5 0 0 1 .5.5v5.243L9 7.1V4.72C9 3.77 9.77 3 10.72 3c.524 0 1.023.27 1.443.592.431.332.847.773 1.216 1.229.736.908 1.347 1.946 1.58 2.48.176.405.393 1.16.556 2.011.165.857.283 1.857.24 2.759-.04.867-.232 1.79-.837 2.33-.67.6-1.622.556-2.741-.004l-1.795-.897A2.5 2.5 0 0 1 9 11.264V8.329l-1-.715-1 .715V7.214c-.1 0-.202.03-.29.093l-2.5 1.786a.5.5 0 1 0 .58.814L7 8.329v2.935A2.5 2.5 0 0 1 5.618 13.5l-1.795.897c-1.12.56-2.07.603-2.741.004-.605-.54-.798-1.463-.838-2.33-.042-.902.076-1.902.24-2.759.164-.852.38-1.606.558-2.012.232-.533.843-1.571 1.579-2.479.37-.456.785-.897 1.216-1.229C4.257 3.27 4.756 3 5.28 3 6.23 3 7 3.77 7 4.72V7.1l.5-.357V1.5A.5.5 0 0 1 8 1m3.21 8.907a.5.5 0 1 0 .58-.814l-2.5-1.786A.5.5 0 0 0 9 7.214V8.33z" />
                        </svg>
                        Agregar Sintoma
                    </a>
                </li>
                <li>
                    <a href="intExpertoPatologico.php" class="nav-link active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-medical-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-3 2v.634l.549-.317a.5.5 0 1 1 .5.866L7 7l.549.317a.5.5 0 1 1-.5.866L6.5 7.866V8.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L5 7l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V5.5a.5.5 0 1 1 1 0m-2 4.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1m0 2h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1" />
                        </svg>
                        Cuadro Patologico
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

        <section class="content-area">
            <div class="card shadow-sm p-4">
                <div class="">
                    <a href="intExpertoPatologico.php" type="button" class="btn btn-secondary">
                        <i class="fa-solid fa-share"></i> Regresar</a>
                </div>
                <h3 class="text-center mb-4">Cuadro Patológico por Enfermedad</h3>

                <?php
                // 1. Usamos INNER JOIN para traer los nombres de las enfermedades y los síntomas
                $query = "SELECT 
                            cp.id, 
                            cp.id_enfermedad, 
                            re.nombre AS nombre_enfermedad, 
                            cp.id_sintoma, 
                            rs.nombre AS nombre_sintoma, 
                            cp.peso,
                            (SELECT SUM(peso) FROM cuadro_Patologico WHERE id_enfermedad = cp.id_enfermedad) AS peso_total
                          FROM cuadro_Patologico cp
                          INNER JOIN registro_enfermedades re ON cp.id_enfermedad = re.id
                          INNER JOIN registro_Sintomas rs ON cp.id_sintoma = rs.id
                          ORDER BY re.nombre ASC"; 
                
                $sql = $conexion->query($query);
                
                // 2. Variables de control
                $enfermedad_actual = null;
                $peso_total_actual = 0; // Guardará la suma de la tabla que se está procesando

                while ($datos = $sql->fetch_object()) {
                    // Verificamos si cambiamos de enfermedad
                    if ($enfermedad_actual !== $datos->id_enfermedad) {
                        
                        // Si ya había una tabla abierta, le agregamos la fila de TOTAL y la cerramos
                        if ($enfermedad_actual !== null) {
                            echo '<tr class="table-info">';
                            echo '<td colspan="2" class="text-end fw-bold">Suma Total:</td>';
                            echo '<td class="fw-bold text-success">' . $peso_total_actual . '</td>';
                            echo '<td></td>'; // Celda vacía debajo de las acciones
                            echo '</tr>';
                            echo '</tbody></table></div>';
                        }
                        
                        // Actualizamos la variable de control
                        $enfermedad_actual = $datos->id_enfermedad;
                ?>
                        <h5 class="mt-4 text-primary border-bottom pb-2">
                            <i class="fa-solid fa-notes-medical"></i> <?= $datos->nombre_enfermedad ?>
                        </h5>
                        
                        <div class="table-responsive mb-4">
                            <table class="table table-hover table-striped align-middle" style="table-layout: fixed;">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 15%;">ID Registro</th>
                                        <th scope="col" style="width: 45%;">Síntoma</th>
                                        <th scope="col" style="width: 20%;">Peso</th>
                                        <th scope="col" class="text-center" style="width: 20%;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                <?php
                    } // Fin del if
                    
                    // Actualizamos el peso total actual en cada ciclo
                    $peso_total_actual = $datos->peso_total;
                ?>
                                    <tr>
                                        <th scope="row" class="text-center">
                                            <?php echo $datos->id ?>
                                        </th>
                                        <td>
                                            <?php echo $datos->nombre_sintoma ?>
                                        </td>
                                        <td class="text-muted small fw-bold">
                                            <?php echo $datos->peso ?>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdropEditar<?= $datos->id ?>"
                                                    class="btn btn-warning btn-sm">Editar</a>

                                                <a href="intExpertoPatologico2.php?id=<?= $datos->id ?>"
                                                    class="btn btn-danger btn-sm fw-bold"
                                                    onclick="return eliminar()">Eliminar</a>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="staticBackdropEditar<?= $datos->id ?>" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">Modificar Peso Patológico</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <form action="" method="post">
                                                        <input type="hidden" value="<?= $datos->id ?>" name="id">

                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Enfermedad:</label>
                                                            <input type="text" class="form-control text-muted" value="<?= $datos->nombre_enfermedad ?>" disabled>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Síntoma:</label>
                                                            <input type="text" class="form-control text-muted" value="<?= $datos->nombre_sintoma ?>" disabled>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label class="form-label fw-bold">Peso:</label>
                                                            <input type="text" class="form-control" name="peso" value="<?= $datos->peso ?>" required>
                                                        </div>

                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-success fw-bold">Guardar Cambios</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                <?php 
                } // Fin del while

                // Cerramos la ÚLTIMA tabla y le agregamos su fila de TOTAL
                if ($enfermedad_actual !== null) {
                    echo '<tr class="table-info">';
                    echo '<td colspan="2" class="text-end fw-bold">Suma Total:</td>';
                    echo '<td class="fw-bold text-success">' . $peso_total_actual . '</td>';
                    echo '<td></td>';
                    echo '</tr>';
                    echo '</tbody></table></div>';
                } else {
                    echo '<div class="alert alert-info text-center mt-4">No hay registros patológicos todavía.</div>';
                }
                ?>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="js/sidebars.js" class="astro-vvvwv3sm"></script>


    <!--Eliminar-->
    <script>
        function eliminar() {
            let res = confirm("¿Desea eliminar este registro permanentemente?");
            return res;
        }
    </script>


</body>

</html>