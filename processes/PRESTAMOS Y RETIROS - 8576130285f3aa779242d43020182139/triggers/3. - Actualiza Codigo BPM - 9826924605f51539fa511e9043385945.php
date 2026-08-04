<?php
$cnx = '1471226895f49403bebfa26089899906';
$cnx_rp = '4647520625f3ca6ed2d2621030136501';
$pro_uid = @@PROCESS;

@@tri_mes_ActualizaBPM = '';

//obtengo el token
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
$msg_m_auth = '';
if(curl_errno($ch_auth)){
    $msg_m_auth = curl_error($ch_auth);
}
curl_close($ch_auth);
$rs_m_auth = json_decode($res_auth);

PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'ACBPM-PYR-44',
$dns_auth,
'POST',
"Accept: application/json".
" Content-Type: application/json".
" Accept-Language: application/json",
json_encode($json_auth),
json_encode($rs_m_auth),
json_encode($msg_m_auth));

$token='';
try
{
    if( !empty($rs_m_auth)){
        foreach($rs_m_auth as $key => $data_auth){
            if($key == 'Token'){
                $token = $data_auth;
            }
        }
    }
}
catch(Exception $e)
{
    @@tri_mes_ActualizaBPM = 'Excepción capturada: '.utf8_encode($e->getMessage());
    @@tri_ban_spc3 = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
}

$id_pv_cero = @@id_pev_cero;
$id_proceso = @@frm_proceso_id;
$tipo_proceso = (@@frm_tipo_solicitud == 'P' ? 1 : 2); //prestamo;
$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;

//$sql = "EXECUTE dbo.spc_PC_actualiza_codBPM $id_proceso, $id_pv_cero, $tipo_proceso, '$app_uid', '$app_number'";
//$rs = executeQuery($sql, $cnx);

$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_UPDATEBPM_CODE'";
$rs_d =  executeQuery($sql_cata, $cnx_rp);

$url_d = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
$dns_d = $url_d;

$aVars = array(
    "idProcess" => $id_proceso,
    "idPvCero" => $id_pv_cero,
    "processType" => $tipo_proceso,
    "appUid" => $app_uid,
    "appNumber" => $app_number
);

$json = json_encode($aVars);
try{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $dns_d);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
    )
);

$res = curl_exec($ch);
$msg_m = '';
if(curl_errno($ch)){
    $msg_m = curl_error($ch);
}
curl_close($ch);

$rs = json_decode($res);

PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'ACBPM-PYR-124',
$dns_d,
'POST',
"Accept: application/json".
" Content-Type: application/json".
" Accept-Language: application/json".
" Authorization: Bearer ". $token,
json_encode($json),
json_encode($rs),
json_encode($msg_m));

if( !empty($rs)){
    foreach($rs as $data){
        if($data->sn_proceso == '-1'){
            @@motivo_proceso = utf8_encode($data->motivo_proceso);
            @@tri_ban_spc3 = 'true';
        }else{
            //aqui redirect al caso
            @@tri_mes_ActualizaBPM = utf8_encode($data->motivo_proceso);
            @@tri_ban_spc3 = '';
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
        }
    }
}else{
    @@tri_mes_ActualizaBPM = $msg_m;
    @@tri_ban_spc3 = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
}
}
catch(Exception $e)
{
    @@tri_mes_ActualizaBPM = 'Excepción capturada: '.utf8_encode($e->getMessage());
    @@tri_ban_spc3 = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
}

