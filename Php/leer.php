<?php

session_start();
if (!$_SESSION["valido"]) {
    header("location: ../inicio_de_sesion.php?estado=4");
    exit();
}

include 'funciones.php';

$sql = "SELECT * FROM arbol_descripcion";
$arboles = ejecutar_sql_configurado($sql);
http_response_code(200);
header('Content-type: application/json');
echo json_encode($arboles, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);