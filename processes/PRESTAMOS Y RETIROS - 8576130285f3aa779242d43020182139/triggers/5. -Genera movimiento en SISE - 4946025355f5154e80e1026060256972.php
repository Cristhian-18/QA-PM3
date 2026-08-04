<?php
//created by Henry
//29-08-2020 cambio max
//Actualiza Codigo BPM
@@__ERROR__ = '';
$cnx = '1471226895f49403bebfa26089899906';
$cnx_rp = '4647520625f3ca6ed2d2621030136501';
$pro_uid = @@PROCESS;

//obtengo el token
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_CU_GEN_TOKEN_AUTH'";
$rs_auth =  executeQuery($sql_cata_auth);

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

PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'Genera movimiento en SISE', $dns_auth, 'POST', 'NO', $json_auth, $res_auth, $msg_m_auth);



$token='';
try
{
    if(is_object($rs_m_auth) && isset($rs_m_auth->Token)){
        foreach($rs_m_auth as $key => $data_auth){
            if($key == 'Token'){
                $token = $data_auth;
            }
        }
    }
}
catch(Exception $e)
{
    $msg = 'Excepción capturada: '.$e->getMessage()."\n";


    @@tri_mes_GrabarMovPR = limpiarCadena($msg);
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2693844245f3ebe2a4d1241089536305');
}



$id_pv_cero = @@id_pev_cero;
//$id_proceso = (@@frm_proceso_id == '' ? @@id_proceso : @@frm_proceso_id);
if(@@frm_tipo_solicitud == 'P')
$id_proceso = (@@id_proceso == '' ? @@id_proceso_prestamo : @@id_proceso);
if(@@frm_tipo_solicitud == 'R')
$id_proceso = (@@id_proceso == '' ? @@id_proceso_retiro : @@id_proceso);


if(@@tri_ban_portal == 'SI'){
    $cod_usuario_fun = 'user_portal';
}else{
    $cod_usuario_fun = @@cod_usuario_fun;
}
$cod_usuario_pda = @@tri_user_emision;

if(@@frm_tipo_solicitud == 'P')
{
    //$sql = "EXECUTE dbo.spc_PC_Grabar_Prestamos $id_pv_cero, $id_proceso, '$cod_usuario_fun', '$cod_usuario_pda'";
    //$rs = executeQuery($sql, $cnx);
    $sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_SAVE_LOAN'";
    $rs_d =  executeQuery($sql_cata, $cnx_rp);

    $url_d = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
    $dns_d = $url_d;

    $aVars = array(
        "idPvCero" => $id_pv_cero,
        "idProcess" => $id_proceso,
        "funUser" => $cod_usuario_fun,
        "pdaUser" => $cod_usuario_pda
    );
    $json = json_encode($aVars);

    //print_r($json);
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
        $msg = curl_error($ch);

    }
    curl_close($ch);

     PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        '5. Genera movimiento en SISE 136',
        $dns_d,
        'POST',
        'Authorization: Bearer ',
        $json,
        $res,
        $msg
    );

    $rs = json_decode($res, true);


    print_r($rs);


    if( !empty($rs) && count($rs) > 0){
        foreach($rs as $data){
            if($data['process'] == '-1' || $data['process'] == '2'){
                @@motivo_proceso = $data['processReason'];
                @@tri_ban_spc6 = 'true';
            }else{
                //aqui redirect al caso
                @@tri_mes_GrabarMovPR = $data['processReason'];
                PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2693844245f3ebe2a4d1241089536305');
            }
        }
    }
    else{
        //aqui redirect al caso
        @@tri_mes_GrabarMovPR = "ERROR: ".$msg;
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2693844245f3ebe2a4d1241089536305');
    }
} catch(Exception $e)
{
    $msg = 'Excepción capturada: '.$e->getMessage()."\n";
    @@tri_mes_GrabarMovPR = limpiarCadena($msg);
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2693844245f3ebe2a4d1241089536305');
}

}else{
    //$sql = "EXECUTE dbo.spc_PC_Grabar_Retiros $id_pv_cero, $id_proceso, '$cod_usuario_fun', '$cod_usuario_pda'";
    //$rs = executeQuery($sql, $cnx);
    $sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_SAVE_WITDHA'";
    $rs_d =  executeQuery($sql_cata, $cnx_rp);

    $url_d = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
    $dns_d = $url_d;
    //echo '<br>';
    $aVars = array(
        "idPvCero" => $id_pv_cero,
        "idProcess" => $id_proceso,
        "funUser" => $cod_usuario_fun,
        "pdaUser" => $cod_usuario_pda
    );
    $json = json_encode($aVars);
    //print_r($json);
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
    $err = curl_error($ch);
    if(curl_errno($ch)){
        $msg_m = curl_error($ch);

    }
    curl_close($ch);


    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        '5. Genera movimiento en SISE',
        $dns_d,
        'POST',
        'Authorization: Bearer ',
        $json,
        $res,
        $err
    );

    $rs = json_decode($res, true);

    if( !empty($rs) && count($rs) > 0 ){
        foreach($rs as $data){
            if($data['process'] == '-1' || $data['process'] == '2'){
                @@motivo_proceso = $data['processReason'];
                @@tri_ban_spc6 = 'true';
            }else{
                //aqui redirect al caso
                @@tri_mes_GrabarMovPR = $data['processReason'];
                PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2693844245f3ebe2a4d1241089536305');
            }
        }
    }
    else{
        //aqui redirect al caso
        @@tri_mes_GrabarMovPR = "ERROR: ".$msg;
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2693844245f3ebe2a4d1241089536305');
    }
} catch(Exception $e)
{
    $msg = 'Excepción capturada: '.$e->getMessage()."\n";
    @@tri_mes_GrabarMovPR = limpiarCadena($msg);
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '2693844245f3ebe2a4d1241089536305');
}

}
//echo $sql;
