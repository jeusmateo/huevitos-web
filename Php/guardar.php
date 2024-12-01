<?php
// * * * *
session_start();
if (!$_SESSION["valido"]) {
    header("location: ../inicio_de_sesion.php?estado=4");
    exit();
}
// * * * *

global $servidor, $usuario, $contrasena, $basedatos;
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
$tmp_name = htmlentities($_FILES["imagen"]["tmp_name"]);
$contenido_imagen = file_get_contents($tmp_name);

// Obtener los datos del formulario
$nombreComunF = $_REQUEST["nombreComun"];
$nombreCientificoF = $_REQUEST["nombreCientifico"];
$familiaF = $_REQUEST["familia"];
$frutoF = $_REQUEST["fruto"];
$floracionF = $_REQUEST["floracion"];
$descripcionF = $_REQUEST["descripcion"];
$usosF = $_REQUEST["usos"];
$imagenF = $contenido_imagen;

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
    binario_imagen,
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