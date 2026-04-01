<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="img/logoindex.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>


<body class="bg-secondary text-bg-primary ">
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-xxl">
                <a class="navbar-brand" href="index.PHP">
                    <img src="img/logoindex.png" alt="Logo" width="39" height="39" class="d-inline-block">
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
                            <a class="nav-link" aria-current="page" href="acercDe.html">Acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contactanos.php">Contactanos</a>
                        </li>
                    </ul>
                    <div class="d-block ms-auto">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#modal1">Registro</button>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#modal2">Iniciar</button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <section>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/carru1.jpeg" class="d-block w-100" style="filter: brightness(0.8);" alt="...">

                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100"
                        style="top: 0; bottom: 0;">

                        <h3 class="fw-bold mb-2 text-uppercase" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">I.T.Z
                        </h3>
                        <h3 class="fw-bold mb-3 text-uppercase" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">I.A
                        </h3>
                        <h3 class="mb-5" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Sistemas Expertos para
                            Diagnóstico de Enfermedades</h3>

                        <div class="d-flex justify-content-center align-items-center gap-4">
                            <img src="img/logo1.png" alt="Logo 1" class="img-fluid"
                                style="max-height: 120px; width: auto; filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.5));">

                            <img src="img/logo2.png" alt="Logo 2" class="img-fluid"
                                style="max-height: 120px; width: auto; filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.5));">
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="img/carru2.jpg" class="d-block w-100" style="filter: brightness(0.8);" alt="...">
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100"
                        style="top: 0; bottom: 0;">
                        <h3 class="fw-bold mb-2 text-uppercase" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Segundo
                        </h3>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="img/carru3.jpg" class="d-block w-100" style="filter: brightness(0.8);" alt="...">
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100"
                        style="top: 0; bottom: 0;">
                        <h3 class="fw-bold mb-2 text-uppercase" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Tercero
                        </h3>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <br>
    <div class="text-center">
        <h3 class="container-xxl">Enfermedades</h3>
    </div>
    <br>

    <section class="container-xxl">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="img/carru3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                cards content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="img/carru3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                cards content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="img/carru3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                cards content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="img/carru3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                cards content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <div class="text-center">
        <h3 class="container-xxl">Sitomas</h3>
    </div>
    <br>

    <section class="container-xxl">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="img/carru3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                cards content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="img/carru3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                cards content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="img/carru3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                cards content.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="img/carru3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                cards content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <br>
    <footer>
        <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
            <div class="container-xxl">
                <a class="navbar-brand" href="index.html">
                    <img src="img/logoindex.png" alt="Logo" width="39" height="39" class="d-inline-block">
                    Mi pagina Web
                </a>
                <div class="d-block ms-auto">
                    <span class="navbar-text">Copyright © 2026</span>
                </div>
            </div>
        </nav>
    </footer>


    <!-- Modal 1-->
    <div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Regristro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Formulario de registro Datos-->
                    <form action="php/newUsuario.php" method="POST">

                        <div class="mb-3">
                            <label for="txtUsuario" class="form-label">Usuario</label>
                            <input name="usuario" type="text" class="form-control" id="txtUsuario"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Es necesario color su usuario.</div>
                        </div>

                        <div class="mb-3">
                            <label for="txtContrasema" class="form-label">Contraseña</label>
                            <input name="contrasena" type="password" class="form-control" id="txtContrasema">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="btnIngresar" class="btn btn-primary">Registrar</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>


    <!-- Modal 2 Inicio de Secion-->
    <div class="modal fade" id="modal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Formulario de registro Datos-->
                    <form action="includes/login.php" method="POST">
                        <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger">Usuario o contraseña incorrectos</div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="txtUsuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="txtContrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="txtContrasena" name="txtContrasena"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="btnIngresar" class="btn btn-primary">Iniciar sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>