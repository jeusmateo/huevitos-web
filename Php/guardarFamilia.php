<?php

// * * * *
session_start();
if (!$_SESSION["valido"]) {
    header("location: index.php?estado=4");
    exit();
}
// * * * *

include 'funciones.php';
include 'variables.php';

global $servidor, $usuario, $contrasena, $basedatos;

if(empty($_REQUEST['nombreFamilia'])){
    header("location: {$_SERVER[""]}");
    exit();
}

$familiaF = htmlentities($_REQUEST['nombreFamilia']);

$sql = "INSERT INTO `arboles_familia`(`nombre`) VALUES ('$familiaF')";

EjecutarSQL($servidor, $usuario, $contrasena, $basedatos, $sql);


// todo
header("location: ../formularioFamilias.php");
