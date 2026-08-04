<?php
//created by Henry
//11-01-2021
//Guardar Estado de Siniestro
try{
    $cnx = '11264850561d723f004d5c2072943786';

    $app_uid   = @@APPLICATION;
    $task_uid  = @@TASK;
    $ticket 			 = @@APP_NUMBER;
    $usr_uid_pda      = @@USER_LOGGED;

    if(@@frm_accion == 'PARCIAL'){
        $estado_evento = 8;
        $estado = 7; //pago parcial
        @@tri_estado_evento = $estado_evento;
        @@tri_estado_siniestro = $estado;
    }else{
        $estado_evento = @@cod_estado_evento;
        $estado = @@cod_estado_siniestro;
        @@tri_estado_evento = $estado_evento;
        @@tri_estado_siniestro = $estado;
    }

    $imp_monto_estimado = @@imp_monto_estimado;
    $imp_monto_pagado = @@imp_monto_pagado;
    $cod_estado_evento = @@cod_estado_evento;
    $cod_estado_siniestro = @@cod_estado_siniestro;
    $id_cns_stro_estado = @@id_cns_stro_estado;

    $sql = "UPDATE SINIESTRO_ESTADO SET estado_evento = '$estado_evento', imp_monto_estimado = '$imp_monto_estimado', imp_monto_pagado = '$imp_monto_pagado', cod_estado_evento = '$cod_estado_evento', cod_estado_siniestro = '$cod_estado_siniestro', id_cns_stro_estado = '$id_cns_stro_estado' WHERE APP_UID = '$app_uid'";

    $rs = executeQuery($sql, $cnx);

    $sql_u = "UPDATE SINIESTRO_REGISTRADO SET estado = '$estado' WHERE APP_UID = '$app_uid'";
    $rs_u = executeQuery($sql_u, $cnx);

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
