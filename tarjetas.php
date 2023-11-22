<?php
    session_start();
    var_dump(intval($_POST['numeroTarjetas']));
    if($_POST['numeroTarjetas'] !== "" && intval($_POST['numeroTarjetas'])%2 === 0){
        $_SESSION['numeroTarjetas'] = $_POST['numeroTarjetas'];
    }else{
        header('Location: index.php?error=1');
    }


?>


<!DOCTYPE html>
<html lang="en">

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
            <p>Tarjetas elegidas: 60</p>
        </div>
        <form class="formulario-header" action="">
            <div class="entrada">
                <button type="submit" name="header" value="nuevaPartida">Nueva Partida</button>
                <button type="submit" name="header" value="numeroDibujos">Cambiar Numero Dibujos</button>
            </div>
        </form>
            <div class="contenedor-tarjetas">
                <div class="contenedorTarj">
                    <?php
                    for ($i = 0; $i < 60; $i++) {
                        echo '<div class="tarjeta"></div>';
                    }
                    ?>
                </div>
            </div>
    </div>
</body>

</html>