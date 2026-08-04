<?php
//created by Henry
//28-08-2020
//spc_PC_informacion_BPM consumo

$cnx = '1471226895f49403bebfa26089899906';
$cnx_rp = '4647520625f3ca6ed2d2621030136501';
$pro_uid = @@PROCESS;
@@frm_bandera_fidelizacion = 'false';

@@frm_fecha_creacion = getCurrentDate() . ' ' . getCurrentTime();

$id_pev_cero = @@id_pev_cero;
$id_proceso = @@id_proceso;
$tipo_proceso = @@tipo_proceso;
@@tri_ban_portal = 'SI';
@@tri_error_bndportal = '';

@@frm_tipo_solicitud = ($tipo_proceso == 1 ? 'P' : 'R');
@@frm_tipo_solicitud_label = ($tipo_proceso == 1 ? 'PRESTAMO' : 'RETIRO');

if (@@frm_tipo_solicitud == 'P') {
    @@id_proceso_prestamo = $id_proceso;
} else {
    if (@@frm_tipo_solicitud == 'R') {
        @@id_proceso_retiro = $id_proceso;
    }
}
//$sql = "EXECUTE dbo.spc_PC_informacion_BPM $id_proceso,$id_pev_cero,$tipo_proceso";
//$rs = executeQuery($sql, $cnx);
$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_GET_BPMINFO'";
$rs =  executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
$dns = $url . $id_proceso . PATH_SEP . $id_pev_cero . PATH_SEP . $tipo_proceso;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $dns);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
$res = curl_exec($ch);
if (curl_errno($ch)) {
    $msg_m = curl_error($ch);
}
curl_close($ch);

$result = array();
$rs = json_decode($res);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger o form', 'Consultar Informacion Portal', $dns, 'GET', 'NO', '', $rs, $msg_m);

