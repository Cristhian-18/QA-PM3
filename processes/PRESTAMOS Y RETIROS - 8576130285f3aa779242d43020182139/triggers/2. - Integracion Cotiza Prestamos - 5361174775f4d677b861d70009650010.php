<?php
//<?php
$cnx = '1471226895f49403bebfa26089899906';
$pro_uid = @@PROCESS;
@@tri_mes_CotizaPR = '';

// ============================================================
// OBTENER TOKEN
// ============================================================
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_CU_GEN_TOKEN_AUTH'";
$rs_auth = executeQuery($sql_cata_auth);
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
curl_setopt($ch_auth, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Accept-Language: application/json"
));
$res_auth = curl_exec($ch_auth);
$msg_m_auth = curl_errno($ch_auth) ? curl_error($ch_auth) : '';
curl_close($ch_auth);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger o form', 'Integracion cotiza Prestamos', $dns_auth, 'POST', 'NO', $json_auth, $res_auth, $msg_m_auth);

$rs_m_auth = json_decode($res_auth, true);
$rs_m_auth = is_array($rs_m_auth) ? $rs_m_auth : array();

// PATCH — detectar error en respuesta de auth
if (!empty($rs_m_auth['type']) || (isset($rs_m_auth['code']) && $rs_m_auth['code'] != 200 && !empty($rs_m_auth['code']))) {
    $mensaje_error_auth = isset($rs_m_auth['message']) ? $rs_m_auth['message'] : 'Error desconocido en auth';
    @@tri_mes_CotizaPR = 'Error auth: ' . $mensaje_error_auth;
    @@tri_ban_spc2     = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
}

$token = '';
try {
    foreach ($rs_m_auth as $key => $data_auth) {
        if ($key == 'Token') {
            $token = $data_auth;
        }
    }
} catch (Exception $e) {
    $error = utf8_encode($e->getMessage());
    @@tri_mes_CotizaPR = 'Excepción capturada: ' . $error;
    @@tri_ban_spc2 = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
}

//print_r($this->caseData);
//die();
// ============================================================
// ASIGNACIÓN DE VARIABLES
// ============================================================
// Leer variables del caso de forma segura
$id_pv_cero_string = @@id_pev_cero;
$frm_monto_prestamo_string = @@frm_monto_prestamo;
$frm_plazo_prestamo_string = @@frm_plazo_prestamo;
$frm_frecuencia_pago_string = @@frm_frecuencia_pago;
$frm_entidad_financiera_receptor_string = @@frm_entidad_financiera_receptor;
$frm_medio_pago_receptor_string = @@frm_medio_pago_receptor;
$frm_entidad_financiera_string = @@frm_entidad_financiera ?? 0;
$frm_medio_pago_string = @@frm_medio_pago ?? 0;
$nro_cta_debitar_string = @@frm_numero_cuenta;
$chk_vencimiento_label_string = @@chk_vencimiento_label;

// Si el usuario no creó cuenta nueva, frm_entidad_financiera queda vacío.
// En ese caso se toma el primer registro de grd_ctas_debito que tenga grd_selecc activo.
if (empty($frm_entidad_financiera_string) || (int)$frm_entidad_financiera_string === 0) {
    $grd = @@grd_ctas_debito;
    if (is_array($grd)) {
        foreach ($grd as $fila) {
            $selecc = isset($fila['grd_selecc']) ? $fila['grd_selecc'] : '0';
            if ($selecc == '1' || $selecc === 1) {
                $frm_entidad_financiera_string = isset($fila['grd_entidad_financiera']) ? $fila['grd_entidad_financiera'] : 0;
                $frm_medio_pago_string         = isset($fila['grd_medio_pago']) ? $fila['grd_medio_pago'] : 0;
                $nro_cta_debitar_string        = isset($fila['grd_numero_cuenta']) ? $fila['grd_numero_cuenta'] : '';
                break;
            }
        }
    }
}

$id_pv_cero = (int)$id_pv_cero_string;
$id_proceso = 0;
$tipo_movimiento = 2;
$TipoOperacion = 0;
$imp_monto_solicitar = (int)$frm_monto_prestamo_string;
$nro_cuotas = (int)$frm_plazo_prestamo_string ;
$cod_frecuencia_pago = (int)$frm_frecuencia_pago_string;
$fec_pago = date('Y-m-d');
$tipo_identificacion = @@frm_tipo_identificacion_receptor;
$nro_identificacion = @@frm_cedula_receptor;
$cod_banco_acreditar = (int)$frm_entidad_financiera_receptor_string;
$cod_tipo_cta_acreditar = (int)$frm_medio_pago_receptor_string;
$nro_cta_acreditar = @@frm_numero_cuenta_receptor;
$sn_transferencia = -1;
$email_contratante = @@frm_correo_electronico_receptor;
$cod_banco_debitar    = (int)$frm_entidad_financiera_string;
$cod_tipo_cta_debitar = (int)$frm_medio_pago_string;
$nro_cta_debitar      = $nro_cta_debitar_string;
$telef_celular = @@frm_celular_receptor;
$tipo_identific_deb = @@frm_tipo_identificacion_pagador;
$nro_identific_deb = @@frm_cedula_pagador;
$chk_vencimiento =  (int)$chk_vencimiento_label_string;
$repLegalItendificationType = @@frm_tipo_identificacion_juridico;
$repLegalIdentification = @@frm_numero_identificacion_juridico;
$lastnameRepLegal = @@frm_apellido_paterno;
$secondLastnameRepLegal = @@frm_apellido_materno;
$nameRepLegal = @@frm_primer_nombre;
$sourceType = 2;

