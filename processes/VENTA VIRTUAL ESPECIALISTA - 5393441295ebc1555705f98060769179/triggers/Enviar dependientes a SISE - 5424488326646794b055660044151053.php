<?php
//Enviar dependientes a SISE
$process = @@PROCESS;

try {
    $cnx = '1479570925ec29f1d8d1d57019959618';

    $sql = "SELECT DESCRIPCION
    FROM ADMIN_CATALOGOS WHERE
    PRO_UID = '$process'
    AND COD_CATALOGO = 'SERVICIOS_WEB'
    AND CODIGO = 'ENVIO_CLIENTE_A_SISE'
    ";

    $rs = executeQuery($sql, $cnx);

    $sql_apikey = "SELECT DESCRIPCION, CAMPO2
    FROM ADMIN_CATALOGOS WHERE
    PRO_UID = '$process'
    AND COD_CATALOGO = 'SERVICIOS_WEB'
    AND CODIGO = 'APIKEY_CU_SISE'
    ";

    $rs_apikey = executeQuery($sql_apikey, $cnx);
    $apikey = $rs_apikey[1]['CAMPO2'];

    $url_envio = $rs[1]['DESCRIPCION'];
    

    /* Recupera destinatarios de correo */
    $desPARA = '';
    $desCC = '';
    $desBCC = '';

    $sql_correo = "SELECT *
    FROM ADMIN_CATALOGOS WHERE
    PRO_UID = 'GENERICO'
    AND INTEGRACION = '5393441295ebc1555705f98060769179'
    AND DESCRIPCION = 'Enviar Dependientes SISE'
    ";

    $rs_correo = executeQuery($sql_correo, $cnx);
    $desPARA = $rs_correo[1]['VALOR'];
    $desCC = $rs_correo[1]['CAMPO2'];
    $desBCC = $rs_correo[1]['CAMPO1'];


    $dependientes_dental = array();
    $dependientes_dental = @@grid_dental;

    $dependientes_exequial = array();
    $dependientes_exequial = @@grid_seguro_exequial;

    $array_dependientes_den = array();
    $array_dependientes_exq = array();

    $i = 1; $j = 1;
    @@frm_accion_dependientes = 'CONTINUAR';
    foreach ($dependientes_dental as $key => $value) {
        //push array
		if (empty($value['frm_dental_identificacion']) || $value['frm_dental_identificacion'] == 'N/A') {
			continue; 
		}
        $tipoDocumento = $value['frm_tipo_identificacion_dental'] == 1 ? 'C' : 'P';
        $noDocumento = $value['frm_dental_identificacion'];
        $apellidoPaterno = $value['frm_dental_primer_apellido'];
        $apellidoMaterno = $value['frm_dental_segundo_apellido'];
        $primerNombre = $value['frm_dental_primer_nombre'];
        $segundoNombre = $value['frm_dental_segundo_nombre'];
        $genero = $value['frm_dental_genero'];
        $fechaNacimiento = $value['frm_dental_fecha_nacimiento'];

        $dependiente = array(
            'tipoDocumento' => $tipoDocumento,
            'noDocumento' => $noDocumento,
            'apellidoPaterno' => $apellidoPaterno,
            'apellidoMaterno' => $apellidoMaterno,
            'primerNombre' => $primerNombre,
            'segundoNombre' => $segundoNombre,
            'genero' => $genero,
            'fechaNacimiento' => $fechaNacimiento,
            'usuario' => 'BPM_VENTA_VIRTUAL_ESPECIALISTA'
        );
        $infoDependienteJson = json_encode($dependiente);
        @@infoDependienteDental = json_encode($dependiente);

        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url_envio,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($dependiente),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "apikey:" . $apikey
                ),
            ));


            $response = curl_exec($curl);
            $err = curl_error($curl);

          /*  PMFBitacoraServicios(
                @@APP_NUMBER,
                'trigger',
                'Enviar dependientes a SISE',
                $url_envio,
                'POST',
                "apikey: ". $apikey,
                $dependiente,
                $response,
                $err
            );*/


            @@tmp_respuesta_dependiente = $response;
			

            if (empty($response)) {
                $de = '';
                //$para = 'jjgutierrezm@segurosequinoccial.com';
                //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
                //$bcc = 'bvelasco@segurosequinoccial.com,victor.cortez@beesmart.ec';
                $para = $desPARA;
                $cc = $desCC;
                $bcc = $desBCC;
                $plantilla_rec = 'Notificacion_manual.html';
                $asunto = 'Problemas en la generacion de dependientes para CU Caso BPM: ' . @#APP_NUMBER;
                $html_decision_notificacion = '<h3>No existen valores de respuesta</h3>';
                $html_decision_notificacion .= '<br>Trama: '.@@infoDependienteDental;
                @@html_decision_notificacion = $html_decision_notificacion;
                @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
                echo '<h3><br>Problemas en la generacion de dependientes para CU<br>Comuniquese con el administrador del sistema</h3>';
                die();
            }

            $err = curl_error($curl);
            if (curl_errno($curl)){
                $error_msg = $err;
                echo "<br>Error de comunicación con el servicio web: " . $error_msg;
                $de = '';
                //$para = 'jjgutierrezm@segurosequinoccial.com';
                //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
                //$bcc = 'bvelasco@segurosequinoccial.com,victor.cortez@beesmart.ec';
                $para = $desPARA;
                $cc = $desCC;
                $bcc = $desBCC;
                $plantilla_rec = 'Notificacion_manual.html';
                $asunto = 'Error de comunicacion con el servicio web - Caso BPM: '.@#APP_NUMBER;
                $html_decision_notificacion = $error_msg;
                @@html_decision_notificacion = $html_decision_notificacion;
                @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
                die();
            }

            if ($err) {
                @@frm_error_dependientes = $err;
                //die();
                @@frm_accion_dependientes = 'ERROR';
            } else {
                $response_deco_den = json_decode($response, true);
                //push response from json to array_dependientes
                if (isset($response_deco_den['codigoAsegurado'])) {
                    $tmpCodigoAsegurado = $response_deco_den['codigoAsegurado'];
                    // Verificar si es un número, si es positivo y tiene al menos 5 dígitos
                    if (!is_numeric($tmpCodigoAsegurado) || $tmpCodigoAsegurado <= 0 || strlen((string)$tmpCodigoAsegurado) < 5) {
                        echo "<h3><br>El codigo del asegurado dependiente no es valido.<br>Comuniquese con el administrador del sistema</h3>";
                        $de = '';
                        //$para = 'jjgutierrezm@segurosequinoccial.com';
                        //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
                        //$bcc = 'bvelasco@segurosequinoccial.com,victor.cortez@beesmart.ec';
                        $para = $desPARA;
                        $cc = $desCC;
                        $bcc = $desBCC;
                        $plantilla_rec = 'Notificacion_manual.html';
                        $asunto = 'El codigo del asegurado dependiente no es valido - Caso BPM: '.@#APP_NUMBER;
                        $html_decision_notificacion = 'El codigo del asegurado dependiente no es valido: '.$tmpCodigoAsegurado;
                        $html_decision_notificacion .= '<br>Trama: '.@@infoDependienteDental;
                        @@html_decision_notificacion = $html_decision_notificacion;
                        @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
                        die();
                    }
                } else {
                    echo "<h3><br>El codigo del asegurado dependiente no es valido.<br>Comuniquese con el administrador del sistema</h3>";
                    $de = '';
                    //$para = 'jjgutierrezm@segurosequinoccial.com';
                    //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
                    //$bcc = 'bvelasco@segurosequinoccial.com,victor.cortez@beesmart.ec';
                    $para = $desPARA;
                    $cc = $desCC;
                    $bcc = $desBCC;
                    $plantilla_rec = 'Notificacion_manual.html';
                    $asunto = 'El codigo del asegurado dependiente no es valido - Caso BPM: '.@#APP_NUMBER;
                    $html_decision_notificacion = 'El codigo del asegurado dependiente no es valido o es nulo: '.$tmpCodigoAsegurado;
                    $html_decision_notificacion .= '<br>Trama: '.@@infoDependienteDental;
                    @@html_decision_notificacion = $html_decision_notificacion;
                    @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
                    die();
                }

                @=grid_dental[$i]['frm_dental_idPersona'] = $response_deco_den['idPersona'];
                @=grid_dental[$i]['frm_dental_codigoAsegurado'] = $response_deco_den['codigoAsegurado'];
                @=grid_dental[$i]['frm_dental_tipo'] = 'DENTAL';
                $array_dependientes_den[] = json_decode($response, true);
                $i++;

                @@frm_accion_dependientes = 'CONTINUAR';
            }
            curl_close($curl);
        } catch (Exception $e) {
            @@frm_accion_dependientes = 'ERROR';
        }
    }

    foreach ($dependientes_exequial as $key => $value) {
		
		if (empty($value['frm_exequial_identificacion']) || $value['frm_exequial_identificacion'] == 'N/A') {
			continue; // Saltar este registro, continuar con el siguiente
		}
        //push array
        $tipoDocumento = $value['frm_exequial_tipo_identificacion'] == 1 ? 'C' : 'P';
        $noDocumento = $value['frm_exequial_identificacion'];
        $apellidoPaterno = $value['frm_exequial_primer_apellido'];
        $apellidoMaterno = $value['frm_exequial_segundo_apellido'];
        $primerNombre = $value['frm_exequial_primer_nombre'];
        $segundoNombre = $value['frm_exequial_segundo_nombre'];
        $genero = $value['frm_exequial_genero'];
        $fechaNacimiento = $value['frm_exequial_fecha_nacimiento'];

        if ((empty($noDocumento) || $noDocumento == 'N/A') &&
        (empty($apellidoPaterno) || $apellidoPaterno == 'N/A') &&
        (empty($apellidoMaterno) || $apellidoMaterno == 'N/A') &&
        (empty($primerNombre) || $primerNombre == 'N/A') &&
        (empty($segundoNombre) || $segundoNombre == 'N/A') &&
        (empty($genero) || $genero == 'N/A')) {


        }else{
            $dependiente = array(
                'tipoDocumento' => $tipoDocumento,
                'noDocumento' => $noDocumento,
                'apellidoPaterno' => $apellidoPaterno,
                'apellidoMaterno' => $apellidoMaterno,
                'primerNombre' => $primerNombre,
                'segundoNombre' => $segundoNombre,
                'genero' => $genero,
                'fechaNacimiento' => $fechaNacimiento,
                'usuario' => 'BPM_VENTA_VIRTUAL_ESPECIALISTA'
            );

            @@infoDependienteExequial = json_encode($dependiente);
            
            try {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url_envio,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($dependiente),
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "apikey:" . $apikey
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
				
				 PMFBitacoraServicios(
                @@APP_NUMBER,
                'trigger',
                'Enviar dependientes a SISE 310',
                $url_envio,
                'POST',
                "apikey: ". $apikey,
                json_encode($dependiente),
                json_encode($response),
                json_encode($err)
            );

                if (empty($response)) {
                    $de = '';
                    //$para = 'jjgutierrezm@segurosequinoccial.com';
                    //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
                    //$bcc = 'bvelasco@segurosequinoccial.com,victor.cortez@beesmart.ec';
                    $para = $desPARA;
                    $cc = $desCC;
                    $bcc = $desBCC;
                    $plantilla_rec = 'Notificacion_manual.html';
                    $asunto = 'Problemas en la generacion de dependientes para CU Caso BPM: ' . @#APP_NUMBER;
                    $html_decision_notificacion = '<h3>No existen valores de respuesta</h3>';
                    $html_decision_notificacion .= '<br>TramaExequial: '.@@infoDependienteExequial;
                    @@html_decision_notificacion = $html_decision_notificacion;
                    @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
                    echo '<h3><br>Problemas en la generacion de dependientes <br>Comuniquese con el administrador del sistema</h3>';
                    die();
                }

                if (curl_errno($curl)){
                    $error_msg = $err;
                    echo "<br>Error de comunicación con el servicio web: " . $error_msg;
                    $de = '';
                    //$para = 'jjgutierrezm@segurosequinoccial.com';
                    //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
                    //$bcc = 'bvelasco@segurosequinoccial.com,victor.cortez@beesmart.ec';
                    $para = $desPARA;
                    $cc = $desCC;
                    $bcc = $desBCC;
                    $plantilla_rec = 'Notificacion_manual.html';
                    $asunto = 'Error de comunicacion con el servicio web - Caso BPM: '.@#APP_NUMBER;
                    $html_decision_notificacion = $error_msg;
                    @@html_decision_notificacion = $html_decision_notificacion;
                    @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
                    die();
                }
                if ($err) {
                    //echo "cURL Error #:" . $err;
                    //die();
                    @@frm_accion_dependientes = 'ERROR';
                } else {
                    $response_deco = json_decode($response, true);
                    //push response from json to array_dependientes

                    if (isset($response_deco['codigoAsegurado'])) {
                        $tmpCodigoAsegurado = $response_deco['codigoAsegurado'];
                        // Verificar si es un número, si es positivo y tiene al menos 5 dígitos
                        if (!is_numeric($tmpCodigoAsegurado) || $tmpCodigoAsegurado <= 0 || strlen((string)$tmpCodigoAsegurado) < 5) {
                            echo "<h3><br>El codigo del asegurado dependiente no es valido.<br>Comuniquese con el administrador del sistema</h3>";
                            $de = '';
                            //$para = 'jjgutierrezm@segurosequinoccial.com';
                            //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
                            //$bcc = 'bvelasco@segurosequinoccial.com,victor.cortez@beesmart.ec';
                            $para = $desPARA;
                            $cc = $desCC;
                            $bcc = $desBCC;
                            $plantilla_rec = 'Notificacion_manual.html';
                            $asunto = 'El codigo del asegurado dependiente no es valido - Caso BPM: '.@#APP_NUMBER;
                            $html_decision_notificacion = 'El codigo del Asegurado Dependiente no es valido: '.$tmpCodigoAsegurado;
                            $html_decision_notificacion .= '<br>TramaExequial: '.@@infoDependienteExequial;
                            @@html_decision_notificacion = $html_decision_notificacion;
                            @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
                            die();
                        }
                    } else {
                        echo "<h3><br>El codigo del asegurado dependiente no es valido.<br>Comunicarse con el administrador del sistema</h3>";
                        $de = '';
                        //$para = 'jjgutierrezm@segurosequinoccial.com';
                        //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
                        //$bcc = 'bvelasco@segurosequinoccial.com,victor.cortez@beesmart.ec';
                        $para = $desPARA;
                        $cc = $desCC;
                        $bcc = $desBCC;
                        $plantilla_rec = 'Notificacion_manual.html';
                        $asunto = 'El codigo del asegurado dependiente no es valido - Caso BPM: '.@#APP_NUMBER;
                        $html_decision_notificacion = 'El codigo del Asegurado Dependiente es nulo o no es valido: '.$tmpCodigoAsegurado;
                        $html_decision_notificacion .= '<br>Trama: '.@@infoDependienteExequial;
                        @@html_decision_notificacion = $html_decision_notificacion;
                        @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
                        die();
                    }

                    @=grid_seguro_exequial[$j]['frm_exequial_idPersona'] = $response_deco['idPersona'];
                    @=grid_seguro_exequial[$j]['frm_exequial_codigoAsegurado'] = $response_deco['codigoAsegurado'];
                    @=grid_seguro_exequial[$j]['frm_exequial_tipo'] = 'EXEQUIAL';
                    $array_dependientes_exq[] = json_decode($response, true);
                    $j++;
                    @@frm_accion_dependientes = 'CONTINUAR';
                }
                curl_close($curl);
            } catch (Exception $e) {
                @@frm_accion_dependientes = 'ERROR';
            }
        }
    }
} catch (Exception $e) {
    @@frm_accion_dependientes = 'ERROR';
}

