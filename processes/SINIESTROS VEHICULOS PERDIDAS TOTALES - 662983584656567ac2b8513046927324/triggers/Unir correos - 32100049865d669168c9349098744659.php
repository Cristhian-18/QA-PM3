<?php

$correo_cliente =  @@frm_busqueda_mail_1 ;
$correo_cliente2 =  @@frm_busqueda_mail_2 ;
$correo_cliente3 = @@tri_correo_cliente;
$usr_analista = @@tri_usr_analista;


$sql_correo = "SELECT USR_EMAIL FROM USERS WHERE USR_UID = '$usr_analista'";
$rs_correo = executeQuery($sql_correo);
$correo_analista = isset($rs_correo['1']['USR_EMAIL']) ? $rs_correo['1']['USR_EMAIL'] : '';

//replace ; with , in the emails
$correo_cliente = str_replace(';', ',', $correo_cliente);
$correo_cliente2 = str_replace(';', ',', $correo_cliente2);
$correo_cliente3 = str_replace(';', ',', $correo_cliente3);

@@tri_correos_enviar =  $correo_cliente . ', '. $correo_cliente2 . ', '. $correo_cliente3 . ', ' . $correo_analista;
/*
echo (@@tri_correos_enviar);
die();
*/