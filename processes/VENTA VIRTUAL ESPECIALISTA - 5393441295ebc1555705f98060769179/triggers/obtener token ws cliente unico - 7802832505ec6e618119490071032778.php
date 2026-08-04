<?php
$url = @@datos_url.'auth';

//create a new cURL resource
$ch = curl_init($url);

//setup request to send json via POST
$data = array(
   "userName" => "servicio_proveedores",
   "password" => "BQFkJJsh1;0VsHOS48y8"
);
$payload = json_encode($data);

//attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

//set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

//return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute the POST request
$result = curl_exec($ch);
//close cURL resource
curl_close($ch);

$arr = json_decode ($result);
@@Token = $arr->{'Token'};

PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'OTWSCU-VVE-35',
        $url,
        'POST',
        "Content-Type: application/json",
        $payload,
        $result,
        '');

