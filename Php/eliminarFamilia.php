<?php
// * * * *
session_start();
if (!$_SESSION["valido"]) {
    header("location: ../administracionVivero.php?estado=4");
    exit();
}
// * * * *

include 'funciones.php';

if(empty($_REQUEST["familia"])){
    header('location: ../formularioFamilias.php');
    exit();
}

$sql = "DELETE FROM arboles_familia WHERE id_familia = ?";
$mysqli = abrir_conexion_sql();
foreach ($_REQUEST["familia"] as $item){
    $id_familia = filter_var($item, FILTER_VALIDATE_INT);
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_familia);
    $stmt->execute();
}
$mysqli->close();

header('location: ../formularioFamilias.php');