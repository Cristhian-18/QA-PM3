<?php
$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;

//OBTENER LA URL Y KEY AUTORIZACION DE DEBITO
$sql = "SELECT VALOR,DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'CONVERSATION_DEBITO_URL'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$conversation_id = $rs['1']['DESCRIPCION'];
$conversation_key = $rs['1']['VALOR'];
@@conversation_debito_key=$conversation_key;
@@conversation_debito_url=$conversation_id;

//OBTENER EL ID DE LA CONVERSACIÓN Y KEY
$sql = "SELECT VALOR,DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'ID_DANA_MULTIPLEFILE'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$conversations_id = $rs['1']['DESCRIPCION'];
$conversations_key = $rs['1']['VALOR'];
@@conversation_solicitud_key=$conversations_key;
@@conversation_solicitud_url=$conversations_id;


//OBTENER ID TRES FILE
$sql = "SELECT VALOR,DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'ID_DANA_TRESFILE'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$conversations_id = $rs['1']['DESCRIPCION'];
$conversations_key = $rs['1']['VALOR'];
@@conversation_tresfile_key=$conversations_key;
@@conversation_tresfile_url=$conversations_id;

//PRO_UID = '".$pro_uid."'
$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB_URL'
AND CODIGO =  'CLIENTE_UNICO'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$url = $rs['1']['VALOR'];
@@datos_url = $url;


$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'CLIENT_PM_SECRET'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);

@@client_pm_secret=$rs['1']['VALOR'];

$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'CLIENT_PM_ID'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$client_pm_id=$rs['1']['VALOR'];
@@client_pm_id=$client_pm_id;


$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'SERVER_PM'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$server_pm=$rs['1']['VALOR'];
@@server_pm=$server_pm;

$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'CLIENT_PM_USER'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$client_pm_user=$rs['1']['VALOR'];
@@client_pm_user=$client_pm_user;

$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'CLIENT_PM_PWD'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$client_pm_pwd=$rs['1']['VALOR'];
@@client_pm_pwd=$client_pm_pwd;

