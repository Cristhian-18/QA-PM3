<?php
//created by Henry
//28-08-2020
//spc_PC_informacion_BPM consumo

$cnx = '8482936745f9583f22269b8093624807';
$cnx_rp = '9690765645f958391b6c2e8035729611';
$pro_uid = @@PROCESS;

@@tri_mes_infoBpm = '';

$id_pev_cero = @@id_pev_cero;
$id_proceso = @@id_proceso;
$tipo_proceso = @@tipo_proceso;

@@id_pv_cero = @@id_pev_cero;
@@id_pv = @@id_proceso;

@@tri_ban_portal = 'true';
@@tri_error_bndportal = '';

@@frm_concepto_debito = ($tipo_proceso == 1 ? 'POLIZA' : 'PRESTAMO');
@@frm_concepto_debito_label = ($tipo_proceso == 1 ? 'POLIZA' : 'PRESTAMO');

$sql_cata = "SELECT DESCRIPCION, VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_GET_INFOCONDUIT'";
$rs = executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
$apiKey = isset($rs['1']['VALOR']) ? $rs['1']['VALOR'] : '';

$body = array(
    "codigoScript" => "PIPECONTRACTOR_INFORMATIONCONDUCTO",
    "codigoAplicacion" => "BPM_LURANA",
    "parametros" => array(
        "id_proceso" => (float) $id_proceso,
        "id_pv_cero" => (int) $id_pev_cero,
        "tipo" => (int) $tipo_proceso
    )
);
$json_body = json_encode($body);

$headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "ApiKey: $apiKey"
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_body);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, false);
$res = curl_exec($ch);
$curl_error = curl_errno($ch) ? curl_error($ch) : '';
curl_close($ch);

$result = array();
$rs = json_decode($res);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'Consulta informacion portal 1', $url, 'POST', 'NO', $json_body, $res, $curl_error);

