<?php
//created by Henry Bautista
//18-11-2019
//insercion en la tabla errores

$cnx = "1479570925ec29f1d8d1d57019959618";
$app_uid =  @@APPLICATION;
$app_number = @@APP_NUMBER;
$app_status =  @@frm_accion;
$task = @@TASK;
$index = @@INDEX;

//tabla de errores
if(!empty(@=chk_errores)){
	foreach(@@chk_errores as $rowo){
		$sql_d = "INSERT INTO VV_ERRORES (
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