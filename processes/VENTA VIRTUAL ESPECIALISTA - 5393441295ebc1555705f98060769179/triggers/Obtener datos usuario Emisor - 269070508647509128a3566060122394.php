<?php
//created by Henry
//9-12-2020
//Obtener datos usuario Auditor monto superior

$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$process = @@PROCESS;

if(empty(@@tri_user_emisor)){
	//T13: Impresión de Póliza
	$task = '3132949705f983343dd1581097699310';
	$usr_emisor = UserCiclicoTarea_PR($task);
	@@tri_user_emisor = $usr_emisor;
}else{
	if(@@TASK == '4291645125f982d2bbc6a56093864701'){
		@@tri_user_emisor = @@USER_LOGGED;
	}
}
