<?php
//revisar si accion == CIERRE
$accion = @@frm_accion;

if ($accion == 'CIERRE') {
    //cerrar otros hilos
    $app_number = @@APP_NUMBER;
    $task = @@TASK;
    $task_2 = '34516342167bd7310e084f9017892236';

	$sql_hilos = "UPDATE 
    APP_DELEGATION 
    SET DEL_THREAD_STATUS = 'CLOSED', 
    DEL_FINISH_DATE = NOW()
    WHERE APP_NUMBER = '$app_number' 
    AND DEL_THREAD_STATUS = 'OPEN'
    AND TAS_UID != '$task'
    AND TAS_UID != '$task_2'
    AND DEL_FINISH_DATE IS NULL";
 
    $rs = executeQuery($sql_hilos);

    echo $sql_hilos;
    echo ' - Hilos cerrados';
	sleep(15);
    $sql_hilos = "UPDATE 
    APPLICATION
    SET APP_STATUS = 'COMPLETED', 
    APP_STATUS_ID = 3,
    APP_FINISH_DATE = NOW()
    WHERE APP_NUMBER = '$app_number' ";
    $rs = executeQuery($sql_hilos);
    
}