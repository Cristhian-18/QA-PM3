<?php
$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;

$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_STOKEN_MAGNUM'";
$rs_auth =  executeQuery($sql_cata_auth, $cnx);

$url_auth = $rs_auth['1']['DESCRIPCION'];

$tri_case_id_magnum = @@tri_case_id_magnum;

$dns_auth = trim(str_replace("caseid", $tri_case_id_magnum, $url_auth));

$token = @@token;

$ch_auth = curl_init();
curl_setopt($ch_auth, CURLOPT_URL, $dns_auth);
curl_setopt($ch_auth, CURLOPT_CUSTOMREQUEST, "POST");
//curl_setopt($ch_auth, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch_auth, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_auth, CURLOPT_FAILONERROR, true);
curl_setopt($ch_auth, CURLOPT_HTTPHEADER,
	array(
					"Accept: application/json",
					"Content-Type: application/json",
					"Accept-Language: application/json",
					"Authorization: Bearer ". $token
				)
	);
$res = curl_exec($ch_auth);
if(curl_errno($ch_auth)){
	$msg_m_auth = curl_error($ch_auth);
	$result['mensaje_mostrar'] = 'Excepción capturada: Error al generar token, comuniquese con el  administrador.- '.utf8_encode($msg_m_auth);
}
curl_close($ch_auth);

$rs_m = json_decode($res);

@@tri_securtoken_magnum = $rs_m->extcaseid;

PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'IMGST-VVE-47',
$dns_auth,
'POST',
"Accept: application/json".
" Content-Type: application/json".
" Accept-Language: application/json".
" Authorization: Bearer ". $token,
'',
json_encode($rs_m),
json_encode($msg_m_auth));

