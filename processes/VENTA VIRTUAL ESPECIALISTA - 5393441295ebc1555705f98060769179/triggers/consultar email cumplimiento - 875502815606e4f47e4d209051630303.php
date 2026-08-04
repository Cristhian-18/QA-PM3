<?php
$cnx = '1479570925ec29f1d8d1d57019959618';
$sql= "SELECT DESCRIPCION email, VALOR nombre
FROM ADMIN_CATALOGOS
WHERE  COD_CATALOGO = 'PARAMETROS_GENERALES' 
AND CODIGO = 'EMAIL_CUMPLIMIENTO'
AND ESTADO = 1";
$rs= executeQuery($sql,$cnx);
@@tri_email_cumplimiento = $rs[1]['email'];
@@tri_nombre_cumplimiento = $rs[1]['nombre'];