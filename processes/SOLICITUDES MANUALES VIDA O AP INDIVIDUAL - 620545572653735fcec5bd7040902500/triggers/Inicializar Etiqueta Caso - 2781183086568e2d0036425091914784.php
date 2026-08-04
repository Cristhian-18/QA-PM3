<?php
//Inicializar Etiqueta Caso
@@tri_etiqueta_caso = '';
@@tri_etiqueta_monto = '';
@@SYS_CASE_PRIORITY = 3;


if(@@frm_datosSolicitud_tipo == 'desgravamen'){
	@@tri_etiqueta_caso = 'DESGRAVAMEN';
	@@SYS_CASE_PRIORITY = 4;
}

$sql = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'CONFIGURACION' AND CODIGO = 'MONTO_ELEVADO'";
$rs = executeQuery($sql);

$monto_elevado = $rs['1']['DESCRIPCION'];

if(@#frm_datosSolicitud_MontoAsegurado > $monto_elevado){
   @@tri_etiqueta_monto = 'MONTO ELEVADO';
   @@SYS_CASE_PRIORITY = 4;
   }