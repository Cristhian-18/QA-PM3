<?php
//created by Henry
//11-1-2021
//Consulta Beneficiarios Poliza
try{

    @@__ERROR__ = '';
    $cnx_rp = '11264850561d723f004d5c2072943786';
    $pro_uid = @@PROCESS;

    $frm_id_cns = @@frm_id_cns;
    $frm_id_pv = @@frm_id_pv;
    $frm_id_pv_cero = @@frm_id_pv_cero;
    $frm_cod_tercero = @@frm_cod_tercero;
    $frm_cod_aseg = @@frm_cod_aseg;
    $frm_nro_aseg = @@frm_nro_aseg;
    $frm_nro_pariente = @@frm_nro_pariente;
    $frm_fec_ocurrencia = @@frm_fecha_ocurrencia;
    $frm_sn_contingente = ($frm_sn_contingente == '' ? 1 : 0);

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
$msg_m_auth = curl_error($ch_auth);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'CBP-S-50', $dns_auth, 'POST', '',  $json_auth, $res_auth, $msg_m_auth);


if(curl_errno($ch_auth)){
    $msg_m_auth = curl_error($ch_auth);
    //tarea 2
    if(@@TASK == '309930261615f607b901f74034966395'){
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '19704822661d89a84dc5eb6067966042');
    }
    else{
        //tarea 4
        if(@@TASK == '359772973624db81b5141e6050784057'){
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '669886330625d96ef6d7cd1073394695');
        }else{
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '76587094661da3be8a7b6b9083070571');
        }
    }
}
curl_close($ch_auth);
$rs_m_auth = json_decode($res_auth, true);



$token='';
try
{
    if(count($rs_m_auth) > 0 && !empty($rs_m_auth)){
        foreach($rs_m_auth as $key => $data_auth){
            if($key == 'Token'){
                $token = $data_auth;
            }
        }
    }
}
catch(Exception $e)
{
    //tarea 2
    if(@@TASK == '309930261615f607b901f74034966395'){
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '19704822661d89a84dc5eb6067966042');
    }
    else{
        //tarea 4
        if(@@TASK == '359772973624db81b5141e6050784057'){
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '669886330625d96ef6d7cd1073394695');
        }else{
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '76587094661da3be8a7b6b9083070571');
        }
    }
}

$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'SERVICIOS_WEB_S' AND CODIGO = 'CONSULTA_BENEFICIARIOS'";
$rs =  executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
$dns = $url;

$aVars = array(
    "frm_id_cns" => $frm_id_cns,
    "frm_id_pv_cero" => $frm_id_pv_cero,
    "frm_id_pv" => $frm_id_pv,
    "frm_cod_tercero" => $frm_cod_tercero,
    "frm_cod_aseg" => $frm_cod_aseg,
    "frm_nro_aseg" => $frm_nro_aseg,
    "frm_nro_pariente" => $frm_nro_pariente,
    "frm_fec_ocurrencia" => $frm_fec_ocurrencia,
    "frm_sn_contingente" => $frm_sn_contingente
);
$json = json_encode($aVars);

//print_r($json);
try{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $dns);
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

$result = json_decode($res);
 
PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'CBP-S-141', $dns, 'POST', 'Authorization', $json, $result, $msg_m);

}catch(Exception $e)
{
     
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'ExcepciÃƒÂ³n capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
    return $result;
}
$i=1;

$array_bene = array();
foreach($result->consulta6 as $databen){
    $array_bene[$i]['cod_leyenda'] = $databen->cod_leyenda;
    $array_bene[$i]['cod_parentesco'] = $databen->cod_parentesco;
    $array_bene[$i]['cod_tercero'] = $databen->cod_tercero;
    $array_bene[$i]['cod_tipo_doc'] = $databen->cod_tipo_doc;
    $array_bene[$i]['cod_tipo_persona'] = $databen->cod_tipo_persona;
    $array_bene[$i]['id_cns'] = $databen->id_cns;
    $array_bene[$i]['id_persona'] = $databen->id_persona;
    $array_bene[$i]['id_pv_cero'] = $databen->id_pv_cero;
    $array_bene[$i]['id_ws_stro_benf'] = $databen->id_ws_stro_benf;
    $array_bene[$i]['grd_ben_nro_aseg'] = $databen->nro_aseg;
    $array_bene[$i]['nro_beneficiario'] = $databen->nro_beneficiario;
    $array_bene[$i]['nro_pariente'] = $databen->nro_pariente;
    $array_bene[$i]['pje_partic'] = $databen->pje_partic;
    $array_bene[$i]['txt_apellido1'] = $databen->txt_apellido1;
    $array_bene[$i]['txt_apellido2'] = $databen->txt_apellido2;
    $array_bene[$i]['txt_documento'] = $databen->txt_documento;
    $array_bene[$i]['txt_nombre'] = $databen->txt_nombre;

    $i++;
}

@=grd_beneficiarios = $array_bene;


} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
