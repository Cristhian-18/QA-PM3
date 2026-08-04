<?php
try {


    $pro_uid = @@PROCESS;

    $appUid = @@APPLICATION;
    $usrUid = @@USER_LOGGED;


    $sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'URL_FINIQUITO_STRO'";
    $rs_auth =  executeQuery($sql_cata_auth);


    $url_auth = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';
    $dns = $url_auth;



    $sql_cata_auth_crede = "SELECT CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN_FINIQUITO_STRO'";
    $rs_auth_cred =  executeQuery($sql_cata_auth_crede);
    $token = $rs_auth_cred['1']['CAMPO2'];


    $aResultados = json_decode(@@respuestaApiLiquidacion, true); //ESTE ESTA VACIO




    $cod_suc = @@frm_sucursal;
    $sucursal = @@frm_sucursal_label;
    $cod_ramo = @@frm_ramo;
    $ramo = @@frm_ramo_label;


    $pathTmpFolder = "/code/workflow/engine/plugins/beesmartec/public_html/archivos_temp/";

    $inputDocumentUID = '658560985684b51b5148805081265793';

    $sqlIndex = "SELECT DEL_INDEX
    FROM APP_DELEGATION
    WHERE APP_UID = '$appUid'
    AND DEL_LAST_INDEX = 1
    ";
    $aDatosIndex = executeQuery($sqlIndex);



    if (!empty($aDatosIndex) && isset($aDatosIndex[1]['DEL_INDEX'])) {
        $indexDoc = $aDatosIndex[1]['DEL_INDEX'];
    } else {
        $indexDoc = @@INDEX;
    }

    @@errorFiniquitos = '0';
    foreach ($aResultados as $resultado) {
        $respuesta = json_decode($resultado['respuesta'], true);

        if (isset($respuesta['code']) && $respuesta['code'] == 0 && isset($respuesta['data']) && is_array($respuesta['data'])) {
            foreach ($respuesta['data'] as $data) {
                $nro_at = $data['nro_aut_tec'];
                $json_finq = array(
                    "iTipoProcess" => 1,
                    "cod_suc" => $cod_suc,
                    "cod_ramo" => $cod_ramo,
                    "nro_at" => $nro_at
                );
                @@tramaFiniquito = json_encode($json_finq);
                try {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $dns);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_finq));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FAILONERROR, true);
                    curl_setopt(
                        $ch,
                        CURLOPT_HTTPHEADER,
                        array(
                            "Accept: application/json",
                            "Content-Type: application/json",
                            "Accept-Language: application/json",
                            "apikey: $token"
                        )
                    );

                    $resFinq = curl_exec($ch);
                    $respuestaApiFiniquito = json_decode($resFinq, true);
                    if (curl_errno($ch)) {
                        @@errorFiniquitos = '1';
                        $msg_m = curl_error($ch);
                    }
                    curl_close($ch);


					PMFBitacoraServicios(@@APP_NUMBER, 'trigger', 'S-EDL-95', $dns, 'POST', "apikey: " . $token, json_encode($json_finq), json_encode($respuestaApiFiniquito), json_encode($msg_m));

                    if (isset($respuestaApiFiniquito['codigo']) && $respuestaApiFiniquito['codigo'] == 200) {
                        $base64 = $respuestaApiFiniquito['data']['base64Pdf'];
                        $fileName = $sucursal . '_' . $ramo . '_' . $nro_at . '.pdf';
                        if ($base64 && $base64 !== "No se encontro Datos") {
                            $binarioPdf = base64_decode($base64);
                        } else {
                            @@respuestaApiFiniquito = $respuestaApiFiniquito;
                            @@errorFiniquitos = '-1';
                        }

                        $rutaArchivo = $pathTmpFolder . $fileName;


                        file_put_contents($rutaArchivo, $binarioPdf);
                        sleep(3);



                        if (file_exists($rutaArchivo)) {
                            $response = PMFAddInputDocument(
                                $inputDocumentUID,
                                null,
                                1,
                                'INPUT',
                                'Finiquito automatico SISE',
                                '',
                                $appUid,
                                $indexDoc,
                                @@TASK,
                                $usrUid,
                                'file',
                                $rutaArchivo
                            );



                            if (file_exists($rutaArchivo)) {
                                unlink($rutaArchivo);
                            }
                            @@frmAccion = 'CONTINUAR';
                        }
                    }
                } catch (Exception $e) {
                    @@errorFiniquitos = '1';
                    @@tri_message_finiquito = 'Excepcion capturada: Error en el servicio del servicio web, comuniquese con el administrador.- ' . $e->getMessage();
                }
            }
        }
    }
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();
}
