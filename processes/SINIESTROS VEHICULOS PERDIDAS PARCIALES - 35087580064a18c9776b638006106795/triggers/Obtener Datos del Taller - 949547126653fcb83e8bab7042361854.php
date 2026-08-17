<?php
unset(@@grd_vehiculos_afectados['accesorios']);

 
//20216636065412a27cfd079043017144
if(@@TASK == '21947251964a193141bc7e8005186014' || @@TASK == '20216636065412a27cfd079043017144'){
	$usruid = @@USER_LOGGED;
}else{
	$usruid = @@tri_user_taller;
  $id_direccionador = @@tri_id_direccionador;
}

$aUser = PMFInformationUser($usruid);

$tri_taller_mail = $aUser['mail'];

$sql = "SELECT * FROM SINIESTROS_DIRECCIONADOR WHERE email_taller = '$tri_taller_mail' and estado = '1' and id = '$id_direccionador'";

$rs = executeQuery($sql);

if(empty($rs)){
	$tri_taller_mail = $aUser['position'];
  $sql = "SELECT * FROM   SINIESTROS_DIRECCIONADOR WHERE email_taller = '$tri_taller_mail' ";
  $rs = executeQuery($sql);
}
 

if(empty($rs)){
	return;
}

@@frm_taller = $rs['1']['nombre_taller'];
@@frm_taller_nombreContacto = $rs['1']['nombre_contacto'];
@@frm_taller_telefonoContacto = $rs['1']['telefono_contacto'];
@@frm_taller_email = $rs['1']['email_taller'];
@@frm_taller_provincia = $rs['1']['provincia'];
@@frm_taller_ciudad = $rs['1']['canton'];
@@frm_taller_direccion = $rs['1']['direccion'];
@@frm_taller_sector = $rs['1']['sector'];
@@frm_taller_tipo = $rs['1']['tipo'];
@@frm_ruc_taller = $rs['1']['ruc_taller'];