// ============================================================
// LLAMADA A QUOTELOAN
// ============================================================
$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_QUOTELOAN'";
$rs_d = executeQuery($sql_cata);
$url_d = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
$dns_d = $url_d;

$aVars = array(
    "idPevCero"                  => $id_pv_cero,
    "process"                    => $id_proceso,
    "movType"                    => $tipo_movimiento,
    "operationType"              => $TipoOperacion,
    "requestAmount"              => $imp_monto_solicitar,
    "nroFees"                    => $nro_cuotas,
    "paymentFrequency"           => $cod_frecuencia_pago,
    "paymentDate"                => $fec_pago,
    "identificationType"         => $tipo_identificacion,
    "identification"             => $nro_identificacion,
    "codBankToCredit"            => $cod_banco_acreditar,
    "codBankAccountTypeToCredit" => $cod_tipo_cta_acreditar,
    "nroAccountToCredit"         => $nro_cta_acreditar,
    "transfer"                   => $sn_transferencia,
    "contractingEmail"           => $email_contratante,
    "codDebitBanck"              => $cod_banco_debitar,
    "codAccountDebitType"        => $cod_tipo_cta_debitar,
    "nroDebitAccount"            => $nro_cta_debitar,
    "cellphone"                  => $telef_celular,
    "identificationTypeDeb"      => $tipo_identific_deb,
    "nroIdentificationDeb"       => $nro_identific_deb,
    "expirationSN"               => $chk_vencimiento,
    "repLegalItendificationType" => $repLegalItendificationType,
    "repLegalIdentification"     => $repLegalIdentification,
    "lastnameRepLegal"           => $lastnameRepLegal,
    "secondLastnameRepLegal"     => $secondLastnameRepLegal,
    "nameRepLegal"               => $nameRepLegal,
    "sourceType"                 => $sourceType
);

$json = json_encode($aVars);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $dns_d);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Accept-Language: application/json",
    "Authorization: Bearer " . $token
));
$res = curl_exec($ch);
$msg_m = curl_errno($ch) ? curl_error($ch) : '';
curl_close($ch);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger o form', 'Integracion cotiza Prestamos', $dns_d, 'POST', 'NO', $json, $res, $msg_m);

$res_quoteloan_raw = $res; // guardar para debug antes de que $res se sobreescriba

$rs_m = json_decode($res, true);
$rs_m = is_array($rs_m) ? $rs_m : array();

// PATCH — detectar respuesta de error del API (ej: SqlNullValueException, 500, etc.)
if (!empty($rs_m['type']) || (isset($rs_m['code']) && $rs_m['code'] != 200 && !empty($rs_m['code']))) {
    $mensaje_error = isset($rs_m['message']) ? $rs_m['message'] : 'Error desconocido en quoteLoan';
    @@tri_mes_CotizaPR = 'Error servicio: ' . $mensaje_error;
    @@tri_ban_spc2     = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
}

try {
    if (!empty($rs_m)) {
        foreach ($rs_m as $data) {
            if ($data['proceso'] == '-1') {
                $id_proceso_prestamo  = $data['idProcesoPrestamo'];
                @@id_proceso_prestamo = $id_proceso_prestamo;
                @@frm_proceso_id      = $id_proceso_prestamo;
                $tipo = 1;

                try {
                    $sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_GET_LOANFEE'";
                    $rs  = executeQuery($sql_cata);
                    $url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
                    $dns = $url . $id_proceso_prestamo . PATH_SEP . $id_pv_cero . PATH_SEP . $tipo;

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $dns);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $res = curl_exec($ch);
                    $err = curl_error($ch);
                    curl_close($ch);

                    PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'Consulta tabla amortización', $dns, 'POST', 'NO', 'NO', $res, $err);

                    $rs_p = json_decode($res, true);  // true => array asociativo
                    $rs_p = is_array($rs_p) ? $rs_p : array();
					$rs_p = [
						[
							"numeroCuota" => 99.00,
							"importeCapital" => 0.00,
							"importeCuota" => 0.00,
							"importeInteres" => 0.00,
							"estado" => "PENDIENTE",
							"fechaVencimiento" => "1900-01-01T00:00:00",
							"importeSaldo" => 0.00
						]
					];


                    // PATCH — detectar error en respuesta de amortización
                    if (!empty($rs_p['type']) || (isset($rs_p['code']) && $rs_p['code'] != 200 && !empty($rs_p['code']))) {
                        $mensaje_error_p = isset($rs_p['message']) ? $rs_p['message'] : 'Error desconocido en getLoanFee';
                        @@tri_mes_CotizaPR = 'Error tabla amortización: ' . $mensaje_error_p;
                        @@tri_ban_spc2     = '';
                        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
                    }


                    @@tri_table_amor_n = $rs_p;
                    @@motivo_proceso   = 'EJECUCION EXITOSA';
                    @@tri_ban_spc2     = 'true';


                } catch (Exception $e) {
                    $error = utf8_encode($e->getMessage());
                    @@tri_mes_CotizaPR = 'Excepción capturada: ' . $error;
                    @@tri_ban_spc2     = '';
                    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
                }


            } else {
                @@tri_mes_CotizaPR = isset($data['motivoProceso']) ? $data['motivoProceso'] : 'Error sin motivo';
                @@tri_ban_spc2     = '';
                PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
            }

        }
    } else {
        @@tri_mes_CotizaPR = !empty($msg_m) ? $msg_m : 'Respuesta vacía del servicio quoteLoan';
        @@tri_ban_spc2     = '';
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
    }

} catch (Exception $e) {
    $error = utf8_encode($e->getMessage());
    @@tri_mes_CotizaPR = 'Excepción capturada: ' . $error;
    @@tri_ban_spc2     = '';
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');
}


