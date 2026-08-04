<?php
//created by Henry
//Inicializar Datos Parcial Alcance
//7-1-2021
try{

    if(@@tri_bandera_alcance == 'ALCANCE' || @@tri_bandera_parcial == 'true'){
        @@tri_imp_monto_estimado = @@imp_monto_estimado;
        @@tri_imp_monto_pagado = @@imp_monto_pagado;
        @@frm_monto_liquidar =  @@imp_monto_pagado;
    }
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
