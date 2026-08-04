<?php
$pro_uid='35087580064a18c9776b638006106795';
 
$pro_uid = '35087580064a18c9776b638006106795';
$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS' AND DESCRIPCION = 'DESARROLLADOR' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
print_r($rs_mails_copias);
@@tri_correo_desarrollador_cc = '';
@@tri_correo_desarrollador_bcc= '';

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
echo 'salvamentos';
echo @@tri_destinatarios_salvamentos;



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
echo @@tri_destinatarios_legal_salvamentos;
	 die();