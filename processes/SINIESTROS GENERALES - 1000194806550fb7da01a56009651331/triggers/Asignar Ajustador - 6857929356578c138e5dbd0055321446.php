<?php
$codigo = @@frm_as_tipoAjustador;
$accion = @@frm_ac_accion;
$operacion_fc = @@tri_tipo_operacion;
if ($accion == 'REASIGNAR') {
	//@@tri_usr_analista = @@frm_as_nombreAjustadorAsignado;
} else {
	if ($codigo == 'EXTERNO' || $codigo == 'SINIESTROS_AJUSTADORES_EXTERNOS') {
		if($operacion_fc == '1'){
			@@tri_usr_ajustador = @@frm_as_nombreAjustadorAsignado;
		} else {
			@@tri_usr_ajustador = @@frm_as_nombreAjustadorAsignado;
		}
	} else {
		@@tri_usr_ajustador = @@USER_LOGGED;
		if($operacion_fc == '1'){
			@@tri_usr_ajustador = @@frm_as_nombreAjustadorAsignado;
		} 
	}
}

$ajustador = PMFInformationUser(@@tri_usr_ajustador);

@@tri_mail_ajustador = $ajustador['mail'];

$tri_mail_ajustador = @@tri_mail_ajustador;
$frm_da_correoElectronico = @@frm_da_correoElectronico;
$frm_ds_emailBroker1 = @@frm_ds_emailBroker1;
$frm_ds_emailBroker2 = @@frm_ds_emailBroker2;
//join all emails separated by comma and remove empty values

$emails = array($tri_mail_ajustador, $frm_ds_emailBroker1, $frm_ds_emailBroker2);
$emails = array_filter($emails);
$emails = implode(',', $emails);

@@tri_destinatarios_mail_ajustador = $emails;
