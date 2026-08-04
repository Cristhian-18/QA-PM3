<?php
$cnx = '8278346505fd796227e6981083172008';
$pro_uid = @@PROCESS;

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

$sql = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'USUARIO_DANA_PAGO' AND ESTADO = 1";
$rsD = executeQuery($sql,$cnx);

@@dana_pago_usr = $rsD[1]['DESCRIPCION'];
@@dana_pago_pwd = $rsD[1]['VALOR'];

