<!DOCTYPE html>
<html>
    <head>
        <title>Registrar usuario</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script>
            function validarVuelo() {
                // Obtener los valores de ambos formularios (VUELO y HOTEL)
                var origen = document.getElementById("origen").value;
                var destino = document.getElementById("destino").value;
                var fechaVuelo = document.getElementById("fecha").value;
                var plazas = document.getElementById("plazas_disponibles").value;
                var precio = document.getElementById("precio").value;
                var nombreHotel = document.getElementById("nombre").value;
                var ubicacion = document.getElementById("ubicacion").value;
                var habitaciones =
                document.getElementById("habitaciones_disponibles").value;
                var tarifaNoche = document.getElementById("tarifa_noche").value;
                var idCliente = document.getElementById("id_cliente").value;
                var fechaReserva = document.getElementById("fecha_reserva").value;
                // Validar que todos los campos estén completos

                if (origen === "" || destino === "" || fechaVuelo === "" || plazas ===
                "" || precio === "" || nombreHotel === "" || ubicacion === "" || habitaciones ===
                "" || tarifaNoche === "" || idCliente === "" || fechaReserva === "") {
                    alert("Por favor, complete todos los campos del vuelo.");
                    return false;
                }
                // Validar que las plazas y precio sean mayores que 0
                if (plazas <= 0 || precio <= 0 || habitaciones <= 0) {
                    alert("El número ingresado debe ser mayor que 0.");
                    return false;
                }
                // Validar que las habitaciones y la tarifa por noche sean mayores que 0
                if (habitaciones <= 0) {
                    alert("El número de habitaciones debe ser mayor a 0.");
                    return false;
                }
                // Si todas las validaciones son correctas, permitir el envío del
                formulario
                return true;
                }
            </script>
    </head>

    <body>
        <form method="post" onsubmit="return validarVuelo()">
        <h1>Agregar vuelo</h1>

        <label for="origen">Ciudad de origen:</label>
        <br>
            <select id="origen" name="origen" required>
                <option value="Santiago">Santiago</option>
                <option value="Rio de Janeiro">Río de Janeiro</option>
                <option value="Buenos Aires">Buenos Aires</option>
                <option value="Lima">Lima</option>
                <option value="Cartagena">Cartagena</option>
                <option value="Paris">París</option>
            </select>

        <label for="destino">Ciudad de destino:</label>
            <select id="destino" name="destino" required>
                <option value="Santiago">Santiago</option>
                <option value="Rio de Janeiro">Río de Janeiro</option>
                <option value="Buenos Aires">Buenos Aires</option>
                <option value="Lima">Lima</option>
                <option value="Cartagena">Cartagena</option>
                <option value="Paris">París</option>
            </select>
        <label for="fecha">Seleccione la fecha de vuelo:</label>
        <input type="date" id="fecha" name="fecha" required><br>
    
        <label for="plazas_disponibles">Plazas disponibles:</label>
        <input type="number" id="plazas_disponibles" name="plazas_disponibles"
        min="1" required><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" min="0"
        required><br>

        <h1>Agregar Hotel</h1>
        <label for="nombre">Nombre:</label>
            <select id="nombre" name="nombre" required>
                <option value="Best Western">Best Western</option>
                <option value="Hotel Atlantico Business">Hotel Atlantico Business</option>
                <option value="Milhouse Hotel Avenue">Milhouse Hotel Avenue</option>
                <option value="Country Club Lima Hotel">Country Club Lima Hotel</option>
                <option value="Ibis Hotel Cartagena">Ibis Hotel Cartagena</option>
                <option value="Ibis Hotel Porte d'Italie">Ibis Hotel Porte d'Italie</option>
            </select><br>

        <label for="ubicacion">Ingrese la ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion" required><br>
        
        <label for="habitaciones_disponibles">Habitaciones disponibles:</label>
        <input type="number" id="habitaciones_disponibles"
        name="habitaciones_disponibles" min="1" required><br>
        
        <label for="tarifa_noche">Tarifa por noche(Dolares):</label>
        <input type="number" id="tarifa_noche" name="tarifa_noche" step="0.01"
        min="0" required><br>

        <label for="id_cliente">Ingrese su ID de cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente"required>

        <label for="fecha_reserva">Ingrese su fecha de reserva:</label>
        <input type="date" id="fecha_reserva" name="fecha_reserva"required>
        
        <input type="submit" name="registrar" value="Agregar">
        </form>
    <?php
        include("conexion.php");
        // Verifica si el botón "registro" ha sido presionado
        if(isset($_POST['registrar'])){
            // Captura los datos del formulario
            $origen = $_POST['origen'];
            $destino = $_POST['destino'];
            $fecha = $_POST['fecha'];
            $plazas_disponibles =$_POST['plazas_disponibles'];
            $precio = $_POST['precio'];
            $nombre = $_POST['nombre'];
            $ubicacion=$_POST['ubicacion'];
            $habitaciones_disponibles =$_POST['habitaciones_disponibles'];
            $tarifa_noche = $_POST['tarifa_noche'];
            $id_cliente = $_POST['id_cliente'];
            $fecha_reserva = $_POST['fecha_reserva'];
            
            // Insertar en la tabla hotel
            $consulta_hotel = "INSERT INTO hotel (nombre, ubicacion,
            habitaciones_disponibles, tarifa_noche)
            VALUES ('$nombre', '$ubicacion', '$habitaciones_disponibles',
            '$tarifa_noche')";

            $resultado_hotel = mysqli_query($conex, $consulta_hotel); //variable conex
            if ($resultado_hotel) {
                $id_hotel = mysqli_insert_id($conex); // Obtener el ID del hotel insertado
            // Insertar en la tabla vuelo
            $consulta_vuelo = "INSERT INTO vuelo(origen, destino, fecha,
            plazas_disponibles, precio) VALUES ('$origen', '$destino', '$fecha',
            '$plazas_disponibles', '$precio')";
            
            $resultado_vuelo = mysqli_query($conex, $consulta_vuelo);
            if ($resultado_vuelo) {
            $id_vuelo = mysqli_insert_id($conex); // Obtener el ID del vuelo insertado

                // Insertar en la tabla reserva
                $consulta_reserva = "INSERT INTO reserva(id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES ('$id_cliente', '$fecha_reserva', '$id_vuelo','$id_hotel')";

                $resultado_reserva = mysqli_query($conex, $consulta_reserva);
                if ($resultado_reserva) {
                echo '<h3 class="bien">¡Formulario ingresado correctamente!</h3>';
                } else {
                echo '<h3 class="mal">¡Error al insertar la reserva!</h3>';
                }
                } else {
                echo '<h3 class="mal">¡Error al insertar el vuelo!</h3>';
                }
                } else {
                echo '<h3 class="mal">¡Error al insertar el hotel!</h3>';
                }
            } else {
            echo '<h3 class="mal">¡Por favor complete todos los campos!</h3>';
            }
        ?>
    </body>
</html>