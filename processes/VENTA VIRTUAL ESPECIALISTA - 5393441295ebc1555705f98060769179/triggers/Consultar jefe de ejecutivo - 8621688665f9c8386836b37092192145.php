<?php
$cnx = '1479570925ec29f1d8d1d57019959618';

$usr_uid = @@USER_LOGGED;
$usr_name = @@USR_USERNAME;
	
$sql = "SELECT * FROM USERS WHERE USR_UID = '$usr_uid'";
@@tmp_jefe = $sql;
$rs = executeQuery($sql);

@@tri_jefe_uid = $rs[1]['USR_REPORTS_TO'];
$jefe_uid = @@tri_jefe_uid;

$sql = "SELECT * FROM USERS WHERE USR_UID = '$jefe_uid'";
$rs = executeQuery($sql);
@@tri_jefe_nombre = $rs[1]['USR_FIRSTNAME'].' '.$rs[1]['USR_LASTNAME'];
@@tri_jefe_email = $rs[1]['USR_EMAIL'];
@@tri_jefe_cedula = $rs[1]['USR_ZIP_CODE'];

// consultar nombre departamento
$tri_depto_vendedor = @@tri_depto_vendedor;
$sql = "SELECT * FROM DEPARTMENT WHERE DEP_UID = '$tri_depto_vendedor'";
$rs = executeQuery($sql);
@@tri_nom_depto = $rs[1]['DEP_TITLE'];

if(@@tri_es_broker == 'SI'){
	@@tri_nom_depto = 'N/A';
}

$sql_agen = "SELECT DESCRIPCION, VALOR, INTEGRACION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'magente' AND CODIGO = '$usr_name'";
$rs_agen = executeQuery($sql_agen, $cnx);
@@ftri_broker_ejecutivo = $rs_agen[1]['DESCRIPCION'];
@@tri_codigo_agente = $rs_agen[1]['VALOR'];
@@tri_codigo_agente_sise = $rs_agen[1]['INTEGRACION'];

@@frm_aps_codigo_tipoAgente = $rs_agen[1]['INTEGRACION'];
$frm_aps_codigo_tipoAgente = $rs_agen[1]['INTEGRACION'];
@@frm_aps_codigo_agente = $rs_agen[1]['VALOR'];

@@frm_vendedor_cargo = $rs_agen[1]['DESCRIPCION'];

//extrae el tipo agente label
$sql_tipoagen = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'ttipo_agente' and CODIGO = '$frm_aps_codigo_tipoAgente'";
$rs_tipoagen = executeQuery($sql_tipoagen, $cnx);
@@frm_aps_codigo_tipoAgente_label = $rs_tipoagen[1]['DESCRIPCION'];

if(@@tri_es_broker == 'SI'){
	@@frm_aps_nombre = $rs_agen[1]['DESCRIPCION'];
	//@@frm_aps_cargo = $rs_agen[1]['DESCRIPCION'];
}