try {
    echo 'aqui 10';
    if (!empty($rs) && count($rs) > 0) {
        foreach ($rs as $dataportal) {
            @@frm_tipo_persona = ($dataportal->personType == 'F' ? 'N' : 'J');
            if ($dataportal->aIdentificationType == 1) {
                @@frm_tipo_identificacion_receptor = 'C';
                @@frm_tipo_identificacion_receptor_label = 'CEDULA';
            }
            if ($dataportal->aIdentificationType == 2) {
                @@frm_tipo_identificacion_receptor = 'R';
                @@frm_tipo_identificacion_receptor_label = 'RUC';
            }
            if ($dataportal->aIdentificationType == 3) {
                @@frm_tipo_identificacion_receptor = 'P';
                @@frm_tipo_identificacion_receptor_label = 'PASAPORTE';
            }
            if ($dataportal->dIdentificationType == 1) {
                @@frm_tipo_identificacion_pagador = 'C';
                @@frm_tipo_identificacion_pagador_label = 'CEDULA';
            }
            if ($dataportal->dIdentificationType == 2) {
                @@frm_tipo_identificacion_pagador = 'R';
                @@frm_tipo_identificacion_pagador_label = 'RUC';
            }
            if ($dataportal->dIdentificationType == 3) {
                @@frm_tipo_identificacion_pagador = 'P';
                @@frm_tipo_identificacion_pagador_label = 'PASAPORTE';
            }

            @@frm_cedula_receptor = $dataportal->aIdentification;
            @@frm_cedula_pagador = $dataportal->dIdentification;
            @@frm_celular_receptor = $dataportal->cellPhone;
            //se queda en blanco y se olculta
            @@frm_numero_endozo_vigente = '';
            @@frm_sucursal = $dataportal->branchOfficeCode;
            @@frm_sucursal_label = $dataportal->branchOfficeName;
            @@frm_canal = $dataportal->ramoCode;
            if ($dataportal->ramoCode == '55')
                @@frm_canal_label = 'VIDA PROVISION';
            if ($dataportal->ramoCode == '58')
                @@frm_canal_label = 'PROTEGER PLUS';
            if ($dataportal->ramoCode == '59')
                @@frm_canal_label = 'VIDA UNIVERSAL';
            @@descriptionRedu =    $dataportal->descriptionRedu;
            @@frm_numero_poliza = $dataportal->policyNumber;
            @@frm_cod_asegurado = $dataportal->insuredCode;
            @@frm_tipo_identificacion =    ($dataportal->identificationType == 1 ? 'C' : 'R');
            @@frm_numero_identificacion = $dataportal->identification;
            @@frm_apellido_paterno = $dataportal->lastname;
            @@frm_apellido_materno = $dataportal->secondLastname;
            @@frm_primer_nombre = $dataportal->name;
            @@frm_correo_electronico_receptor = $dataportal->contractorEmail;
            //provisional
            //@@frm_correo_electronico_receptor = 'se_mlopez@equivida.com';
            if (@@frm_tipo_solicitud == 'P') {
                @@frm_monto_disponible = $dataportal->amountAvailable;
            } else {
                if (@@frm_tipo_solicitud == 'R') {
                    @@frm_monto_disponible = $dataportal->amountAvailableWithdrawal;
                }
            }
            //@@frm_monto_disponible = $dataportal->amountAvailable;
            //@@frm_monto_actual = $dataportal->amountAvailableWithdrawal;
            @@frm_monto_actual = $dataportal->amountAvailable80;
            @@frm_monto_disponible_80 = $dataportal->amountAvailable80;
            @@frm_monto = $dataportal->requestAmount;
            @@frm_monto_prestamo = $dataportal->requestAmount;
            $imp_monto_solicitar = $dataportal->requestAmount;
            @@frm_frecuencia_pago = $dataportal->paymentFrequencyCode;
            $cod_frecuencia_pago = $dataportal->paymentFrequencyCode;
            //consultamos el label
            $sql_f = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'FRECUENCIA_PAGO' AND ESTADO = 1 AND  CODIGO = '$cod_frecuencia_pago'";
            $rs_f = executeQuery($sql_f, $cnx_rp);
            @@frm_frecuencia_pago_label = $rs_f['1']['DESCRIPCION'];
            @@frm_plazo_prestamo = $dataportal->duesNumber;
            $nro_cuotas = $dataportal->duesNumber;
            $fec_pago = $dataportal->paymentDate;
            @@frm_costo_retiro = $dataportal->chargeWithdrawal;
            @@frm_derecho_retiro = $dataportal->penalty;
            @@frm_val_descontado = $dataportal->amountToDiscount;
            @@frm_tasa_calc = $dataportal->ratePercentage;
            $frm_tasa_calc = $dataportal->ratePercentage;
            @@frm_total_capital = $dataportal->capital;
            @@frm_total_interes = $dataportal->interest;
            @@frm_total_pagar = $dataportal->fee;
            @@frm_entidad_financiera_receptor = $dataportal->bankToCredit;
            $frm_entidad_financiera_receptor = $dataportal->bankToCredit;
            //consultamos el label
            $sql_b = "SELECT  DESCRIPCION
            FROM ADMIN_CATALOGOS
            WHERE COD_CATALOGO='BANCOS_PR' AND ESTADO=1
            AND VALOR = 'PR' AND CODIGO = '$frm_entidad_financiera_receptor'";
            $rs_b = executeQuery($sql_b, $cnx_rp);
            @@frm_entidad_financiera_receptor_label = $rs_b['1']['DESCRIPCION'];
            @@frm_medio_pago_receptor = ($dataportal->bankToCreditAccountType == 0 ? $dataportal->bankToCreditAccountType :  '1');
            @@frm_medio_pago_receptor_label = ($dataportal->bankToCreditAccountType == 0 ? 'CUENTA AHORROS' :  'CUENTA CORRIENTE');
            @@frm_numero_cuenta_receptor = $dataportal->accountCredit;
            @@frm_entidad_financiera = $dataportal->bankToDebit;
            $frm_entidad_financiera = $dataportal->bankToDebit;
            //consultamos el label
            $sql_b = "SELECT  DESCRIPCION
            FROM ADMIN_CATALOGOS
            WHERE COD_CATALOGO='BANCOS_PR' AND ESTADO=1
            AND VALOR = 'AC' AND CODIGO = '$frm_entidad_financiera'";
            $rs_b = executeQuery($sql_b, $cnx_rp);
            @@frm_entidad_financiera_label = $rs_b['1']['DESCRIPCION'];
            @@frm_medio_pago = ($dataportal->bankToDebitAccountType == 0 ? $dataportal->bankToDebitAccountType :  '1');
            @@frm_medio_pago_label = ($dataportal->bankToDebitAccountType == 0 ? 'CUENTA AHORROS' :  'CUENTA CORRIENTE');
            @@frm_numero_cuenta = $dataportal->accountDebit;
            $cod_conducto =    $dataportal->conducto;
            $ind_conducto =    $dataportal->indConducto;
            @@frm_cod_tipoAgente = $dataportal->codeTypeAgent;
            $frm_cod_tipoAgente = $dataportal->codeTypeAgent;
            $sql_ta = "SELECT DESCRIPCION, DESCRIPCION FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'TIPO_AGENTE' AND CODIGO = '$frm_cod_tipoAgente'";
            $rs_ta = executeQuery($sql_ta, $cnx_rp);
            @@frm_tipo_agente = $rs_ta['1']['DESCRIPCION'];
            @@frm_cod_agente = $dataportal->codeAgent;
            @@frm_agente = $dataportal->agentText;
            @@frm_canal_venta = $dataportal->channel;
            @@frm_linea_negocio = $dataportal->bussinesGroup;
            @@frm_sublinea_negocio = $dataportal->subBusinessGroup;
        }
    } else {
        @@tri_mes_infoBpm = $msg_m;
        @@tri_error_bndportal = 'true';
    }
} catch (Exception $e) {
    @@tri_error_bndportal = 'true';
    @@tri_mes_infoBpm = 'Excepción capturada: ' . utf8_encode($e->getMessage());
}

