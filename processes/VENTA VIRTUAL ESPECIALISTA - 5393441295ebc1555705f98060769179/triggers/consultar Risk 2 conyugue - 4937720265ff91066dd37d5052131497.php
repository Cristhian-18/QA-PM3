<?php
// CONSULTAR DATOS DEL WS PARA CONSULTAR @@tri_rcs_v1_conyuge_estado == 'PENDIENTE'
$cnx = '1479570925ec29f1d8d1d57019959618';
$sqlws  = "SELECT * FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SERVICIOS_WEB' AND CODIGO = 'RISKV2'";
$rsws   = executeQuery($sqlws,$cnx);
$ip     = $rsws['1']['VALOR'];

$tipo = @@frm_conyuge_tipo_identificacion;
$cedula = @@frm_conyuge_numero_identificacion;
$fecha_inicio = date('Y-m-d H:i:s');

$url = $ip."$tipo/$cedula";
//@@tmp_url = $url;

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
        'Consultar RCS V2 Conyuge',
        $url,
        'GET',
        'NO',
        'NO APLICA',
        $response,
        $err
    );

    $datos['data'] = json_decode($response,true);
    $data = $datos['data'];
    //	@@tmp_data = $data;
    $indice = count($data)-1;
    $tri_rcs_v2_conyuge_estado = $data[$indice]['codEstadoPersona'];
    @@tri_rcs_v2_conyuge_codestado = $tri_rcs_v2_conyuge_estado;
    @@tri_rcs_v2_conyuge_estado = ($tri_rcs_v2_conyuge_estado == 'P' ? 'PENDIENTE' : 'APROBADO');
    @@tri_rcs_v2_conyuge_estado = ($tri_rcs_v2_conyuge_estado == 'R' ? 'NO APROBADO' : @@tri_rcs_v2_conyuge_estado);

    // borrar en qa
    //	@@tri_rcs_v2_conyuge_codestado = 'A';
    //	@@tri_rcs_v2_conyuge_estado = 'APROBADO';

}
catch(SoapFault $result){
    $datos['error'] = 'SI';
    echo json_encode($datos);
}


// grabacion en tabla de log ws

$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;
$ws = $url;
$nombre_ws = 'RCS V2';
$id_consultada = $cedula;
$tipo_interviniente = 'Conyuge';
$respuesta = @@tri_rcs_v2_conyuge_estado;
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
