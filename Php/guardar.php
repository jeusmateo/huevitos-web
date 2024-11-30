<?php

// * * * * TODO: descomentar esto para habilitar la validación de sesión
//session_start();
//if (!$_SESSION["valido"]) {
//    header("location: index.php?estado=4");
//    exit();
//}
// * * * *

global $servidor, $usuario, $contrasena, $basedatos;
include 'variables.php';
include 'funciones.php';

function isFieldsEmpty(): bool {
    return empty($_REQUEST["nombreComun"]) ||
        empty($_REQUEST["nombreCientifico"]) ||
        empty($_REQUEST["familia"]) ||
        empty($_REQUEST["fruto"]) ||
        empty($_REQUEST["floracion"]) ||
        empty($_REQUEST["descripcion"] ||
            empty($_REQUEST["imagen"]));
}

if (isFieldsEmpty()) {
    header("location: ../formularioPlantas.php");
    exit();
}

// Obtener los datos del formulario
$nombreComunF = $_REQUEST["nombreComun"];
$nombreCientificoF = $_REQUEST["nombreCientifico"];
$familiaF = $_REQUEST["familia"];
$frutoF = $_REQUEST["fruto"];
$floracionF = $_REQUEST["floracion"];
$descripcionF = $_REQUEST["descripcion"];
$imagenF = $_REQUEST["imagen"];

//Evitar cross scripting - sustituir caracteres ' o " por equivalentes en HTML
$nombreComunF = htmlentities($nombreComunF);
$nombreCientificoF = htmlentities($nombreCientificoF);
$familiaF = htmlentities($familiaF);
$frutoF = htmlentities($frutoF);
$floracionF = htmlentities($floracionF);
$descripcionF = htmlentities($descripcionF);
$imagenF = htmlentities($imagenF);

var_dump($nombreComunF);
var_dump($nombreCientificoF);
var_dump($familiaF);
var_dump($frutoF);
var_dump($floracionF);
var_dump($descripcionF);
var_dump($imagenF);

// Abre la conexion a la base de datos
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos);

$stmt = $conexion->prepare("INSERT INTO arboles(
    nombre_cientifico,
    ruta_imagen,
    id_familia,
    nombre_comun,
    descripcion,
    fruto,
    floracion
)
VALUES(?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "ssissss",
    $nombreCientificoF,
    $imagenF,
    $familiaF,
    $nombreComunF,
    $descripcionF,
    $frutoF,
    $floracionF
);

$stmt->execute();

exit();

header("location: administracionVivero.php");