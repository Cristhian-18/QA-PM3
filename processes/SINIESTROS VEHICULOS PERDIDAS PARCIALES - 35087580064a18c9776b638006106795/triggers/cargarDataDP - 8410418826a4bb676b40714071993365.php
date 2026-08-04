<?php
//-SINIESTROS VEHICULOS PERDIDAS PARCIALES
//200785

$appNumber = (int) @@APP_NUMBER;
//$appNumber = 200785;
/*
$sql = "SELECT t.*, c.CON_VALUE AS frm_name_process
FROM certificacion.PMT_PRELIQUIDACION_PARCIAL t
JOIN APPLICATION a ON a.APP_NUMBER = t.APP_NUMBER
JOIN CONTENT c ON c.CON_ID = a.PRO_UID
WHERE t.APP_NUMBER = " . $appNumber . "
  AND c.CON_CATEGORY = 'PRO_TITLE'
  AND c.CON_LANG = 'es'";
*/
$sql = "SELECT t.*, COALESCE(c.CON_VALUE, 'SINIESTROS VEHICULOS PERDIDAS PARCIALES') AS frm_name_process
FROM certificacion.PMT_PRELIQUIDACION_PARCIAL t
JOIN APPLICATION a ON a.APP_NUMBER = t.APP_NUMBER
LEFT JOIN CONTENT c ON c.CON_ID = a.PRO_UID 
  AND c.CON_CATEGORY = 'PRO_TITLE'
  AND c.CON_LANG = 'es'
WHERE t.APP_NUMBER = " . $appNumber;
$rs = executeQuery($sql);

// Usuario del taller = dueno del taller (TRI_USER_TALLER = USR_UID en PMT_TALLER),
// no quien tenga la tarea actualmente abierta (puede ser otra persona la que tome el caso).
$triUserTaller = isset($rs['1']['TRI_USER_TALLER']) ? $rs['1']['TRI_USER_TALLER'] : '';

$rsUsrAsignado = [];
if ($triUserTaller !== '') {
  $sqlUsrAsignado = "SELECT USR_USERNAME FROM USERS WHERE USR_UID = '" . addslashes($triUserTaller) . "'";
  $rsUsrAsignado = executeQuery($sqlUsrAsignado);
}

//Nuevas Variables
@@frm_usuario_taller                            = isset($rsUsrAsignado['1']['USR_USERNAME'])                         ? $rsUsrAsignado['1']['USR_USERNAME'] : '';
@@frm_name_process                              = isset($rs['1']['frm_name_process'])                                ? $rs['1']['frm_name_process']                                : '';
@@frm_numcaso                                   = isset($rs['1']['APP_NUMBER'])                                      ? $rs['1']['APP_NUMBER']                                      : '';
//RUC TALLER - Cristhian 17/07/2026
@@frm_ruc_taller                                = isset($rs['1']['FRM_RUC_TALLER'])                                  ? $rs['1']['FRM_RUC_TALLER']                                  : '';

 
// Solo se usa el numero de preliquidacion de la BD si es numerico y mayor a 0.
// Nulo, vacio o 0 -> 'xxxx' (valor por defecto, aun no se ha generado ninguno).
$numPreliqDb = isset($rs['1']['FRM_NUMPRELIQ']) ? $rs['1']['FRM_NUMPRELIQ'] : null;
if ($numPreliqDb !== null && ctype_digit((string) $numPreliqDb) && (int) $numPreliqDb > 0) {
    @@frm_numpreliq       = $numPreliqDb;
    @@frm_numpreliq_label = isset($rs['1']['FRM_NUMPRELIQ_LABEL']) ? $rs['1']['FRM_NUMPRELIQ_LABEL'] : $numPreliqDb;
} else {
    @@frm_numpreliq       = 'xxxx';
    @@frm_numpreliq_label = 'xxxx';
}
@@frm_estado_label                              = '';
@@frm_estado                                    = '';

//Nuevas Variables - Variables que se cargarán por el Servicio SISE "Consultar Informacion SISE".
@@frm_numero_reclamo_sise                       = 'xxxx';
@@frm_numero_reporte_sise                       = 'xxxx';



//Variables Existentes.
@@frm_valoresAprobados_manoObraProformada       = (isset($rs['1']['FRM_VALORESAPROBADOS_MANOOBRAPROFORMADA']) && $rs['1']['FRM_VALORESAPROBADOS_MANOOBRAPROFORMADA'] !== '')         ? $rs['1']['FRM_VALORESAPROBADOS_MANOOBRAPROFORMADA']         : 0;
@@frm_valoresAprobados_valorRepuestosProformado = (isset($rs['1']['FRM_VALORESAPROBADOS_VALORREPUESTOSPROFORMADO']) && $rs['1']['FRM_VALORESAPROBADOS_VALORREPUESTOSPROFORMADO'] !== '')   ? $rs['1']['FRM_VALORESAPROBADOS_VALORREPUESTOSPROFORMADO']   : 0;
@@frm_deducible_deducible                       = (isset($rs['1']['FRM_DEDUCIBLE_DEDUCIBLE']) && $rs['1']['FRM_DEDUCIBLE_DEDUCIBLE'] !== '')                         ? $rs['1']['FRM_DEDUCIBLE_DEDUCIBLE']                         : 0;
@@frm_deducible_rasa                            = (isset($rs['1']['FRM_DEDUCIBLE_RASA']) && $rs['1']['FRM_DEDUCIBLE_RASA'] !== '')                              ? $rs['1']['FRM_DEDUCIBLE_RASA']                              : 0;

