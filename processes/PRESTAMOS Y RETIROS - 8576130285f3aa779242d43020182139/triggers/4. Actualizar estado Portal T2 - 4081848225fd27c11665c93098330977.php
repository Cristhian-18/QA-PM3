<?php
//created by Henry
//29-08-2020
//Actualizar estado Portal

$cnx = '1471226895f49403bebfa26089899906';
$cnx_rp = '4647520625f3ca6ed2d2621030136501';
$pro_uid = @@PROCESS;

$id_pev_cero = @@id_pev_cero;

if(@@frm_tipo_solicitud == 'P'){
    $id_proceso = @@id_proceso_prestamo;
    $tipo_proceso = 1;
    @@tipo_proceso = $tipo_proceso;
}else{
    if(@@frm_tipo_solicitud == 'R'){
        $id_proceso = @@id_proceso_retiro;
        $tipo_proceso = 2;
        @@tipo_proceso = $tipo_proceso;
    }
}

//validacion por tarea
//tarea 2
if(@@frm_respuesta_cliente == 'Acepto'){
    $cod_estado = '2'; //EN PROCESO
    $comentario = @@frm_respuesta_cliente;
}else{
    $cod_estado = '5';//CANCELADA
    $comentario = @@frm_respuesta_cliente;
}

@@cod_estado = $cod_estado;

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
if(curl_errno($ch_auth)){
    $msg_m_auth = curl_error($ch_auth);
}
curl_close($ch_auth);
$rs_m_auth = json_decode($res_auth);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'AEP-PR-73',
    $dns_auth,
    'POST',
    'NO',
    $json_auth,
    $res_auth,
    $msg_m_auth
);


$token='';
try {

    if(!empty($rs_m_auth) && is_object($rs_m_auth)) {
        // Si json_decode retorna un objeto
        if(isset($rs_m_auth->Token)) {
            $token = $rs_m_auth->Token;
        }


    } elseif(is_array($rs_m_auth)) {
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

$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_UPDATESTATE_LOWTH'";
$rs_d =  executeQuery($sql_cata, $cnx_rp);

$url_d = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
$dns_d = $url_d;


$aVars = array(
    "idProcess" => $id_proceso,
    "idPvCero" => $id_pev_cero,
    "processType" => $tipo_proceso,
    "stateCod" => $cod_estado,
    "observation" => $comentario
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
        "Authorization: Bearer " . $token
    )
);

// echo 'Enviando solicitud al servicio...';
// echo 'URL: '.$dns_d;
// echo '<br> Payload: '.$json;
// echo '<br> Token: '.$token;
// echo '<br> -----------------------------<br>';

$res = curl_exec($ch);

echo 'Respuesta del servicio: '.$res;

if(curl_errno($ch)){
    $msg_m = curl_error($ch);
}
curl_close($ch);

$rs_m = json_decode($res);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'AEP-PR-160',
    $dns_d,
    'POST',
    'Authorization: Bearer',
    $json,
    $res,
    $msg_m
);



if(is_array($rs_m)){
    foreach($rs_m as $data){
        if($data->sn_proceso == '-1'){
            @@tri_mes_UpdatePR = utf8_encode($data->motivo_proceso);
        }else{
            @@tri_mes_UpdatePR = utf8_encode($data->motivo_proceso);
        }
    }
}else{
    @@tri_mes_UpdatePR = $msg_m;
}
}
catch(Exception $e)
{
    @@tri_mes_UpdatePR = 'Excepción capturada: '.utf8_encode($e->getMessage());
}

