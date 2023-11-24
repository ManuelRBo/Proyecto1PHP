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

if(!isset($_SESSION['arrayTarjetas'])){
    $arrayAnimales = crearArrayAnimales();
    $arrayTarjetas = crearArrayTarjetas($arrayAnimales, $_SESSION['numeroTarjetas']);
    $_SESSION['arrayTarjetas'] = $arrayTarjetas;
    $_SESSION['tarjeta1'] = [];
    $_SESSION['tarjeta2'] = [];
}


if (isset($_POST['pulsarTarjeta'])) {
    if ($_SESSION['tarjeta1'] === "") {
        $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
        array_push($_SESSION['tarjeta1'],$_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][0]);
        array_push($_SESSION['tarjeta1'][1],$_POST['pulsarTarjeta']);
    } elseif ($_SESSION['tarjeta2'] === "") {
        $_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][1] = "pulsada";
        array_push($_SESSION['tarjeta2'],$_SESSION['arrayTarjetas'][$_POST['pulsarTarjeta']][0]);
        array_push($_SESSION['tarjeta2'][1],$_POST['pulsarTarjeta']);
    

        if (comprobarTarjetas($_SESSION['arrayTarjetas'], $_SESSION['tarjeta1'], $_SESSION['tarjeta2'])) {
            $_SESSION['tarjeta1'] = "";
            $_SESSION['tarjeta2'] = "";
            $_SESSION['tarjeta3'] = "";
        } else {
            $indice1 = $_SESSION['tarjeta1'][1];
            $indice2 = $_SESSION['tarjeta2'][1];
            
            $_SESSION['arrayTarjetas'][$indice1][1] = "noPulsada";
            $_SESSION['arrayTarjetas'][$indice2][1] = "noPulsada";
            $_SESSION['tarjeta1'] = "";
            $_SESSION['tarjeta2'] = "";
        }
    }
}




// echo "<pre>";
// var_dump($_SESSION['tarjeta1']);
// var_dump($_SESSION['tarjeta2']);
// var_dump($_SESSION['arrayTarjetas']);
// echo "</pre>";
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagina2.css">
    <title>Memory</title>

</head>

<body>
    <div class="contenedor">
        <div class="header">
            <h1>Memory</h1>
            <p>Tarjetas elegidas: <?php echo $_SESSION['numeroTarjetas'] ?></p>
        </div>
        <form class="formulario-header" action="">
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