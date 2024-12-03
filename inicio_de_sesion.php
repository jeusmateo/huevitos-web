<?php

session_start();

if (isset($_SESSION["valido"])) {
    header("location: administracionVivero.php");
    exit();
}

include("Php/funciones.php");

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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="Css/inicioSesion.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const estado = "<?php echo $mensaje; ?>";
            const usuario = "<?php echo $usuario; ?>";

            const panelEstado = document.getElementById("estado");
            const inputUsuario = document.getElementById("usuario");

            // Mostrar mensaje de estado si existe
            if (estado) {
                panelEstado.textContent = estado;
                panelEstado.style.visibility = "visible";
                panelEstado.style.opacity = "1";

                // Ocultar el mensaje después de 3 segundos
                setTimeout(() => {
                    panelEstado.style.opacity = "0";
                    panelEstado.style.transition = "opacity 1s ease";
                }, 3000);
            }

            // Prellenar el campo de usuario si hay valor
            if (usuario) {
                inputUsuario.value = usuario;
            }
        });
    </script>
</head>

<body>
    <div class="contenedor">
        <div class="caja-login">
            <h2>Iniciar Sesión</h2>
            <!-- Mensaje de estado -->
            <div id="estado" class="mensaje-estado"></div>
            <form action="Php/Validador.php" method="post" name="forma">
                <div class="contenedor-input">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
                </div>
                <div class="contenedor-input">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>
                </div>
                <button type="submit" class="btn">Iniciar Sesión</button>
                <p class="enlace-registro">Regresar al inicio <a href="index.html">Inicio</a></p>
            </form>
        </div>
    </div>
</body>

</html>
