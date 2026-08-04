<?php
@@frm_fecha_actual= getCurrentDate();
@@fecha_manana = date("Y-m-d", strtotime('tomorrow')); 
@@fecha_ayer = date("Y-m-d", strtotime('yesterday'));
@@fecha_vacio = "";
@@frm_cliente_respuesta = '';

$usuario = @@USER_LOGGED;
@@tri_user_t1 = $usuario;
@@frm_uid_vendedor = $usuario;
$sql="SELECT * FROM USERS WHERE USR_UID = '$usuario'";
$rs = executeQuery($sql);
date_default_timezone_set('America/Guayaquil');

@@frm_fecha_solicitud = getCurrentDate() . " " . getCurrentTime();
@@frm_vendedor_nombre = $rs[1]['USR_FIRSTNAME'].' '.$rs[1]['USR_LASTNAME'];
@@frm_vendedor_email = $rs[1]['USR_EMAIL'];
@@frm_vendedor_telefono = $rs[1]['USR_PHONE'];
@@frm_vendedor_identificacion = $rs[1]['USR_ZIP_CODE'];
@@tri_depto_vendedor = $rs[1]['DEP_UID'];
@@tri_vendedor_ciudad = $rs[1]['USR_LOCATION'];
$tri_vendedor_ciudad = @@tri_vendedor_ciudad;
//select LOCATION

$sql_2 = "SELECT * FROM ISO_LOCATION WHERE IC_UID = 'EC' AND IL_UID = '$tri_vendedor_ciudad'";
$rs_2 = executeQuery($sql_2);
@@tri_vendedor_ciudad_label = $rs_2[1]['IL_NAME'];

@@tri_seq_persona = (@@tri_seq_persona == '' ? 'NO_DEFINIDO' : @@tri_seq_persona);
//@@tmp_contador_derivacion = 1;
