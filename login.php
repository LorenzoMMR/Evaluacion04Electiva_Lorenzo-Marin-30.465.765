<?php
    include "config.php";
    session_start();

    if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
        // Verificar las credenciales de inicio de sesión en la base de datos
        $query = "SELECT * FROM usuarios WHERE Email = '{$_POST['usuario']}' AND Contraseña = '{$_POST['contraseña']}'";
        $result = mysqli_query($conexion, $query);

        if (mysqli_num_rows($result) == 1) {
            // Iniciar sesión y redireccionar al usuario a la página principal
            $_SESSION['usuario'] = $_POST['usuario'];
            header("Location: principal.php");
            exit();
        } else {
            // Mostrar un mensaje de error si las credenciales son incorrectas
            $error = "Usuario o contraseña incorrectos";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="Estilos_login.css">
</head>

<body class="login-body">
    <form class="login-form" action="login.php" method="POST">
        <h1 class="login-heading">Iniciar sesión</h1>
        <label for="usuario">Correo electrónico:</label>
        <input type="text" id="usuario" name="usuario" placeholder="" required>
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" placeholder="" required>
        <button type="submit" class="login-button">Iniciar sesión</button>
    </form>

    <?php
        // Mostrar un mensaje de error si las credenciales son incorrectas
        if (isset($error)) {
            echo "<p>$error</p>";
        }
    ?>
</body>
</html>