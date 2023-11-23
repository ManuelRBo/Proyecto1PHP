<?php

function crearArrayAnimales(){
    $arrayAnimales = [];
    for($i = 128000; $i <= 128060; $i++){
        $arrayAnimales[] = "&#".$i.";";
    }
    return $arrayAnimales;
}

function crearArrayTarjetas($arrayAnimales, $numeroTarjetas){
    $arrayTarjetas = [];
    for($i = 0; $i < $numeroTarjetas/2; $i++){
        $arrayTarjetas[] = [$arrayAnimales[$i], "noPulsada"];
        $arrayTarjetas[] = [$arrayAnimales[$i], "noPulsada"];

    }
    shuffle($arrayTarjetas);
    return $arrayTarjetas;
}

function tarjetaPulsada($arrayTarjetas, $i){
    return "<button class='botonesTarjetas' style='background-color: white;' name='pulsarTarjeta' value='" . $i . "'>
                " . $arrayTarjetas[$i][0] . "
            </button>";
}

function tarjetaNoPulsada($i){
    return "<button class='botonesTarjetas' name='pulsarTarjeta' value='" . $i . "'>
                &#10026;
            </button>";
}