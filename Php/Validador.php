<?php

include 'funciones.php';

//$usuarioF = (isset($_REQUEST["usuario"]) && is_string($_REQUEST["usuario"])) ? $_REQUEST["usuario"] : "";
//$contrasenaF = (isset($_REQUEST["contrasena"]) && is_string($_REQUEST["contrasena"])) ? $_REQUEST["contrasena"] : "";
//$recordarUsuario = isset($_REQUEST["recordarUsuario"]) ? true : false; // Verificar si se seleccionó "Recordar usuario"

$usuarioF = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$contrasenaF = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_STRING);
$recordarUsuario = filter_input(INPUT_POST, 'recordarUsuario', FILTER_VALIDATE_BOOL);

if ($usuarioF == "") {
    header("location: ../inicio_de_sesion.php?estado=1");
    exit();
}
if (empty($contrasenaF)) {
    header("location: ../inicio_de_sesion.php?estado=2&usuario=" . $usuarioF);
    exit();
}

$conexion = abrir_conexion_sql();

// Evitar inyección SQL
$usuarioF = mysqli_real_escape_string($conexion, $usuarioF);
$contrasenaF = mysqli_real_escape_string($conexion, $contrasenaF);

$sentenciaSQL = "SELECT usuario, contrasena, nombre FROM usuarios WHERE usuario ='" . $usuarioF . "' AND contrasena ='" . $contrasenaF . "'";
$resultado = mysqli_query($conexion, $sentenciaSQL);
mysqli_close($conexion);

if (mysqli_num_rows($resultado) > 0) {
    $registro = mysqli_fetch_assoc($resultado);

    session_start();
    $_SESSION["valido"] = true;
    $_SESSION["nombre"] = $registro["nombre"];

    // Manejar la cookie si "Recordar usuario" está seleccionado
    if ($recordarUsuario) {
        setcookie("usuarioRecordado", $usuarioF, time() + (86400 * 30), "/"); // Cookie válida por 30 días
    } else {
        // Eliminar la cookie si no se selecciona "Recordar usuario"
        setcookie("usuarioRecordado", "", time() - 3600, "/");
    }

    // Si hay registro reenviar a la página administracionVivero.php
    header("location: ../administracionVivero.php");
} else {
    // Si no redirigir a la página inicio_de_sesion.php con estado 3
    header("location: ../inicio_de_sesion.php?estado=3");
}