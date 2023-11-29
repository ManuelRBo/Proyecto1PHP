<?php
/**
 * En esta pagina se encuentra la configuracion una vez empezado el juego para actualizar el numero de tarjetas o reiniciar el juego
 * @author Manuel Rodrigo Borriño
 */

//Recuperaremos la sesion, incluiremos las funciones e iniciaremos la variable errores
include 'funciones.php';
session_start();
$error = "";

//Comprobaremos que exista configurar en POST para actualizar el numero de tarjetas o reinicar
if(isset($_POST['configurar'])){
    //En caso de que pulsemos en actualizar, comprobaremos que no este vacio ni sea impar, entonces actualizaremos la variable de sesion
    //y crearemos el nuevo array para despues volver a tarjetas.php
    if($_POST['configurar'] === "actualizar"){
        if($_POST['numeroTarjetas'] !== "" && intval($_POST['numeroTarjetas']) > 1 && intval($_POST['numeroTarjetas']) < 62){
            $_SESSION['numeroTarjetas'] = intval($_POST['numeroTarjetas'])*2;
            $_SESSION['tarjeta1'] = "";
            $_SESSION['tarjeta2'] = "";
            $_SESSION['numeroJugadas'] = 0;
            $_SESSION['arrayTarjetas'] = crearArrayTarjetas($_SESSION['numeroTarjetas']);
            header('Location: tarjetas.php');
            //Si esta vacio o es impar la variable error sera cero
        }else{
            $error = '0';
        }
        //En el caso de que pulsemos en reiniciar mandaremos en la URL el mensaje a tarjetas.php
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
    <link rel="stylesheet" href="css/configurar.css">
    <title>Memory</title>
</head>
<body>
    <div class="contenedor">
        <h1>Memory</h1>
        <h2 style="text-align: center; margin-bottom: 10px ;">Configurar Juego</h2>
        <form action="configurar.php" method="post">
            <div class="entrada">
                <input type="number" name="numeroTarjetas" id="numeroTarjetas">
                <label for="numeroTarjetas">Número de dibujos</label>
            </div>
            <button name="configurar" value="actualizar">Actualizar</button>
            <button name="configurar" value="reiniciar">Reiniciar</button>
        </form>
        <!-- Si el error es 0 mostraremos el mensaje de error -->
            <?php
                if($error === '0'){
                    echo '
                    <p class="error">Rellena el campo con un número par entre 2 y 61</p>';
                }
            ?>
    </div>
</body>
</html>