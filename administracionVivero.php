<?php

session_start();
if (!isset($_SESSION["valido"])) {
    header("location: inicio_de_sesion.php?estado=4");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="Css/encabezado.css" type="text/css">
    <link rel="stylesheet" href="Css/cartaPlantas.css" type="text/css">
    <link rel="stylesheet" href="Css/administracionVivero.css">

    <title>Catalogo</title>

</head>

<body>
<header id="encabezado">
    <div class="encabezado-container">
        <div class="logo-container">
            <img src="Recursos/Svg/logo_uady.svg" alt="logo UADY" class="logo">
            <img src="Recursos/img/RSULogo.png" alt="logo RSU" class="logo">
        </div>
        <div class="dicho-uady">
            <h4>"Luz, Ciencia y Verdad"</h4>
        </div>

        <nav>
            <ul class="nav">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="Php/cerrarSesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </div>
</header>

<div id="tituloCatalogo">
    <pre>

    </pre>
    <b>Catálogo de plantas</b>
    <br><br>
</div>

<div id="contenidoCatalogo" class="restriccion">
    <div id="buscador">
        <div id="contenedorBarraBusqueda">
            <form>
                <input id="barrabusqueda" type="text" placeholder="Search.." name="search">
                <img src="Recursos/img/lupa.png" width="30px" height="30px" align="center" alt="lupa">
                <!--<button type="submit"><img height="50px" alt="lupa"></button>-->

            </form>
        </div>
        <!--<input type="button" value="Add card" class="agregarCarta" onclick="addCard();">-->
        <input type="button" value="Registrar nueva planta" class="agregarCarta"
               onclick="location.href='formularioPlantas.php'">
    </div>

    <div id="cardScroller">
        <div id="cardContainer" class="flexCards"></div>
    </div>
</div>

</body>
<script src="Js/ajax.js"></script>
<script src="Js/cardInfo.js"></script>
<script src="Js/administracionVivero.js"></script>

</html>