try
{
    if ($curl_error !== '') {
        // Error nuestro - fallo de comunicacion
        @@tri_mes_infoBpm = 'Error de servicio de consulta.';
        @@tri_error_bndportal = 'true';

    } elseif (!isset($rs->exitoso)) {
        // Error nuestro - formato inesperado
        @@tri_mes_infoBpm = 'Error de servicio de consulta.';
        @@tri_error_bndportal = 'true';

    } elseif ($rs->exitoso !== true) {
        // Error de ELLOS - se muestra el mensaje que envia el servicio
        @@tri_mes_infoBpm = !empty($rs->errores)
            ? implode(' | ', (array) $rs->errores)
            : (isset($rs->mensaje) ? $rs->mensaje : 'No existe datos en la consulta');
        @@tri_error_bndportal = 'true';

    } elseif (!empty($rs->datos) && is_array($rs->datos) && count($rs->datos) > 0) {
        foreach ($rs->datos as $dataportal) {
            //seccion poliza y prestamo
            @@insuredCode = $dataportal->securedCodeCont;
            @@insuredPaymentCode = $dataportal->securedCodePag;

            @@frm_tipo_identificacion_poliza = $dataportal->contractorIdentificationType;
            @@frm_identificacion_poliza = $dataportal->identificationContractor;
            @@frm_nombres_poliza = $dataportal->nameContractor;
            @@frm_apellidos_poliza = $dataportal->lastnameContractor . ' ' . $dataportal->secondLastnameContractor;
            @@frm_celular_poliza = $dataportal->cellPhone;
            @@frm_correo_electronico_poliza = $dataportal->email;
            //@@frm_correo_electronico_poliza = 'hbautista@segurosequinoccial.com';
            @@frm_sucursal = $dataportal->branchOfficeCode;

            $frm_sucursal = $dataportal->branchOfficeCode;
            //ciudad
            $sql_c = "SELECT CODIGO, DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'SUCURSALES_PR' AND CODIGO = '$frm_sucursal'";
            $rs_c = executeQuery($sql_c, $cnx_rp);
            @@frm_sucursal_label = $rs_c['1']['DESCRIPCION'];

            @@frm_contratante = @@frm_concepto_debito . '' . $dataportal->policyNumber;
            @@frm_contratante_label = @@frm_concepto_debito . ' - ' . $dataportal->policyNumber;
            @@frm_ramo = $dataportal->ramoCode;
            //seccion datos pagador
            @@frm_tipo_identificacion_pagador = $dataportal->payerIdentificationType;
            @@frm_cedula_pagador = $dataportal->payerIdentification;
            @@frm_nombre_pagador = $dataportal->namePayer;
            @@frm_apellidos_pagador = $dataportal->lastnamePayer;
            @@frm_apellidos_pagador_m = $dataportal->secondLastnamePayer;
            @@frm_celular_debito = $dataportal->payerCellphone;
            @@frm_correo_electronico_debito = $dataportal->payerEmail;
            //@@frm_correo_electronico_debito = 'hbautista@segurosequinoccial.com';
            @@conduitType = $dataportal->conduitType;
            if ($dataportal->conduitType == '2') {
                @@frm_medio_pago = 'TARJETA';
                @@frm_medio_pago_label = 'TARJETA';
                @@frm_fecha_caducidad_tarjeta = $dataportal->expirationCard;
                $frm_entidad_financiera = $dataportal->bankCodeConduit;
                @@frm_tipo_tarjeta = $dataportal->bankCodeConduit;

                //tipo tarjeta
                try
                {
                    $sql_cata = "SELECT DESCRIPCION, VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_GET_BANKS'";
                    $rs_bancos = executeQuery($sql_cata, $cnx_rp);
                    $url_bancos = isset($rs_bancos['1']['DESCRIPCION']) ? $rs_bancos['1']['DESCRIPCION'] : '';
                    $apiKey_bancos = isset($rs_bancos['1']['VALOR']) ? $rs_bancos['1']['VALOR'] : '';

                    if ($dataportal->ramoCode == 60 || $dataportal->ramoCode == 61) {
                        $sntiporamo = 1;
                    } else {
                        $sntiporamo = 2;
                    }
                    $type_pp = ($tipo_proceso == 1 ? -1 : 0);

                    $body_bancos = array(
                        "codigoScript" => "PIPECONTRACTOR_CREDITCARD",
                        "codigoAplicacion" => "BPM_LURANA",
                        "parametros" => array(
                            "sn_banco" => 0,
                            "sn_tiporamo" => $sntiporamo,
                            "sn_poliza" => $type_pp,
                            "sn_portal" => 1
                        )
                    );
                    $json_body_bancos = json_encode($body_bancos);

                    $headers_bancos = array(
                        "Accept: application/json",
                        "Content-Type: application/json",
                        "ApiKey: $apiKey_bancos"
                    );

                    $ch_bancos = curl_init();
                    curl_setopt($ch_bancos, CURLOPT_URL, $url_bancos);
                    curl_setopt($ch_bancos, CURLOPT_POST, true);
                    curl_setopt($ch_bancos, CURLOPT_POSTFIELDS, $json_body_bancos);
                    curl_setopt($ch_bancos, CURLOPT_HTTPHEADER, $headers_bancos);
                    curl_setopt($ch_bancos, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch_bancos, CURLOPT_FAILONERROR, false);
                    $res_bancos = curl_exec($ch_bancos);
                    $curl_error_bancos = curl_errno($ch_bancos) ? curl_error($ch_bancos) : '';
                    curl_close($ch_bancos);

                    PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'Consulta informacion portal', $url_bancos, 'POST', 'NO', $json_body_bancos, $res_bancos, $curl_error_bancos);

                    if ($curl_error_bancos !== '') {
                        @@tri_mes_infoBpm = 'Error de servicio de consulta.';
                        @@tri_error_bndportal = 'true';
                    } else {
                        $rs_bancos_resp = json_decode($res_bancos);

                        if (!isset($rs_bancos_resp->exitoso)) {
                            @@tri_mes_infoBpm = 'Error de servicio de consulta.';
                            @@tri_error_bndportal = 'true';

                        } elseif ($rs_bancos_resp->exitoso !== true) {
                            @@tri_mes_infoBpm = !empty($rs_bancos_resp->errores)
                                ? implode(' | ', (array) $rs_bancos_resp->errores)
                                : (isset($rs_bancos_resp->mensaje) ? $rs_bancos_resp->mensaje : 'no hay datos');
                            @@tri_error_bndportal = 'true';

                        } elseif (!empty($rs_bancos_resp->datos) && is_array($rs_bancos_resp->datos) && count($rs_bancos_resp->datos) > 0) {
                            foreach ($rs_bancos_resp->datos as $databan) {
                                if ($dataportal->bankCodeConduit == $databan->cod_entidad) {
                                    @@frm_tipo_tarjeta_label = $databan->txt_desc;
                                }
                            }
                        } else {
                            @@tri_mes_infoBpm = 'no hay datos';
                            @@tri_error_bndportal = 'true';
                        }
                    }

                } catch (Exception $e)
                {
                    @@tri_mes_infoBpm = 'Excepción capturada: ' . utf8_encode($e->getMessage());
                    @@tri_error_bndportal = 'true';
                }
            } else {
                @@frm_entidad_financiera = $dataportal->bankCodeConduit;
                $frm_entidad_financiera = $dataportal->bankCodeConduit;
                //banco
                try
                {
                    $sql_cata = "SELECT DESCRIPCION, VALOR FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_GET_BANKS'";
                    $rs_bancos = executeQuery($sql_cata, $cnx_rp);
                    $url_bancos = isset($rs_bancos['1']['DESCRIPCION']) ? $rs_bancos['1']['DESCRIPCION'] : '';
                    $apiKey_bancos = isset($rs_bancos['1']['VALOR']) ? $rs_bancos['1']['VALOR'] : '';

                    if ($dataportal->ramoCode == 60 || $dataportal->ramoCode == 61) {
                        $sntiporamo = 1;
                    } else {
                        $sntiporamo = 2;
                    }
                    $type_pp = ($tipo_proceso == 1 ? -1 : 0);

                    $body_bancos = array(
                        "codigoScript" => "PIPECONTRACTOR_CREDITCARD",
                        "codigoAplicacion" => "BPM_LURANA",
                        "parametros" => array(
                            "sn_banco" => -1,
                            "sn_tiporamo" => $sntiporamo,
                            "sn_poliza" => $type_pp,
                            "sn_portal" => 1
                        )
                    );
                    $json_body_bancos = json_encode($body_bancos);

                    $headers_bancos = array(
                        "Accept: application/json",
                        "Content-Type: application/json",
                        "ApiKey: $apiKey_bancos"
                    );

                    $ch_bancos = curl_init();
                    curl_setopt($ch_bancos, CURLOPT_URL, $url_bancos);
                    curl_setopt($ch_bancos, CURLOPT_POST, true);
                    curl_setopt($ch_bancos, CURLOPT_POSTFIELDS, $json_body_bancos);
                    curl_setopt($ch_bancos, CURLOPT_HTTPHEADER, $headers_bancos);
                    curl_setopt($ch_bancos, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch_bancos, CURLOPT_FAILONERROR, false);
                    $res_bancos = curl_exec($ch_bancos);
                    $curl_error_bancos = curl_errno($ch_bancos) ? curl_error($ch_bancos) : '';
                    curl_close($ch_bancos);

                    PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'Consulta informacion portal 3', $url_bancos, 'POST', 'NO', $json_body_bancos, $res_bancos, $curl_error_bancos);

                    if ($curl_error_bancos !== '') {
                        @@tri_mes_infoBpm = 'Error de servicio de consulta.';
                        @@tri_error_bndportal = 'true';
                    } else {
                        $rs_bancos_resp = json_decode($res_bancos);

                        if (!isset($rs_bancos_resp->exitoso)) {
                            @@tri_mes_infoBpm = 'Error de servicio de consulta.';
                            @@tri_error_bndportal = 'true';

                        } elseif ($rs_bancos_resp->exitoso !== true) {
                            @@tri_mes_infoBpm = !empty($rs_bancos_resp->errores)
                                ? implode(' | ', (array) $rs_bancos_resp->errores)
                                : (isset($rs_bancos_resp->mensaje) ? $rs_bancos_resp->mensaje : 'no hay datos');
                            @@tri_error_bndportal = 'true';

                        } elseif (!empty($rs_bancos_resp->datos) && is_array($rs_bancos_resp->datos) && count($rs_bancos_resp->datos) > 0) {
                            foreach ($rs_bancos_resp->datos as $databan) {
                                if ($dataportal->bankCodeConduit == $databan->cod_entidad) {
                                    @@frm_entidad_financiera_label = $databan->txt_desc;
                                }
                            }
                        } else {
                            @@tri_mes_infoBpm = 'no hay datos';
                        }
                    }

                } catch (Exception $e)
                {
                    @@tri_mes_infoBpm = $e->getMessage();
                }

                if ($dataportal->isCurrentAccount == '0') {
                    @@frm_medio_pago = 'CTAAHO';
                    @@frm_medio_pago_label = 'CUENTA AHORROS';
                } else {
                    @@frm_medio_pago = 'CTACTE';
                    @@frm_medio_pago_label = 'CUENTA CORRIENTE';
                }
            }

            @@frm_numero_tarjeta = $dataportal->cardAccountNumber;
            @@frm_monto = $dataportal->amount;
            @@frm_frecuencia_pago = $dataportal->paymentFrequencyCode;
            @@frm_concepto_pago = $dataportal->policyNumber;
            @@frm_bus_poliza = $dataportal->policyNumber;
            @@frm_concepto_pago_label = $dataportal->policyNumber;
            @@frm_pago_terceros = ($dataportal->isThirdPayment == 0 ? 'N' : 'S');
            if ($dataportal->isThirdPayment == '-1') {
                @@frm_polizaanombrede = @@frm_nombres_poliza . ' ' . @@frm_apellidos_poliza;
                @@frm_parentesco = $dataportal->relationshipCode;
            }
        }
    } else {
        @@tri_mes_infoBpm = 'No existe datos en la consulta';
        @@tri_error_bndportal = 'true';
    }
}
catch (Exception $e)
{
    @@tri_mes_infoBpm = 'Excepción capturada: ' . utf8_encode($e->getMessage());
    @@tri_error_bndportal = 'true';
}