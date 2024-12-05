<?php
session_start();

// Redirigir si el usuario ya inició sesión
if (isset($_SESSION["valido"])) {
    header("location: administracionVivero.php");
    exit();
}

include("Php/funciones.php");

// Revisar si existe la cookie para recordar el usuario
$usuario = "";
if (isset($_COOKIE["usuarioRecordado"])) {
    $usuario = $_COOKIE["usuarioRecordado"];
}

// Manejo de estados para mensajes
$estado = filter_input(INPUT_GET, "estado", FILTER_SANITIZE_URL);

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

            const panelEstado = document.getElementById("estado");
            const inputUsuario = document.getElementById("usuario");
            const checkboxRecordar = document.getElementById("recordarUsuario");

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

            // Prellenar el campo de usuario desde localStorage
            const usuarioGuardado = localStorage.getItem("usuarioRecordado");
            if (usuarioGuardado) {
                inputUsuario.value = usuarioGuardado;
                checkboxRecordar.checked = true;
            }

            // Guardar o eliminar el usuario en localStorage al enviar el formulario
            const form = document.forms["forma"];
            form.addEventListener("submit", function () {
                if (checkboxRecordar.checked) {
                    localStorage.setItem("usuarioRecordado", inputUsuario.value);
                } else {
                    localStorage.removeItem("usuarioRecordado");
                }
            });
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
            <div class="contenedor-recordar">
                <input type="checkbox" id="recordarUsuario" name="recordarUsuario">
                <label for="recordarUsuario">Recordar Usuario</label>
            </div>
            <button type="submit" class="btn">Iniciar Sesión</button>
            <p class="enlace-registro">Regresar al inicio <a href="index.html">Inicio</a></p>
        </form>
    </div>
</div>
</body>

</html>