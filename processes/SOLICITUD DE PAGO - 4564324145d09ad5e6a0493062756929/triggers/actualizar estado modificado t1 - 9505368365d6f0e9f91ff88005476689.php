<?php
$app = @@APPLICATION;
$cnx = '1665078345d09b448804c01043460634'; 
$sql = "UPDATE COM_DETALLE_APROBACION SET APP_STATUS = 'MODIFICADO' WHERE APP_UID = '$app'";
$rs  = executeQuery($sql,$cnx);
@@sw_devuelto = 'SI';