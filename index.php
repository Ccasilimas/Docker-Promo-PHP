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

// Verificar si se obtuvieron resultados
if ($result === FALSE) {
    die("Error en la consulta: " . $conn->error);
}

// Obtener la lista de tiendas y productos
$Tiendas = [];
$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Tiendas[$row["Tienda"]] = true;
        $productos[] = $row;
    }
}

// Filtrar productos si se proporciona una búsqueda
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
if ($search_query !== '') {
    $productos = array_filter($productos, function($producto) use ($search_query) {
        return stripos($producto["product_name"], $search_query) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promociones</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="bg-success text-white text-center py-4">
        <h1>Promociones</h1>
    </header>
    <div class="container mt-4">
        <div class="row">
            <!-- Menú lateral -->
            <div class="col-md-3">
                <h4>Tiendas</h4>
                <div class="btn-group-vertical w-100" role="group" aria-label="Tiendas">
                    <button type="button" class="btn btn-success" onclick="showPromociones('')">Todas las Tiendas</button>
                    <?php
                    foreach ($Tiendas as $Tienda => $dummy) {
                        echo '<button type="button" class="btn btn-success" onclick="showPromociones(\'' . htmlspecialchars($Tienda) . '\')">' . htmlspecialchars($Tienda) . '</button>';
                    }
                    ?>
                </div>
                <h4 class="mt-4">Buscar Productos</h4>
                <form method="get" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar productos" name="search" value="<?php echo htmlspecialchars($search_query); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Contenido principal -->
            <div class="col-md-9">
                <div class="row">
                    <?php
                    if (count($productos) > 0) {
                        foreach ($productos as $producto) {
                            echo '<div class="col-md-4 mb-4 Tienda-promociones ' . htmlspecialchars($producto["Tienda"]) . '">';
                            echo '<div class="card">';
                            echo '<img src="' . htmlspecialchars($producto["img_url"]) . '" class="card-img-top" alt="' . htmlspecialchars($producto["product_name"]) . '">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . htmlspecialchars($producto["product_name"]) . '</h5>';
                            echo '<p class="card-text"><del>Precio anterior: ' . htmlspecialchars($producto["old_price"]) . '</del></p>';
                            echo '<p class="card-text text-danger font-weight-bold">Precio actual: ' . htmlspecialchars($producto["price"]) . '</p>';
                            echo '<p class="card-text bg-success text-white p-2 rounded">Descuento: ' . htmlspecialchars($producto["discount"]) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No hay promociones disponibles.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showPromociones(tienda) {
            var cards = document.getElementsByClassName('Tienda-promociones');
            for (var i = 0; i < cards.length; i++) {
                if (tienda === '' || cards[i].classList.contains(tienda)) {
                    cards[i].style.display = 'block';
                } else {
                    cards[i].style.display = 'none';
                }
            }
        }
    </script>
    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
