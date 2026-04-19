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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            <a href="menu.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">MENÚ I.E.</span>
            </a>
            <hr />
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="intExperto.php" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bandaid" viewBox="0 0 16 16"><path d="M14.121 1.879a3 3 0 0 0-4.242 0L8.733 3.026l4.261 4.26 1.127-1.165a3 3 0 0 0 0-4.242M12.293 8 8.027 3.734 3.738 8.031 8 12.293zm-5.006 4.994L3.03 8.737 1.879 9.88a3 3 0 0 0 4.241 4.24l.006-.006 1.16-1.121ZM2.679 7.676l6.492-6.504a4 4 0 0 1 5.66 5.653l-1.477 1.529-5.006 5.006-1.523 1.472a4 4 0 0 1-5.653-5.66l.001-.002 1.505-1.492z" /><path d="M5.56 7.646a.5.5 0 1 1-.706.708.5.5 0 0 1 .707-.708Zm1.415-1.414a.5.5 0 1 1-.707.707.5.5 0 0 1 .707-.707M8.39 4.818a.5.5 0 1 1-.708.707.5.5 0 0 1 .707-.707Zm0 5.657a.5.5 0 1 1-.708.707.5.5 0 0 1 .707-.707ZM9.803 9.06a.5.5 0 1 1-.707.708.5.5 0 0 1 .707-.707Zm1.414-1.414a.5.5 0 1 1-.706.708.5.5 0 0 1 .707-.708ZM6.975 9.06a.5.5 0 1 1-.707.708.5.5 0 0 1 .707-.707ZM8.39 7.646a.5.5 0 1 1-.708.708.5.5 0 0 1 .707-.708Zm1.413-1.414a.5.5 0 1 1-.707.707.5.5 0 0 1 .707-.707" /></svg>
                        Agregar Enfermedad
                    </a>
                </li>
                <li>
                    <a href="intExpertoSintomas.php" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lungs-fill" viewBox="0 0 16 16"><path d="M8 1a.5.5 0 0 1 .5.5v5.243L9 7.1V4.72C9 3.77 9.77 3 10.72 3c.524 0 1.023.27 1.443.592.431.332.847.773 1.216 1.229.736.908 1.347 1.946 1.58 2.48.176.405.393 1.16.556 2.011.165.857.283 1.857.24 2.759-.04.867-.232 1.79-.837 2.33-.67.6-1.622.556-2.741-.004l-1.795-.897A2.5 2.5 0 0 1 9 11.264V8.329l-1-.715-1 .715V7.214c-.1 0-.202.03-.29.093l-2.5 1.786a.5.5 0 1 0 .58.814L7 8.329v2.935A2.5 2.5 0 0 1 5.618 13.5l-1.795.897c-1.12.56-2.07.603-2.741.004-.605-.54-.798-1.463-.838-2.33-.042-.902.076-1.902.24-2.759.164-.852.38-1.606.558-2.012.232-.533.843-1.571 1.579-2.479.37-.456.785-.897 1.216-1.229C4.257 3.27 4.756 3 5.28 3 6.23 3 7 3.77 7 4.72V7.1l.5-.357V1.5A.5.5 0 0 1 8 1m3.21 8.907a.5.5 0 1 0 .58-.814l-2.5-1.786A.5.5 0 0 0 9 7.214V8.33z" /></svg>
                        Agregar Sintoma
                    </a>
                </li>
                <li>
                    <a href="intExpertoPatologico.php" class="nav-link active" aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-medical-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-3 2v.634l.549-.317a.5.5 0 1 1 .5.866L7 7l.549.317a.5.5 0 1 1-.5.866L6.5 7.866V8.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L5 7l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V5.5a.5.5 0 1 1 1 0m-2 4.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1m0 2h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1" /></svg>
                        Cuadro Patologico
                    </a>
                </li>
            </ul>
            <hr />
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../img/logoindex.png" alt="" width="32" height="32" class="rounded-circle me-2" />
                    <strong>Opciones</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <div class="b-example-divider b-example-vr"></div>

        <section class="content-area">
            <div class="card shadow-sm p-4">
                <h3 class="text-center">Cuadro Patologico</h3>
                <div style="grid-template-columns: 1fr 1fr;" class="d-grid gap-0 row-gap-3">
                    <div class="p-2">
                        <div class="col-md-10 mx-auto">
                            <div class="mb-3 d-flex align-items-center">
                                <label for="selectEnfermedad" class="form-label fw-bold mb-0 me-2">Enfermedad:</label>
                                <select id="selectEnfermedad" class="form-select form-select-sm" aria-label="Default select example">
                                    <option value="" selected>Selecciona una enfermedad...</option>
                                    <?php 
                                        if($resultadoEnfermedades) {
                                            while($row = mysqli_fetch_assoc($resultadoEnfermedades)) { 
                                                echo '<option value="'.$row['id'].'" data-img="'.$row['ruta_imagen'].'">'.$row['nombre'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="image-placeholder mt-2 text-center" id="img-enfermedad-container">
                                <span>[Imagen de Enfermedad]</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="col-md-10 mx-auto">
                            <div class="mb-3 d-flex align-items-center">
                                <label for="selectSintoma" class="form-label fw-bold mb-0 me-2">Sintoma:</label>
                                <select id="selectSintoma" class="form-select form-select-sm" aria-label="Default select example">
                                    <option value="" selected>Open this select menu</option>
                                    <?php 
                                        if($resultadoSintomas) {
                                            while($row = mysqli_fetch_assoc($resultadoSintomas)) { 
                                                echo '<option value="'.$row['id'].'" data-img="'.$row['ruta_imagen'].'">'.$row['nombre'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="image-placeholder mt-2 text-center" id="img-sintoma-container">
                                <span>[Imagen de Síntoma]</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 mx-auto mt-2 mb-2">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <label for="inputPeso" class="fw-bold me-2 fs-5">Peso:</label>
                        <input type="number" id="inputPeso" class="form-control form-control-sm border-dark rounded-0 text-end" style="width: 70px;" value="0" min="0" max="100">
                        <span class="fw-bold ms-1 fs-5">%</span>
                    </div>
                </div>

                <div style="grid-template-columns: 1fr 7fr;" class="d-grid gap-3 mt-3 mb-2 col-md-11 mx-auto">
                    <div class="p-2">
                        <div class="d-grid gap-2">
                            <button id="btnAnadir" type="button" class="btn btn-primary">Anadir</button>
                            <button id="btnGuardar" type="button" class="btn btn-success">Guardar</button>
                            <!--
                            <button id="btnEliminar" type="button" class="btn btn-secondary">Eliminar</button>
                            <button id="btnCancelar" type="button" class="btn btn-danger">Cancelar</button>
                            -->
                        </div>
                    </div>
                    <div class="p-2">
                        <label class="form-label fw-bold mb-1" id="label-caracteristicas">Características seleccionadas:</label>
                        <div class="table-responsive border" style="height: 250px; overflow-y: auto;">
                            <table class="table table-hover table-striped align-middle mb-0">
                                <thead class="table-primary" style="position: sticky; top: 0; z-index: 1;">
                                    <tr>
                                        <th scope="col">Enfermedad</th>
                                        <th scope="col">Sintoma</th>
                                        <th scope="col" class="text-center">Peso</th>
                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-caracteristicas">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="intExpertoPatologico2.php" type="button" class="btn btn-secondary">
                        <i class="fa-solid fa-eye fa-beat"></i>
                        Ver Tabla
                    </a>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="js/sidebars.js" class="astro-vvvwv3sm"></script>

    <script>
        // Elementos principales
        const selectEnfermedad = document.getElementById('selectEnfermedad');
        const selectSintoma = document.getElementById('selectSintoma');
        const inputPeso = document.getElementById('inputPeso');
        const tabla = document.getElementById('tabla-caracteristicas');
        const labelCaracteristicas = document.getElementById('label-caracteristicas');

        // 1. FUNCIÓN PARA IMÁGENES
        function actualizarImagen(selectElement, containerId, textoVacio) {
            const container = document.getElementById(containerId);
            selectElement.addEventListener('change', function () {
                if (this.value === "") {
                    container.innerHTML = `<span>[${textoVacio}]</span>`;
                    return;
                }
                const opcionSeleccionada = this.options[this.selectedIndex];
                const rutaImg = opcionSeleccionada.getAttribute('data-img');

                if (rutaImg && rutaImg.trim() !== "") {
                    container.innerHTML = `<img src="${rutaImg}" style="max-width: 100%; max-height: 215px; object-fit: contain;" alt="Imagen">`;
                } else {
                    container.innerHTML = `<span>[${textoVacio}]</span>`;
                }
            });
        }
        actualizarImagen(selectEnfermedad, 'img-enfermedad-container', 'Sin Imagen de Enfermedad');
        actualizarImagen(selectSintoma, 'img-sintoma-container', 'Sin Imagen de Síntoma');

        // 2. FUNCIÓN PARA LEER DATOS AL SELECCIONAR ENFERMEDAD
        // 2. FUNCIÓN PARA LEER DATOS AL SELECCIONAR ENFERMEDAD
        selectEnfermedad.addEventListener('change', function () {
            const idEnfermedad = this.value;
            tabla.innerHTML = ''; 

            if (idEnfermedad === "") {
                labelCaracteristicas.innerText = "Características seleccionadas:";
                return;
            }

            const nombreEnfermedad = this.options[this.selectedIndex].text;
            labelCaracteristicas.innerText = `Características de: ${nombreEnfermedad}`;
            tabla.innerHTML = '<tr><td colspan="4" class="text-center text-primary fw-bold py-2">Cargando datos...</td></tr>';

            fetch(`../addPatologico/obtener_patologia.php?id_enfermedad=${idEnfermedad}`)
                .then(res => res.json())
                .then(data => {
                    tabla.innerHTML = ''; 
                    
                    if (data.success && data.data.length > 0) {
                        data.data.forEach(item => {
                            const tr = document.createElement('tr');
                            tr.className = 'fila-guardada bg-light';
                            tr.dataset.idEnfermedad = idEnfermedad;
                            tr.dataset.idSintoma = item.id_sintoma;
                            
                            // Agregamos clases extra a los botones para identificarlos
                            tr.innerHTML = `
                                <td class="align-middle fw-semibold text-primary">${nombreEnfermedad}</td>
                                <td class="align-middle fw-bold text-secondary">${item.nombre_sintoma}</td>
                                <td class="text-center align-middle"><span class="badge bg-secondary px-2 py-1 fs-6 span-peso">${item.peso}%</span></td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-warning btn-sm fw-bold btn-editar">Editar</button>
                                    <button class="btn btn-danger btn-sm fw-bold btn-eliminar">Eliminar</button>
                                </td>
                            `;

                            // ==========================================
                            // LÓGICA PARA LOS BOTONES EDITAR Y ELIMINAR
                            // ==========================================
                            const btnEditar = tr.querySelector('.btn-editar');
                            const btnEliminar = tr.querySelector('.btn-eliminar');
                            const spanPeso = tr.querySelector('.span-peso');

                            // 1. Botón Eliminar
                            btnEliminar.addEventListener('click', function() {
                                if (confirm(`¿Estás seguro de que deseas eliminar el síntoma "${item.nombre_sintoma}"?`)) {
                                    fetch('../addPatologico/eliminar_patologia.php', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json' },
                                        body: JSON.stringify({ id_enfermedad: idEnfermedad, id_sintoma: item.id_sintoma })
                                    })
                                    .then(res => res.json())
                                    .then(resData => {
                                        if (resData.success) {
                                            tr.remove(); // Borramos la fila visualmente
                                            // Si la tabla quedó vacía, mostramos el mensaje
                                            if (tabla.children.length === 0) {
                                                tabla.innerHTML = `<tr><td colspan="4" class="text-center text-muted py-2" id="fila-vacia">Aún no hay síntomas guardados.</td></tr>`;
                                            }
                                        } else {
                                            alert("Error al eliminar: " + resData.error);
                                        }
                                    });
                                }
                            });

                            // 2. Botón Editar
                            btnEditar.addEventListener('click', function() {
                                // Abre una alerta pidiendo el nuevo número
                                let nuevoPeso = prompt(`Ingresa el nuevo peso para "${item.nombre_sintoma}":`, item.peso);
                                
                                if (nuevoPeso !== null && nuevoPeso.trim() !== "" && !isNaN(nuevoPeso)) {
                                    fetch('../addPatologico/actualizar_patologia.php', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json' },
                                        body: JSON.stringify({ 
                                            id_enfermedad: idEnfermedad, 
                                            id_sintoma: item.id_sintoma, 
                                            peso: parseFloat(nuevoPeso) 
                                        })
                                    })
                                    .then(res => res.json())
                                    .then(resData => {
                                        if (resData.success) {
                                            item.peso = parseFloat(nuevoPeso); // Actualizamos la memoria
                                            spanPeso.innerText = `${item.peso}%`; // Actualizamos lo visual
                                        } else {
                                            alert("Error al actualizar: " + resData.error);
                                        }
                                    });
                                } else if (nuevoPeso !== null) {
                                    alert("Por favor, ingresa un número válido.");
                                }
                            });

                            tabla.appendChild(tr);
                        });
                    } else {
                        tabla.innerHTML = `<tr><td colspan="4" class="text-center text-muted py-2" id="fila-vacia">Aún no hay síntomas guardados para esta enfermedad.</td></tr>`;
                    }
                })
                .catch(error => {
                    console.error("Error en fetch:", error);
                    tabla.innerHTML = `<tr><td colspan="4" class="text-center text-danger fw-bold py-2">Error al conectar con la base de datos.</td></tr>`;
                });
        });

        // 3. FUNCIÓN PARA AÑADIR A LA TABLA (TEMPORAL)
        document.getElementById('btnAnadir').addEventListener('click', function () {
            const idEnfermedad = selectEnfermedad.value;
            const idSintoma = selectSintoma.value;
            const peso = inputPeso.value;

            if (idEnfermedad === "" || idSintoma === "" || peso <= 0) {
                alert("Por favor, selecciona una enfermedad, un síntoma y asigna un peso mayor a 0.");
                return;
            }

            const txtEnfermedad = selectEnfermedad.options[selectEnfermedad.selectedIndex].text;
            const txtSintoma = selectSintoma.options[selectSintoma.selectedIndex].text;

            // Eliminamos la fila de mensaje "Vacío" si existe, PARA NO BORRAR LOS QUE YA ESTÁN
            const filaVacia = document.getElementById('fila-vacia');
            if (filaVacia) {
                filaVacia.remove();
            }

            const tr = document.createElement('tr');
            tr.className = 'fila-nueva';
            tr.dataset.idEnfermedad = idEnfermedad;
            tr.dataset.idSintoma = idSintoma;
            tr.dataset.peso = peso;

            tr.innerHTML = `
                <td class="align-middle fw-semibold text-primary">${txtEnfermedad}</td>
                <td class="align-middle fw-bold text-success">${txtSintoma} <span class="badge bg-warning text-dark ms-1">NUEVO</span></td>
                <td class="text-center align-middle"><span class="badge bg-success px-2 py-1 fs-6">${peso}%</span></td>
                <td class="text-center align-middle"><small class="text-muted fw-bold">Pendiente</small></td>
            `;
            
            tabla.appendChild(tr);
        });

        // 4. FUNCIÓN PARA GUARDAR EN LA BASE DE DATOS
        document.getElementById('btnGuardar').addEventListener('click', function () {
            const filasNuevas = document.querySelectorAll('#tabla-caracteristicas tr.fila-nueva');

            if (filasNuevas.length === 0) {
                alert("No hay ningún síntoma nuevo marcado con NUEVO para guardar.");
                return;
            }

            let datosAGuardar = [];
            filasNuevas.forEach(fila => {
                datosAGuardar.push({
                    id_enfermedad: fila.dataset.idEnfermedad,
                    id_sintoma: fila.dataset.idSintoma,
                    peso: fila.dataset.peso
                });
            });

            const btnGuardar = this;
            btnGuardar.innerText = "Guardando...";
            btnGuardar.disabled = true;

            fetch('../addPatologico/guardar_patologia.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(datosAGuardar)
            })
            .then(res => res.json())
            .then(data => {
                btnGuardar.innerText = "Guardar";
                btnGuardar.disabled = false;

                if (data.success) {
                    alert("¡Datos guardados con éxito en la Base de Datos!");
                    
                    selectSintoma.value = "";
                    inputPeso.value = 0;
                    
                    // Al disparar el evento change, la tabla se limpia sola y vuelve a leer de la BD
                    selectEnfermedad.dispatchEvent(new Event('change'));
                } else {
                    alert("Error al guardar: " + data.error);
                }
            })
            .catch(error => {
                btnGuardar.innerText = "Guardar";
                btnGuardar.disabled = false;
                console.error('Error:', error);
                alert("Ocurrió un error de red al intentar guardar.");
            });
        });
    </script>
</body>
</html>