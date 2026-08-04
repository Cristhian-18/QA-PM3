<?php
//created by Henry
//Obtener datos bancarios


$docId = @@frm_da_NoDocumentoContratate;
$cnx = '934957180650c74e8ed0e10096114321';

$sql = "SELECT * FROM PMT_DATOS_BANCARIOS_GN WHERE FRM_DA_NODOCUMENTOCONTRATATE = '$docId' AND FRM_DB_NUMERO_CUENTA <> '' GROUP BY FRM_DA_NODOCUMENTOCONTRATATE";

$rs = executeQuery($sql);


@@frm_db_banco = $rs['1']['FRM_DB_BANCO'];
@@frm_db_tipo_cuenta = $rs['1']['FRM_DB_TIPO_CUENTA'];
@@frm_db_numero_cuenta = $rs['1']['FRM_DB_NUMERO_CUENTA'];
@@frm_db_tipo_documento = $rs['1']['FRM_DB_TIPO_DOCUMENTO'];
@@frm_db_numero_documento = $rs['1']['FRM_DB_NUMERO_DOCUMENTO'];
@@frm_db_mail = $rs['1']['FRM_DB_MAIL'];
@@frm_db_mail2 = $rs['1']['FRM_DB_MAIL2'];