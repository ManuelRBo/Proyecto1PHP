<?php
include 'funciones.php';
session_start();
if (isset($_POST['numeroTarjetas'])) {
    if ($_POST['numeroTarjetas'] !== "" && intval($_POST['numeroTarjetas']) % 2 === 0) {
        $_SESSION['numeroTarjetas'] = $_POST['numeroTarjetas'];
    } else {
        session_destroy();
        header('Location: index.php?error=0');
    }
}

if (isset($_POST['header'])) {
    if ($_POST['header'] === "nuevaPartida") {
        $_SESSION['arrayTarjetas'] = crearArrayTarjetas($_SESSION['numeroTarjetas']);
        foreach ($_SESSION['arrayTarjetas'] as $key => $value) {
            $_SESSION['arrayTarjetas'][$key][1] = "noPulsada";
        }
        $_SESSION['tarjeta1'] = "";
        $_SESSION['tarjeta2'] = "";
        shuffle($_SESSION['arrayTarjetas']);
        $_SESSION['numeroJugadas'] = 0;
    } else if ($_POST['header'] === "numeroDibujos") {
        header('Location: configurar.php');
    }
}elseif(isset($_GET['reinicar'])){
    $_SESSION['arrayTarjetas'] = crearArrayTarjetas($_SESSION['numeroTarjetas']);
    foreach ($_SESSION['arrayTarjetas'] as $key => $value) {
        $_SESSION['arrayTarjetas'][$key][1] = "noPulsada";
    }
    $_SESSION['tarjeta1'] = "";
    $_SESSION['tarjeta2'] = "";
    shuffle($_SESSION['arrayTarjetas']);
    $_SESSION['numeroJugadas'] = 0;
}

if (!isset($_SESSION['arrayTarjetas'])) {
    $arrayAnimales = crearArrayAnimales();
    $arrayTarjetas = crearArrayTarjetas($_SESSION['numeroTarjetas']);
    $_SESSION['arrayTarjetas'] = $arrayTarjetas;
    $_SESSION['tarjeta1'] = "";
    $_SESSION['tarjeta2'] = "";
    $_SESSION['numeroJugadas'] = 0;
}


if (isset($_POST['pulsarTarjeta'])) {
    if ($_SESSION['tarjeta1'] === "") {
        $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
        $_SESSION['tarjeta1'] = $_POST['pulsarTarjeta'];
    } elseif ($_SESSION['tarjeta2'] === "") {
        $_SESSION['numeroJugadas'] += 1;
        $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
        $_SESSION['tarjeta2'] = $_POST['pulsarTarjeta'];
        if(ganar($_SESSION['arrayTarjetas'])){
            header('Location: ganar.php');
        }
    } else {
        if (comprobarTarjetas($_SESSION['arrayTarjetas'], $_SESSION['tarjeta1'], $_SESSION['tarjeta2'])) {
            $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
            $_SESSION['tarjeta1'] = $_POST['pulsarTarjeta'];
            $_SESSION['tarjeta2'] = "";
        } else {
            $_SESSION['arrayTarjetas'][$_SESSION['tarjeta1']][1] = "noPulsada";
            $_SESSION['arrayTarjetas'][$_SESSION['tarjeta2']][1] = "noPulsada";
            $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
            $_SESSION['tarjeta1'] = $_POST['pulsarTarjeta'];
            $_SESSION['tarjeta2'] = "";
        }
    }
}

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
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
            <p>Jugadas Realizadas: <?php echo (isset($_SESSION['numeroJugadas'])) ? $_SESSION['numeroJugadas'] : '0';?></p> 
        </div>
        <form class="formulario-header" action="tarjetas.php" method="post">
            <div class="entrada">
                <button type="submit" name="header" value="nuevaPartida">Nueva Partida</button>
                <button type="submit" name="header" value="numeroDibujos">Cambiar Numero Dibujos</button>
            </div>
        </form>
        <div class="contenedor-tarjetas">
            <div class="contenedorTarj">
                <?php for ($i = 0; $i < $_SESSION['numeroTarjetas']; $i++) : ?>
                    <div class='tarjeta'>
                        <form action="tarjetas.php" method="post">
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