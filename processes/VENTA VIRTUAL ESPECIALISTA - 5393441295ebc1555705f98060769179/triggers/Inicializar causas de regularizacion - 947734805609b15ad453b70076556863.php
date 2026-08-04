<?php
$cnx = '7477305145e37562849cda7003565620';
$sql = "SELECT CODIGO frm_cod_regulacion, DESCRIPCION frm_causa_regulacion FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'CAUSAS_REGULARIZACION' AND ESTADO = 1 ";
$rs = executeQuery($sql,$cnx);
@@tmp_regul = $rs;
@@grd_causas_regulacion = $rs;