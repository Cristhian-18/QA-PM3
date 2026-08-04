<?php
///$de = 'NOTIFICACIONES BPM EQUISUIZA - Venta Virtual<infoequivida@segurosequinoccial.com>';
$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
$de = '';
$para = @@frm_vendedor_email;
$cc =  @@tri_jefe_email;
$bcc = '';
$asunto = 'Decisión de caso en Magnum - '.@#APP_NUMBER; 

/* Recupera destinatarios de correo */
$desBCC = '';

$sql_correo = "SELECT *
FROM ADMIN_CATALOGOS WHERE
PRO_UID = 'GENERICO' 
AND INTEGRACION = '5393441295ebc1555705f98060769179'
AND DESCRIPCION = 'enviar email notificaciones'
";

$rs_correo = executeQuery($sql_correo, $cnx);
$desBCC = $rs_correo[1]['CAMPO1'];

if(@@tri_decision_magnum_result === 'REFER') {	
    $plantilla_rec = 'respuesta_magnum.html';    
}else if (@@tri_decision_magnum_result === 'ACCEPT' && @@banderaPasoControlSuscripcion === 'SI') {
    if (strpos(strtoupper(@@html_decision_magnum), 'EXTRAPRIMA') === false && (@@rutat7 === 'ACEPTO' || @@rutat7 ==='EMISION_MANUAL')){
        $plantilla_rec = 'Notificacion_manual.html';
		$para = @@frm_vendedor_email.','.@@frm_correo_electronico_personal;
        $asunto = 'Notificación Emisión Póliza Caso BPM '.@#APP_NUMBER.' '.@#frm_nombres_completos;
		$cc =  @@tri_jefe_email;
        //$bcc = 'pmartinez@segurosequinoccial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
        $bcc = $desBCC;
        $html_decision_notificacion = '<br>Gracias por sus respuestas, se procede con la emisión de la póliza';
        @@html_decision_notificacion = $html_decision_notificacion;
    }else{
        $plantilla_rec = 'respuesta_magnum.html';
    }
}else{
    $plantilla_rec = 'respuesta_magnum.html';
}



if (@@correoEnviado_T7 === 'NO') {
	if (@@correoEnviadoDesicionMagnum === 'NO'){
    	@@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
    	@@correoEnviado_T7 = 'SI';
    	@@correoEnviadoDesicionMagnum = 'SI';
	}
}

