<?php
$banderaMundo = "0";

if(stripos(@@frm_taller, "MUNDO MOTRIZ") !== false){
    $banderaMundo = "1";
    $suma = 0;
    @@frm_alcanceAdicional_valorManoAprobado = @@frm_alcanceAdicional_valorMano;
    @@tri_bandera_alcance = "1";
}

 