<?php

echo 'reaseguros';

//TRIGGER PARA ENVIAR CORREO A REASEGUROS CUANDO LLEGA UN NUEVO CASO
echo "<br> TIPO : " . @@frm_ac_Operacion;
echo "<br> IDPV : " . @@frm_idpv;
$bandera_reaseguros = @@tri_bandera_enviado_reaseguros;
if ($bandera_reaseguros == 1) {
	echo "<br> Ya se envio correo a reaseguros";
	return;
}

$bandera_correo_enviado = @@tri_correo_enviado_reaseguros;

if ($bandera_correo_enviado == 1) {
	echo "<br> Ya se envio correo a reaseguros";
	return;
}

$correos = array();
$datos_coaseguros = array();
echo "<br> ID : " . @@frm_id;

$datos_coaseguros = @@frm_companias_coaseguradas;

print_r($datos_coaseguros);
$emails = @@tri_destinatarios_copias_cc;
$emails .= ',';
/*$frm_companias_coaseguradas[$i] = [
                'frm_compania' => $codCia,
                //'frm_compania_label' => $compania_label,
                'frm_porcentajePrima' => number_format(round($pjePrimaTotal, 2, PHP_ROUND_HALF_UP), 2, '.', '')
            ];*/

$mail_analista = @@mail_analista;

foreach ($datos_coaseguros as $compania) {
	//$sql_compania = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
	//      WHERE COD_CATALOGO = 'COASEGURADORES' AND CODIGO = '$codCia'";
	$sql_compania = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
			WHERE COD_CATALOGO = 'COASEGURADORES' AND CODIGO = '" . $compania['frm_compania'] . "'";
	$rs_compania = executeQuery($sql_compania);

	$email_compania = $rs_compania[1]['INTEGRACION'];
	$correos[] = $email_compania;
	$emails .= $email_compania . ',';
}

$emails .= $mail_analista;
//REEMPLAZAR ; POR , SIEMPRE QUE SE ENCUENTRE
$emails = str_replace(';', ',', $emails);

//AÑADIR CORREO ANALISTA
$usr = PMFInformationUser(@@tri_usr_analista);
$emails .= ',' . $usr['mail'] . ',';
$usr = PMFInformationUser(@@tri_usr_reaseguros);
$emails .= $usr['mail'];

//ENVIO DE EMAIL
$numCaso = @@APP_NUMBER;
//get email from @@tri_usr_reaseguros

$de = '';
$para = $emails;
@@emails_reaseguros = $emails;
$bcc = @@tri_destinatarios_copias_bcc;
$asunto = "Notificación de Siniestro - Equisuiza - Caso BPM " . @#APP_NUMBER;

$plantilla_rec = 'Mail_Coaseguro.html';
@@envio_mail = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());

//GRABAR EN BITACORA CON FECHA DE ENVIO Y CORREOS
$cnx = '934957180650c74e8ed0e10096114321';
$app_uid   = @@APPLICATION;
$task_uid  = @@TASK;
$del_index           = @@INDEX;
$del_index_siguiente = @@INDEX + 1;
$cod_negativa = 0;
@@frm_accion_aux  = @@frm_accion;

$sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND (DEL_INDEX = '$del_index' OR DEL_INDEX = '$del_index_siguiente' ) ORDER BY DEL_INDEX";
$rs  = executeQuery($sql);
$rs_actual    = $rs['1'];
$rs_siguiente = $rs['2'];

$ticket 			 = @@APP_NUMBER;
$usr_uid_actual      = @@USER_LOGGED;

$fecha_inicio        = date('Y-m-d H:i:s');
$fecha_fin           = date('Y-m-d H:i:s');
$fecha_vencimiento   = date('Y-m-d H:i:s');
$fecha_derivacion    = date('Y-m-d H:i:s');

$usr_uid_receptor    = '';
$tas_uid_actual    = '';
$tarea_actual    = 'Envio de correo a reaseguros';
@@tri_correo_enviado_reaseguros = 1;
$comentario = 'Se ha enviado correo a reaseguros con los correos: ' . $emails;
$accion     = 'ENVIO_CORREO';
$accion_label     = 'Envio de correo a reaseguros';

$sql = "INSERT INTO certificacion.SINIESTRO_GN_BITACORA (
	APP_NUMBER,
	APP_UID,
	TASK_UID,
	FECHA_INICIO,
	FECHA_FIN,
	FECHA_DERIVACION,
	FECHA_VENCIMIENTO,
	DEL_INDEX,
	COD_ACCION,
	USR_UID_ACTUAL,
	USR_UID_RECEPTOR,
	COMENTARIO, ACCION, COD_NEGATIVA, COD_ESTADO)
	  values('$ticket', '$app_uid', '$task_uid', '$fecha_inicio', '$fecha_fin', '$fecha_derivacion', '$fecha_vencimiento', '$del_index', '$accion', '$usr_uid_actual', '$usr_uid_receptor', UPPER('$comentario'),'$accion_label', '$cod_negativa','$cod_estado')";
@@tmp_sql_com = $sql;
$rs_i = executeQuery($sql);

@@tri_bandera_enviado_reaseguros = 1;

/*echo
//ENVIO DE EMAIL
$numCaso = @@APP_NUMBER;
//get email from @@tri_usr_reaseguros
$usr = PMFInformationUser(@@tri_usr_reaseguros);
@@correo_reas = $usr;

$para = $usr['mail'];

$bcc='';
$asunto = "Notificación de SINIESTRO ". @#APP_NUMBER;

if(@@frm_accion == 'CONTINUAR_IP')
{
    $texto = 'Se le notifica que el ajustador ha subido el informe preliminar del siniestro '.$numCaso;
	$plantilla_rec = 'Plantilla_mail.html';
	@@envio_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_texto_mail' => $texto));
} else if(@@frm_accion == 'CONTINUAR_IF'){
    $texto = 'Se le notifica que el ajustador ha subido el informe final del siniestro '.$numCaso;
	$plantilla_rec = 'Plantilla_mail.html';
	@@envio_mail = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_texto_mail' => $texto));
}
*/


/*echo ("Correo enviado a: ".$para);
echo (@@envio_mail);
die();*/
