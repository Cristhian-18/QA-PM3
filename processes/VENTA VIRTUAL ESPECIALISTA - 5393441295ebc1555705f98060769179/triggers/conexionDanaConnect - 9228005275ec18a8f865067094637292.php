<?php
$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'pagos'
AND ESTADO = 1";
$rs  = executeQuery($sql);
$server_pm=$rs['1']['VALOR'];
@@server_pm=$server_pm;


if(!is_string(@@frm_tipo_tarjeta)){
    @@frm_tipo_tarjeta="-1";
}
if(!is_string(@@frm_entidad_financiera)){
    @@frm_tipo_tarjeta="-1";
}



if(is_null(@@frm_tipo_tarjeta_label)){@@frm_tipo_tarjeta_label="N/A";}
if(is_null(@@frm_fecha_caducidad_tarjeta)){@@frm_fecha_caducidad_tarjeta="N/A";}
if(is_null(@@frm_polizaanombrede)){@@frm_polizaanombrede="N/A";}
if(is_null(@@frm_parentesco)){@@frm_parentesco="N/A";}
if(is_null(@@frm_entidad_financiera_label)){@@frm_entidad_financiera_label="N/A";}


$data = array(
    "TipoId"=>@@frm_tipo_identificacion_pagador,
    "Identificacion"=>@@frm_cedula_pagador,
    "Nombres"=>@@frm_nombre_pagador,
    "Apellidos"=>"",
    "Celular"=>@@frm_celular,
    "Email"=>@@frm_correo_electronico_personal,
    "MedioPago"=>@@frm_medio_pago_label,
    "TipoTarjeta"=>@@frm_tipo_tarjeta_label,
    "FechaCaducidad"=>@@frm_fecha_caducidad_tarjeta,
    "NroCuenta"=>@@frm_numero_tarjeta,
    "Monto"=>@@frm_monto,
    "MontoLetras"=>@@frm_monto_letras,
    "FrecuenciaPago"=>@@frm_frecuencia_pago,
    "Concepto"=>@@frm_concepto_debito,
    "NroPolizaPrestamo"=>@@frm_concepto_pago,
    "PagoTerceros"=>@@frm_pago_terceros_label,
    "NombrePoliza"=>@@frm_polizaanombrede,
    "Parentesco"=>@@frm_parentesco,
    "Banco"=>@@frm_entidad_financiera_label,
    "CedulaEjecutivo"=>@@frm_vendedor_identificacion,
    "NombreEjecutivo"=>@@frm_vendedor_nombre,
    "EmailEjecutivo"=>@@frm_vendedor_email,
    "CelularEjecutivo"=>@@frm_vendedor_telefono,
    "CanalEjecutivo"=>"Especialista",
    "FechaSolicitud"=>getCurrentDate(),
    "IdProceso"=>@@APPLICATION

);


$conversation_id=@@conversation_debito_id;
$url = @@conversation_debito_url1.$conversation_id.@@conversation_debito_url2;

@@tmp_url = $url;
$usr=$usuario.":".$clave;
$usr=@@conversation_debito_key;
$data= json_encode($data);
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL            => $url,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Basic ". $usr
    ),
    CURLOPT_POSTFIELDS	=>	$data
));
//"Authorization: Basic ". "d2Vic2VydmljZUBlcXVpdmlkYTpQNCQkdzByZFpvMjA="
//"Authorization: Basic ". base64_encode($usr)"webservice@equivida:P4$\$w0rdZo20"
try{
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    curl_close($curl);
    $datos['data'] = json_decode($response,true);
    @@test=$response;

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'conexionDanaConnect',
        $url,
        'POST',
        'Authorization: Basic ',
        $data,
        $response,
        $err
    );
}
catch(SoapFault $result){
    $datos['error'] = 'SI';
    echo json_encode($datos);
}
