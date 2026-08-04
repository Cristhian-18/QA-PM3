<?php
// <?php
// Modificado by Alan Fonseca
// Conexión a Dana
// parametros

$cnx                   = '1479570925ec29f1d8d1d57019959618';
$pro_uid               = @@PROCESS;
$pro_uid               = 'GENERICO';
@@danaResultado        = 'Inicializando';
@@sw_danaResultado = false;
@@sw_pago = (int)@@sw_pago + 1;
@@versionProceso = @@APP_NUMBER.'PAG'.@@sw_pago;

@@pago_medios_estado = '';
@@frm_pago_medios_estado = '';
@@frm_pago_medios_estado_label = '';
@@frm_pago_medios_estado_fecha = '';
@@frm_pago_medios_estado_fecha_label = '';
@@result_pago = '';
@@resultado_pago ='';
@@tmp_pago_dana = '';
//OBTENER LA URL DE DANA Y TOKEN CONVERSATION_DEBITO_URL   ID_DANA_PAGO
$sql = "SELECT VALOR, DESCRIPCION
FROM ADMIN_CATALOGOS
WHERE COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO       = 'ID_DANA_PAGO'
AND ESTADO       = 1";
$rs       = executeQuery($sql,$cnx);
$url      = $rs['1']['DESCRIPCION'];
$token    = $rs['1']['VALOR'];

// consusltar credenciales
$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'CLIENT_PM_SECRET'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$client_pm_secret=$rs['1']['VALOR'];

$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'CLIENT_PM_ID'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$client_pm_id=$rs['1']['VALOR'];

$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'SERVER_PM'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$server_pm=$rs['1']['VALOR'];
$server_pm=$server_pm;

$sql = "SELECT DESCRIPCION, VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'USUARIO_DANA_PAGO'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$client_pm_user=$rs['1']['DESCRIPCION'];
$client_pm_pwd=$rs['1']['VALOR'];


// link de pago
$sql = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'LINK_PAGO_PASARELA'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$link_pago=$rs['1']['DESCRIPCION'];

// completar trama

@@tmp_pago_dana = $url;
@@dana_link_pago = $link_pago.@@APPLICATION;
// 	"LinkSolicitud"=>@@dana_link_solicitud,

$data = array(
    "AsuntoMail"=>"Pago de solicitud",
    "TextoMail"=>"de tu solicitud de póliza",
    "IdProceso"=>@@APPLICATION,
    "TipoId"=>@@frm_tipo_identificacion_pagador_label,
    "Identificacion"=>@@frm_cedula_pagador,
    "Nombres"=>@@frm_nombre_pagador,
    "Apellidos"=>@@frm_apellidos_pagador,
    "Celular"=>@@frm_celular_debito,
    "Email"=>@@frm_correo_electronico_debito,

    "EmailEjecutivo"=>@@frm_vendedor_email,
    "NombreEjecutivo"=>@@frm_vendedor_nombre,
    "CelularEjecutivo"=>@@frm_vendedor_telefono,
    "CanalEjecutivo"=>"Especialista",

    "IdVersionProceso"=>@@versionProceso,
    "ServerPM"=>@@server_pm,
    "client_id"=>$client_pm_id,
    "client_secret"=>$client_pm_secret,
    "username"=>$client_pm_user,
    "password"=>$client_pm_pwd,
    "LinkPago"=>@@dana_link_pago,
    "Index_Tarea"=>@@INDEX

);

$data= json_encode($data);
@@tmp_dana_pago = $data;
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL            => $url,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Basic ". $token
    ),
    CURLOPT_POSTFIELDS	=>	$data
));

try{
    $response = curl_exec($curl);
    $err      = curl_error($curl);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'Enviar a Dana Autorizacion Debito 1 doc t6',
        $url,
        'POST',
        "Authorization: Basic ". $token,
        $data,
        $response,
        $err
    );

    curl_close($curl);
    $datos['data'] = json_decode($response,true);
    @@result_pago = $datos['data'];
    @@resultado_pago =$datos['data']['wsResult']['resultDescription'];

    if(@@resultado_pago !="OK"){
        $g = new G();
        $g->SendMessageText("Error al enviar al cliente try", "WARNING");
    }
}
catch(SoapFault $result){
    $g = new G();
    $g->SendMessageText("Error al enviar al cliente catch", "WARNING");
}

 