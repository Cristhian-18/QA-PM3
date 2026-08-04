<?php
$cnx = '1479570925ec29f1d8d1d57019959618';
$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;
$sql = "SELECT ESTADO_PAGO FROM VV_AUTORIZACIONES_DEBITO WHERE APP_UID ='$app_uid'" ;
@@tmp_sql = $sql;
$rs = executeQuery($sql,$cnx);
@@frm_control_pago = $rs[1]['ESTADO_PAGO'];

