<?php
//created by Henry
//21-12-2020
//actualizar telefonos en CU


$cnx = '1471226895f49403bebfa26089899906';
$cnx_rp = '4647520625f3ca6ed2d2621030136501';
$pro_uid = @@PROCESS;

@@tri_mes_UpdFonoPR = '';

$identificacion = @@frm_numero_identificacion;
$tipoIdentificacion = @@frm_tipo_identificacion;
$numeroTelefono = substr(@@frm_celular_receptor, 2);
$tipoTelefono = 3;

$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_UPDATEFONO'";
$rs_d =  executeQuery($sql_cata, $cnx_rp);

$url_d = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
$dns_d = $url_d;

$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_CU_GEN_TOKEN_AUTH'";
$rs_auth =  executeQuery($sql_cata_auth, $cnx_rp);

$url_auth = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
$dns_auth = $url_auth;

$aVars_auth = array(
    "userName" => "servicio_proveedores",
    "password" => "BQFkJJsh1;0VsHOS48y8"
);

$json_auth = json_encode($aVars_auth);

$ch_auth = curl_init();
curl_setopt($ch_auth, CURLOPT_URL, $dns_auth);
curl_setopt($ch_auth, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch_auth, CURLOPT_POSTFIELDS, $json_auth);
curl_setopt($ch_auth, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_auth, CURLOPT_FAILONERROR, true);
curl_setopt($ch_auth, CURLOPT_HTTPHEADER,
array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Accept-Language: application/json"
)
);
$res_auth = curl_exec($ch_auth);


if(curl_errno($ch_auth)){
    $msg_m_auth = curl_error($ch_auth);
}
curl_close($ch_auth);
$rs_m_auth = json_decode($res_auth);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'actualizar telefono CU - obtener token',
    $dns_auth,
    'POST',
    'NO',
    $json_auth,
    $res_auth,
    $msg_m_auth
);

$token='';
echo 'aqui 1xx';
try {
    if(!empty($rs_m_auth) && is_object($rs_m_auth)) {
        // Si json_decode retorna un objeto
        if(isset($rs_m_auth->Token)) {
            $token = $rs_m_auth->Token;
        }
    } elseif(is_array($rs_m_auth) && count($rs_m_auth) > 0) {
        // Si por alguna razón es un array
        if(isset($rs_m_auth['Token'])) {
            $token = $rs_m_auth['Token'];
        }
    }

    if(empty($token)) {
        @@tri_mes_UpdatePR = 'Error: No se obtuvo el token';
    }
}
catch(Exception $e) {
    @@tri_mes_UpdatePR = 'Excepción capturada: ' . utf8_encode($e->getMessage());
}

$aVars = array(
    "identificacion" => $identificacion,
    "tipoIdentificacion" => $tipoIdentificacion,
    "numeroTelefono" => $numeroTelefono,
    "tipoTelefono" => $tipoTelefono
);
$json = json_encode($aVars);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $dns_d);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, false);
curl_setopt($ch, CURLOPT_HTTPHEADER,
array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Accept-Language: application/json",
    "Authorization: Bearer " . $token
)
);

$res = curl_exec($ch);



if(curl_errno($ch)){
    $msg_m = curl_error($ch);
}
curl_close($ch);

$rs_m = json_decode($res);


PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'actualizar telefono CU',
    $dns_d,
    'PUT',
    'Authorization: Bearer',
    $json,
    $res,
    $msg_m
);



try
{

    if(is_array($rs_m) && count($rs_m) > 0 && !empty($rs_m)){
        foreach($rs_m as $key => $data){
            if($key == 'estado'){
                if($data == 'ok')
                @@tri_mes_UpdFonoPR = $data;
                if($data == 'error')
                @@tri_mes_UpdFonoPR = $data;
            }else{
                @@tri_mes_UpdFonoPR = $data;
            }
        }
    }else{
        @@tri_mes_UpdFonoPR = $msg_m;
    }
}
catch(Exception $e)
{
    @@tri_mes_UpdFonoPR = 'Excepción capturada: '.utf8_encode($e->getMessage());
}

