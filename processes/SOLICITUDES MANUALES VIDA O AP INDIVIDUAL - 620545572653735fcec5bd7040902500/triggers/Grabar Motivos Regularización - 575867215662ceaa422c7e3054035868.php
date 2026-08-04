<?php
//created by Henry Bautista
//27-04-2024
//insercion en la tabla errores

$cnx = "98304643465452bb4b4f927027857546";
$app_uid =  @@APPLICATION;
$app_number = @@APP_NUMBER;
$app_status =  @@frm_accion;
$task = @@TASK;
$index = @@INDEX;

//tabla de errores
if(!empty(@=chk_motivos)){
	foreach(@@chk_motivos as $rowo){
		$sql_d = "INSERT INTO certificacion.EMISIONES_NUEVAS_AP_ERRORES (
			  APP_UID,
			  APP_NUMBER,
			  APP_STATUS,
			  COD_ERROR,
			  ERROR,
			  INDX,
			  TASK
	)
	VALUES
	  (
		'$app_uid',
		'$app_number',
		'$app_status',
		'$rowo',
		'$rowo',
		'$index',
		'$task'
	  )";
	$rs_d = executeQuery($sql_d,$cnx);
	}
}
