<?php
// <?php
@@aData     = '';
@@__ERROR__ = '';

$cnx            = '1479570925ec29f1d8d1d57019959618'; //cnx rp_equivida
$Identificacion = @@frm_cedula_pagador;               //cedula del asegurado
$PrimerNombre   = @@frm_nombre_pagador;               // nombre del asegurado
$SegundoNombre  = '';                                 // nombre2 del asegurado
$Apellido       = @@frm_apellidos_pagador;
$Email          = @@frm_correo_electronico_debito;  //email del asegurado
$Telefono       = @@frm_celular_debito;             //celular del asegurado
$pago           = @@frm_monto_deposito_provisional; //total a pagar form:"AUTORIZACION DEBITO"
$server         = @@URL_SERVER_SQL;

$sql = "SELECT * FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'EQUIPAYMENT'
AND ESTADO = 1";
$rs = executeQuery($sql, $cnx);

$url        = $rs['1']['VALOR'];
$urlretorno = $server . $rs['1']['CAMPO1'] . @@APPLICATION;
$ocp        = $rs['1']['INTEGRACION'];
$codigo     = $rs['1']['CAMPO2']; //Aqui va el token para Bearer
//@@tmp_url   = $url;
$comercio = "Póliza BPM-E" . @@APP_NUMBER;

$postData = [
    "Factura" => [
        "Cliente"    => [
            "Identificacion" => $Identificacion,
            "PrimerNombre"   => $PrimerNombre,
            "SegundoNombre"  => $SegundoNombre,
            "Apellido"       => $Apellido,
            "Email"          => $Email,
            "Telefono"       => $Telefono,
            "Aplicacion"     => [
                "IdAplicacion"   => @@APP_NUMBER,
                "Identificacion" => $comercio,
            ],
        ],
        "Numero"     => "0",
        "Comercio"   => $comercio,
        "Subtotal12" => 0.00,
        "Subtotal0"  => floatval($pago),
        "Iva"        => 0.00,
        "Total"      => floatval($pago),
        "UrlRetorno" => $urlretorno,
    ],
];
@@tmp_data = json_encode($postData);

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => '',
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_POSTFIELDS     => json_encode($postData),
    CURLOPT_HTTPHEADER     => [
        "Ocp-Apim-Subscription-Key: $ocp",
        "Authorization: Bearer $codigo",
        "Content-Type: application/json",
    ],
]);
$response  = curl_exec($curl);
@@response = $response;
$err       = curl_error($curl);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'autorizacion de debito',
    $url,
    'POST',
    $usr,
    $data,
    json_encode($response, JSON_INVALID_UTF8_SUBSTITUTE),
    json_encode($err, JSON_INVALID_UTF8_SUBSTITUTE)
);

if ($err == '') {
    @@aData               = json_decode($response, true);
    @@link_fechaCaducidad = @@aData['fechaCaducidad'];
    @@link_descripcion    = @@aData['descripcion'];
    @@link_idPago         = @@aData['idPago'];
    @@link_url            = @@aData['url'];
} else {
    @@aData = $err;
}

