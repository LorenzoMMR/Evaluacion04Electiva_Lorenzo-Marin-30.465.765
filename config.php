<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "ventas";

    $conexion = mysqli_connect($server, $username, $password, $database);

    if (!$conexion) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }
?>