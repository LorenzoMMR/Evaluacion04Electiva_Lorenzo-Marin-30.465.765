<?php
    include "config.php";

    if (isset($_GET['producto']) && isset($_GET['fecha'])) {
        $producto = $_GET['producto'];
        $fecha = $_GET['fecha'];

        // Obtener los registros de ventas según los parámetros de búsqueda
        $query = "SELECT * FROM registros WHERE Producto='$producto' AND Fecha='$fecha'";
        $result = mysqli_query($conexion, $query);
    } else {
        // Mostrar todos los registros de ventas si no se especifican parámetros de búsqueda
        $query = "SELECT * FROM registros";
        $result = mysqli_query($conexion, $query);
    }
?>

<!-- Formulario de búsqueda para ventas -->
<form action="buscar.php" method="GET">
    <input type="text" name="producto" placeholder="Producto">
    <input type="date" name="fecha" placeholder="Fecha">
    <button type="submit">Buscar</button>
</form>

<!-- Datagridview para ventas -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['ID_Ventas']}</td>";
                echo "<td>{$row['Fecha']}</td>";
                echo "<td>{$row['Producto']}</td>";
                echo "<td>{$row['Cantidad']}</td>";
                echo "<td>{$row['Precio']}</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>