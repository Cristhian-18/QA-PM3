<?php
//ENVIO DE EMAIL  @@tri_ruta_aprobacion== 'PENDIENTE' && @@tri_contador_rcs2  > 0 &&
//$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$cnx                   = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
$app_uid = @@APPLICATION;
//OBTENER mail del catalogo

$del_index_siguiente = @@INDEX+1;
@@frm_comentario_mail = @@frm_comentario;
$sql = "SELECT * FROM APP_DELEGATION WHERE APP_UID = '$app_uid' AND DEL_INDEX = '$del_index_siguiente' ORDER BY DEL_INDEX";
$rs  = executeQuery($sql);
$rs_siguiente = $rs['1'];
$usr_uid_receptor    = $rs_siguiente['USR_UID'];

$aUser = PMFInformationUser($usr_uid_receptor);
$para = $aUser['mail'];

@@tri_user_mail_suscriptor = $para;

if(@@frm_accion == 'FINALIZAR'){
	$de = '';
	//$cc =  'victor.cortez@beesmart.ec';
	$cc =  '';
	$bcc= '';
	$asunto = 'Caso no aprobado Comercial '.@#APP_NUMBER.' '.@#frm_primer_nombre.' '.@#frm_apellido_paterno; 

	$plantilla_rec = 'Notificacion_suscriptor_NO.html';

	@@envio_mail_suscriptor_no = PMFSendMessage(@@APPLICATION,$de,$para, $cc, $bcc, $asunto, $plantilla_rec, array());
}
