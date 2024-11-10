<?php
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos
$sql = "SELECT * FROM promociones";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promociones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Promociones</h1>
    </header>
    <div class="promociones">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="promocion-item">';
                echo '<img src="' . htmlspecialchars($row["img_url"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '">';
                echo '<div class="promo-details">';
                echo '<h2>' . htmlspecialchars($row["product_name"]) . '</h2>';
                echo '<p>Tienda: ' . htmlspecialchars($row["tienda"]) . '</p>';
                echo '<p><del>Precio anterior: ' . htmlspecialchars($row["old_price"]) . '</del></p>';
                echo '<p class="price">Precio actual: ' . htmlspecialchars($row["price"]) . '</p>';
                echo '<p class="discount">Descuento: ' . htmlspecialchars($row["discount"]) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay promociones disponibles.</p>';
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
