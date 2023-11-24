<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ganar.css">
    <title>Ganar</title>
</head>
<body>
    <div class="contenedor">
        <h1>Memory</h1>
        <h2>¡Has ganado!</h2>
        <h3>Has realizado <?php echo $_SESSION['numeroJugadas'] ?> jugadas</h3>
        <form action="index.php" method="post">
            <button>Reiniciar</button>
        </form>
    </div>
</body>
</html>