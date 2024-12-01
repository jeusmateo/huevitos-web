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
    <meta charset="UTF-8">
    <title>Formulario de familias</title>
</head>
<body>

<form action="Php/guardarFamilia.php" method="post">
<label for="nombreFamilia">Nombre de la familia</label>
    <input type="text" name="nombreFamilia" id="nombreFamilia">
    <input type="submit" value="Añadir">
</form>

<form action="Php/eliminarFamilia.php" method="post">
    <table id="tabla-familias" border>
        <tr>
            <th colspan="3">Nombre</th>
        </tr>
        <?php

        include 'Php/funciones.php';

        $sql = 'SELECT id_familia, nombre FROM arboles_familia';

        $resultado = ejecutarSQLConfigurado($sql);

        foreach ($resultado as $fila) {
            echo "<tr><td><input type='checkbox' name='familia[]' value='$fila[id_familia]'></td><td>$fila[nombre]</td></tr>\n";
        }

        ?>
    </table>
    <p><input type="submit" value="Eliminar"></p>
</form>


</body>
</html>