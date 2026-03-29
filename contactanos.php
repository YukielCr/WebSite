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

<body class="bg-secondary text-bg-primary">
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




    <h2 class="py-4 text-center">Contactanos:</h2>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/carru1.jpeg" class="d-block w-100" alt="..." height="2rem">
        </div>
    </div>



    <section class="container-lg mt-5">
        <div class="card shadow-sm p-4">
            <h3 class="text-center">Mensaje</h3>
            <form action="php/envMensaje.php" method="POST" >
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre y apellido" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Coloca tu numero" name="telefono" required>
            </div>


            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Correo</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email" required>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Mensaje</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Escribe aqui tu mensaje" name="mensaje" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        </div>

        

    </section>




    <footer class="mt-5">
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



    <!-- Modal 1 Registro-->
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
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Usuario</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Es necesario color su usuario.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Registrar</button>
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
                        <?php if(isset($_GET['error'])): ?>
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