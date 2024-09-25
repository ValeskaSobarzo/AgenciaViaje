<?php
    include("conexion.php");
        // Consulta para obtener todos los registros de la tabla reserva
        $consulta = "SELECT * FROM reserva";
        $resultado = mysqli_query($conex, $consulta);
        if (mysqli_num_rows($resultado) > 0) {
            echo "<table border='1'>
                <tr>
                    <th>ID Reserva</th>
                    <th>ID Cliente</th>
                    <th>Fecha Reserva</th>
                    <th>ID Vuelo</th>
                    <th>ID Hotel</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                <td>{$row['id_reserva']}</td>
                <td>{$row['id_cliente']}</td>
                <td>{$row['fecha_reserva']}</td>
                <td>{$row['id_vuelo']}</td>
                <td>{$row['id_hotel']}</td>
            </tr>";
        }

            echo "</table>";
        } else {
        echo "No se encontraron reservas.";
        }
