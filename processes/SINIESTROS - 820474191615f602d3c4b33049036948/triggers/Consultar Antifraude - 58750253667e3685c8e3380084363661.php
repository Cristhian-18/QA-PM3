<?php
function getGridValue($gridData, $field, $default = '') {
    if (!is_array($gridData) || empty($gridData)) {
        return $default;
    }

    // Asegurar que el campo tenga el prefijo grd_ si es necesario
    if (strpos($field, 'grd_') !== 0) {
        $field = 'grd_' . $field;
    }

    // Buscar en todas las filas (primera fila por defecto)
    foreach ($gridData as $fila) {
        if (isset($fila[$field])) {
            return $fila[$field];
        }
    }

    return $default;
}

@@__ERROR__ = '';
@@tri_bandera_anf = '';
try{
    $cnx_rp = '11264850561d723f004d5c2072943786';
    $pro_uid = @@PROCESS;

    //header
    $codigoModelo = 'VIDA_SINIESTRO';
    $num_poliza = @@frm_numero_poliza;
    $cont_identificacion = @@frm_numero_identificacion;
    //$cont_identificacion = "0202625430";
    $cod_ramo_comercial = @@frm_ramo;
    $ramo = @@frm_ramo_label;
    $canal_distribucion = "";
    $cod_sucursal = @@frm_sucursal;
    $sucursal = @@frm_sucursal_label;
    $aseg_identificacion= @@frm_numero_identificacion;
    //$aseg_identificacion = "0202625430";
    $aseg_nombres = @@frm_nombres;
    $aseg_apellidos = @@frm_apellido_paterno.' '.@@frm_apellido_materno;
    $fecha_registro_siniestro = @@frm_fecha_notificacion;
    $fecha_ocurrencia_siniestro = @@frm_fecha_ocurrencia;
    $cod_cobertura = @@frm_cobertura_madre;
    $cobertura = @@frm_coberturas;
    $monto_siniestro = @@frm_monto_reportado;
    $num_certificado = "";
    $fecha_emision = "";
    $fecha_ini_vigencia = "";
    $nro_siniestro = @@tri_nro_stro;
    $bpm_app_number = @@APP_NUMBER;
    $bpm_app_uid = @@APPLICATION;
    $suma_asegurada = 0;

    //obtengo el token
    $sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_AF_GEN_TOKEN_AUTH'";
    $rs_auth =  executeQuery($sql_cata_auth, $cnx_rp);

    $url_auth = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
    $dns_auth = $url_auth;

    $sql_cata_auth_crede = "SELECT DESCRIPCION, VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN_AF'";
    $rs_auth_cred =  executeQuery($sql_cata_auth_crede, $cnx_rp);
    $usr_auth = $rs_auth_cred['1']['DESCRIPCION'];
    $usr_pass = $rs_auth_cred['1']['VALOR'];

    $aVars_auth = array(
        "email" => $usr_auth,
        "password" => $usr_pass
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
$rs_m_auth = json_decode($res_auth, true);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'CA-S-96', $dns_auth, 'POST', '',  $json_auth, $res_auth, $msg_m_auth);


$token='';
try
{
    if(count($rs_m_auth) > 0 && !empty($rs_m_auth)){
        foreach($rs_m_auth as $key => $data_auth){
            if($key == 'token'){
                $token = $data_auth;
            }
        }
    }
}
catch(Exception $e)
{
    $msg_m_auth = curl_error($ch_auth);
}

$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND COD_CATALOGO = 'SERVICIOS_WEB_S' AND CODIGO = 'CONSULTA_ANTIFRAUDE'";
$rs =  executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
$dns = $url;

$antifra = array("codigoModelo" => $codigoModelo);
$lstCoberturas = array();
/*
if (isset(@@grd_coberturas) && is_array(@@grd_coberturas)) {
    foreach (@@grd_coberturas as $fila) {
        if (isset($fila[grd_txt_aplicar]) && strtoupper(trim($fila[grd_txt_aplicar])) === "SI") {
            die("hasta aqui");
            $lstCoberturas[] = array(
                "cobertura" => isset($fila["grd_txt_desc_riesgo"]) ? $fila["grd_txt_desc_riesgo"] : "",
                "cod_cobertura" => isset($fila["grd_cod_cobertura"]) ? (int)$fila["grd_cod_cobertura"] : 0,
                "suma_asegurada" => isset($fila["grd_imp_suma_aseg"]) ? (float)$fila["grd_imp_suma_aseg"] : 0,
                "monto_siniestro" => isset($fila["grd_txt_valor"]) ? (float)$fila["grd_txt_valor"] : 0
            );
        }
    }
}*/

if (isset(@@grd_coberturas) && is_array(@@grd_coberturas)) {
    foreach (@@grd_coberturas as $fila) {
        $aplicar = isset($fila['grd_txt_aplicar']) ? $fila['grd_txt_aplicar'] : '';

        if (strtoupper(trim($aplicar)) === "SI") {
            $lstCoberturas[] = array(
                "cobertura" => getGridValue(@@grd_coberturas, 'txt_desc_riesgo'),
                "cod_cobertura" => (int)getGridValue(@@grd_coberturas, 'cod_cobertura', 0),
                "suma_asegurada" => (float)getGridValue(@@grd_coberturas, 'imp_suma_aseg', 0),
                "monto_siniestro" => (float)getGridValue(@@grd_coberturas, 'txt_valor', 0)
            );
        }
    }
}

$antifra['siniestrosVida'] = array("num_poliza" => $num_poliza,
"cont_identificacion" => $cont_identificacion,
"cod_ramo_comercial" => $cod_ramo_comercial,
"ramo" => $ramo,
"canal_distribucion" => $canal_distribucion,
"cod_sucursal" => $cod_sucursal,
"sucursal" => $sucursal,
"aseg_identificacion" => $aseg_identificacion,
"aseg_nombres" => $aseg_nombres,
"aseg_apellidos" => $aseg_apellidos,
"fecha_registro_siniestro" => $fecha_registro_siniestro,
"fecha_ocurrencia_siniestro" => $fecha_ocurrencia_siniestro,
"cod_cobertura" => $cod_cobertura,
"num_certificado" => $num_certificado,
"fecha_emision" => $fecha_emision,
"fecha_ini_vigencia" => $fecha_ini_vigencia,
"nro_siniestro" => (string)$nro_siniestro,
"bpm_app_number" => $bpm_app_number,
"bpm_app_uid" => $bpm_app_uid,
"coberturas" => $lstCoberturas);
$json_stro = json_encode($antifra);
@@send_json_af = $json_stro;

try{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $dns);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_stro);
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

