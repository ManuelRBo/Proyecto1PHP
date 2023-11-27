<?php

/**
 * Esta pagina maneja el funcionamiento principal del juego, pinchar tarjetas, mostrarlas, redirigirnos en caso de error, etc.
 * @author Manuel Rodrigo Borriño
 */


//Incluimos el archivo funciones.php e iniciamos una sesion
include 'funciones.php';
session_start();

//Comprobamos que exista el numero de tarjetas en POST
if (isset($_POST['numeroTarjetas'])) {
    //Si existe, comprbamos que no este vacio y que no sea impar ya que al ser aprejas tienen que ser tarjetas pares
    if ($_POST['numeroTarjetas'] !== "" && intval($_POST['numeroTarjetas']) % 2 === 0 && intval($_POST['numeroTarjetas']) > 1 && intval($_POST['numeroTarjetas']) < 62) {
        //Lo añadimos a la sesion si es correcta la comprobacion
        $_SESSION['numeroTarjetas'] = $_POST['numeroTarjetas'];
    } else {
        //Si no destruimos la sesion y redirigimos a index.php con el mensaje de error en la URL
        session_destroy();
        header('Location: index.php?error=0');
    }
}

//Al comenzar la partida si no existe en la sesion el array de tarjetas, lo iniciamos junto con todas las variables de sesion
if (!isset($_SESSION['arrayTarjetas'])) {
    $arrayTarjetas = crearArrayTarjetas($_SESSION['numeroTarjetas']);
    $_SESSION['arrayTarjetas'] = $arrayTarjetas;
    $_SESSION['tarjeta1'] = "";
    $_SESSION['tarjeta2'] = "";
    $_SESSION['numeroJugadas'] = 0;
}

//Aqui comprobamos hemos pinchado en los botones de nueva partida o cambiar numero de dibujos
if (isset($_POST['header'])) {
    //Si existe, vamos a comprobar cual boton pinchamos
    if ($_POST['header'] === "nuevaPartida") {
        //Si es nueva partida, creamos un nuevo array y reseteamos todas las variables
        $_SESSION['arrayTarjetas'] = crearArrayTarjetas($_SESSION['numeroTarjetas']);
        $_SESSION['tarjeta1'] = "";
        $_SESSION['tarjeta2'] = "";
        shuffle($_SESSION['arrayTarjetas']);
        $_SESSION['numeroJugadas'] = 0;
        //Si pinchamos en cambiar numero de dibujos, redirigimos a la pagina configurar.php
    } else if ($_POST['header'] === "numeroDibujos") {
        header('Location: configurar.php');
    }

    //Esta comprobacion se hara desde la pagina configurar en caso de que queramos solo reiniciar el juego
} elseif (isset($_GET['reinicar'])) {
    //Si existe reiniciar en la URL crearemos un array y reiniciaremos todas las variables
    $_SESSION['arrayTarjetas'] = crearArrayTarjetas($_SESSION['numeroTarjetas']);
    $_SESSION['tarjeta1'] = "";
    $_SESSION['tarjeta2'] = "";
    shuffle($_SESSION['arrayTarjetas']);
    $_SESSION['numeroJugadas'] = 0;
}

//Esta comprobacion se realizara cada vez que se pulse una tarjeta
if (isset($_POST['pulsarTarjeta'])) {
    if ($_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] !== "pulsada") {
        $_SESSION['cartaAnterior'] = $_POST['pulsarTarjeta'];
        //Si hemos pulsado una tarjeta, guardaremos la primera tarjeta pulsada en la variable de sesion, la marcaremos como pulsada y guadaremos su posicion
        if ($_SESSION['tarjeta1'] === "") {
            $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
            $_SESSION['tarjeta1'] = $_POST['pulsarTarjeta'];

            //Se haria lo mismo que con la segunda tarjeta pulsada, y en este caso sumaremos 1 al numero de jugadas
        } elseif ($_SESSION['tarjeta2'] === "") {
            $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
            $_SESSION['tarjeta2'] = $_POST['pulsarTarjeta'];
            $_SESSION['numeroJugadas'] += 1;

            //Cada vez que pulsemos la segunda tarjeta comprobaremos si se ha ganado, en caso de que todas esten pulsadas redirigiremos a ganar.php
            if (ganar($_SESSION['arrayTarjetas'])) {
                header('Location: ganar.php');
            }

            //En caso de que las variables de tarjeta 1 y 2 esten comprobaremos que ambas sean iguales al pulsar una tercera tarjeta
        } else {

            //Si son iguales pondremos guardaremos la tercera tarjeta en tarjeta 1 y se marcara como pulsada y reiniciamos tarjeta 2
            if (comprobarTarjetas($_SESSION['arrayTarjetas'], $_SESSION['tarjeta1'], $_SESSION['tarjeta2'])) {
                $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
                $_SESSION['tarjeta1'] = $_POST['pulsarTarjeta'];
                $_SESSION['tarjeta2'] = "";

                //Si no son iguales pondremos ambas tarjetas en no pulsada y pondremos la terera tarjeta en la tarjeta 1 y como pulsada y reiniciamos la tarjeta 2
            } else {
                $_SESSION['arrayTarjetas'][$_SESSION['tarjeta1']][1] = "noPulsada";
                $_SESSION['arrayTarjetas'][$_SESSION['tarjeta2']][1] = "noPulsada";
                $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
                $_SESSION['tarjeta1'] = $_POST['pulsarTarjeta'];
                $_SESSION['tarjeta2'] = "";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tarjetas.css">
    <title>Memory</title>

</head>

<body>
    <div class="contenedor">
        <div class="header">
            <h1>Memory</h1>
            <p>Tarjetas elegidas: <?php echo $_SESSION['numeroTarjetas'] ?></p>
            <p>Jugadas Realizadas: <?php echo (isset($_SESSION['numeroJugadas'])) ? $_SESSION['numeroJugadas'] : '0'; ?></p>
        </div>
        <form class="formulario-header" action="tarjetas.php" method="post">
            <div class="entrada">
                <button type="submit" name="header" value="nuevaPartida">Nueva Partida</button>
                <button type="submit" name="header" value="numeroDibujos">Cambiar Numero Dibujos</button>
            </div>
        </form>
        <div class="contenedor-tarjetas">
            <div class="contenedorTarj">
                <!-- Realizaremos el for para mostrar todas las tarjetas segun el numero que hayan introducido -->
                <?php for ($i = 0; $i < $_SESSION['numeroTarjetas']; $i++) : ?>
                    <div class='tarjeta'>
                        <form action="tarjetas.php" method="post">
                            <!-- Si la en el arrayTarjetas la tarjeta esta pulsada llamaremos a la funcion tarjetaPulsada para que aparezca el dibujo,
                                 si aparece como noPulsada se mostrara el dorso de la tarjeta -->
                            <?php if ($_SESSION['arrayTarjetas'][$i][1] === "pulsada") {
                                echo tarjetaPulsada($_SESSION['arrayTarjetas'], $i);
                            } else if ($_SESSION['arrayTarjetas'][$i][1] === "noPulsada") {
                                echo tarjetaNoPulsada($i);
                            }
                            ?>
                        </form>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</body>

</html>