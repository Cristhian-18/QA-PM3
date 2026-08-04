<?php
//STALIN
$cc = @@frm_solicitante_ccostos;
$contrato = 'NO';
$monto = (@@frm_valor_total) * 1;

$cnx = '1665078345d09b448804c01043460634'; 

$sql = "SELECT USR_PDA FROM COM_MONTOS_PDA
WHERE CENTRO_COSTOS = '$cc'
AND CONTRATO = '$contrato'
AND $monto  BETWEEN DESDE AND HASTA
AND ESTADO = 'ACTIVO'";

@@TMP_T2 = $sql;

$rs = executeQuery($sql,$cnx);

@@uid_pda = $rs['1']['USR_PDA'];