@@frm_busqueda_nombres                          = isset($rs['1']['FRM_BUSQUEDA_NOMBRES'])                            ? $rs['1']['FRM_BUSQUEDA_NOMBRES']                            : '';
@@frm_vehiculo_placa                            = isset($rs['1']['FRM_VEHICULO_PLACA'])                              ? $rs['1']['FRM_VEHICULO_PLACA']                              : '';
@@frm_vehiculo_marca                            = isset($rs['1']['FRM_VEHICULO_MARCA'])                              ? $rs['1']['FRM_VEHICULO_MARCA']                              : '';
@@frm_vehiculo_modelo                           = isset($rs['1']['FRM_VEHICULO_MODELO'])                             ? $rs['1']['FRM_VEHICULO_MODELO']                             : '';
@@frm_vehiculo_chasis                           = isset($rs['1']['FRM_VEHICULO_CHASIS'])                             ? $rs['1']['FRM_VEHICULO_CHASIS']                             : '';

//@@tri_id_stro                                   = isset($rs['1']['TRI_ID_STRO'])                                     ? $rs['1']['TRI_ID_STRO']                                     : '';
//@@tri_nro_stro                                  = isset($rs['1']['TRI_NRO_STRO'])                                    ? $rs['1']['TRI_NRO_STRO']                                    : '';



/*@=appData = [
    'frm_name_process'                              => isset($rs['1']['frm_name_process'])                                ? $rs['1']['frm_name_process']                                : '',
    'frm_numcaso'                                   => isset($rs['1']['APP_NUMBER'])                                      ? $rs['1']['APP_NUMBER']                                      : '',
    'frm_valoresAprobados_manoObraProformada'       => isset($rs['1']['FRM_VALORESAPROBADOS_MANOOBRAPROFORMADA'])         ? $rs['1']['FRM_VALORESAPROBADOS_MANOOBRAPROFORMADA']         : '',
    'frm_valoresAprobados_valorRepuestosProformado' => isset($rs['1']['FRM_VALORESAPROBADOS_VALORREPUESTOSPROFORMADO'])   ? $rs['1']['FRM_VALORESAPROBADOS_VALORREPUESTOSPROFORMADO']   : '',
    'frm_deducible_deducible'                       => isset($rs['1']['FRM_DEDUCIBLE_DEDUCIBLE'])                         ? $rs['1']['FRM_DEDUCIBLE_DEDUCIBLE']                         : '',
    'frm_deducible_rasa'                            => isset($rs['1']['FRM_DEDUCIBLE_RASA'])                              ? $rs['1']['FRM_DEDUCIBLE_RASA']                              : '',
    'tri_nro_stro'                                  => isset($rs['1']['TRI_NRO_STRO'])                                    ? $rs['1']['TRI_NRO_STRO']                                    : '',
    'frm_busqueda_nombres'                          => isset($rs['1']['FRM_BUSQUEDA_NOMBRES'])                            ? $rs['1']['FRM_BUSQUEDA_NOMBRES']                            : '',
    'frm_vehiculo_placa'                            => isset($rs['1']['FRM_VEHICULO_PLACA'])                              ? $rs['1']['FRM_VEHICULO_PLACA']                              : '',
    'frm_vehiculo_marca'                            => isset($rs['1']['FRM_VEHICULO_MARCA'])                              ? $rs['1']['FRM_VEHICULO_MARCA']                              : '',
    'frm_vehiculo_modelo'                           => isset($rs['1']['FRM_VEHICULO_MODELO'])                             ? $rs['1']['FRM_VEHICULO_MODELO']                             : '',
    'frm_vehiculo_chasis'                           => isset($rs['1']['FRM_VEHICULO_CHASIS'])                             ? $rs['1']['FRM_VEHICULO_CHASIS']                             : '',
    'tri_id_stro'                                   => isset($rs['1']['TRI_ID_STRO'])                                     ? $rs['1']['TRI_ID_STRO']                                     : '',
    'frm_numpreliq'                                 => 'xxxx',
    'frm_numpreliq_label'                           => 'xxxx',
    'frm_estado_label'                              => '',
    'frm_estado'                                    => '',
];*/