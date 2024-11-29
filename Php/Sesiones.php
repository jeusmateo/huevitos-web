<?php

session_start();

$_SESSION["usuario"] = "admin";
$_SESSION["Edad"] = 20;
$_SESSION["valido"] = true;


include ("variables.php");

echo "Bienvenido " . $_SESSION["usuario"];

session_destroy();

?>