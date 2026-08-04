<?php
//created by Henry
//Verificar Monto disponible vs solicitado

//Inicializar variables
@@tri_bandera_monto = '';

$cnx                       = '1471226895f49403bebfa26089899906';
$cnx_rp                    = '4647520625f3ca6ed2d2621030136501';
$pro_uid                   = @@PROCESS;
$frm_tipo_solicitud        = @@frm_tipo_solicitud;
$frm_sucursal              = @@frm_sucursal;
$frm_canal                 = @@frm_canal;
$frm_numero_poliza         = @@frm_numero_poliza;
$frm_numero_endozo_vigente = @@frm_numero_endozo_vigente;

$frm_monto_validar  = str_replace('.', '', @@frm_monto_solicitado);
$frm_monto_validar  = str_replace(',', '.', $frm_monto_validar);
@@frm_monto_validar = $frm_monto_validar;

$id_pv_cero = @@id_pev_cero;
$fecha      = date('Y-m-d');

if ($frm_tipo_solicitud == 'P') {
    //$sql_m = "EXECUTE dbo.spc_PC_prestamosnuev $id_pv_cero,0,1,1,0,0,'$fecha',0";
    //$rs_m = executeQuery($sql_m, $cnx);
    //CONSULTA URL DE WS
    $sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_GET_NEWPOL'";
    $rs_d     = executeQuery($sql_cata, $cnx_rp);

    $url_d = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
    $dns_d = $url_d;

    $aVars = [
        "idPvCero"         => $id_pv_cero,
        "loanType"         => 0,
        "snQuote"          => 1,
        "amount"           => 1,
        "numberMonths"     => 0,
        "totalFees"        => 0,
        "beginPaymentDate" => $fecha,
        "processId"        => 0,
    ];
    $json = json_encode($aVars);

    try {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $dns_d);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
            ]
        );

        $res = curl_exec($ch);
        if (curl_errno($ch)) {
            $msg_m = curl_error($ch);
        }
        curl_close($ch);

        $rs_m = json_decode($res);

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'VMDS-PR-74',
            $dns_d,
            'POST',
            '',
            json_encode($json),
            json_encode($rs_m),
            json_encode($msg_m));

        if (is_array($rs_m) and count($rs_m) > 0) {
            foreach ($rs_m as $keym => $datam) {
                if ($datam->motivoProceso == '-1') {
                    $imp_monto_disponible         = $datam->amountAvailable;
                    @@frm_monto_disponible_actual = $datam->amountAvailable;
                    if ($frm_monto_validar <= $imp_monto_disponible) {
                        @@tri_bandera_monto = '';
                    } else {
                        if (@@TASK == '8760052855f3aa896a9a815031066895') {
                            @@cmb_accion_t3 = 'N';
                        }

                        if (@@TASK == '8163617725f3aa929732d82091255154') {
                            @@cmb_accion_t5 = 'N';
                        }

                        @@tri_bandera_monto = 'true';
                        @@frm_comentario    = @@frm_comentario . ' ' . 'NEGADO POR MONTO NO DISPONIBLE';
                    }
                } else {
                    @@tri_bandera_monto = 'true';
                }
            }
        } else {
            @@tri_bandera_monto = 'true';

        }
    } catch (Exception $e) {
        @@tri_bandera_monto = 'true';
    }

} else {
    //$sql_m = "EXECUTE dbo.spc_PC_retirosnuevo $id_pv_cero,0,1,50,0";
    //$rs_m = executeQuery($sql_m, $cnx);
    //CONSULTA URL DE WS
    $sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'ULR_GET_NEWPOLWHT'";
    $rs_d     = executeQuery($sql_cata, $cnx_rp);

    $url_d = isset($rs_d['1']['DESCRIPCION']) ? $rs_d['1']['DESCRIPCION'] : '';
    $dns_d = $url_d;

    $aVars = [
        "idPvCero"      => $id_pv_cero,
        "operationType" => 0,
        "snQuote"       => 1,
        "amount"        => 50,
        "processId"     => 0,
    ];
    $json = json_encode($aVars);
    //echo $json;
    try {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $dns_d);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
            ]
        );

        $res = curl_exec($ch);
        if (curl_errno($ch)) {
            $msg_m = curl_error($ch);
        }
        curl_close($ch);

        $rs_m = json_decode($res);

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'VMDS-PR-74',
            $dns_d,
            'POST',
            '',
            json_encode($json),
            json_encode($rs_m),
            json_encode($msg_m));

        echo 'aqui 13';
        if (is_array($rs_m) and count($rs_m) > 0) {
            foreach ($rs_m as $keym => $datam) {
                if ($datam->processReason == '-1') {
                    $imp_monto_disponible         = $datam->impAmountDispCalc;
                    @@frm_monto_disponible_actual = $datam->impAmountDispCalc;
                    if ($frm_monto_validar <= $imp_monto_disponible) {
                        @@tri_bandera_monto = '';
                    } else {
                        if (@@TASK == '8760052855f3aa896a9a815031066895') {
                            @@cmb_accion_t3 = 'N';
                        }

                        if (@@TASK == '8163617725f3aa929732d82091255154') {
                            @@cmb_accion_t5 = 'N';
                        }

                        @@tri_bandera_monto = 'true';
                        @@frm_comentario    = @@frm_comentario . ' ' . 'NEGADO POR MONTO NO DISPONIBLE';
                    }
                } else {
                    @@tri_bandera_monto           = 'true';
                    @@frm_monto_disponible_actual = $datam->processReason;
                    @@frm_comentario              = @@frm_comentario . ' ' . $datam->processReason;
                }
            }
        } else {
            @@tri_bandera_monto = 'true';
        }
    } catch (Exception $e) {
        @@tri_bandera_monto = 'true';
    }
}

