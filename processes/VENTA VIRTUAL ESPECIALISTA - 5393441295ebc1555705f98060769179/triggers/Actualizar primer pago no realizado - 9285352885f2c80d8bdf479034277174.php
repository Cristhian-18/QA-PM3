<?php
$cnx = '1479570925ec29f1d8d1d57019959618';
$app_uid = @@APPLICATION;
$estado = @@frm_pago_medios_estado;
$estado = (@@frm_accion_t4 == 'REPROCESAR' ? 'PENDIENTE': $estado);
$sql = "UPDATE VV_AUTORIZACIONES_DEBITO
SET 
ESTADO_PAGO = '$estado'
WHERE APP_UID = '$app_uid'";
$rs = executeQuery($sql,$cnx);