<?php
session_start();
include('../connection/conexion.php');

if (isset($_POST['btnIngresar'])) {
    $usuarioForm = $_POST['txtUsuario'];
    $passwordForm = $_POST['txtContrasena'];

    // Consulta preparada usando MySQLi para evitar Inyección SQL
    $query = "SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?";
    $sentencia = mysqli_prepare($conexion, $query);
    
    // Las "ss" indican que estamos enviando dos variables de tipo String (texto)
    mysqli_stmt_bind_param($sentencia, "ss", $usuarioForm, $passwordForm);
    mysqli_stmt_execute($sentencia);
    
    // Obtenemos el resultado
    $resultado = mysqli_stmt_get_result($sentencia);
    $usuarioEncontrado = mysqli_fetch_assoc($resultado);

    if ($usuarioEncontrado) {
        // Guardamos datos en la sesión
        $_SESSION['usuario'] = $usuarioEncontrado['usuario'];
        $_SESSION['logueado'] = true;
        
        // Redirigir a la interfaz de experto
        header("Location: ../login/intExperto.php");
        exit();
    } else {
        // Redirigir de vuelta con error
        // NOTA: Asegúrate de que tu archivo principal se llame index.php y no index.html
        header("Location: ../index.php?error=1");
        exit();
    }
}
?>