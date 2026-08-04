<?php
//created by Henry modified by Jean

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
print_r($rs_mails_copias);
@@tri_correo_desarrollador_cc = ',';
@@tri_correo_desarrollador_bcc= ',';

if(!empty($rs_mails_copias) && isset($rs_mails_copias[0])){
    // Verificar CAMPO1
    if(!empty($rs_mails_copias[0]['CAMPO1'])){
        @@tri_correo_desarrollador_cc = $rs_mails_copias[0]['CAMPO1'];
    }

    // Verificar CAMPO2
    if(!empty($rs_mails_copias[0]['CAMPO2'])){
        @@tri_correo_desarrollador_bcc= $rs_mails_copias[0]['CAMPO2'];
    }
}

$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS' AND DESCRIPCION = 'SALVAMENTOS' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
$destinatarios_copias = ',';
if(!empty($rs_mails_copias)){
	@@tri_destinatarios_salvamentos_cc = ',';
	@@tri_destinatarios_salvamentos_cc .= $rs_mails_copias[1]['CAMPO1'];
	$destinatarios_copias .= $rs_mails_copias[1]['CAMPO1'];
	@@tri_destinatarios_salvamentos_bcc = ',';
	@@tri_destinatarios_salvamentos_bcc .= $rs_mails_copias[1]['CAMPO2'];
	//CONCAT CAMPO2
	$destinatarios_copias .= ','.$rs_mails_copias[1]['CAMPO2'];
}

@@tri_destinatarios_salvamentos = $destinatarios_copias;

$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS' AND DESCRIPCION = 'LEGAL_SALVAMENTOS' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
$destinatarios_copias = ',';
if(!empty($rs_mails_copias)){
	@@tri_destinatarios_legal_salvamentos_cc = ',';
	@@tri_destinatarios_legal_salvamentos_cc .= $rs_mails_copias[1]['CAMPO1'];
	$destinatarios_copias .= $rs_mails_copias[1]['CAMPO1'];
	@@tri_destinatarios_legal_salvamentos_bcc = ',';
	@@tri_destinatarios_legal_salvamentos_bcc .= $rs_mails_copias[1]['CAMPO2'];
	//CONCAT CAMPO2
	$destinatarios_copias .= ','.$rs_mails_copias[1]['CAMPO2'];
}

@@tri_destinatarios_legal_salvamentos = $destinatarios_copias;


unset(@@grd_vehiculos_afectados['accesorios']);

if(@@nro_inspeccion != null && @@nro_inspeccion != '' ){
	@@tri_id_stro = @@nro_inspeccion. " - ". date("Y");
}
if(@@id_stro_insp != null && @@id_stro_insp != '' ){
	@@tri_nro_stro = @@id_stro_insp;
}
$cnx = '934957180650c74e8ed0e10096114321';
$app_uid = @@APPLICATION;
$app_uid_padre = @@app_padre;

$sql = "SELECT TASK_UID AS tarea,
  USR_UID_ACTUAL AS usuario,
  FECHA_DERIVACION AS f_tranferencia,
  FECHA_INICIO AS f_inicio,
  FECHA_FIN AS f_fin,
  ACCION AS accion,
  COMENTARIO AS txt_comentario
FROM certificacion.SINIESTRO_VH_BITACORA_TOTAL WHERE APP_UID = '$app_uid' order by ID_BITACORA";

$sql2 = "SELECT TASK_UID AS tarea,
  USR_UID_ACTUAL AS usuario,
  FECHA_DERIVACION AS f_tranferencia,
  FECHA_INICIO AS f_inicio,
  FECHA_FIN AS f_fin,
  ACCION AS accion,
  COMENTARIO AS txt_comentario
FROM certificacion.SINIESTRO_VH_BITACORA WHERE APP_UID = '$app_uid_padre' order by ID_BITACORA";

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
	/*$aux_comentarios_padre++;
	if($aux_comentarios_padre == $limit ||	$aux_comentarios_padre > 3){
		break;
	}*/
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

@=grd_historial_caso = $grd_historial;

$case_id=@@APPLICATION;
$aVars = array(
     'grd_historial_caso' => $grd_historial);

$result = PMFSendVariables($case_id, $aVars);

$_SESSION['beesmartec'] = '/syscertificacion/es/3sesa/beesmartec/services/siniestrosVeh/inf?id=365';
