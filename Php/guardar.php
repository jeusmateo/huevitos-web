<?php
session_start();
if (!$_SESSION["valido"]) {
    header("location: ../inicio_de_sesion.php?estado=4");
    exit();
}

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
        empty($_REQUEST["usos"]);
}

if (isFieldsEmpty()) {
    header("location: ../formularioPlantas.php");
    exit();
}

$conexion = abrir_conexion_sql();
$ruta_imagen = '';

if (!empty($_REQUEST["id_planta"])) {
    $id = sprintf("%d", $_REQUEST["id_planta"]);
    $stmt = $conexion->prepare("SELECT nombre_imagen FROM arboles WHERE id_arbol = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($ruta_imagen);
    $stmt->fetch();
    $stmt->close();
}

if ($_FILES["imagen"]["error"] == UPLOAD_ERR_OK && $_FILES["imagen"]["size"] > 0) {
    $tmp_name = $_FILES["imagen"]["tmp_name"];
    $nombre_imagen = htmlentities(basename($_FILES["imagen"]["name"]));
    $ruta_imagen = "$carpeta_imagenes/$nombre_imagen";

    if (!file_exists($carpeta_imagenes)) {
        mkdir($carpeta_imagenes);
    }

    if (!move_uploaded_file($tmp_name, $ruta_imagen)) {
        header("location: ../formularioPlantas.php?error=2");
        exit();
    }
} else {
    header('location: ../formularioPlantas.php');
}

// Obtener los datos del formulario
$nombreComunF = htmlentities($_REQUEST["nombreComun"]);
$nombreCientificoF = htmlentities($_REQUEST["nombreCientifico"]);
$familiaF = htmlentities($_REQUEST["familia"]);
$frutoF = htmlentities($_REQUEST["fruto"]);
$floracionF = htmlentities($_REQUEST["floracion"]);
$descripcionF = htmlentities($_REQUEST["descripcion"]);
$usosF = htmlentities($_REQUEST["usos"]);

if (empty($_REQUEST["id_planta"])) {
    $stmt = $conexion->prepare("INSERT INTO arboles(
        nombre_cientifico,
        nombre_imagen,
        id_familia,
        nombre_comun,
        descripcion,
        fruto,
        floracion,
        usos
    )
    VALUES(?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssisssss",
        $nombreCientificoF,
        $nombre_imagen,
        $familiaF,
        $nombreComunF,
        $descripcionF,
        $frutoF,
        $floracionF,
        $usosF
    );
} else {
    $stmt = $conexion->prepare("UPDATE arboles
    SET nombre_cientifico = ?,
        nombre_imagen = ?,
        id_familia = ?,
        nombre_comun = ?,
        descripcion = ?,
        fruto = ?,
        floracion = ?,
        usos = ?
    WHERE id_arbol = ?");

    $stmt->bind_param(
        "ssisssssi",
        $nombreCientificoF,
        $nombre_imagen,
        $familiaF,
        $nombreComunF,
        $descripcionF,
        $frutoF,
        $floracionF,
        $usosF,
        $id
    );
}

$stmt->execute();
header("location: ../administracionVivero.php");