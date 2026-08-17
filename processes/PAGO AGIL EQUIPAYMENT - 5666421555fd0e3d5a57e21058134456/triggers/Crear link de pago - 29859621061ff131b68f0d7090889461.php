<?php
// <?php
@=aData = '';
@@__ERROR__ = '';
//@@tri_destinatarios = @@frm_vendedor_email.','.@@frm_cliente_email;
//cambio para que vaya solo al vendedor el pago
@@tri_destinatarios = @@frm_vendedor_email;

$cnx            = '8278346505fd796227e6981083172008';
$Identificacion = @@frm_cliente_cedula;
$PrimerNombre   = @@frm_cliente_nombre;
$SegundoNombre  = @@frm_cliente_segundo_nombre;
$Apellido       = @@frm_cliente_apellidoPaterno.' '. @@frm_cliente_apellidoMaterno;
$Email          = @@frm_cliente_email;
$Telefono       = @@frm_cliente_celular;
$pago           = @@frm_primera_cuota_total_pagar;

$host = $_SERVER['HTTP_HOST'];
$protocolo = $_SERVER['HTTP_X_FORWARDED_PROTO'];
$server = "$protocolo://$host";
 

$sql = "SELECT * FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'EQUIPAYMENT'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);

$url        =$rs['1']['VALOR'];
$urlretorno =$server.$rs['1']['CAMPO1'].@@APPLICATION;
$ocp        =$rs['1']['INTEGRACION'];
$codigo 	=$rs['1']['CAMPO2'] ; //Aqui va el token para Bearer
//@@tmp_url   = $url;
$mensaje = 'Pago póliza vida BPM: '.@@APP_NUMBER;
$postData = array(
  "Factura" => array(
      "Cliente" => array(
          "Identificacion" => $Identificacion,
          "PrimerNombre"   => $PrimerNombre,
          "SegundoNombre"  => $SegundoNombre,
          "Apellido"       => $Apellido,
          "Email"          => $Email,
          "Telefono"       => $Telefono,
          "Aplicacion"     => array(
              "IdAplicacion"   => @@APP_NUMBER,
              "Identificacion" => $mensaje
          )
      ),
      "Numero"     => "0",
      "Comercio"   => $mensaje,
      "Subtotal12" => 0.00,
      "Subtotal0"  => floatval($pago),
      "Iva"        => 0.00,
      "Total"      => floatval($pago),
      "UrlRetorno" => $urlretorno
  )
);
@@tmp_data = json_encode($postData);

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL            => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING       => '',
  CURLOPT_MAXREDIRS      => 10,
  CURLOPT_TIMEOUT        => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_FAILONERROR => true,
  CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST  => 'POST',
  CURLOPT_POSTFIELDS     => json_encode($postData),
  CURLOPT_HTTPHEADER => array(
    "Ocp-Apim-Subscription-Key: $ocp",
    "Authorization: Bearer $codigo",
    "Content-Type: application/json"
  ),
));

if(curl_errno($curl)){


	//Si no tengo link de pago me regresa al formulario
	$msg = curl_error($curl);
	$g = new G();
		$g->SendMessageText("No se generó link de pago => <br>Link: ". $url ."<br> Error: "  .$msg, "ERROR");
	@@tmp_step = PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '6367521845fd7a0593eb719006280520');
}

$response = curl_exec($curl);
$err      = curl_error($curl);
curl_close($curl);

PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'CLP-PAE-95',
$url,
'POST',
"APIKEY:". $apikey . "Authorization: ". $token,
json_encode($postData),
json_encode($response),
json_encode($err));

@@tmp_respuesta = $response;
$aData = array();
if( $err == '' ){
	$aData = json_decode($response, true);
	@@link_fechaCaducidad = $aData['fechaCaducidad'];
	@@link_descripcion    = $aData['descripcion'];
	@@link_idPago         = $aData['idPago'];
	@@link_url            = $aData['url'];
	@=aData = $aData;
} else {
	$aData = $err;
	@=aData = $aData;
}

$linkIdPago = @@link_idPago;
if(!$linkIdPago){
	//Si no tengo link de pago me regresa al formulario
	$msg = isset($aData['descripcion']) ? $aData['descripcion'] : $aData;
	$g = new G();
		$g->SendMessageText("No se generó link de pago. => <br>Link: ". $url ."<br> Error: "  .$msg, "ERROR");
	@@tmp_step = PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '6367521845fd7a0593eb719006280520');
}


