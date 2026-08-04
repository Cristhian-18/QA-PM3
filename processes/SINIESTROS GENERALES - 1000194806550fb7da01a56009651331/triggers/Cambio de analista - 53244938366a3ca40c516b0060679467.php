<?php
//VERIFICAR CAMBIO DE ANALISTA
//@@tri_usr_analista = @@USER_LOGGED

$analista_id = @@tri_usr_analista;
if(@@frm_ac_accion == 'REASIGNAR'){
@@tri_usr_analista = @@tri_usr_analista_2;
}

$sql_n = "SELECT USR_FIRSTNAME, USR_LASTNAME, USR_EMAIL FROM USERS WHERE USR_UID = '$analista_id'";
$rs_n = executeQuery($sql_n);
$nombre_analista = $rs_n['1']['USR_FIRSTNAME'];
$apellido_analista = $rs_n['1']['USR_LASTNAME'];
@@mail_analista =  $rs_n['1']['USR_EMAIL'];
$nombre_analista = $nombre_analista . ' ' . $apellido_analista;
$nombre_analista = strtoupper($nombre_analista);
@@tri_nombre_analista = $nombre_analista;


