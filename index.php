<?php
 $error = $_GET['error'] ?? '';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagina1.css">
    <title>Memory</title>
</head>
<body>
    <div class="contenedor">
        <h1>Memory</h1>
        <form action="tarjetas.php" method="post">
            <div class="entrada">
                <input type="number" name="numeroTarjetas" id="numeroTarjetas">
                <label for="numeroTarjetas">Número de tarjetas</label>
            </div>
            <button>Comenzar Juego</button>
        </form>
    </div>
</body>
</html>