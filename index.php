<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Productos</title>
</head>
<body>
    <h1>Registrar Producto</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br><br>
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" required>
        <br><br>
        <input type="submit" value="Registrar">
    </form>

    <?php
    // Configuración de conexión a la base de datos
    $servername = "localhost";
    $username = "tu_usuario"; // Reemplaza con tu usuario de MySQL
    $password = "tu_contraseña"; // Reemplaza con tu contraseña de MySQL
    $dbname = "exam_db";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Procesar formulario y guardar datos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        
        $sql = "INSERT INTO productos (nombre, precio) VALUES ('$nombre', '$precio')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p>Producto registrado exitosamente.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    // Mostrar datos registrados
    echo "<h2>Lista de Productos</h2>";
    $sql = "SELECT id, nombre, precio FROM productos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>ID: " . $row["id"]. " - Nombre: " . $row["nombre"]. " - Precio: $" . $row["precio"]. "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No hay productos registrados.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
