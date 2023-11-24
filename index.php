<?php
/**
 * Esta pagina realiza la funcion de la pagina principal donde se encuentra el formulario donde se ingresa el numero de tarjetas para jugar
 * @author Manuel Rodrigo Borriño
 */

    // Recuperamos la sesion y la destruimos cuando volvemos desde la pagina ganar.php
    session_start();
    session_destroy();

    // Si hay un error en la URL nos lo guarda en la variable y sino guarda vacio
    $error = $_GET['error'] ?? '';
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
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
            <?php

            //En el caso de que el error sea 0 nos muestra un mensaje de error
                if($error === '0'){
                    echo '
                    <p class="error">Rellena el campo con un número par</p>';
                }
            ?>
    </div>
</body>
</html>