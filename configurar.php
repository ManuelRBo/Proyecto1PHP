<?php
include 'funciones.php';
session_start();
$error = "";
if(isset($_POST['configurar'])){
    if($_POST['configurar'] === "actualizar"){
        if($_POST['numeroTarjetas'] !== "" && intval($_POST['numeroTarjetas']) % 2 === 0){
            header('Location: tarjetas.php');
        }else{
            $error = '0';
        }
    }else if($_POST['configurar'] === "reiniciar"){
        header('Location: tarjetas.php?reinicar=1');
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagina3.css">
    <title>Memory</title>
</head>
<body>
    <div class="contenedor">
        <h1>Memory</h1>
        <h2 style="text-align: center; margin-bottom: 10px ;">Configurar Juego</h2>
        <form action="configurar.php" method="post">
            <div class="entrada">
                <input type="number" name="numeroTarjetas" id="numeroTarjetas">
                <label for="numeroTarjetas">Número de tarjetas</label>
            </div>
            <button name="configurar" value="actualizar">Actualizar</button>
            <button name="configurar" value="reiniciar">Reiniciar</button>
        </form>
            <?php
                if($error === '0'){
                    echo '
                    <p class="error">Rellena el campo con un número par</p>';
                }
            ?>
    </div>
</body>
</html>