$array_resultado_depen = array(); $aux_i = 1;

foreach(@=grid_dental as $dataden){
    $iden_d = $dataden['frm_dental_identificacion'];
    $tipoDocumento = $dataden['frm_tipo_identificacion_dental'] == 1 ? 'C' : 'P';
    $apellidoPaterno = $dataden['frm_dental_primer_apellido'];
    $apellidoMaterno = $dataden['frm_dental_segundo_apellido'];
    $primerNombre = $dataden['frm_dental_primer_nombre'];
    $segundoNombre = $dataden['frm_dental_segundo_nombre'];
    $genero = $dataden['frm_dental_genero'];
    $fechaNacimiento = $dataden['frm_dental_fecha_nacimiento'];
    $parentesco = $dataden['frm_dental_parentesco'];
    $idPersona = $dataden['frm_dental_idPersona'];
    $codigoAsegurado = $dataden['frm_dental_codigoAsegurado'];

    $array_resultado_depen[$aux_i]['tipo_identificacion'] = $tipoDocumento;
    $array_resultado_depen[$aux_i]['identificacion'] = $iden_d;
    $array_resultado_depen[$aux_i]['primer_apellido'] = $apellidoPaterno;
    $array_resultado_depen[$aux_i]['segundo_apellido'] = $apellidoMaterno;
    $array_resultado_depen[$aux_i]['primer_nombre'] = $primerNombre;
    $array_resultado_depen[$aux_i]['segundo_nombre'] = $segundoNombre;
    $array_resultado_depen[$aux_i]['genero'] = $genero;
    $array_resultado_depen[$aux_i]['fecha_nacimiento'] = $fechaNacimiento;
    $array_resultado_depen[$aux_i]['parentesco'] = $parentesco;
    $array_resultado_depen[$aux_i]['idPersona'] = $idPersona;
    $array_resultado_depen[$aux_i]['codigoAsegurado'] = $codigoAsegurado;
    $array_resultado_depen[$aux_i]['tipo'] = 'DENTAL';
    foreach(@=grid_seguro_exequial as $dataex){
        $iden_e = $dataex['frm_exequial_identificacion'];
        if($iden_d == $iden_e){
            $array_resultado_depen[$aux_i]['tipo'] = 'DENTAL-EXEQUIAL';
            break;
        }
    }
    $aux_i++;
}

