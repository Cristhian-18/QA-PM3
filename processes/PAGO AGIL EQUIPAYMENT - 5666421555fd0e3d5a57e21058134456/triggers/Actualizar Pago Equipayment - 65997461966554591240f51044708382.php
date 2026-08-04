<?php
 
$cnx     = '8278346505fd796227e6981083172008';
$id_pago = @@link_idPago;
$id_pago = base64_decode($id_pago);

// consulta de url de ws de estado de pago
$sql = "SELECT * FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'EQUIPAYMENT_PAGO'
AND ESTADO = 1";
$rs  = executeQuery($sql, $cnx);
$url = $rs['1']['VALOR'] . $id_pago;
$ocp = $rs['1']['INTEGRACION'];

// codigo de ws de equipayment cambiar en produccion
$codigo = $rs['1']['CAMPO2'];
$curl   = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => '',
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => 'GET',
    CURLOPT_HTTPHEADER     => [
        "Ocp-Apim-Subscription-Key: $ocp",
        "Authorization: Bearer $codigo",
    ],
]);

$response = curl_exec($curl);
if (curl_errno($curl)) {     
    $msg_m = curl_error($curl);
    @@tri_msg_error = $msg_m;
}
curl_close($curl);
$respuesta = json_decode($response);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'APE-PAE-44',
    $url,
    'GET',
    "Ocp-Apim-Subscription-Key: $ocp" . "Authorization: Bearer $codigo",
    '',
    json_encode($respuesta),
    json_encode($msg_m));

$pago_estado  = $respuesta->descripcionEstado;
$resultado    = json_decode($respuesta->resultadoTrama);
$fechaTransac = substr($respuesta->fechaTransaccion, 0, 20);

@@pago_medios_estado            = $respuesta->descripcionEstado;
@@resultadoTexto                = $respuesta->resultadoTexto;
@@frm_pago_medios_estado        = $respuesta->descripcionEstado;
@@pago_medios_authorizationCode = $respuesta->authorizationCode;
@@pago_medios_clientId          = $respuesta->idPago;
@@pago_medios_transactionDate   = $fechaTransac;
@@pago_medios_message           = 'Lote ' . $respuesta->lote . ' Referencia ' . $respuesta->referencia;
@@pago_medios_cardNumber        = $respuesta->bin;
@@pago_medios_cardBrand         = $respuesta->marca;
@@pago_medios_cardHolder        = $respuesta->banco;
@@pago_medios_ipAddress         = $respuesta->ip;

