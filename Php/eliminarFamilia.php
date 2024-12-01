<?php
// * * * *
session_start();
if (!$_SESSION["valido"]) {
    header("location: administracionVivero.php?estado=4");
    exit();
}
// * * * *

include 'funciones.php';

if(empty($_REQUEST["familia"])){
    header('location: ../formularioFamilias.php');
    exit();
}

$sql = "DELETE FROM arboles_familia WHERE id_familia = ?";
$mysqli = abrirConexionSQL();
foreach ($_REQUEST["familia"] as $item){
    $id_familia = sprintf("%d", $item);
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_familia);
    $stmt->execute();
}
$mysqli->close();

header('location: ../formularioFamilias.php');