$bandera_dental_exequial = 0;
foreach(@=grid_seguro_exequial as $dataex){
    $iden_e = $dataex['frm_exequial_identificacion'];
    $tipoDocumento = $dataex['frm_exequial_tipo_identificacion'] == 1 ? 'C' : 'P';
    $apellidoPaterno = $dataex['frm_exequial_primer_apellido'];
    $apellidoMaterno = $dataex['frm_exequial_segundo_apellido'];
    $primerNombre = $dataex['frm_exequial_primer_nombre'];
    $segundoNombre = $dataex['frm_exequial_segundo_nombre'];
    $genero = $dataex['frm_exequial_genero'];
    $fechaNacimiento = $dataex['frm_exequial_fecha_nacimiento'];
    $parentesco = $dataex['frm_exequial_parentesco'];
    $idPersona = $dataex['frm_exequial_idPersona'];
    $codigoAsegurado = $dataex['frm_exequial_codigoAsegurado'];


    foreach($array_resultado_depen as $datadental){
        $iden_dupli = $datadental['identificacion'];
        $tipo = $datadental['tipo'];
        if($iden_e == $iden_dupli){
            $bandera_dental_exequial = $bandera_dental_exequial + 1;
            break;
        }else{
            $bandera_dental_exequial = 0;
            //break;
        }
    }
    if($bandera_dental_exequial == 0){
        $array_resultado_depen[$aux_i]['tipo_identificacion'] = $tipoDocumento;
        $array_resultado_depen[$aux_i]['identificacion'] = $iden_e;
        $array_resultado_depen[$aux_i]['primer_apellido'] = $apellidoPaterno;
        $array_resultado_depen[$aux_i]['segundo_apellido'] = $apellidoMaterno;
        $array_resultado_depen[$aux_i]['primer_nombre'] = $primerNombre;
        $array_resultado_depen[$aux_i]['segundo_nombre'] = $segundoNombre;
        $array_resultado_depen[$aux_i]['genero'] = $genero;
        $array_resultado_depen[$aux_i]['fecha_nacimiento'] = $fechaNacimiento;
        $array_resultado_depen[$aux_i]['parentesco'] = $parentesco;
        $array_resultado_depen[$aux_i]['idPersona'] = $idPersona;
        $array_resultado_depen[$aux_i]['codigoAsegurado'] = $codigoAsegurado;
        $array_resultado_depen[$aux_i]['tipo'] = 'EXEQUIAL';
        $aux_i++;

    }
}

@=grd_dependientes_sise = $array_resultado_depen;
//@=grd_dependientes_sise_exq = $array_dependientes_exq;

$aData = array('grid_seguro_exequial' => @=grid_seguro_exequial, 'grid_dental' => @=grid_dental, 'grd_dependientes_sise' => @=grd_dependientes_sise);
PMFSendVariables(@@APPLICATION, $aData);

