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
    <title>Enfermedades</title>
    <link rel="icon" href="img/logoindex.png">
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
    require "../addEnfermedad/eliminar.php";
    require "../addEnfermedad/editar.php";
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
                    <a href="#" class="nav-link active" aria-current="page">
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
                <h3 class="text-center">Agregar Enfermedad</h3>
                <div style="grid-template-columns: 1fr 1fr;" class="d-grid gap-3">
                    <div class="p-2">
                        <form id="formEnfermedad" action="../addEnfermedad/altas.php" method="post"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="txtNombreEnfermedad" class="form-label fw-bold">Nombre</label>
                                <input name="nombre" type="text" class="form-control" id="txtNombreEnfermedad"
                                    aria-describedby="emailHelp" placeholder="Nombre de la Enfermedad, Eje: Covid-19"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="txtDescripcionEnfermedad" class="form-label fw-bold">Descripcion</label>
                                <input name="descripcion" type="text" class="form-control" id="txtDescripcionEnfermedad"
                                    placeholder="Descripcion de la Enfermedad, Eje: Dolor de cabeza" required>
                            </div>
                            <div class="mb-3">
                                <label for="fileImageForEnfermedad" class="form-label fw-bold">Imagen</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*"
                                    onchange="mostrarImagen(event)">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar 🗃️</button>
                            <button type="reset" class="btn btn-secondary" onclick="limpiarTodo()">Limpiar 🗑️</button>
                            <button type="button" class="btn btn-warning"
                                onclick="ejecutarModificacion()">Actualizar ✏️</button>
                            <button type="button" class="btn btn-danger" onclick="ejecutarBaja()">Eliminar 🗑️</button>
                        </form>
                    </div>
                    <div class="p-2 align-items-center justify-content-center text-center">
                        <div class="mx-auto p-2" style="width: 400px;">
                            <img id="vista-previa" src="../img/profile.jpg" class="img-thumbnail" alt="..."
                                style="max-height: 280px; text-align: center;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm p-4 mt-3">
                <h3 class="text-center">Operacion de CRUD</h3>
                <p>Bienvenido, <strong>
                        <?php echo $_SESSION['usuario']; ?>
                    </strong></p>

                <div class="mb-3">
                    <form class="d-flex mt-3" role="search" onsubmit="return false;">
                        <input class="form-control me-2" type="number" placeholder="Coloca el Id" aria-label="Search"
                            name="enfe" />
                        <button class="btn btn-success" type="button" onclick="ejecutarConsulta()">Buscar 🔍</button>
                    </form>
                </div>



                <!--Creacion de la Tabla de Enfermedades-->
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <!--Encabezados de la tabla-->
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Ruta Imagen</th>
                                <th scope="col" class="text-center">Imagen</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <!--Informacion de la tabla-->
                        <tbody>
                            <?php
                            $sql = $conexion->query("SELECT * FROM registro_enfermedades");
                            while ($datos = $sql->fetch_object()) {
                                // Ajustamos la ruta de la imagen
                                $ruta_imagen = $datos->ruta_imagen;
                                ?>
                            <tr>
                                <th scope="row" class="text-center">
                                    <?php echo $datos->id ?>
                                </th>
                                <td class="fw-semibold text-primary">
                                    <?php echo $datos->nombre ?>
                                </td>
                                <td>
                                    <?php echo $datos->descripcion ?>
                                </td>
                                <td class="text-muted small">
                                    <?php echo $datos->ruta_imagen ?>
                                </td>
                                <td class="text-center">
                                    <img width="80" height="80" src="<?= $ruta_imagen ?>" alt="enfermedad"
                                        class="img-thumbnail rounded" style="object-fit: cover;">
                                </td>
                                <td class="text-center">
                                    <div>
                                        <a data-bs-toggle="modal"
                                            data-bs-target="#staticBackdropEditar<?= $datos->id ?>"
                                            class="btn btn-warning btn-sm fw-bold">Editar</a>
                                        <a href="intExperto.php?id=<?= $datos->id ?>"
                                            class="btn btn-danger btn-sm fw-bold"
                                            onclick="return eliminar()">Eliminar</a>
                                    </div>
                                </td>
                            </tr>

                            <!--Modal para modificar los dartos-->
                            <div class="modal fade" id="staticBackdropEditar<?= $datos->id ?>" tabindex="-1"
                                aria-labelledby="staticBackdropLabel">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title fw-bold" id="staticBackdropLabel">Modificar
                                                Enfermedad</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form action="" enctype="multipart/form-data" method="post">
                                                <input type="hidden" value="<?= $datos->id ?>" name="id">
                                                <input type="hidden" value="<?= $datos->ruta_imagen ?>"
                                                    name="ruta_actual">

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nombre:</label>
                                                    <input type="text" class="form-control" name="nombre"
                                                        value="<?= $datos->nombre ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Descripción:</label>
                                                    <textarea name="descripcion" class="form-control" rows="3"
                                                        required><?= $datos->descripcion ?></textarea>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label fw-bold">Nueva Imagen (Opcional):</label>
                                                    <input type="file" class="form-control" name="imagen">
                                                </div>

                                                <div class="d-grid">
                                                    <input type="submit" value="Guardar Cambios" name="btneditar"
                                                        class="btn btn-success fw-bold">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </section>


    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="js/sidebars.js" class="astro-vvvwv3sm"></script>


    <!--Limpiar-->
    <script>
        function limpiarTodo() {
            // En mantenimiento no  me deja hacerlo
        }
    </script>
    <!--Mostrar la imagen-->
    <script>
        function mostrarImagen(event) {
            const archivo = event.target.files[0];
            if (archivo) {
                const urlTemporal = URL.createObjectURL(archivo);
                const imagenPreview = document.getElementById('vista-previa');
                imagenPreview.src = urlTemporal;
                imagenPreview.style.display = 'block';
            }
        }
    </script>

    <!--Eliminar-->
    <script>
        function eliminar() {
            let res = confirm("¿Desea eliminar este registro permanentemente?");
            return res;
        }
    </script>

    <!--Consultar-->
    <script>
        async function ejecutarConsulta() {
            let nombreEnfermedad = document.querySelector('input[name="enfe"]').value;

            if (nombreEnfermedad.trim() === "") {
                alert("Por favor, escribe el nombre de la enfermedad que deseas buscar.");
                return;
            }

            try {
                let respuesta = await fetch('../addEnfermedad/consultutaUnica.php?nombre=' + encodeURIComponent(nombreEnfermedad));
                let datos = await respuesta.json();

                if (datos.error) {
                    alert(datos.mensaje);
                    document.querySelector('textarea[name="descripcion"]').value = "";
                    document.getElementById('vista-previa').style.display = 'none';
                } else {
                    // 1. Llenamos el Nombre
                    let campoNombre = document.querySelector('input[name="nombre"]');
                    if (campoNombre) {
                        campoNombre.value = datos.nombre;
                    }

                    // 2. Llenamos la Descripción (Usamos corchetes para que funcione sea input o textarea)
                    let campoDescripcion = document.querySelector('[name="descripcion"]');
                    if (campoDescripcion) {
                        campoDescripcion.value = datos.descripcion;
                    }

                    // 3. Mostramos la Imagen
                    const imagenPreview = document.getElementById('vista-previa');
                    if (datos.ruta_imagen && datos.ruta_imagen.trim() !== "") {
                        let rutaLimpia = datos.ruta_imagen.replace("../../images/", "../images/");
                        imagenPreview.src = rutaLimpia;
                        imagenPreview.style.display = 'block';
                    } else {
                        imagenPreview.style.display = 'none';
                    }
                }
            } catch (error) {
                console.error("Error Fetch:", error);
                alert("Error de conexión. Revisa la consola.");
            }
        }
    </script>

    <!--Modificar-->
    <script>
        function ejecutarModificacion() {
            let nombreEnfermedad = document.querySelector('input[name="nombre"]').value;
            if (nombreEnfermedad.trim() === "") {
                alert("Por favor, escribe el nombre de la enfermedad que deseas modificar.");
            } else {
                let confirmacion = confirm("¿Seguro que deseas modificar los datos de la enfermedad: " + nombreEnfermedad + "?");
                if (confirmacion) {
                    let formulario = document.querySelector('form');
                    formulario.action = '../addEnfermedad/modificaciones.php';
                    formulario.submit();
                }
            }
        }
    </script>

    <!--Ejecusion de Bajas-->
    <script>
        function ejecutarBaja() {
            let nombreEnfermedad = document.querySelector('input[name="nombre"]').value;
            if (nombreEnfermedad.trim() === "") {
                alert("Por favor, escribe el nombre de la enfermedad que deseas dar de baja.");
            } else {
                let confirmacion = confirm("¿Seguro que deseas eliminar la enfermedad: " + nombreEnfermedad + "?");
                if (confirmacion) {
                    window.location.href = '../addEnfermedad/bajas.php?nombre=' + encodeURIComponent(nombreEnfermedad);
                }
            }
        }
    </script>

</body>

</html>