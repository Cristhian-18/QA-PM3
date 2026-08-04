<?php
// CONSULTAR DATOS DEL WS PARA CONSULTAR @@tri_rcs_v1_estado == 'PENDIENTE'
$cnx = '1479570925ec29f1d8d1d57019959618';
$sqlws  = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'RISKV2'";
$rsws   = executeQuery($sqlws,$cnx);
$ip     = $rsws['1']['VALOR'];
@@tmp_rsws = $rsws;
$cedula = @@frm_numero_identificacion;
$tipo 	= @@frm_tipo_identificacion;
$fecha_inicio = date('Y-m-d H:i:s');

$url = $ip."$tipo/$cedula";
@@tmp_urlrcs2 = $url;

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

try{
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    curl_close($curl);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'consultar Risk 2',
        $url,
        'GET',
        'NO',
        'NO APLICA',
        $response,
        $err
    );

    $datos['data'] = json_decode($response,true);
    $data = $datos['data'];
    @@tmp_data = $data;
    $indice = count($data)-1;
    $tri_rcs_v2_estado = $data[$indice]['codEstadoPersona'];
    @@tri_rcs_v2_codestado = $tri_rcs_v2_estado;

    @@tri_rcs_v2_estado = ($tri_rcs_v2_estado == 'A' ? 'APROBADO' : 'PENDIENTE');
    @@tri_rcs_v2_estado = ($tri_rcs_v2_estado == 'P' ? 'PENDIENTE' : @@tri_rcs_v2_estado);
    @@tri_rcs_v2_estado = ($tri_rcs_v2_estado == 'R' ? 'NO APROBADO' : @@tri_rcs_v2_estado);
}
catch(SoapFault $result){
    $datos['error'] = 'SI';
    echo json_encode($datos);
    die();
}

// QUITAR EN QA
//@@tri_rcs_v2_codestado = 'R';
//@@tri_rcs_v2_estado = 'NO APROBADO';


// grabacion en tabla de log ws

$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;
$ws = $url;
$nombre_ws = 'RCS V2';
$id_consultada = $cedula;
$tipo_interviniente = 'Cliente';
$respuesta = @@tri_rcs_v2_estado;
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
