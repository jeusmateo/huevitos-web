<?php
var_dump($_REQUEST);

include "funciones.php";

$id = filter_input(INPUT_POST, 'id_planta', FILTER_VALIDATE_INT);

$sql = "DELETE FROM arboles WHERE id_arbol = ?";
$conexion = abrir_conexion_sql();

$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$conexion->close();

header("location: ../administracionVivero.php");