if ($tipo_proceso == '1') {
    $tipo = 1; //prestamo;
    //consulta la tabla de amortizacion
    //$sql_p = "EXECUTE dbo.spc_PC_ConsCuotPrest_BPM $id_proceso,$id_pev_cero, $tipo";
    //$rs_p = executeQuery($sql_p, $cnx);

    try {
        $sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_GET_LOANFEE'";
        $rs =  executeQuery($sql_cata, $cnx_rp);
        $url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
        $dns = $url . $id_proceso . PATH_SEP . $id_pev_cero . PATH_SEP . $tipo;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $dns);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $res = curl_exec($ch);
        if (curl_errno($ch)) {
            $msg_t = curl_error($ch);
        }
        curl_close($ch);

        $result = array();
        $rs_p = json_decode($res);
        echo 'aqui 11';
        if (is_array($rs_p) and count($rs_p) > 0) {
            $frm_total_pagar = 0;
            $frm_total_capital = 0;
            $frm_total_interes = 0;
            //<th>Importe Interes</th>
            $tri_table_amor = '<table border="1" width="100%" class="table table-responsive"><thead><tr><th>Numero</th><th>Importe Capital</th><th>Importe Interes</th><th>Importe Cuota</th><th>Estado</th><th>Fecha Vencimiento</th></tr></thead><tbody>';
            $i = 1;
            foreach ($rs_p as $keym => $datam) {
                if ($datam->numeroCuota == 1)
                    @@frm_valor_inicial = $datam->importeCapital;

                $tri_table_amor .= '<tr>';
                if ($datam->numeroCuota == '99')
                    $tri_table_amor .= '<td align="center">TOTALES</td>';
                else
                    $tri_table_amor .= '<td align="center">' . $datam->numeroCuota . '</td>';
                $tri_table_amor .= '<td align="center">' . $datam->importeCapital . '</td>';
                if ($datam->numeroCuota != '99')
                    $frm_total_capital = $frm_total_capital + $datam->importeCapital;
                if ($datam->numeroCuota != '99')
                    $frm_total_pagar = $frm_total_pagar + $datam->importeCuota;
                $tri_table_amor .= '<td align="center">' . $datam->importeInteres . '</td>';
                $tri_table_amor .= '<td align="center">' . $datam->importeCuota . '</td>';
                if ($datam->numeroCuota != '99')
                    $frm_total_interes = $frm_total_interes + $datam->importeInteres;
                //$tri_table_amor .= '<td>'.$datam->importeSaldo.'</td>';
                if ($datam->numeroCuota != '99')
                    $tri_table_amor .= '<td align="center">' . $datam->estado . '</td>';
                else
                    $tri_table_amor .= '<td align="center">-</td>';
                if ($datam->numeroCuota != '99')
                    $tri_table_amor .= '<td align="center">' . substr($datam->fechaVencimiento, 0, 10) . '</td>';
                else
                    $tri_table_amor .= '<td align="center">-</td>';

                $tri_table_amor .= '</tr>';
                $i++;
                $result['mensaje'] = 'true';
            }
            $tri_table_amor .= '</tbody></table>';
            @@frm_total_pagar = $frm_total_pagar;
            @@tri_table_amor = $tri_table_amor;
        } else {
            @@tri_mes_infoBpm = "ERROR EN LA TABLA DE AMORTIZACION " . $msg_t;
            @@tri_error_bndportal = 'true';
        }
    } catch (Exception $e) {
        @@tri_mes_infoBpm = 'Excepción capturada: ' . utf8_encode($e->getMessage());
        @@tri_error_bndportal = 'true';
    }
}
