<?php
//<?php

$user = 'BPM-'.@@USR_USERNAME;
@@tri_usr_rcs = $user;

$fecha_inicio = date('Y-m-d H:i:s');
@@tri_rcs_v1_conyuge_estado = '';
@@tri_rcs_v1_conyuge_novedad = '';
@@tri_rcs_v1_conyuge_mensaje = '';


// consulta de conexión
$cnx = "1479570925ec29f1d8d1d57019959618";
$sqlws  = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'RISK'";
$rsws   = executeQuery($sqlws,$cnx);
$linkWS     = $rsws['1']['VALOR'];
$bearer = $rsws[1]['CAMPO1'];
@@tmp_datos_conyuge = 'isaac';

// llenado de variables
$nombre1Conyuge = @@frm_conyuge_primer_nombre;
$nombre2Conyuge = @@frm_conyuge_segundo_nombre;
$apellido1Conyuge = @@frm_conyuge_apellido_paterno;
$apellido2Conyuge = @@frm_conyuge_apellido_materno;
$cedulaConyuge = @@frm_conyuge_numero_identificacion;

$casoBpm = @@APP_NUMBER;
$emailVendedor = @@frm_vendedor_email;
$nombreVendedor = @@frm_vendedor_nombre;
$sUserCode = @@USR_USERNAME;
$tri_jefe_email = @@tri_jefe_email;

// aqui llamdo al nuevo ws
$curl = curl_init();
@@tmp_cony = '{
    "sUSERCODE":"'.$sUserCode.'",
    "sDocId":"'.$cedulaConyuge.'",
    "sNom1":"'.$nombre1Conyuge.'",
    "sNom2":"'.$nombre2Conyuge.'",
    "sApe1":"'.$apellido1Conyuge.'",
    "sApe2":"'.$apellido2Conyuge.'",
    "sOrigen":"BPM_VV",
    "bEnviarEmailCumplimiento":false,
    "cod_Aseg":0,
    "sFiguraPersona":"CONYUGE",
    "sTipoTransaccion":"EMISION",
    "sTransaccion":"BPM-'.$casoBpm.'",
    "sBroker":"DIRECTOS",
    "sEjComercial":"'.$nombreVendedor.'",
    "sUserEmail":"'.$emailVendedor.'",
    "sEmail_autCC":""
}';
curl_setopt_array($curl, array(
    CURLOPT_URL => "$linkWS",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYHOST=> false,
    CURLOPT_SSL_VERIFYPEER=> false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "sUSERCODE":"'.$sUserCode.'",
        "sDocId":"'.$cedulaConyuge.'",
        "sNom1":"'.$nombre1Conyuge.'",
        "sNom2":"'.$nombre2Conyuge.'",
        "sApe1":"'.$apellido1Conyuge.'",
        "sApe2":"'.$apellido2Conyuge.'",
        "sOrigen":"BPM_VV",
        "bEnviarEmailCumplimiento":false,
        "cod_Aseg":0,
        "sFiguraPersona":"CONYUGE",
        "sTipoTransaccion":"EMISION",
        "sTransaccion":"BPM-'.$casoBpm.'",
        "sBroker":"DIRECTOS",
        "sEjComercial":"'.$nombreVendedor.'",
        "sUserEmail":"'.$emailVendedor.'",
        "sEmail_autCC":""
    }',
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $bearer",
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);
$err      = curl_error($curl);
curl_close($curl);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'Consultar Risk T1 conyuge GSI',
    $linkWS,
    'POST',
    'Authorization: Bearer ',
    @@tmp_cony,
    $response,
    $err
);

$result = json_decode($response,true);
@@tmp_datos_conyuge = $result;
$estado = $result['respuesta'];
@@tmp_estado_conyuge = $estado;
if ($err == '' && isset($result['respuesta'])){
    @@tri_rcs_v1_conyuge_estado =  ($estado == 2 ? 'APROBADO' : 'PENDIENTE') ;
    @@tri_rcs_v1_conyuge_mensaje = (@@tri_rcs_v1_conyuge_estado == 'PENDIENTE' ? 'CLIENTE EN ANÁLISIS, NECESITA DE AUTORIZACIÓN' : '');

    @@tri_rcs_error_c = ($result == "" ? 'SI' : 'NO');
    @@tri_rcs_error_c = ($estado < 1 ? 'SI' : @@tri_rcs_error);
    // CAMBIAR PROD
    //	@@tri_rcs_v1_estado = 'PENDIENTE';

} else {
    @@tri_rcs_error_c = 'SI';
}

// grabacion en tabla de log ws

$app_uid = @@APPLICATION;
$app_number = $casoBpm;
$ws = $linkWS;
$nombre_ws = 'RCS V1';
$id_consultada = $cedulaConyuge;
$tipo_interviniente = 'Conyuge';
$respuesta = @@tri_rcs_v1_conyuge_estado;
$fecha_fin = date('Y-m-d H:i:s');

$sql = "INSERT INTO VV_LOG_WS (
    APP_UID,
    APP_NUMBER,
    WS,
    NOMBRE_WS,
    ID_CONSULTADA,
    TIPO_INTERVINIENTE,
    RESPUESTA,
    FECHA_INICIO,
    FECHA_FIN
)
VALUES
(
    '$app_uid',
    '$app_number',
    '$ws',
    '$nombre_ws',
    '$id_consultada',
    '$tipo_interviniente',
    '$respuesta',
    '$fecha_inicio',
    '$fecha_fin'
)" ;
$rs   = executeQuery($sql,$cnx);
