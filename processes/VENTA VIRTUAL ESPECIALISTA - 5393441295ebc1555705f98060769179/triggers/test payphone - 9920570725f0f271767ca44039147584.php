<?php
$url = 'https://pay.payphonetodoesposible.com/api/button/Prepare';

$headers = array(
    "Content-Type: application/json",
    "Accept: application/json",
    sprintf('Authorization: Bearer %s', '-Roj0n74Qsgh1SOaObI2xP58gbl1WlcnWjLK98R9sBQKkoNA71NJAygZipPs2cftgSoGLF78fXka97PLGbI90SYF1ukoJuzx_-ML8UhVI995qE6Y3_IsFXNftIqcI7kEPMowpNIBXWR3Ja4y_ofSkLcV0YdDXEsLhMgjJNH-KuGU3JSk8Ou0mMWhCWzyWmfhRbU8h1qS7yktDHtzJac5GkDT5b4Ob-rh9yCjF_lVadQDiLvxLCHwgn3Lymzi5y7fq5qGL-eF4EozYCO7K59EjMKZIQ3lqU17CCnjopIFV2LRc_Qs-e5PWqJ9l6RZ9TICCyCLQA')
);


$data = [
	 "responseUrl"=> "http://www.equivida.com",
    "amount" => "125",
    "amountWithoutTax" => "125",
    "amountWithTax" => "0",
    "tax" => "0",
    "service" => "0",
    "tip" => "0",
    "currency" => "USD",
    "timeZone" => "0",
    "lat" => "0",
    "lng" => "0",
    "clientTransactionId" => "123456",
    "lang" => "ES",
    "storeId" => "720d425c-e28d-4c29-b631-862da04c0185",
    "terminalId" => "",
    "reference" => "test",
    "phoneNumber" => "+593997942334",
    "email" => "faustol@gmail.com",
    "optionalParameter" => "",
    "documentId" => "0703410001",
    "cancellationUrl" => "http =>//www.equivida.com",
    "transferTo" => ""
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
@@send_dat=json_encode($data);
if ($err) {
  $test= "cURL Error #:" . $err;
	 @@link_pago_medios=$test;
} else {

  $datos['data'] = json_decode($response,true);
  @@link_pago_medios= $datos['data']['payWithCard'];



	$para = 'faustol@gmail.com';
$cc = '';
$bcc = '';
$cc = 'floja@equivida.com';



@@sw_emailCotizador = PMFSendMessage(@@APPLICATION, 'bpm@equivida.com', $para, $cc, $bcc,
   'Equivida - Cobro de Poliza', 'cobro.html', array(), '');

}

PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'TP-VVE-75',
$url,
'POST',
$headers,
json_encode($data),
json_encode($response),
json_encode($test));
