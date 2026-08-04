<?php
//@@frm_tipo_identificacion = 'C';//despues borrar
//@@frm_trabajo_expuesta_politicamente = 'S';//despues borrar


$tipo_identificacion = @@frm_tipo_identificacion;

switch (@@frm_tipo_identificacion) {
    case 'C':
        $tipo_identificacion = 'NATURAL';
        $where_opcionales = 'OPCIONAL_NATURAL';
        break;
    case 'P':
        $tipo_identificacion = 'NATURAL';
        $where_opcionales = 'OPCIONAL_NATURAL';
        break;
    case 'R':
        $tipo_identificacion = 'JURIDICA';
        $where_opcionales = 'OPCIONAL_JURIDICA';
        break;
}

$cnx = '1479570925ec29f1d8d1d57019959618';

$obligatorios_adicionales = '';

$obligatorios_adicionales .= (@@frm_trabajo_expuesta_politicamente == 'S' ? "'ASE_PEP'," : "");
$obligatorios_adicionales .= (@@frm_estado_civil == '2' || @@frm_estado_civil == '5'? "'ASE_CEDULA_CONYUGE',":"");
$obligatorios_adicionales .= (@@frm_numero_identificacion != @@frm_cedula_pagador ? "'ASE_CEDULA_PAGADOR',":"");
$obligatorios_adicionales .= (@@frm_tipo_identificacion == 'P' ? "'ASE_PASAPORTE',":"");
$obligatorios_adicionales .= (@@frm_tipo_identificacion == 'P' ? "'ASE_VISA',":"");
$obligatorios_adicionales .= (@@frm_ocupacion_tipo_empleo == 'INDEPENDIENTE' ? "'ASE_RUC',":"");
$obligatorios_adicionales .= (@@frm_declaracion_a_discapacidad == 'S' ? "'ASE_DISCAPACIDAD',":"");
$obligatorios_adicionales .= (@@frm_declaracion_j_combo == 'S' ? "'ASE_DROGA',":"");
$obligatorios_adicionales .= (@@frm_tipo_uso_moto == 'COMPETENCIA' ? "'ASE_MOTO',":"");
$obligatorios_adicionales .= (@@frm_piloto == 'S' ? "'ASE_PILOTO',":"");
$obligatorios_adicionales .= (@@frm_militar == 'SI' ? "'ASE_MILITAR',":"");
$obligatorios_adicionales .= (@@frm_plan_pago_impuestos == 'NO' ? "'ASE_IMPUESTOS',":"");

$obligatorios_adicionales .= ((@@eqfx_pagador_tipo == 'C' || @@eqfx_pagador_tipo == 'D') && @@frm_medio_pago != 'TARJETA' ? "'ASE_BANCARIO',":"");

if(is_array(@@grid_otros_seguros)){
$ramo = (count(@=grid_otros_seguros) > 0 ? 'SI' : 'NO');
}

$obligatorios_adicionales .= ($ramo == 'SI'  || @@frm_valor_asegurado > 250000 ? "'ASE_FINANCIERO',":"");

// enfermedades
if (@@frm_declaracion_a_diabetes == 'S' || @@frm_declaracion_a_corazon == 'S' || @@frm_declaracion_a_cancer == 'S' || @@frm_declaracion_a_cirrosis == 'S' || @@frm_declaracion_a_renal == 'S' || @@frm_declaracion_a_pulmonar == 'S' || @@frm_declaracion_a_nervioso == 'S' || @@frm_declaracion_a_tiroides == 'S' || @@frm_declaracion_a_sida == 'S'

   ){
$obligatorios_adicionales .= "'ASE_MEDICO',";
}
$obligatorios_adicionales = substr($obligatorios_adicionales,0,-1);

// por calificacion de equifax
$obligatorios_adicionales .= (@@ajx_eqfx_cliente_tipo == 'C' && @@frm_medio_pago != 'TARJETA' ? "'ASE_BANCARIO',":"");

if($obligatorios_adicionales == ''){
	$obligatorios_adicionales = "''";
}



////////////////
// Obligatorios
////////////////
@@grd_obligatorios = array();

$sql = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
VALOR = '$tipo_identificacion'
AND PRO_UID = '5393441295ebc1555705f98060769179'
AND ESTADO = 1
AND COD_CATALOGO = 'DOCUMENTOS_CLIENTE'
ORDER BY DESCRIPCION";

$rs = executeQuery($sql,$cnx);

if(is_array($rs)){
    for ($i = 1; $i <= count($rs); $i++) {
        @@grd_obligatorios[$i]['frm_obli_descripcion'] = $rs[$i]['DESCRIPCION'];
    }
}

$sql = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
PRO_UID = '5393441295ebc1555705f98060769179'
AND ESTADO = 1
AND COD_CATALOGO = 'DOCUMENTOS_CLIENTE'
ORDER BY DESCRIPCION";

/*
VALOR = '$where_opcionales'
AND CODIGO IN (".$obligatorios_adicionales.")
*/

$rs_2 = executeQuery($sql,$cnx);

if(is_array($rs_2)){
for ($i = 1; $i <= count($rs_2); $i++) {
	@@grd_obligatorios[count($rs) + $i]['frm_obli_descripcion'] = $rs_2[$i]['DESCRIPCION'];
}
}

////////////////
// OPCIONALES
////////////////
/*
@=opcionales = array();

$sql = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
VALOR = '$where_opcionales'
AND PRO_UID = '5393441295ebc1555705f98060769179'
AND ESTADO = 1
AND COD_CATALOGO = 'DOCUMENTOS_CLIENTE'
ORDER BY DESCRIPCION";

$rs_3 = executeQuery($sql,$cnx);

for ($i = 1; $i <= count($rs_3); $i++) {
	@=opcionales[] = array($rs_3[$i]['CODIGO'], $rs_3[$i]['DESCRIPCION']);
}
*/

$sql = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
PRO_UID = '5393441295ebc1555705f98060769179'
AND ESTADO = 1
AND COD_CATALOGO = 'DOCUMENTOS_CLIENTE'
ORDER BY DESCRIPCION";

/*AND CODIGO NOT IN (".$obligatorios_adicionales.")
VALOR = '$where_opcionales'
AND CODIGO IN (".$obligatorios_adicionales.")
*/
@@opcionales = array();

$rs_4 = executeQuery($sql,$cnx);

if(is_array($rs_4)){
for ($i = 1; $i <= count($rs_4); $i++) {
	@=opcionales[] = array($rs_4[$i]['CODIGO'], $rs_4[$i]['DESCRIPCION']);
}
}

@@grd_especificos = array();

@@sw_documentos = 'inicializado';

//condicion del trigger
/*@@sw_documentos != 'inicializado'*/
