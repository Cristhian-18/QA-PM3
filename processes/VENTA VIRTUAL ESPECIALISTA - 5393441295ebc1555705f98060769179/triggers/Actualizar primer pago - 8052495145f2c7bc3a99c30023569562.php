<?php
$cnx = '1479570925ec29f1d8d1d57019959618';
$app_uid = @@APPLICATION;
$frm_pago_medios_estado = @@frm_pago_medios_estado;
$pago_medios_cardBrand = @@pago_medios_cardBrand;        
$pago_medios_authorizationCode = @@pago_medios_authorizationCode;
$pago_medios_fecha = @@pago_medios_transactionDate;	

$detalle  ='clientId : '.@@pago_medios_clientId;
$detalle .=' message : '.@@pago_medios_message;
$detalle .=' cardNumber : '.@@pago_medios_cardNumber;
$detalle .=' cardHolder : '.@@pago_medios_cardHolder;
$detalle .=' ipAddress : '.@@pago_medios_ipAddress; 
//$frm_pago_medios_estado
$sql = "UPDATE VV_AUTORIZACIONES_DEBITO
SET 
ESTADO_PAGO = 'PAGADO',
PRIMER_PAGO_AUTORIZACION = '$pago_medios_authorizationCode',
PRIMER_PAGO_FECHA_PAGO = '$pago_medios_fecha',
PRIMER_PAGO_TIPO_TARJETA = '$pago_medios_cardBrand',
PRIMER_PAGO_DETALLE = '$detalle' 
WHERE APP_UID = '$app_uid'";
@@tmp_sql_pagook = $sql;
$rs = executeQuery($sql,$cnx);

