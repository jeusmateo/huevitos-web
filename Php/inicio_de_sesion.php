<?php

include("funciones.php");

$estado = filter_input(INPUT_GET, "estado", FILTER_SANITIZE_URL);
$usuario = filter_input(INPUT_GET, "usuario", FILTER_SANITIZE_STRING);

switch ($estado) {
    case "1":
        $mensaje = "Debe proporcionar su nombre de usuario";
        break;
    case "2":
        $mensaje = "Debe proporcionar su contraseña";
        break;
    case "3":
        $mensaje = "Usuario o contraseña incorrectos";
        break;
    case "4":
        $mensaje = "Debes iniciar sesión para utilizar el sistema";
        break;
    case "5":
        $mensaje = "Sesión cerrada exitosamente";
        break;
    default:
        $mensaje = "";
}

?>

<html>

<head>
    <title>Aplicación</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <style>
        table {
            border: solid 1px;
        }

        #estado {
            border: solid 1px #CCC;
            background-color: #EEE;
            color: blue;
            visibility: hidden;
            margin-bottom: 4px;
            padding: 4px;
            width: 500px;
        }
    </style>

    <script>
        <?php echo "var estado = '" . $mensaje . "';"; ?>

        function ocultarPanelEstado(panelEstado) {
            document.getElementById("estado").style.visibility = "hidden";
        }

        window.onload = function() {

            document.forma.onsubmit = function() {

                // Validación individual
                if (document.forma.usuario.value == "") {
                    alert("Debe proporcionar el nombre de usuario.");
                    document.forma.usuario.focus();
                    return false;
                }
            }

            document.forma.usuario.value = "<?php echo $usuario; ?>";

            if (estado != "") {
                panelEstado = document.getElementById("estado");
                panelEstado.innerHTML = estado;
                panelEstado.style.visibility = "visible";
                setTimeout(ocultarPanelEstado, 3000);
            }

        }
    </script>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../Css/inicioSesion.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2>Iniciar Sesión</h2>
            <!-- Div para mensajes de estado -->
            <div id="estado">Mensaje</div>
            <form action="validador.php" method="post">
                <div class="input-container">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
                </div>
                <div class="input-container">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>
                </div>
                <button type="submit" class="btn">Iniciar Sesión</button>
                
            </form>
        </div>
    </div>
</body>

</html>
