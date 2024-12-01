
<?php

session_start();

if (!isset($_SESSION["valido"])) {
    header("location: inicio_de_sesion.php?estado=4");
    exit();
}

session_destroy();

header("location: inicio_de_sesion.php?estado=5");

?>