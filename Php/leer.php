<?php

include 'funciones.php';

$sql = "SELECT * FROM arbol_descripcion";
$arboles = ejecutar_sql_configurado($sql);
http_response_code(200);
header('Content-type: application/json');
echo json_encode($arboles, JSON_FORCE_OBJECT);