<?php

include("variables.php");

$usuarioF = (isset($_REQUEST["usuario"]) && is_string($_REQUEST["usuario"])) ? $_REQUEST["usuario"] : "";
$contrasenaF = (isset($_REQUEST["contrasena"]) && is_string($_REQUEST["contrasena"])) ? $_REQUEST["contrasena"] : "";

if ($usuarioF == "") {
	header("location: inicio_de_sesion.php");
	exit();
}
if (empty($contrasenaF)) {
	header("location: inicio_de_sesion.php" . $usuarioF);
	exit();
}

$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
if (!$conexion) {
	die("Fallo: " . mysqli_connect_error());
}


//Evitar inyección SQL
$usuarioF = mysqli_real_escape_string($conexion, $usuarioF);
$contrasenaF = mysqli_real_escape_string($conexion, $contrasenaF);

$sentenciaSQL = "SELECT usuario, contrasena, nombre FROM usuarios WHERE usuario ='" . $usuarioF . "' AND contrasena ='" . $contrasenaF . "'";

echo $sentenciaSQL;
exit();

$resultado = mysqli_query($conexion, $sentenciaSQL);
mysqli_close($conexion);

if (mysqli_num_rows($resultado) > 0) {

	$registro = mysqli_fetch_assoc($resultado);

	session_start();
	$_SESSION["valido"] = true;
	$_SESSION["nombre"] = $registro["nombre"];

	//Si hay registro reenviar a la página menu.php
	header("location: menu.php");
} else {
	//Si no redirigir a la página index.html 
	header("location: index.php");
}
