<?php
/**
 * En esta pagina se encuentran las funciones principales
 * @author Manuel Rodrigo Borriño
 */

/**
 * Esta funcion creara el array con los 60 animales
 * @return arrayAnimales[] : array de los 60 animales
 */
function crearArrayAnimales(){
    $arrayAnimales = [];
    for($i = 128000; $i <= 128060; $i++){
        $arrayAnimales[] = "&#".$i.";";
    }
    return $arrayAnimales;
}


/**
 * Creara el array de todos los animales con el tamaño del numero de tarjetas que le pasemos, por cada animal habra una pareja
 * @param numeroTarjetas : numero de tarjetas que elija el jugador
 * @return arrayTarjetas[] : array con todas lass parejas de animales y que cada una este en no pulsada
 */
function crearArrayTarjetas($numeroTarjetas){
    $arrayAnimales = crearArrayAnimales();
    shuffle($arrayAnimales);
    $arrayTarjetas = [];
    for($i = 0; $i < $numeroTarjetas/2; $i++){
        $arrayTarjetas[] = [$arrayAnimales[$i], "noPulsada"];
        $arrayTarjetas[] = [$arrayAnimales[$i], "noPulsada"];

    }
    shuffle($arrayTarjetas);
    return $arrayTarjetas;
}

/**
 * Esta funcion devulve un elemento html con la tarjeta y el dibujo cuando pinchemos sobre ella
 * 
 * @param arrayTarjetas[] : variable de sesion que contiene todas las tarjetas con los animales
 * @param i : variable del numero de tarjeta que es
 * @return button : retorna un boton junto con el dibujo del animal
 */
function tarjetaPulsada($arrayTarjetas, $i){
    return "<button class='botonesTarjetas' style='background-color: white; scale: 1.2;' name='pulsarTarjeta' value='" . $i . "'>
                " . $arrayTarjetas[$i][0] . "
            </button>";
}

/**
 * Esta funcion devulve un elemento html con la tarjeta y el dibujo cuando no este pinchada
 * 
 * @param i : variable del numero de tarjeta que es
 * @return button : retorna un boton junto con el dibujo del dorso de la tarjeta
 */
function tarjetaNoPulsada($i){
    return "<button class='botonesTarjetas' name='pulsarTarjeta' value='" . $i . "'>
                &#10026;
            </button>";
}

/**
 * Esta funcion realiza la funcion de comprobar que lass tarjetas sean o no iguales
 *  
 * @param arrayTarjetas[] : variable de sesion que contiene todas las tarjetas con los animales
 * @param tarjeta1 : posicion de la tarjeta 1 pinchada dentro del array
 * @param tarjeta2 : posicion de la tarjeta 2 pinchada dentro del array
 * @return true : si la tarjetas son iguales
 * @return false : si no son iguales
 */
function comprobarTarjetas($arrayTarjetas, $tarjeta1, $tarjeta2){
    if($arrayTarjetas[$tarjeta1][0] === $arrayTarjetas[$tarjeta2][0]){
        return true;
    }else{
        return false;
    }
}

/**
 * Esta funcion comprueba que todas las tarjetas esten pulsadas
 * 
 * @param arrayTarjetas[] : variable de sesion que contiene todas las tarjetas con los animales
 * @return true : si todas estan pulsadas
 * @return false : si hay alguna que no este pulsada
 */
function ganar($arrayTarjetas){
    foreach($arrayTarjetas as $key => $value){
        if($arrayTarjetas[$key][1] === "noPulsada"){
            return false;
        }
    }
    return true;
}