
<?php
session_start();

//comprobamos si el usuario inicio sesion
if (isset($_SESSION["usuario"])) {
    header("location: administracionVivero.php");
    exit();
}

// comrpobamos si se envio el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    //validar credenciales
    if ($usuario == "admin" && $contrasena == "123") {
        $_SESSION["usuario"] = $usuario;
        header("location: administracionVivero.php");
        exit();
    } else {
        $mensaje_error = "Usuario o contraseña incorrectos";
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones de usuario</title>
</head>
<body>

    <h2>Iniciar Sesión</h2>

    <?php if (isset($mensaje_error)): ?>
        <p style="color:red"><?= $mensaje_error ?></p>
    <?php endif; ?>
    

    <form method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required><br><br>
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>


</body>
</html>