<?php
//created by Henry Bautista
//20-08-2020
//Obtener historial de caso

$app = @@APPLICATION;

$sql = "SELECT TAS_UID, USR_UID, DEL_DELEGATE_DATE, DEL_INIT_DATE, DEL_FINISH_DATE, DEL_THREAD_STATUS FROM APP_DELEGATION WHERE APP_UID = '$app'";

$rs = executeQuery($sql);

$grd_historial = array();
$i=1;
foreach($rs as $data){
	//validacion por tarea
	switch($data['TAS_UID']){
		case '1628975415f95804f7cc8f1008580474':
			$comentario = @@frm_comentario;	
		break;
		default:
			$comentario = '--';		
		break;
	}
	$grd_historial[$i]['tarea'] = PMFGetTaskName($data['TAS_UID'],'es');
	$grd_historial[$i]['usuario'] = NomUsuario($data['USR_UID']);
	$grd_historial[$i]['f_tranferencia'] = $data['DEL_DELEGATE_DATE'];
	$grd_historial[$i]['f_inicio'] = $data['DEL_INIT_DATE'];
	$grd_historial[$i]['f_fin'] = $data['DEL_FINISH_DATE'];
	$grd_historial[$i]['accion'] = ($data['DEL_THREAD_STATUS'] == 'OPEN' ? 'En progreso' : 'derivado');
	$grd_historial[$i]['txt_comentario'] = $comentario;
	$i++;
}

@=grd_historial_caso = $grd_historial;