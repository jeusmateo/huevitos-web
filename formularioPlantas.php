<?php

session_start();
if (!$_SESSION["valido"]) {
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
    <link rel="stylesheet" href="Css/formularioPlantas.css" type="text/css">

    <title>Formulario de Plantas</title>
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
                <li><a href="formularioFamilias.php">Administrar familia de plantas</a></li>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="">Catálogo</a></li>
                <li><a href="contacto.html">Contacto</a></li>
            </ul>
        </nav>
    </div>
</header>

<section id="planta-section">
    <br><br><br><br>
    <form id="plantaForm" action="Php/guardar.php" method="post" enctype="multipart/form-data">
        <h2>Registro de planta</h2>
        <!-- Otros campos del formulario -->
        <table align="center">
            <tr>
                <td><label for="nombreComun">Nombre común de la planta:</label></td>
                <td><input type="text" id="nombreComun" name="nombreComun" placeholder="Nombre común"></td>
            </tr>
            <tr>
                <td><label for="nombreCientifico">Nombre científico de la planta:</label></td>
                <td><input type="text" id="nombreCientifico" name="nombreCientifico" placeholder="Nombre científico">
                </td>
            </tr>
            <tr>
                <td><label for="familia">Familia de la planta:</label></td>
                <td><select name="familia" id="familia">
                        <?php
                        include 'Php/funciones.php';
                        $sql = "SELECT id_familia, nombre FROM arboles_familia";

                        $familias = ejecutar_sql_configurado($sql);
                        foreach ($familias as $familia) {
                            echo "<option value='$familia[id_familia]'>$familia[nombre]</option>\n";
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td><label for="fruto">Fruto de la planta:</label></td>
                <td><input type="text" id="fruto" name="fruto" placeholder="Fruto"></td>
            </tr>
            <tr>
                <td><label for="floracion">Floracion de la planta:</label></td>
                <td><input type="text" id="floracion" name="floracion" placeholder="Floracion"></td>
            </tr>
        </table>

        <label for="descripcion">Descripcion de la planta</label>
        <textarea id="descripcion" name="descripcion" placeholder="Descripción de la planta" rows="5"></textarea>

        <label for="usos">Usos de la planta</label>
        <textarea name="usos" id="usos" rows="5"></textarea>

        <!-- Visualizacion de la imagen -->
        <div id="dropZone">
            Arrastra aquí una imagen
        </div>
        <div id="preview">Imagen no disponible</div>

        <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
        <!-- El archivo maximo es de 2^24 + 3 https://dev.mysql.com/doc/refman/8.0/en/storage-requirements.html#data-types-storage-reqs-strings -->
        <input type="hidden" name="MAX_FILE_SIZE" value="16777219"/>

        <!-- Input oculto para manejar la imagen a subir-->
        <input type="file" id="fileInput" name="imagen">

        <button type="submit">Enviar</button>

    </form>
    <script src="Js/formularioPlanta.js"></script>
</section>

</body>
</html>