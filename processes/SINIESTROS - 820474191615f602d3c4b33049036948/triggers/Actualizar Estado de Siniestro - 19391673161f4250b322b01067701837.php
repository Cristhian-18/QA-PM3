<?php
try{

    $cnx = '11264850561d723f004d5c2072943786';

    $app_uid   = @@APPLICATION;
    $task_uid  = @@TASK;
    $ticket 			 = @@APP_NUMBER;
    $usr_uid_pda      = @@USER_LOGGED;

    $estado_evento = 7;
    @@tri_estado_evento = $estado_evento;
    $monto_estimado = @@frm_monto_reportado;
    $monto_pagado = @@frm_monto_liquidar;
    @@tri_monto_aprobado = @@frm_monto_liquidar;

    $sql = "UPDATE SINIESTRO_ESTADO SET estado_evento = '$estado_evento', usr_uid_pda = '$usr_uid_pda', monto_estimado = '$monto_estimado', monto_pagado = '$monto_pagado' WHERE APP_UID = '$app_uid'";

    $rs = executeQuery($sql, $cnx);

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

}

