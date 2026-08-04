<?php
$proveedor_uid = @@tri_usr_salvamentos;

$sql_u = "SELECT * FROM USERS WHERE USR_UID = '$proveedor_uid'";
$rs_u = executeQuery($sql_u);
$nombre_proveedor = $rs_u['1']['USR_FIRSTNAME'];
$porcentaje_proveedor = $rs_u['1']['USR_POSITION'];
  
@@frm_proveedor_nombre = $nombre_proveedor;
@@frm_proveedor_porcentaje = $porcentaje_proveedor;