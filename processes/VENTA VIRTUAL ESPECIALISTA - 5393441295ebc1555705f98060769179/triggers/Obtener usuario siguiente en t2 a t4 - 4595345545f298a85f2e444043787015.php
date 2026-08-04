<?php
// USUARIO DANA PAGOS

$cnx  = '1479570925ec29f1d8d1d57019959618';
$sql = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'USUARIO_DANA_PAGO' AND ESTADO = 1";
$rsD = executeQuery($sql,$cnx);

@@dana_pago_usr = $rsD[1]['DESCRIPCION'];
@@dana_pago_pwd = $rsD[1]['VALOR'];
$dana_pago_usr = @@dana_pago_usr;

$rs = executeQuery("SELECT * FROM USERS WHERE USR_USERNAME = '$dana_pago_usr'");

@@dana_pago_uid = $rs[1]['USR_UID'];
@@tri_user_pago = $rs[1]['USR_UID'];

// USUARIO DANA AUTORIZACION DE DEBITO
$sql = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'USUARIO_DANA_PAGADOR' AND ESTADO = 1";
$rsD = executeQuery($sql,$cnx);

@@dana_pagador_usr = $rsD[1]['DESCRIPCION'];
@@dana_pagador_pwd = $rsD[1]['VALOR'];
$dana_pagador_usr = @@dana_pagador_usr;


$rs = executeQuery("SELECT * FROM USERS WHERE USR_USERNAME = '$dana_pagador_usr'");

@@dana_pagador_uid = $rs[1]['USR_UID'];
@@tri_user_pagador = $rs[1]['USR_UID'];

