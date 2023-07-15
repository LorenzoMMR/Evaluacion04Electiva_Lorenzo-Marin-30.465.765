<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar registro</title>
    <link rel="stylesheet" href="Estilos_editar_registro.css">
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

        // Obtener los datos del registro desde la base de datos
        $query = "SELECT * FROM registros WHERE ID_Ventas='$id'";
        $result = mysqli_query($conexion, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
        } else {
            die("El registro no existe");
        }
    } else {
        die("El registro no existe");
    }

    // Actualizar los datos del registro si se ha enviado el formulario
    if (isset($_POST['id']) && isset($_POST['fecha']) && isset($_POST['producto']) && isset($_POST['cantidad']) && isset($_POST['precio'])) {
        $id = $_POST['id'];
        $fecha = $_POST['fecha'];
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];

        $query = "UPDATE registros SET Fecha='$fecha', Producto='$producto', Cantidad='$cantidad', Precio='$precio' WHERE ID_Ventas='$id'";
        mysqli_query($conexion, $query);

        // Redirigir al usuario a la página principal después de guardar los cambios
        header("Location: principal.php");
        exit();
    }
?>

<!-- Formulario para editar el registro -->
<form action="editar_registro.php?id=<?php echo $row['ID_Ventas']; ?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['ID_Ventas']; ?>">
    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" placeholder="" value="<?php echo $row['Fecha']; ?>" required>
    <label for="producto">Producto:</label>
    <input type="text" id="producto" name="producto" placeholder="" value="<?php echo $row['Producto']; ?>" required>
    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" placeholder="" value="<?php echo $row['Cantidad']; ?>" required>
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" placeholder="" value="<?php echo $row['Precio']; ?>" required>
    <button type="submit">Guardar cambios</button>
</form>