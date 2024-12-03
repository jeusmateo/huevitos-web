<?php

function EjecutarSQL ($servidor, $usuario, $contrasena, $basedatos, $sentenciaSQL) {
	$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
	if (!$conexion) {
    	die("Fallo: " . mysqli_connect_error());
	}

	$resultado = mysqli_query($conexion, $sentenciaSQL);
	mysqli_close($conexion);

}

function ConsultarSQL ($servidor, $usuario, $contrasena, $basedatos, $sentenciaSQL) {
	$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);
	if (!$conexion) {
    	die("Fallo: " . mysqli_connect_error());
	}

	$resultado = mysqli_query($conexion, $sentenciaSQL);

	for ($registros = array (); $fila = mysqli_fetch_assoc($resultado); $registros[] = $fila);

	mysqli_close($conexion);

	return $registros;
}

function ejecutar_sql_configurado($sentenciaSQL): array {
    $mysqli=abrir_conexion_sql();

    $resultado = $mysqli->query($sentenciaSQL);
    $mysqli->close();

    $registro = array();

    foreach ($resultado as $fila){
        $registro[] = $fila;
    }

    return $registro;
}

function abrir_conexion_sql(): mysqli{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    global $servidor, $usuario, $contrasena, $basedatos;
    include 'variables.php';
    return new mysqli($servidor, $usuario, $contrasena, $basedatos);
}