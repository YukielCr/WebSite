<?php
// ESTO VA EN LA LÍNEA 1, ANTES DE CUALQUIER HTML
session_start();

// Si no existe la sesión, mandarlo de regreso al index
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: ../index.php");
    exit();
}
include("../connection/conexion.php");
// Obtener todos los síntomas para llenar el primer ComboBox (select)
//$querySintomas = "SELECT id, nombre, descripcion FROM registro_Sintomas";
$querySintomas = "SELECT id, nombre FROM registro_Sintomas";
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
</head>

<body class="bg-secondary text-bg-primary">
    <?php
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
                            <a class="nav-link" href="intExperto.php">Interfas Experto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="busAdelante.php">Interfas Usuario</a>
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
            <a href="busAdelante.php"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">MENÚ I.E.</span>
            </a>
            <hr />
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="busAdelante.php" class="nav-link active">
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
                    <h3 class="text-center">Búsqueda Hacia Adelante</h3>

                    <div class="card-body p-4 p-md-5">
                        <div class="row mb-4">
                            <div class="col-md-9">
                                <label for="cbx_sintomas" class="form-label fw-bold text-secondary">Características a
                                    evaluar:</label>
                                <select id="cbx_sintomas" class="form-select form-select-lg mb-3 shadow-sm">
                                    <?php while ($row = mysqli_fetch_assoc($resultadoSintomas)) { ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['nombre']; ?>
                                            <!-- <?php echo $row['nombre'] . " - " . $row['descripcion']; ?> -->
                                        </option>
                                    <?php } ?>
                                </select>

                                <select id="lista_seleccionados" class="form-select shadow-sm" multiple
                                    style="height: 250px;"></select>
                            </div>

                            <div class="col-md-3 d-flex flex-column justify-content-center gap-3 mt-4 mt-md-0 pt-md-4">
                                <button class="btn btn-outline-primary btn-lg shadow-sm" onclick="añadirSintoma()">
                                    📁 Añadir
                                </button>
                                <button class="btn btn-outline-danger btn-lg shadow-sm" onclick="eliminarSintoma()">
                                    🖍️ Eliminar
                                </button>

                                 <button class="btn btn-outline-warning btn-lg shadow-sm" onclick="eliminarTodos()">
                                    🖍️ Eliminar Todos
                                </button>
                            </div>
                        </div>

                        <hr class="my-4 text-muted">

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">


                            <form id="formInferencia" action="../busAdelante/inferir.php" method="POST" class="m-0">
                                <input type="hidden" name="sintomas_ids" id="sintomas_ids" value="">

                                <button type="button" class="btn btn-success"
                                    onclick="prepararInferencia()">Inferir</button>
                            </form>
                        </div>

                    </div>


            </div>
        </section>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="js/sidebars.js" class="astro-vvvwv3sm"></script>

    <script>
        function añadirSintoma() {
            var cbx = document.getElementById("cbx_sintomas");
            var lista = document.getElementById("lista_seleccionados");

            var opcionSeleccionada = cbx.options[cbx.selectedIndex];

            // Verificar que no se haya agregado ya para evitar duplicados
            var yaExiste = false;
            for (var i = 0; i < lista.options.length; i++) {
                if (lista.options[i].value === opcionSeleccionada.value) {
                    yaExiste = true;
                    break;
                }
            }

            if (!yaExiste && opcionSeleccionada.value !== "") {
                var nuevaOpcion = document.createElement("option");
                nuevaOpcion.value = opcionSeleccionada.value;
                nuevaOpcion.text = opcionSeleccionada.text;
                lista.add(nuevaOpcion);
            }
        }

        function eliminarSintoma() {
            var lista = document.getElementById("lista_seleccionados");
            // Eliminar los elementos que estén seleccionados en el cuadro grande
            for (var i = lista.options.length - 1; i >= 0; i--) {
                if (lista.options[i].selected) {
                    lista.remove(i);
                }
            }
        }


        function prepararInferencia() {
            var lista = document.getElementById("lista_seleccionados");
            var form = document.getElementById("formInferencia");
            var inputIds = document.getElementById("sintomas_ids");

            // Validar que haya al menos un síntoma seleccionado
            if (lista.options.length === 0) {
                alert("Por favor, añada al menos un síntoma a la lista antes de inferir.");
                return;
            }

            // Recorrer la lista y guardar los IDs en un arreglo
            var ids = [];
            for (var i = 0; i < lista.options.length; i++) {
                ids.push(lista.options[i].value);
            }

            // Convertir el arreglo en una cadena separada por comas (ej. "1,4,15")
            inputIds.value = ids.join(",");

            // Enviar el formulario
            form.submit();
        }

        function eliminarTodos() {
            var lista = document.getElementById("lista_seleccionados");
            // Eliminar todos los elementos del cuadro grande
            while (lista.options.length > 0) {
                lista.remove(0);
            }
        }

            
    </script>



</body>

</html>