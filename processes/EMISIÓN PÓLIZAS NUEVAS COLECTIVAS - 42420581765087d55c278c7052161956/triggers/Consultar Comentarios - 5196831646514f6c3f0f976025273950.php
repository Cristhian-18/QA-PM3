<?php
$app_uid = @@APPLICATION;
$pro_uid = @@PROCESS;

//TICKET 12/3/2025

$responsable = @@frm_responsable_emision;
if($responsable == 'amestanza' || $responsable == '00000000000000000000000000000001' || $responsable == '563630101656d370ecdd212058604221'){
	@@frm_responsable_emision = '231322641656d36754fd036030669346';
}

$cnx = '6897140966514f7293404b5050866175';

$sql = "SELECT TASK_UID AS tarea,
  USR_UID_ACTUAL AS usuario,
  FECHA_DERIVACION AS f_tranferencia,
  FECHA_INICIO AS f_inicio,
  FECHA_FIN AS f_fin,
  ACCION AS accion,
  COMENTARIO AS txt_comentario
FROM certificacion.EMISIONES_NUEVAS_BITACORA WHERE APP_UID = '$app_uid' ORDER BY ID_BITACORA";

$rs_comentarios = executeQuery($sql);

try{

$grd_historial = array();
$i=1;

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

@=grd_historial_caso = $grd_historial;

$case_id=@@APPLICATION;
$aVars = array(
     'grd_historial_caso' => $grd_historial);

$result = PMFSendVariables($case_id, $aVars);
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
	die();
}
