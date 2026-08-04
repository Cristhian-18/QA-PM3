<?php
//created by Henry

@@tri_fecha_dictamen= getCurrentDate();
$usuario = @@USER_LOGGED;
$sql="SELECT * FROM USERS WHERE USR_UID = '$usuario'";
$rs = executeQuery($sql);
date_default_timezone_set('America/Guayaquil');

@@tri_suscriptor_label = $rs[1]['USR_FIRSTNAME'].' '.$rs[1]['USR_LASTNAME'];
@@tri_user_mail_suscriptor = $rs[1]['USR_EMAIL'];

@@frm_Fecha_atencion =  date('d-m-Y');
