<?php
/*chk_docs_basicos
SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '1000194806550fb7da01a56009651331' AND COD_CATALOGO = 'DOCUMENTOS' AND ESTADO = 1 ORDER BY DESCRIPCION

SubForm Adjuntar Documentos

chk_docs_basicos_grid
*/
//<?

$array_documentos = array();
$array_documentos = @@chk_docs_basicos_grid;

if(empty($array_documentos)){
	$query = 'SELECT DESCRIPCION as frm_documento FROM ADMIN_CATALOGOS WHERE PRO_UID = "1000194806550fb7da01a56009651331" AND COD_CATALOGO = "DOCUMENTOS" AND ESTADO = 1 ORDER BY DESCRIPCION';
	$result = executeQuery($query);
    @@chk_docs_basicos_grid = $result;
}