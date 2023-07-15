<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Página principal</title>
    <link rel="stylesheet" href="Estilos_principal.css">
    <style>
        body {
            background-image: url('Img/FondoPrincipal.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }

    include "config.php";

    // Manejar la creación de un nuevo usuario
    if (isset($_POST['nombre'], $_POST['correo'], $_POST['contraseña'])) {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        $query = "INSERT INTO usuarios (Nombre, Email, Contraseña) VALUES ('$nombre', '$correo', '$contraseña')";
        mysqli_query($conexion, $query);
    }

    // Manejar la actualización de un usuario existente
    if (isset($_POST['id'], $_POST['nombre'], $_POST['correo'], $_POST['contraseña'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        $query = "UPDATE usuarios SET Nombre='$nombre', Email='$correo', Contraseña='$contraseña' WHERE ID='$id'";
        mysqli_query($conexion, $query);
    }

    // Manejar la eliminación de un usuario existente
    if (isset($_GET['eliminar'])) {
        $id = $_GET['eliminar'];

        $query = "DELETE FROM usuarios WHERE ID='$id'";
        mysqli_query($conexion, $query);
    }

    // Manejar la búsqueda de usuarios
    if (isset($_GET['buscar'])) {
        $busqueda = $_GET['buscar'];

        $query = "SELECT * FROM usuarios WHERE Nombre LIKE '%$busqueda%' OR Email LIKE '%$busqueda%'";
        $result = mysqli_query($conexion, $query);
    } else {
        $query = "SELECT * FROM usuarios";
        $result = mysqli_query($conexion, $query);
    }

    // Manejar la creación de un nuevo registro
    if (isset($_POST['fecha'], $_POST['producto'], $_POST['cantidad'], $_POST['precio'])) {
        $fecha = $_POST['fecha'];
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];

        $query = "INSERT INTO registros (Fecha, Producto, Cantidad, Precio) VALUES ('$fecha', '$producto', '$cantidad', '$precio')";
        mysqli_query($conexion, $query);
    }

    // Manejar la actualización de un registro existente
    if (isset($_POST['id'], $_POST['fecha'], $_POST['producto'], $_POST['cantidad'], $_POST['precio'])) {
        $id = $_POST['id'];
        $fecha = $_POST['fecha'];
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];

        $query = "UPDATE registros SET Fecha='$fecha', Producto='$producto', Cantidad='$cantidad', Precio='$precio' WHERE ID_Ventas='$id'";
        mysqli_query($conexion, $query);
    }

    // Manejar la eliminación de un registro existente
    if (isset($_GET['eliminar_registro'])) {
        $id = $_GET['eliminar_registro'];

        $query = "DELETE FROM registros WHERE ID_Ventas='$id'";
        mysqli_query($conexion, $query);
    }

    // Manejar la búsqueda de registros
    if (isset($_GET['buscar_registro'])) {
        $busqueda = $_GET['buscar_registro'];

        $query = "SELECT * FROM registros WHERE Fecha LIKE '%$busqueda%' OR Producto LIKE '%$busqueda%'";
        $result_registros = mysqli_query($conexion, $query);
    } else {
        $query = "SELECT * FROM registros";
        $result_registros = mysqli_query($conexion, $query);
    }
    ?>

    <h1>Página principal</h1>

    <!-- Formulario para crear un nuevo usuario -->
    <form action="principal.php" method="POST">
        <h2>Agregar usuario</h2>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="" required>
        <label for="correo">Correo electrónico:</label>
        <input type="text" id="correo" name="correo" placeholder="" required>
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" placeholder="" required>
       <button type="submit">Agregar usuario</button>
    </form>

    <!-- Formulario para buscar usuarios -->
    <form action="principal.php" method="GET">
        <label for="buscar">Buscar usuarios(Nombre):</label>
        <input type="text"id="buscar" name="buscar" placeholder="">
        <button type="submit">Buscar</button>
    </form>

    <!-- Tabla de usuarios -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $fila['ID'] ?></td>
                    <td><?= $fila['Nombre'] ?></td>
                    <td><?= $fila['Email'] ?></td>
                    <td>
                        <a class="btn-editar" href="editar.php?id=<?= $fila['ID'] ?>">Editar</a>
                        <a class="btn-eliminar" href="principal.php?eliminar=<?= $fila['ID'] ?>" onclick="return confirm('¿Está seguro de que desea eliminar este usuario?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Formulario para crear un nuevo registro -->
    <form action="principal.php" method="POST">
        <h2>Agregar registro</h2>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" placeholder="" required>
        <label for="producto">Producto:</label>
        <input type="text" id="producto" name="producto" placeholder="" required>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" placeholder="" required>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" placeholder="" required>
        <button type="submit">Agregar registro</button>
    </form>

    <!-- Formulario para buscar registros -->
    <form action="principal.php" method="GET">
        <label for="buscar_registro">Buscar registros(Nombre del Producto):</label>
        <input type="text"id="buscar_registro" name="buscar_registro" placeholder="">
        <button type="submit">Buscar</button>
    </form>

    <!-- Tabla de registros -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = mysqli_fetch_assoc($result_registros)): ?>
                <tr>
                    <td><?= $fila['ID_Ventas'] ?></td>
                    <td><?= $fila['Fecha'] ?></td>
                    <td><?= $fila['Producto'] ?></td>
                    <td><?= $fila['Cantidad'] ?></td>
                    <td><?= $fila['Precio'] ?></td>
                    <td><?= $fila['Cantidad'] * $fila['Precio'] ?></td>
                    <td>
                        <a class="btn-editar" href="editar_registro.php?id=<?= $fila['ID_Ventas'] ?>">Editar</a>
                        <a class="btn-eliminar" href="principal.php?eliminar_registro=<?= $fila['ID_Ventas'] ?>" onclick="return confirm('¿Está seguro de que desea eliminar este registro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>