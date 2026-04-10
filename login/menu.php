<?php
// ESTO VA EN LA LÍNEA 1, ANTES DE CUALQUIER HTML
session_start();

// Si no existe la sesión, mandarlo de regreso al index
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: ../index.php");
    exit();
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
</head>

<body class="bg-secondary text-bg-primary">
    <?php
    require "../connection/conexion.php";
    require "../addSintomas/eliminar.php";
    require "../addSintomas/editar.php";
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
                            <a class="nav-link" href="#">Interfas Usuario</a>
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
                    <a href="intExpertoPatologico.php" class="nav-link text-white">
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


        <!--Informacion del contenedor-->

        <section class="content-area">
            <div class="card shadow-sm p-4">
                <h3 class="text-center">Mantenimiento</h3>

                <div class=" text-center">
                    <div class="row">
                        <div class="col" style="width: 200px;">
                            <img src="../img/mantenimiento.jpg" alt="Mantenimiento">
                        </div>
                        <div class="col" style="width: 200px;">
                            <img src="../img/mantenimiento.jpg" alt="Mantenimiento">
                        </div>
                        <div class="col" style="width: 200px;">
                            <img src="../img/mantenimiento.jpg" alt="Mantenimiento">
                        </div>
                    </div>
                </div>
                <div class=" text-center mt-4">
                    <div class="row">
                        <div class="col" style="width: 200px;">
                            <img src="../img/mantenimiento.jpg" alt="Mantenimiento">
                        </div>
                        <div class="col" style="width: 200px;">
                            <img src="../img/mantenimiento.jpg" alt="Mantenimiento">
                        </div>
                        <div class="col" style="width: 200px;">
                            <img src="../img/mantenimiento.jpg" alt="Mantenimiento">
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