<?php
//<?
//created by Henry modified by Jean
print_r(@@grd_vehiculos_afectados);
unset(@@grd_vehiculos_afectados['accesorios']);

$pro_uid = '35087580064a18c9776b638006106795';
$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS' AND DESCRIPCION = 'COPIA_GENERICA' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
$destinatarios_copias = ',';
if(!empty($rs_mails_copias)){
	@@tri_destinatarios_copias_cc = ',';
	@@tri_destinatarios_copias_cc .= $rs_mails_copias[1]['CAMPO1'];
	$destinatarios_copias .= $rs_mails_copias[1]['CAMPO1'];
	@@tri_destinatarios_copias_bcc = ',';
	@@tri_destinatarios_copias_bcc .= $rs_mails_copias[1]['CAMPO2'];
	//CONCAT CAMPO2
	$destinatarios_copias .= ','.$rs_mails_copias[1]['CAMPO2'];
}

@@tri_destinatarios_copias = $destinatarios_copias;

$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS' AND DESCRIPCION = 'MUNDO_MOTRIZ' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
@@tri_destinatarios_copias_mundo_motriz_cc = ',';
@@tri_destinatarios_copias_mundo_motriz_cc .= $rs_mails_copias[1]['CAMPO1'];
$destinatarios_copias_mundo_motriz = ',';
$destinatarios_copias_mundo_motriz .= $rs_mails_copias[1]['CAMPO1'];
//CONCAT CAMPO2
@@tri_destinatarios_copias_mundo_motriz_bcc = ',';
@@tri_destinatarios_copias_mundo_motriz_bcc .= $rs_mails_copias[1]['CAMPO2'];
$destinatarios_copias_mundo_motriz .= ','.$rs_mails_copias[1]['CAMPO2'];
@@tri_destinatarios_copias_mundo_motriz = $destinatarios_copias_mundo_motriz;

$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS' AND DESCRIPCION = 'DESARROLLADOR' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
@@tri_correo_desarrollador_cc = ',';
if(!empty($rs_mails_copias)){
	@@tri_correo_desarrollador_cc .= $rs_mails_copias[1]['CAMPO1'];
}
@@tri_correo_desarrollador_bcc = ',';
if(!empty($rs_mails_copias)){
	@@tri_correo_desarrollador_bcc .= $rs_mails_copias[1]['CAMPO2'];
}

@@tri_bot_cliente = '90331897265bdbf82f35100009622465';
$sql_bot_cliente = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'BOT_CLIENTE'";
$rs_bot_cliente = executeQuery($sql_bot_cliente);
if(!empty($rs_bot_cliente)){
	@@tri_bot_cliente = $rs_bot_cliente['1']['USR_UID'];
} else {
	@@tri_bot_cliente = '90331897265bdbf82f35100009622465';
}

$newCaseId = @@app_uid_rc;
$c = new Cases();
$aCase = $c->loadCase($newCaseId);


@@frm_busqueda_datosBroker_Id = $aCase['APP_DATA']['frm_busqueda_datosBroker_Id'] ? $aCase['APP_DATA']['frm_busqueda_datosBroker_Id'] : '';
@@frm_codTipoAgente = $aCase['APP_DATA']['frm_codTipoAgente'] ? $aCase['APP_DATA']['frm_codTipoAgente'] : '';
@@frm_codAgente = $aCase['APP_DATA']['frm_codAgente'] ? $aCase['APP_DATA']['frm_codAgente'] : '';

$analista = @@tri_usr_analista;

if($analista == '95282121465bdc1213b5351076915024'){
	@@tri_usr_analista = "289826748664bb06d8b1a82010029742";
	/*echo "caso reasignado";
	die();*/
}

$analista_negativas = @@frm_emisionNegativa_jefatura;
if(@@frm_emisionNegativa_jefatura == '23731403865bdbfaf88b4b1029849752'
|| @@frm_emisionNegativa_jefatura == ''
|| @@frm_emisionNegativa_jefatura == 'mmatute@segurosequinoccial.com'
||  @@frm_emisionNegativa_jefatura == 'fibarra@segurosequinoccial.com'){
	@@frm_emisionNegativa_jefatura = "69530880965be3fb9140bc8043898088";
}


$cnx = '934957180650c74e8ed0e10096114321';
$app_uid = @@APPLICATION;
$app_uid_padre = @@app_uid_rc;
$sql = "SELECT ID_BITACORA,
  TASK_UID AS tarea,
  USR_UID_ACTUAL AS usuario,
  FECHA_DERIVACION AS f_tranferencia,
  FECHA_INICIO AS f_inicio,
  FECHA_FIN AS f_fin,
  ACCION AS accion,
  COMENTARIO AS txt_comentario
FROM  SINIESTRO_VH_BITACORA WHERE APP_UID = '$app_uid' order by ID_BITACORA";

$rs_comentarios = executeQuery($sql);
//get first id in array
$last_id = 0;
foreach($rs_comentarios as $data){
	$last_id = $data['ID_BITACORA'];
	break;
}



$sql2 = "SELECT TASK_UID AS tarea,
  USR_UID_ACTUAL AS usuario,
  FECHA_DERIVACION AS f_tranferencia,
  FECHA_INICIO AS f_inicio,
  FECHA_FIN AS f_fin,
  ACCION AS accion,
  COMENTARIO AS txt_comentario
FROM  SINIESTRO_VH_BITACORA WHERE APP_UID = '$app_uid_padre' and
ID_BITACORA < $last_id
 order by ID_BITACORA";

$limit = @@limite_historial_antiguo;
if($limit>5){
	$limit = 5;
}
$rs_comentarios2 = executeQuery($sql2);
/*print_r($rs_comentarios2);
die();*/
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
	/*if($aux_comentarios_padre == $limit ||	$aux_comentarios_padre > 3){
		break;
	}*/
}

$grd_historial[$i]['tarea'] = "----";
	$grd_historial[$i]['usuario'] = "----";
	$grd_historial[$i]['f_tranferencia'] = "----";
	$grd_historial[$i]['f_inicio'] = "----";
	$grd_historial[$i]['f_fin'] = "----";
	$grd_historial[$i]['accion'] = "Creación del caso";
	$grd_historial[$i]['txt_comentario'] = "----";
	$i++;
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

$_SESSION['beesmartec'] = '/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/inf?id=365';
