<?php
//Cerrar hilos reaseguros
if(@@frm_ac_accion  == 'FINALIZAR'){
	$app_number = @@APP_NUMBER;
    $task = '2658432166555847bc41125032580507';
	$sql_hilos = "UPDATE 
    APP_DELEGATION 
    SET DEL_THREAD_STATUS = 'CLOSED'
    WHERE APP_NUMBER = '$app_number' 
    AND DEL_THREAD_STATUS = 'OPEN'
    AND TAS_UID != '$task'
    AND DEL_FINISH_DATE IS NULL";

    $rs = executeQuery($sql_hilos);

    echo $sql_hilos;
    echo ' - Hilos cerrados';

}

