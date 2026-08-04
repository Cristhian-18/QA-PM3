<?php
$caso = @@APP_NUMBER;
$sql = "SELECT
DEL_INDEX, TAS_UID
FROM
certificacion.APP_DELEGATION
WHERE APP_NUMBER = $caso
AND DEL_THREAD_STATUS = 'OPEN'
AND DEL_LAST_INDEX = 1
ORDER BY DEL_INDEX DESC";
$rs= executeQuery($sql);

@@TASK = $rs[1]['TAS_UID'];
@@INDEX = $rs[1]['DEL_INDEX'];
@@TMP_TASK = $rs[1]['TAS_UID'];
@@TMP_INDEX = $rs[1]['DEL_INDEX'];


if (@@pago_medios_estado == 'PAGADO' || @@pago_medios_estado == 'Pagado'){
    @@pago_medios_estado = 'PAGADO';
    @@frm_pago_medios_estado = 'PAGADO';
    @@frm_pago_medios_estado_label = 'PAGADO';
    @@frm_pago_medios_estado_fecha = @@pago_medios_transactionDate;
    @@frm_pago_medios_estado_fecha_label = @@pago_medios_transactionDate;

}

