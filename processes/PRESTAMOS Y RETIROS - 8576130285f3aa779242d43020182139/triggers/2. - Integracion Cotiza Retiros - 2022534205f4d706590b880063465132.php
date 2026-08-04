<?php
//created by Henry
//29-08-2020
//Grabar Informacion SISE

$cnx = '1471226895f49403bebfa26089899906';


$pro_uid = @@PROCESS;


@@tri_mes_CotizaPR = '';


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

PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'ICR-PR-63',
$dns_auth,
'POST', 'No',
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
    $error = utf8_encode($e->getMessage());
    @@tri_mes_CotizaPR = 'Excepción capturada: '.$error;


    @@tri_ban_spc2 = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
}

$id_pv_cero = @@id_pev_cero;
$id_proceso = 0;
$tipo_movimiento = 2; //2-Solicitud Aprobado por el Cliente (boton enviar)
$TipoOperacion = 0; //retiro
$imp_monto_solicitar = @@frm_monto;
$imp_valor_rescate = @@imp_valor_rescate ?? 0;
$imp_cargos_x_retiro = @@frm_costo_retiro ?? 0;
$imp_penalidad = @@frm_derecho_retiro ?? 0;
$imp_retiro_bruto = @@frm_val_descontado ?? 0;
//para cta acreditacion
//$tipo_identificacion = (@@frm_tipo_identificacion == 'C' ? 1 : 2);
//$tipo_identificacion = @@frm_tipo_identificacion;
//$nro_identificacion = @@frm_numero_identificacion;
$tipo_identificacion = @@frm_tipo_identificacion_receptor;
$nro_identificacion = @@frm_cedula_receptor;

$cod_banco_acreditar = @@frm_entidad_financiera_receptor;
$cod_tipo_cta_acreditar = @@frm_medio_pago_receptor;
$nro_cta_acreditar = @@frm_numero_cuenta_receptor;
$sn_transferencia = '-1'; //tomando del portal
$email_contratante = @@frm_correo_electronico_receptor;
$telef_celular = @@frm_celular_receptor;
//representante legal
$repLegalItendificationType = @@frm_tipo_identificacion_juridico;
$repLegalIdentification = @@frm_numero_identificacion_juridico;
$lastnameRepLegal = @@frm_apellido_paterno;
$secondLastnameRepLegal = @@frm_apellido_materno;
$nameRepLegal = @@frm_primer_nombre;
$sourceType = 2;
$imp_monto_disp_retiro = @@frm_monto_disponible;
$imp_monto_disp_calc = @@frm_monto_actual;

//volver a consultar una nueva cotizacion
//spc_PC_ConsCotizacion

//$sql = "EXECUTE dbo.spc_PC_CotizaRetiros $id_pv_cero, $id_proceso, $tipo_movimiento, $TipoOperacion, $imp_monto_solicitar, $imp_valor_rescate, $imp_cargos_x_retiro, $imp_penalidad, $imp_retiro_bruto, '$tipo_identificacion', '$nro_identificacion', $cod_banco_acreditar, $cod_tipo_cta_acreditar, $nro_cta_acreditar, $sn_transferencia, '$email_contratante', '$telef_celular'";
//$rs = executeQuery($sql, $cnx);



$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_GET_QUOTEWITHD'";

$rs_d =  executeQuery($sql_cata);

$url_d = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
$dns_d = $url_d;


$aVars = array(
    "idPvCero" => $id_pv_cero,
    "process" => $id_proceso,
    "movType" => $tipo_movimiento,
    "operationType" => $TipoOperacion,
    "requestAmount" => $imp_monto_solicitar,
    "rescueValue" => (float) $imp_valor_rescate,
    "withdrawalFees" => (float)$imp_cargos_x_retiro,
    "penalty" => (float)$imp_penalidad,
    "grossWithdrawal" => (float)$imp_retiro_bruto,
    "identificationType" => $tipo_identificacion,
    "nroIdentification" => $nro_identificacion,
    "codBankToCredit" => $cod_banco_acreditar,
    "codBankAccountTypeToCredit" => $cod_tipo_cta_acreditar,
    "nroAccountToCredit" => $nro_cta_acreditar,
    "transfer" => $sn_transferencia,
    "contractingEmail" => $email_contratante,
    "cellphone" => $telef_celular,
    "repLegalItendificationType" => $repLegalItendificationType,
    "repLegalIdentification" => $repLegalIdentification,
    "lastnameRepLegal" => $lastnameRepLegal,
    "secondLastnameRepLegal" => $secondLastnameRepLegal,
    "nameRepLegal" => $nameRepLegal,
    "sourceType" => $sourceType,
    "amountAvailable" => $imp_monto_disp_retiro,
    "amountAvailable80" => $imp_monto_disp_calc
);
$json = json_encode($aVars);
@@json_prueba = $json;
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

$rs = json_decode($res);

PMFBitacoraServicios(
 @@APP_NUMBER,
'trigger',
'ICR-PR-202',
$dns_d,
'POST', 'Si',
json_encode($json),
json_encode($rs),
json_encode($msg_m));

if( !empty($rs)){
    foreach($rs as $data){
        if($data->proceso == '-1'){
            @@frm_proceso_id = $data->idProcesoRetiro;
            @@id_proceso_retiro = $data->idProcesoRetiro;
            @@tri_mes_CotizaPR = $data->motivoProceso;
            @@tri_ban_spc2 = 'true';
            echo @@tri_mes_CotizaPR . '176';

        }else{
            //aqui redirect al caso
            @@tri_mes_CotizaPR = $data->motivoProceso;
            @@tri_ban_spc2 = '';
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
            echo @@tri_mes_CotizaPR . '183';
        }
    }
}else{
    @@tri_mes_CotizaPR = $msg_m;
    echo @@tri_mes_CotizaPR . '206';


    @@tri_ban_spc2 = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');

}
}
catch(Exception $e)
{

    @@tri_mes_CotizaPR = 'Excepción capturada: '.limpiarCadena($e->getMessage());
    @@tri_ban_spc2 = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
}



