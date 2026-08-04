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
switch(@@TASK){
    //tarae 1
    case '3344220625f3aa7f69c4e00045814586':
    $cod_estado = '1'; //INGRESO MANUAL
    $comentario = 'INGRESO MANUAL';
    break;
    //tarea 2
    case '9666398235f3aa81e583733020266160':
    if(@@frm_respuesta_cliente == 'Acepto'){
        $cod_estado = '2'; //EN PROCESO
        $comentario = @@frm_respuesta_cliente;
    }else{
        $cod_estado = '5';//CANCELADA
        $comentario = @@frm_respuesta_cliente;
    }
    break;
    //tarea 3
    case '8760052855f3aa896a9a815031066895':
    if(@@cmb_accion_t3 == 'A')
    $cod_estado = '6'; //AUTORIZADA POR EL GESTOR
    else
    $cod_estado = '7';//NEGADO

    $comentario = @@frm_comentario;
    break;
    //tarea 4
    case '5567842745f3aa9ae5c6848018455054':
    $cod_estado = '7';//NEGADO
    $comentario = @@frm_comentario_t4;
    break;
    //tarea 5
    case '8163617725f3aa929732d82091255154':
    if(@@cmb_accion_t5 == 'A')
    $cod_estado = '3'; //AUTORIZADA
    else
    $cod_estado = '7';//NEGADO

    $comentario = @@frm_comentario_t5;
    break;
    //tarea 6
    case '4953250045f4ad54e93c1e8067311607':
    $cod_estado = '3'; //AUTORIZADA
    $comentario = @@frm_comentario_t6;
    break;
    //tarea 6.1
    case '1544916375f3aaa4eaec343054838090':
    if(@@cmb_accion_t6_1 == 'A')
    $cod_estado = '4'; //TRANSFERIDA
    else
    $cod_estado = '7';//NEGADO

    $comentario = @@frm_comentario_t6_1;
    break;
    //tarea 4 RETENCION
    case '42776573267ad7009927e90081631510':
    if(@@cmb_accion_t4_1== 'AC' || @@cmb_accion_t4_1== 'AD'){
        $cod_estado = '2'; //PROCESO
        $comentario = @@frm_comentario_t4_1;
    }else{
        $cod_estado = '7';//NEGADO
        $comentario = @@frm_comentario_t4_1;
    }
    break;
    default:
    $comentario = '--';
    break;
}

@@cod_estado = $cod_estado;

//$sql = "EXECUTE dbo.spc_PC_act_EstadoPortal $id_proceso,$id_pev_cero,$tipo_proceso, $cod_estado, '$comentario'";
//$rs = executeQuery($sql, $cnx);

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
'AEP-PR-136',
$url,
'POST', 'NO',
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
    @@tri_mes_UpdatePR = 'Excepción capturada: '.utf8_encode($e->getMessage());
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
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
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
'AEP-PR-202',
$dns_d,
'POST', 'Si',
json_encode($json),
json_encode($rs_m),
json_encode($msg_m));

if( !empty($rs_m)){
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
