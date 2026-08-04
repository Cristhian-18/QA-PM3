<?php
$cnx                   = '8278346505fd796227e6981083172008';
$pro_uid               = @@PROCESS;

@@danaResultado        = 'Inicializando';
@@sw_danaResultado = false;

@@sw_pago = (@@sw_pago == '' ? 1 : @@sw_pago + 1);
@@versionProceso = @@APP_NUMBER.'AGIL'.@@sw_pago;

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
WHERE COD_CATALOGO = 'PASARELA_PAGO'
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
@@client_pm_secret=$rs['1']['VALOR'];

$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'CLIENT_PM_ID'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
@@client_pm_id=$rs['1']['VALOR'];

$sql = "SELECT VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'SERVER_PM'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
@@server_pm=$rs['1']['VALOR'];

$sql = "SELECT DESCRIPCION, VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'PASARELA_PAGO'
AND CODIGO =  'DANA_PAGO_AGIL'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
@@dana_pago_usr=$rs['1']['DESCRIPCION'];
@@dana_pago_pwd=$rs['1']['VALOR'];

// link de pago
$sql = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'PASARELA_PAGO'
AND CODIGO =  'LINK_PAGO_AGIL'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$link_pago=$rs['1']['DESCRIPCION'];

// completar trama

@@tmp_pago_dana = $url;
@@dana_link_pago = $link_pago.@@APPLICATION;
// 	"LinkSolicitud"=>@@dana_link_solicitud,

$data = array(
	"AsuntoMail"=>'Pago de '.strtolower(@@frm_proceso_label),
	"TextoMail"=>'del proceso '.strtolower(@@frm_proceso_label).' por concepto de '.strtolower(@@frm_concepto_label),
	"IdProceso"=>@@APPLICATION,
	"TipoId"=>@@frm_cliente_tipo_identificacion,
	"Identificacion"=>@@frm_cliente_cedula,
	"Nombres"=>@@frm_cliente_nombre.' '.@@frm_cliente_segundo_nombre,
	"Apellidos"=>@@frm_cliente_apellidoPaterno.' '.@@frm_cliente_apellidoMaterno,
	"Celular"=>@@frm_cliente_celular,
	"Email"=>@@frm_cliente_email,

	"EmailEjecutivo"=>@@frm_vendedor_email,
	"NombreEjecutivo"=>@@frm_vendedor_nombre,
	"CelularEjecutivo"=>@@frm_vendedor_telefono,
	"CanalEjecutivo"=>@@frm_proceso,

	"IdVersionProceso"=>@@versionProceso,
	"ServerPM"=>@@server_pm,
	"client_id"=>@@client_pm_id,
	"client_secret"=>@@client_pm_secret,
	"username"=>@@dana_pago_usr,
	"password"=>@@dana_pago_pwd,
	"LinkPago"=>@@dana_link_pago
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
	curl_close($curl);
	$datos['data'] = json_decode($response,true);
	@@result_pago = $datos['data'];
	@@resultado_pago =$datos['data']['wsResult']['resultDescription'];

	if(@@resultado_pago !="OK"){
		$g = new G();
		$g->SendMessageText("Error al enviar al cliente try", "WARNING");
	}

	PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'EPAD-PAE-137',
    $url,
    'POST',
    " Accept: application/json" .
	" Content-Type: application/json" .
	" Accept-Language: application/json" .
	" Authorization: Basic ". $token,
    $data,
    $response,
    $err);
}
catch(SoapFault $result){
	$g = new G();
	$g->SendMessageText("Error al enviar al cliente catch", "WARNING");
}

