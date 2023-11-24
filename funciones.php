<?php

function crearArrayAnimales(){
    $arrayAnimales = [];
    for($i = 128000; $i <= 128060; $i++){
        $arrayAnimales[] = "&#".$i.";";
    }
    return $arrayAnimales;
}

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

function tarjetaPulsada($arrayTarjetas, $i){
    return "<button class='botonesTarjetas' style='background-color: white; scale: 1.2;' name='pulsarTarjeta' value='" . $i . "'>
                " . $arrayTarjetas[$i][0] . "
            </button>";
}

function tarjetaNoPulsada($i){
    return "<button class='botonesTarjetas' name='pulsarTarjeta' value='" . $i . "'>
                &#10026;
            </button>";
}

function comprobarTarjetas($arrayTarjetas, $tarjeta1, $tarjeta2){
    if($arrayTarjetas[$tarjeta1][0] === $arrayTarjetas[$tarjeta2][0]){
        return true;
    }else{
        return false;
    }
}


function ganar($arrayTarjetas){
    foreach($arrayTarjetas as $key => $value){
        if($arrayTarjetas[$key][1] === "noPulsada"){
            return false;
        }
    }
    return true;
}