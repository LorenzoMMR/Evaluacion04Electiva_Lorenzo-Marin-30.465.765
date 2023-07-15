<!DOCTYPE html>
<html>
<head>
    <title>Editar usuario</title>
    <link rel="stylesheet" type="text/css" href="Estilos_editar.css">
</head>
<style>
        body {
            background-image: url('Img/FondoPrincipal.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
<body>
    <?php
        include "config.php";

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Obtener los datos del usuario desde la base de datos
            $query = "SELECT * FROM usuarios WHERE ID='$id'";
            $result = mysqli_query($conexion, $query);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
            } else {
                die("El usuario no existe");
            }
        } else {
            die("El usuario no existe");
        }

        // Actualizar los datos del usuario si se ha enviado el formulario
        if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contraseña = $_POST['contraseña'];

            $query = "UPDATE usuarios SET Nombre='$nombre', Email='$correo', Contraseña='$contraseña' WHERE ID='$id'";
            mysqli_query($conexion, $query);

            // Redirigir al usuario a la página principal después de guardar los cambios
            header("Location: principal.php");
            exit();
        }
    ?>

    <!-- Formulario para editar los datos del usuario -->
    <form action="editar.php?id=<?php echo $row['ID']; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $row['Nombre']; ?>">
        <input type="text" name="correo" placeholder="Correo electrónico" value="<?php echo $row['Email']; ?>">
        <input type="password" name="contraseña" placeholder="Contraseña" value="<?php echo $row['Contraseña']; ?>">
        <button type="submit">Guardar cambios</button>
    </form>
</body>
</html>