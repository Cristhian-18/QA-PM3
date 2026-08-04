<?php
$cnx = '8278346505fd796227e6981083172008';
$app_uid = @@APPLICATION;
$frm_pago_medios_estado = @@frm_pago_medios_estado;
$estado = ($frm_pago_medios_estado == 'PAGADO' ? 'FINALIZADO': 'ABIERTO');
$pago_medios_cardBrand = @@pago_medios_cardBrand;        
$pago_medios_authorizationCode = @@pago_medios_authorizationCode;
$pago_medios_fecha = @@pago_medios_transactionDate;	

$detalle  ='clientId : '.@@pago_medios_clientId;
$detalle .=' message : '.@@pago_medios_message;
$detalle .=' cardNumber : '.@@pago_medios_cardNumber;
$detalle .=' cardHolder : '.@@pago_medios_cardHolder;
$detalle .=' ipAddress : '.@@pago_medios_ipAddress; 
//$frm_pago_medios_estado
$sql = "UPDATE PA_PAGOS
SET 
APP_STATUS = '$estado',
PAGO_ESTADO = '$frm_pago_medios_estado',
PAGO_AUTORIZACION = '$pago_medios_authorizationCode',
PAGO_FECHA_PAGO = '$pago_medios_fecha',
PAGO_TIPO_TARJETA = '$pago_medios_cardBrand',
PAGO_DETALLE = '$detalle' 
WHERE APP_UID = '$app_uid'";
@@tmp_sql_ok = $sql;

$rs = executeQuery($sql,$cnx);
@@tmp_rs = $rs;

@@tri_bandera_pago='true';
 