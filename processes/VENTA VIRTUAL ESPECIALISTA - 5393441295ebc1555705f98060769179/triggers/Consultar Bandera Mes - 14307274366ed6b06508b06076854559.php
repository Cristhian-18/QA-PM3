<?php

$process = @@PROCESS;

//estado de la bandera
$sql = "SELECT id, case when now() between fecha_desde and fecha_hasta then 'SI' else 'NO' end as bandera
FROM VTAESPECIALISTA_CONFIGURACION WHERE id = (SELECT MAX(id) FROM VTAESPECIALISTA_CONFIGURACION)";

$rs = executeQuery($sql);

$id_bandera = $rs['1']['bandera'];
@@tri_bandera_cierreMes = $id_bandera;

if($id_bandera == 'SI'){
	@@frm_accion_cierre = 'CIERRE';
	//@@frm_accion = 'CIERRE';
}else{
	@@frm_accion_cierre = 'CONTINUAR';
	//@@frm_accion = 'CONTINUAR';
}
