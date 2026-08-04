<?php
//Consultar código del broker
$pro_uid = @@PROCESS;
@@tri_msg_error = '';

//catalogos de marcas modelos
//obtengo el token
	$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'APIKEY'";
	$rs_auth =  executeQuery($sql_cata_auth);

	$apikey = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
	
	$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'TOKEN'";
	$rs_auth =  executeQuery($sql_cata_auth);

	$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';