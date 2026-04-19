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
            <a href="menuUsuario.php"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">MENÚ I.E.</span>
            </a>
            <hr />
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="busAdelante.php" class="nav-link text-white">
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
                <h3 class="text-center mb-4">Generar Reportes PDF</h3>

                <div class="d-grid gap-3 d-md-flex justify-content-center mb-4">
                    <button onclick="cargarPDF('../addMenu/pdfEnfermedades.php')" class="btn btn-primary">
                        <i class="bi bi-file-earmark-pdf"></i> Listado de Enfermedades
                    </button>
                    <button onclick="cargarPDF('../addMenu/pdfSintomas.php')" class="btn btn-secondary">
                        <i class="bi bi-file-earmark-pdf"></i> Listado de Síntomas
                    </button>

                    <button type="button" onclick="descargarEnfermedades()" class="btn btn-success">
                        <i class="bi bi-download"></i> Descargar Enfermedades
                    </button>
                    <!-- Que este booton descarge el pdf de enfermedades -->
                </div>

                <div id="pdf-viewer-container" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center bg-light p-2 border">
                        <span>Vista Previa del Documento</span>
                        <div>
                            <button onclick="imprimirVisor()" class="btn btn-sm btn-success">
                                <i class="bi bi-printer"></i> Imprimir / Guardar PDF
                            </button>
                            <button onclick="cerrarVisor()" class="btn btn-sm btn-danger">Cerrar</button>
                        </div>
                    </div>
                    <iframe id="pdf-iframe" src="" style="width: 100%; height: 600px;" frameborder="0"></iframe>
                </div>
            </div>


        </section>


    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="js/sidebars.js" class="astro-vvvwv3sm"></script>

    <!-- iMPRESION DEL PDF -->
    <script>
        function cargarPDF(ruta) {
            const contenedor = document.getElementById('pdf-viewer-container');
            const iframe = document.getElementById('pdf-iframe');

            iframe.src = ruta;
            contenedor.style.display = 'block';

            // Desplazar suavemente hacia el visor
            contenedor.scrollIntoView({ behavior: 'smooth' });
        }

        function cerrarVisor() {
            document.getElementById('pdf-viewer-container').style.display = 'none';
            document.getElementById('pdf-iframe').src = '';
        }

        function imprimirVisor() {
            const iframe = document.getElementById('pdf-iframe');
            if (iframe.src) {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            }
        }
    </script>

    <!-- Descargar Enfermedades -->
    <script>
        function descargarEnfermedades() {
            // Cambiamos el texto del botón temporalmente
            const btnDescarga = document.querySelector('button.btn-success');
            const textoOriginal = btnDescarga.innerHTML;
            btnDescarga.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generando PDF...';
            btnDescarga.disabled = true;

            // Creamos el iframe invisible pero renderizable
            const hiddenIframe = document.createElement('iframe');

            // EL TRUCO: En lugar de display:none, lo sacamos de la pantalla pero le damos tamaño
            hiddenIframe.style.position = 'absolute';
            hiddenIframe.style.left = '-9999px';
            hiddenIframe.style.width = '1000px'; // Ancho suficiente para la tabla
            hiddenIframe.style.height = '1000px';
            hiddenIframe.style.border = 'none';

            // Le pasamos el parámetro ?descargar=1
            hiddenIframe.src = '../addMenu/pdfEnfermedades2.php?descargar=1';
            document.body.appendChild(hiddenIframe);

            // Damos un poco más de tiempo (4 segundos) para asegurar que el PDF se dibuje y descargue
            setTimeout(() => {
                btnDescarga.innerHTML = textoOriginal;
                btnDescarga.disabled = false;
                // Limpiamos el DOM
                document.body.removeChild(hiddenIframe);
            }, 4000);
        }
    </script>

</body>

</html>