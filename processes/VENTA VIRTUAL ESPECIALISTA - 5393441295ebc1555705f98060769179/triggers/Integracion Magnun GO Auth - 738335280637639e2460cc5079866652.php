<?php
//craeted by Henry
//Integracion Magnun GO Auth
 

$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;

$sql_cata_auth = "SELECT DESCRIPCION, VALOR, INTEGRACION, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_AUTH_MAGNUM'";
$rs_auth =  executeQuery($sql_cata_auth, $cnx);

$url_auth = $rs_auth['1']['DESCRIPCION'];
$userName = $rs_auth['1']['VALOR'];
$password = $rs_auth['1']['INTEGRACION'];
$campo2 = $rs_auth['1']['CAMPO2'];

$dns_auth = $url_auth;

$ch_auth = curl_init();
curl_setopt($ch_auth, CURLOPT_URL, $dns_auth);
curl_setopt($ch_auth, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch_auth, CURLOPT_POSTFIELDS, $campo2);
curl_setopt($ch_auth, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_auth, CURLOPT_FAILONERROR, true);
curl_setopt($ch_auth, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch_auth, CURLOPT_USERPWD, "$userName:$password");
curl_setopt($ch_auth, CURLOPT_HTTPHEADER,
array(
    "Accept: application/json",
    "Content-Type: application/x-www-form-urlencoded",
    "Accept-Language: application/json"
)
);
$res_auth = curl_exec($ch_auth);
$err = curl_error($ch_auth);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'Integracion Magnun GO Auth',
    $url_auth,
    'POST',
    'NO APLICA',
    $campo2,
    $res_auth,
    $err
);


if(curl_errno($ch_auth)){
    $msg_m_auth = curl_error($ch_auth);
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al generar token, comuniquese con el  administrador.- '.utf8_encode($msg_m_auth);
}
curl_close($ch_auth);
$rs_m_auth = json_decode($res_auth);

@@token = $rs_m_auth->access_token;

//@@tri_case_id_magnum='';
 
