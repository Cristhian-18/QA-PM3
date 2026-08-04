<?php
$tipo_persona;
$tipo_persona=@@frm_tipo_persona;
//$tipo_persona="NATURAL";
switch($tipo_persona){
	case "NATURAL":
		$tipo_persona="Persona Natural";
		break;

	case "JURIDICA":
		$tipo_persona="Empresa";
		break;
	default:
		$tipo_persona="Persona Natural";
		break;
}
$tipo_documento;
$tipo_documento=@@frm_tipo_identificacion_pagador;
$tipo_documento="C";
switch($tipo_documento){
	case "C":
		$tipo_documento="01";
		break;

	case "R":
		$tipo_documento="02";
		break;
	case "P":
		$tipo_documento="03";
		break;
	default:
		$tipo_documento="01";
		break;
}


$url = 'https://cloud.abitmedia.com/api/payments/create-payment-request';

$headers = array(
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 3724770d-a4c7-4330-97dc-6d66237dbc19",
    "cache-control: no-cache",
    sprintf('Authorization: Bearer %s', '2y-13-tx-zsjtggeehkmygjbtsf-51z5-armmnw-ihbuspjufwubv4vxok6ery7wozao3wmggnxjgyg')
);

$data = [
    'companyType' => $tipo_persona,
    'document' =>@@frm_cedula_pagador,
    'documentType' => $tipo_documento,
    'fullName' => @@frm_nombre_pagador,
    'address' => @@frm_calle_principal,
    'mobile' => @@frm_celular,
    'email' => @@frm_correo_electronico_personal,
    'description' => 'Pago Póliza Equivida',
    'amount' =>@@frm_monto,
    'amountWithTax' => 0,
    'amountWithoutTax' =>@@frm_monto,
    'tax' => 0,
     'notifyUrl' => 'https://www.ghostm.net/equivida.php',
    'reference' => @@APPLICATION,
    'gateway' => 3
    // 'generateInvoice' => '1 o 0 en caso de si o no y contar con el servicio',
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

  PMFBitacoraServicios(
      @@APP_NUMBER,
      'trigger',
      'TPM-SVPP-83',
      $url,
      'POST',
      $headers,
      json_encode($data),
      json_encode($response),
      json_encode($err));

if ($err) {
  echo "cURL Error #:" . $err;
} else {

  $datos['data'] = json_decode($response,true);
  @@link_pago_medios=$datos['data']['data']['url'];
  //En caso de error
  // return [
  //         'message' => 'Mensaje global del error',
  //         'errors' => Detalle de los errores,
  //         'code' => 0, //0 Error, 1 Procesado exitosamente
  //         'status' => 422, //Detalle codigo de error http
  //       ];

  //En caso de proceso exitoso
  // return [
  //   'message' => 'Solicitud generada exitosamente',
  //   'code' => 1, //0 Error, 1 Procesado exitosamente
  //   'status' => 200, //Detalle codigo de error http
  //   'data' => [
  //     'url' => 'URL ABSOLUTA DEL PAGO',
  //   ],
  // ];


$para = @@frm_correo_electronico_personal;
$cc = '';
$bcc = '';
$cc = 'floja@equivida.com';



@@sw_emailCotizador = PMFSendMessage(@@APPLICATION, 'bpm@equivida.com', $para, $cc, $bcc,
   'Equivida - Cobro de Poliza', 'cobro.html', array(), '');
}
