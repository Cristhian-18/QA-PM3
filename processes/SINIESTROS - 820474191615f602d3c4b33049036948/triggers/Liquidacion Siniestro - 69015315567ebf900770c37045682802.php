<?php
//created by Hugo
//31-03-2025
//Liquidacion autimatica de siniestros
try {
    @@__ERROR__ = '';
    @@tri_bandera_lqs = '';
    @@errorLiquidacion = '';
    @@errorFiniquitos = '';

    $_SESSION['PROCESS'] = '820474191615f602d3c4b33049036948';

    $cnx_rp = '11264850561d723f004d5c2072943786';
    $pro_uid = @@PROCESS;

    $sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_LIQUIDA_SINIESTRO'";
    $rs_auth =  executeQuery($sql_cata_auth, $cnx_rp);

    $url_auth = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
    $dns_auth = $url_auth;

    $sql_cata_auth_crede = "SELECT CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN_LIQ_STRO'";
    $rs_auth_cred =  executeQuery($sql_cata_auth_crede, $cnx_rp);
    $token = $rs_auth_cred['1']['CAMPO2'];

    $sql_cata_info = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_INFO_STRO_CASO'";
    $rs_info =  executeQuery($sql_cata_info, $cnx_rp);
    $dns_info = isset($rs_info['1']['DESCRIPCION']) ? $rs_info['1']['DESCRIPCION'] : '';

    $sql_cata_token_info = "SELECT CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN_INFO_STRO_CASO'";
    $rs_info_token =  executeQuery($sql_cata_token_info, $cnx_rp);
    $tokenInfo = $rs_info_token['1']['CAMPO2'];

    $json_info = array(
        "codTicket" => @@APP_NUMBER
    );

    /*$json_info = array(
        "codTicket" => 113159
    );*/

    /*echo "<br>Trama: ".json_encode($json_info)."<br>";
    echo "<br>URL Info: $dns_info<br>";
    echo "<br>Token Info: $tokenInfo<br>";*/
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $dns_info);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_info));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "apikey: $tokenInfo"
            )
        );


        $resInfo = curl_exec($ch);

        @@resInfoStoCrudo = $resInfo;
        $msg_m = '';
        if (curl_errno($ch)) {
            $msg_m = curl_error($ch);
        }
        curl_close($ch);

        $resultInfo = json_decode($resInfo);

 

    PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'LQS-S-77', $dns_info, 'POST', "Authorization", json_encode($json_info), json_encode($resInfo), json_encode($msg_m));




        @@resInfoSto = $resultInfo;
        //{"data":{"casoBPM":0,"idStro":0,"nroReclamo":0,"fecRegistro":"0001-01-01T00:00:00","codUsuario":null,"idPv":0,"codRamo":0,"codSuc":0,"aaaaEjercicio":0,"codItem":0,"coberturas":null},"codigo":200,"mensaje":""}
        if ($resultInfo->codigo == 200) {
            $casoBPM = $resultInfo->data->casoBPM;


            if ((int)$casoBPM == 0) {

                @@errorLiquidacion = '1';
                @@tri_bandera_lqs = 'false';
                @@tri_message_update = 'Error en el servicio de consulta de datos del siniestro, el servicio no devuelve datos,comuniquese con el administrador.';
                echo "<br>Error en el servicio de consulta de datos del siniestro, el servicio no devuelve datos,comuniquese con el administrador. <br> ";
                echo "<br>Trama:<br>" . json_encode($json_info);
                echo "<br>Respuesta:<br>" . json_encode($resultInfo);
                sleep(3);
            }

            $cod_suc = $resultInfo->data->codSuc;
            $cod_ramo = $resultInfo->data->codRamo;
            $aaaa_ejercicio = $resultInfo->data->aaaaEjercicio;
            $nro_reclamo = $resultInfo->data->nroReclamo;
            $cod_item = $resultInfo->data->codItem;
        } else {
            @@errorLiquidacion = '1';
            @@tri_message_update = $resultInfo->mensaje . ' - ERROR';
            echo "<br>Error en consulta de informacion del siniestro: <br> ";
            echo "<br>Trama:<br>" . json_encode($json_info);
            echo "<br>Respuesta:<br> " .  json_encode($resultInfo);
            echo ($resultInfo->mensaje);
            sleep(3);
        }
    } catch (Exception $e) {
        @@errorLiquidacion = '1';
        $resultInfo['mensaje'] = 'false';
        @@tri_message_update = 'Excepcion capturada: Error en el servicio del servicio web, comuniquese con el administrador.- ' . $e->getMessage();
    }

    if (@@errorLiquidacion != '1') {
        $cod_ticketcrm =  @@APP_NUMBER;
        $app_number_BPM = @@APP_NUMBER;

        $cod_usuario = @@USR_USERNAME;
        $app_uid_BPM = @@APPLICATION;

        $jsonFinal = array();

        $grilla = @@grdDetallePago;

        $coberturaPagos = array();
        $pagosIndividuales = array(); // 16931



        if (is_array($grilla)) {
            foreach ($grilla as $fila) {
                $procesado = isset($fila['txtProcesado']) ? $fila['txtProcesado'] : '';
                $pagoInd = isset($fila['grdChkPagoIndividual']) ? trim(strtoupper($fila['grdChkPagoIndividual'])) : '';

                if ($procesado != '1') {
                    if ($pagoInd === 'SI') {
                        $pagosIndividuales[] = $fila;
                    } else {

                        $coberturaPagos[] = $fila;
                    }
                }
            }
        }


        $imp_total = 0;

        foreach ($coberturaPagos as $fila) {
            $codAbonaVrs = $fila['grdtxtCodigoContratante'];
            // Inicializamos si no existe
            if (!isset($jsonItem[$codAbonaVrs])) {
                $jsonItem[$codAbonaVrs] = array(
                    'cod_movimiento' => 3,
                    'cod_suc' => $cod_suc,
                    'cod_ramo' => $cod_ramo,
                    'cod_abona' => (strtoupper($fila['grdtxtPagarAPago']) === "BENEFICIARIO") ? 15 : 7,
                    'cod_tipo_agente' => null,
                    'cod_agente' => null,
                    'cod_cia' => null,
                    'cod_cobrador' => null,
                    'cod_abona_vrs' => (int)$codAbonaVrs,
                    'sn_transferencia' => (strtoupper($fila['grdtxtPagoTransferencia']) === "SI") ? -1 : 0,
                    'imp_total' => $imp_total,
                    'cod_comprobante' => null,
                    'nro_comprobante' => null,
                    'nro_serie' => null,
                    'fec_emi_comprobante' => null,
                    'nro_aut_contribuyente' => null,
                    'nro_aut_imprenta' => null,
                    'fec_validez_comprobante' => null,
                    'nro_nit' => null,
                    'txt_razon_social' => null,
                    'txt_desc' => $fila['grdtxtObservaciones'],
                    'sn_genera_op' => (strtoupper($fila['grdtxtGenerarOp']) === "SI") ? -1 : 0,
                    'cod_ticketcrm' => $cod_ticketcrm,
                    'aaaa_ejercicio' => $aaaa_ejercicio,
                    'nro_reclamo' => $nro_reclamo,
                    'cod_usuario' => $cod_usuario,
                    'app_uid_BPM' => $app_uid_BPM,
                    'app_number_BPM' => $app_number_BPM,
                    'detalleSiniestroCobertura' => []
                );
            }
            $codIndCob = null;
            foreach ($resultInfo->data->coberturas as $cobertura) {
                if (isset($cobertura->descripcion) && $cobertura->descripcion === $fila['grdtxtCobertura']) {
                    $codIndCob = $cobertura->codIndCob;
                    break; // Sale del loop al encontrar el primero que hace match
                }
            }


            $detallePagos = array(
                "cod_item" => (int)$cod_item,
                "cod_ind_cob" => isset($codIndCob) ? $codIndCob : 2,
                "cod_clase_pago" => 1,
                "cod_tipo_pago" => (strtoupper($fila['grdtxtTipoPago']) === "TOTAL") ? 2 : 1,
                "cod_cpto" => (int)$fila['grdtxtConceptoCobertura'],
                "imp_cpto" => (float)$fila['grdtxtValorPagar'],
                "cod_ccosto" => 0
            );

            $jsonItem[$codAbonaVrs]['imp_total'] += (float)$fila['grdtxtValorPagar'];
            $jsonItem[$codAbonaVrs]['detalleSiniestroCobertura'][] = $detallePagos;
        }

        //$jsonFinal = array_values($jsonItem);

        $jsonItemIndividual = array();

        $imp_total = 0;
        foreach ($pagosIndividuales as $fila) {
            $codAbonaVrs = $fila['grdtxtCodigoContratante'];
            $codIndCob = null;
            foreach ($resultInfo->data->coberturas as $cobertura) {
                if (isset($cobertura->descripcion) && $cobertura->descripcion === $fila['grdtxtCobertura']) {
                    $codIndCob = $cobertura->codIndCob;
                    break; // Sale del loop al encontrar el primero que hace match
                }
            }

            $detallePagos = array(
                "cod_item" => (int)$cod_item,
                "cod_ind_cob" => isset($codIndCob) ? $codIndCob : 2,
                "cod_clase_pago" => 1,
                "cod_tipo_pago" => (strtoupper($fila['grdtxtTipoPago']) === "TOTAL") ? 2 : 1,
                "cod_cpto" => (int)$fila['grdtxtConceptoCobertura'],
                "imp_cpto" => (float)$fila['grdtxtValorPagar'],
                "cod_ccosto" => 0
            );

            $individual = array(
                'cod_movimiento' => 3,
                'cod_suc' => $cod_suc,
                'cod_ramo' => $cod_ramo,
                'cod_abona' => (strtoupper($fila['grdtxtPagarAPago']) === "BENEFICIARIO") ? 15 : 7,
                'cod_tipo_agente' => null,
                'cod_agente' => null,
                'cod_cia' => null,
                'cod_cobrador' => null,
                'cod_abona_vrs' => (int)$codAbonaVrs,
                'sn_transferencia' => (strtoupper($fila['grdtxtPagoTransferencia']) === "SI") ? -1 : 0,
                'imp_total' => (float)$fila['grdtxtValorPagar'],
                'cod_comprobante' => null,
                'nro_comprobante' => null,
                'nro_serie' => null,
                'fec_emi_comprobante' => null,
                'nro_aut_contribuyente' => null,
                'nro_aut_imprenta' => null,
                'fec_validez_comprobante' => null,
                'nro_nit' => null,
                'txt_razon_social' => null,
                'txt_desc' => $fila['grdtxtObservaciones'],
                'sn_genera_op' => (strtoupper($fila['grdtxtGenerarOp']) === "SI") ? -1 : 0,
                'cod_ticketcrm' => $cod_ticketcrm,
                'aaaa_ejercicio' => $aaaa_ejercicio,
                'nro_reclamo' => $nro_reclamo,
                'cod_usuario' => $cod_usuario,
                'app_uid_BPM' => $app_uid_BPM,
                'app_number_BPM' => $app_number_BPM,
                'detalleSiniestroCobertura' => array($detallePagos)
            );

            $jsonItemIndividual[] = $individual;
        }

        if (isset($jsonItem) && is_array($jsonItem)) {
            $jsonFinal = array_values($jsonItem);
            if (isset($jsonItemIndividual) && is_array($jsonItemIndividual)) {
                $jsonFinal = array_merge($jsonFinal, $jsonItemIndividual);
            }
        } else {
            $jsonFinal = array_values($jsonItemIndividual);
        }

        @@jsonDetallePagos = json_encode($jsonFinal);

        $resLstro = array();
        @@errorLiquidacion = '0';
        foreach ($jsonFinal as $item) {
            $jsonData = json_encode($item, JSON_UNESCAPED_UNICODE);
            echo "<br><br>JSON Data: <br> ";
            echo $jsonData;
            echo "<br>";
            $codAbona = isset($item['cod_abona_vrs']) ? $item['cod_abona_vrs'] : 'N/A';
            $respuestaApi = '';
            try {
                $ch_lstro = curl_init();
                curl_setopt($ch_lstro, CURLOPT_URL, $dns_auth);
                curl_setopt($ch_lstro, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch_lstro, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch_lstro, CURLOPT_RETURNTRANSFER, true);
                //curl_setopt($ch_lstro, CURLOPT_FAILONERROR, true);
                curl_setopt(
                    $ch_lstro,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Accept: application/json",
                        "Content-Type: application/json",
                        "Accept-Language: application/json",
                        "ApiKey: $token"
                    )
                );


                $res = curl_exec($ch_lstro);



                if (curl_errno($ch_lstro)) {
                    $msg_m = curl_error($ch_lstro);
                    $respuestaApi = 'Error cURL: ' . $msg_m;
                } else {
                    $respuestaApi = $res;
                    $jsonDecoded = json_decode($res, true);
                }
                curl_close($ch_lstro);

                $result = json_decode($res);
           
               PMFBitacoraServicios(
					@@APP_NUMBER,
					'trigger',
					'LS-S-330',
					$dns_auth,
					'POST',
					'NO',
					json_encode($jsonData),
					json_encode($result),
					json_encode($msg_m)
				);


                @@result_lsto = $result;
                /*echo "<br>ResultadoCurl: <br> ";
        print_r ($result);
        echo "<br>";*/
                if ($result->codigo == 0) {
                    @@tri_bandera_lqs = 'true';
                } else {
                    @@errorLiquidacion = '1';
                    @@tri_bandera_lqs = 'false';
                    @@tri_message_update = $result->mensaje . ' - ERROR';
                    echo "<br>Error ejecucion : <br> ";
                    echo ($result->mensaje);
                    //die();
                }
            } catch (Exception $e) {
                $respuestaApi = 'Excepción capturada: ' . $e->getMessage();
                $result['mensaje'] = 'false';
                @@tri_message_update = 'Excepcion capturada: Error en el servicio del servicio web, comuniquese con el administrador.- ' . $e->getMessage();
                @@errorLiquidacion = '1';
            }

            $resLstro[] = array(
                'cod_abona_vrs' => $codAbona,
                'trama' => $jsonData,
                'respuesta' => $respuestaApi
            );
        }
        @@respuestaApiLiquidacion = json_encode($resLstro);
        echo @@respuestaApiLiquidacion;
    }
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
