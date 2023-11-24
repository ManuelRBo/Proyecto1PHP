<?php
/**
 * Esta pagina se mostrara una vez que se gane
 * @author Manuel Rodrigo Borriño
 */

    //Recuperaremos la sesion para mostrar el numero de jugadas
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
        <!-- Aqui mostramos el numero de jugadas -->
        <h3>Has realizado <?php echo $_SESSION['numeroJugadas'] ?> jugadas</h3>
        <!-- Al pulsar en reinicar nos enviara a index.php -->
        <form action="index.php" method="post">
            <button>Reiniciar</button>
        </form>
    </div>
</body>
</html>