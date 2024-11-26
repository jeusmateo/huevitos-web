<?php

session_start();

if (!isset($_SESSION["valido"])) {
    header("location: index.html");
    exit();
}


$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$basedatos = "inventario";



?>