$result = json_decode($res, true);
 
PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'CA-S-204', $dns, 'POST', 'Authorization', $json_stro,  $result, $msg_m);


@@result_af = $result;


if($result->codigo == 0)
{

    @@tri_af_puntaje = $result->puntaje;
    @@tri_af_codigoAlerta = $result->codigoAlerta;
    @@tri_af_descripcion = $result->descripcion;
    @@tri_bandera_anf = 'true';

    if(isset($result['indicador']) && is_array($result['indicador']) && count($result['indicador']) > 0){
        $arr_grid_indicador = array();
        $aux_i = 1;
        $result_indicador = $result->indicador;
        foreach($result_indicador as $data_indicador){
            $arr_grid_indicador[$aux_i]['descripcionArgumentation'] = $data_indicador->descripcionArgumentation;
            $arr_grid_indicador[$aux_i]['argumentationId'] = $data_indicador->argumentationId;
            $arr_grid_indicador[$aux_i]['id'] = $data_indicador->id;
            $arr_grid_indicador[$aux_i]['name'] = $data_indicador->name;
            $arr_grid_indicador[$aux_i]['value'] = $data_indicador->value;
            $aux_i = $aux_i + 1;
        }
    }
}else{
    @@tri_message_update = $result->mensaje.' - ERROR';
}

}catch(Exception $e)
{
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    @@tri_message_update = 'ExcepciÃƒÂ³n capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
}

@@grd_antifraude = $arr_grid_indicador;
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

}
