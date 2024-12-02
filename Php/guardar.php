<?php
// * * * *
session_start();
if (!$_SESSION["valido"]) {
    header("location: ../inicio_de_sesion.php?estado=4");
    exit();
}
// * * * *

global $servidor, $usuario, $contrasena, $basedatos, $carpeta_imagenes;
include 'variables.php';
include 'funciones.php';

function isFieldsEmpty(): bool
{
    return empty($_REQUEST["nombreComun"]) ||
        empty($_REQUEST["nombreCientifico"]) ||
        empty($_REQUEST["familia"]) ||
        empty($_REQUEST["fruto"]) ||
        empty($_REQUEST["floracion"]) ||
        empty($_REQUEST["descripcion"]) ||
        empty($_REQUEST["usos"]) ||
        empty($_FILES["imagen"]);
}

if (isFieldsEmpty() || $_FILES["imagen"]["error"] != UPLOAD_ERR_OK || $_FILES["imagen"]["size"] == 0) {
    header("location: ../formularioPlantas.php");
    exit();
}

// procesar imagen
$tmp_name = $_FILES["imagen"]["tmp_name"];
$nombre_imagen = htmlentities(basename($_FILES["imagen"]["name"]));
$ruta_imagen = "$carpeta_imagenes/$nombre_imagen";

if(!file_exists($carpeta_imagenes)){
    mkdir($carpeta_imagenes);
}

if(!move_uploaded_file($tmp_name, $ruta_imagen)){
    header("location: ../formularioPlantas.php?error=2");
}

// Obtener los datos del formulario
$nombreComunF = $_REQUEST["nombreComun"];
$nombreCientificoF = $_REQUEST["nombreCientifico"];
$familiaF = $_REQUEST["familia"];
$frutoF = $_REQUEST["fruto"];
$floracionF = $_REQUEST["floracion"];
$descripcionF = $_REQUEST["descripcion"];
$usosF = $_REQUEST["usos"];
$imagenF = $ruta_imagen;

//Evitar cross scripting - sustituir caracteres ' o " por equivalentes en HTML
$nombreComunF = htmlentities($nombreComunF);
$nombreCientificoF = htmlentities($nombreCientificoF);
$familiaF = htmlentities($familiaF);
$frutoF = htmlentities($frutoF);
$floracionF = htmlentities($floracionF);
$descripcionF = htmlentities($descripcionF);
$usosF = htmlentities($usosF);

$conexion = abrir_conexion_sql();

$stmt = $conexion->prepare("INSERT INTO arboles(
    nombre_cientifico,
    ruta_imagen,
    id_familia,
    nombre_comun,
    descripcion,
    fruto,
    floracion,
    usos
)
VALUES(?, ?, ?, ?, ?, ?, ?,?)");

$stmt->bind_param(
    "ssisssss",
    $nombreCientificoF,
    $imagenF,
    $familiaF,
    $nombreComunF,
    $descripcionF,
    $frutoF,
    $floracionF,
    $usosF
);

$stmt->execute();

header("location: ../administracionVivero.php");