<?php
if(@@frm_recibio_deposito == 'S'){

	$cnx = "1479570925ec29f1d8d1d57019959618";

	$frm_banco_equivida = @@frm_banco_equivida;

	$sql = "
	SELECT  CODIGO,VALOR
	FROM ADMIN_CATALOGOS
	WHERE COD_CATALOGO='BANCO_EQUIVIDA'
	AND ESTADO=1
	AND CODIGO = '$frm_banco_equivida'
	";

	$rs = executeQuery($sql,$cnx);

	@@frm_banco_ccontable = $rs[1]['VALOR'];

}
else{
	@@frm_banco_ccontable = '';
}