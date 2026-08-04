<?php
//created by Henry modified by Jean

$cnx = '719639371656bac7d35dba6039344904';
$app_uid = @@APPLICATION;
$app_uid_padre = @@app_uid_padre;

$sql = "SELECT TASK_UID AS tarea,
  USR_UID_ACTUAL AS usuario,
  FECHA_DERIVACION AS f_tranferencia,
  FECHA_INICIO AS f_inicio,
  FECHA_FIN AS f_fin,
  ACCION AS accion,
  COMENTARIO AS txt_comentario
FROM  SINIESTRO_VH_BITACORA_LEGAL WHERE APP_UID = '$app_uid' order by ID_BITACORA";

$sql2 = "SELECT TASK_UID AS tarea,
  USR_UID_ACTUAL AS usuario,
  FECHA_DERIVACION AS f_tranferencia,
  FECHA_INICIO AS f_inicio,
  FECHA_FIN AS f_fin,
  ACCION AS accion,
  COMENTARIO AS txt_comentario
FROM  SINIESTRO_VH_BITACORA WHERE APP_UID = '$app_uid_padre' order by ID_BITACORA";

$limit = @@limite_historial_antiguo;


$rs_comentarios = executeQuery($sql);
$rs_comentarios2 = executeQuery($sql2);

$grd_historial = array();
$i=1;
foreach($rs_comentarios2 as $data){
	$grd_historial[$i]['tarea'] = PMFGetTaskName($data['tarea'],'es');
	$grd_historial[$i]['usuario'] = NomUsuario($data['usuario']);
	$grd_historial[$i]['f_tranferencia'] = $data['f_tranferencia'];
	$grd_historial[$i]['f_inicio'] = $data['f_inicio'];
	$grd_historial[$i]['f_fin'] = $data['f_fin'];
	$grd_historial[$i]['accion'] = $data['accion'];
	$grd_historial[$i]['txt_comentario'] = $data['txt_comentario'];
	$i++;
	$aux_comentarios_padre++;
	if($aux_comentarios_padre == $limit){
		break;
	}
}

foreach($rs_comentarios as $data){
	$grd_historial[$i]['tarea'] = PMFGetTaskName($data['tarea'],'es');
	$grd_historial[$i]['usuario'] = NomUsuario($data['usuario']);
	$grd_historial[$i]['f_tranferencia'] = $data['f_tranferencia'];
	$grd_historial[$i]['f_inicio'] = $data['f_inicio'];
	$grd_historial[$i]['f_fin'] = $data['f_fin'];
	$grd_historial[$i]['accion'] = $data['accion'];
	$grd_historial[$i]['txt_comentario'] = $data['txt_comentario'];
	$i++;
}


//@=grd_historial_caso = $grd_historial;


//$grd_historial = array();
$aux_comentarios_padre = 1;




if($limit == null){
	//echo "entro";
	@@limite_historial_antiguo = $aux_comentarios_padre;
	//echo(@@limite_historial_antiguo);
	//die();
}


@=grd_historial_caso = $grd_historial;

$case_id=@@APPLICATION;
$aVars = array(
     'grd_historial_caso' => $grd_historial);

$result = PMFSendVariables($case_id, $aVars);
