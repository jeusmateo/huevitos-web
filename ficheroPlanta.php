<?php

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
//var_dump($id);

$familia = '';
$nombre_imagen = '';
$nombre_cientifico = '';
$nombre_comun = '';
$descripcion = '';
$fruto = '';
$floracion = '';
$usos = '';

if ($id) {
    $sql = "SELECT familia, 
               nombre_imagen, 
               nombre_cientifico, 
               nombre_comun, 
               descripcion, 
               fruto, 
               floracion, 
               usos from arbol_descripcion WHERE id_arbol = ?";

    include 'Php/funciones.php';
    $conexion = abrir_conexion_sql();

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->bind_result(
        $familia,
        $nombre_imagen,
        $nombre_cientifico,
        $nombre_comun,
        $descripcion,
        $fruto,
        $floracion,
        $usos
    );

    $stmt->fetch();

    $familia = htmlspecialchars($familia, ENT_QUOTES, 'UTF-8');
    $nombre_imagen = htmlspecialchars($nombre_imagen, ENT_QUOTES, 'UTF-8');
    $nombre_cientifico = htmlspecialchars($nombre_cientifico, ENT_QUOTES, 'UTF-8');
    $nombre_comun = htmlspecialchars($nombre_comun, ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8');
    $fruto = htmlspecialchars($fruto, ENT_QUOTES, 'UTF-8');
    $floracion = htmlspecialchars($floracion, ENT_QUOTES, 'UTF-8');
    $usos = htmlspecialchars($usos, ENT_QUOTES, 'UTF-8');

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Fichero(ejemplo) | Vivero Institucional</title>
    <link href="Css/FicheroPlanta.css" rel="stylesheet">
    <style>
        button {
            background-color: #C79316;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #boton-descarga{
            position: absolute;
            bottom: 20px;
            left: 20px;
        }

    </style>
</head>
<body>
<header id="encabezado">
    <div class="encabezado-container">
        <div class="logo-container">
            <img alt="logo UADY" class="logo" src="Recursos/Svg/logo_uady.svg">
            <img alt="logo RSU" class="logo" src="Recursos/img/RSULogo.png">
        </div>
        <div class="lema-uady">
            <h4>"Luz, Ciencia y Verdad"</h4>
        </div>
        <nav>
            <ul class="nav">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="catalogo.html">Catálogo</a></li>
                <li><a href="contacto.html">Contacto</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
    <div id="ficha-planta">
        <div id="titulo-planta">
                <pre>





                </pre>
            <h1><?php echo $nombre_comun ?></h1>
            <h2><?php echo $nombre_cientifico ?></h2>
        </div>
        <div id="planta-container">
            <div id="imagen-planta">
                <a href="data/<?php echo $nombre_imagen ?>" download="<?php echo $nombre_imagen ?>"><button id="boton-descarga">Descargar</button></a>
                <img alt="" height="700" src="data/<?php echo $nombre_imagen ?>" width="600">
                <!--                <div id="imagen-texto">-->
                <!--                    <table border="0" cellpadding="2px" id="tabla-imagen">-->
                <!--                        <thead>-->
                <!--                        <tr>-->
                <!--                            <th colspan="2">ALTURA EN VIVERO</th>-->
                <!--                        </tr>-->
                <!--                        </thead>-->
                <!---->
                <!--                        <tbody>-->
                <!--                        <tr>-->
                <!--                            <td>Planta chica:</td>-->
                <!--                            <td>40- 60 cm</td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <td>Árbol estándar:</td>-->
                <!--                            <td>>1.2 m</td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <td>Árbol crecido:</td>-->
                <!--                            <td>>2 m</td>-->
                <!--                        </tr>-->
                <!--                        </tbody>-->
                <!--                    </table>-->
                <!--                </div>-->
            </div>
            <div id="descripcion-planta">
                <h3>Familia</h3>
                <p><?php echo $familia ?></p>
                <h3>Descripcion</h3>
                <p><?php echo $descripcion ?></p>
                <h3>Fruto</h3>
                <p><?php echo $fruto ?></p>
                <h3>Floracion</h3>
                <p><?php echo $floracion ?></p>
                <h3>Usos</h3>
                <p><?php echo $usos ?></p>
            </div>
        </div>
    </div>
</main>

<script src="Js/ajax.js"></script>

<script>
    window.onload = () => {
        const queryString = window.location.search;
        console.log(queryString);

    }

</script>

</body>

</html>
