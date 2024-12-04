<?php

include 'funciones.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$sql = "SELECT * FROM arbol_descripcion";
if (!empty($search)) {
    $sql .= " WHERE nombre_cientifico LIKE '%$search%' OR nombre_comun LIKE '%$search%'";
}


$arboles = ejecutar_sql_configurado($sql);
http_response_code(200);
header('Content-type: application/json');
echo json_encode($arboles, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);