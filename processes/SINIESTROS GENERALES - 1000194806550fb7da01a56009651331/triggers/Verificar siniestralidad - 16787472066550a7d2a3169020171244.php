<?php
//Made by Jean

$pro_uid = @@PROCESS;
$sql = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$pro_uid'
AND COD_CATALOGO = 'SERVICIOS_API_GENERALES'
AND CODIGO = 'Consultar_siniestros_generales'
";

$rs = executeQuery($sql);

//print_r($rs);

$url_siniestro = $rs[1]['DESCRIPCION'];

$sql_apikey = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
WHERE PRO_UID = '$pro_uid'
AND COD_CATALOGO = 'SERVICIOS_API_GENERALES'
AND CODIGO = 'apikey_generales'
";

$rs_apikey = executeQuery($sql_apikey);

$apikey = $rs_apikey[1]['DESCRIPCION'];

/*echo "URL: $url_siniestro\n";
echo "APIKEY
: $apikey\n";*/

$id_pv = @@frm_idpv;

//DEV
//$id_pv = '9878415';

$json_idpv = json_encode(array("idpv" => "$id_pv"));
echo $json_idpv;

//CAMBIAR POR EL CODIGO DE RAMO DE LA POLIZA
//DESARROLLO
$codigo_ramo = 1;

$sql_frecuencia = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND
COD_CATALOGO = 'FRECUENCIA_SINIESTRALIDAD' AND CODIGO = '$codigo_ramo'";

$rs_frecuencia = executeQuery($sql_frecuencia);

$frecuencia_mensual = $rs_frecuencia[1]['CAMPO1'];
$frecuencia_anual = $rs_frecuencia[1]['CAMPO2'];

$cod_item = '1';

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_siniestro);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_idpv);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Accept-Language: application/json",
            "apikey: $apikey"
        )
    );

    $res = curl_exec($ch);
    $json_result = json_decode($res, true);

    $data = $json_result['data'];
    //print all keys and values
    $polizas = array();
    $polizas = $data['polizas'];
    if(curl_errno($ch)) {
        $msg_m = curl_error($ch);
    }
    curl_close($ch);

     PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'VS-SN-88',
    $url_siniestro,
    'POST',
    "apikey: $apikey",
    json_encode($json_idpv),
    json_encode($res),
    json_encode($msg_m));

    $aux_array = 1;

    foreach ($polizas as $poliza) {
        echo "cod_item: " . $poliza['cod_item'] . "\n";
        if ($poliza['cod_item'] == intval($cod_item)) {
            print_r ($poliza);
            echo "cod_item: " . $poliza['cod_item'] . "\n";
            echo "cod_suc: " . $poliza['cod_suc'] . "\n";
            echo "cod_ramo: " . $poliza['cod_ramo'] . "\n";
            echo "nro_pol: " . $poliza['nro_pol'] . "\n";
            echo "aaaa_endoso: " . $poliza['aaaa_endoso'] . "\n";
            echo '<br>';
            $siniestros = $poliza['siniestros'];
            $anio_actual = date('Y');
            $mes_actual = date('m');
            $siniestros_anio = 0;
            $siniestros_mes = 0;
            foreach ($siniestros as $siniestro) {
               /* echo json_encode($siniestro);
                echo '<br>';
                echo '<br>';
                echo '<br>';*/

                @=frm_grd_siniestrosRegsitrados[$aux_array] = array(
                    'grd_FechaStro' => $siniestro['fechaRegistro'],
                    'grd_NoSiniestro'=>$siniestro['nroReclamoAgente'],
                    'grd_NoItem'=>$siniestro['codItem'],
                    'grd_causa'=>$siniestro['causa'],
                    'grd_codigoCobertura'=>$siniestro['codCobertura'],
                    'grd_ramo'=>'',
                    'grd_coberturas'=>$siniestro['cobertura'],
                    'grd_objeto'=>$siniestro['biensies'],
                    'grd_Amparo'=>'',
                    'grd_categoria'=>'',
                    'grd_sumaAsegurada'=>$siniestro['impReserva'],
'grd_montoSolicitado'=>$siniestro['impReserva'],
);
                    $aux_array++;
                echo "anio_siniestro: " . $siniestro['anioInspeccion'] . "\n";
                echo "fec_siniestro: " . $siniestro['fechaRegistro'] . "\n";
                if ($siniestro['anioInspeccion'] == $anio_actual) {
                    $siniestros_anio++;
                    if ($siniestro['mesInspeccion'] == $mes_actual) {
                        $siniestros_mes++;
                    }
                }
                echo '<br>';
            }
            echo "Siniestros en el año: $siniestros_anio\n";
            echo "Siniestros en el mes: $siniestros_mes\n";
            echo '<br>';
        }
    }
    //die();
    if ($siniestros_anio >= $frecuencia_anual) {
        echo "Max siniestros anuales: $frecuencia_anual\n";
        echo "Siniestralidad anual superada\n";
        echo '<br>';
        $bandera_alerta_temprana = 1;
        $texto_alerta = "Siniestralidad anual superada";
    }

    if ($siniestros_mes >= $frecuencia_mensual) {
        echo "Max siniestros mensuales: $frecuencia_mensual\n";
        echo "Siniestralidad mensual superada\n";
        echo '<br>';
        $bandera_alerta_temprana = 1;
        $texto_alerta = "Siniestralidad mensual superada";
    }

    if ($bandera_alerta_temprana == 1) {
        //Envio correo alerta temprana

        $app_uid = @@APPLICATION;

        $process = @@PROCESS;
        $sql = "SELECT CODIGO, VALOR FROM ADMIN_CATALOGOS WHERE
COD_CATALOGO = 'CORREOS_ALERTAS_INUSUALES'
AND PRO_UID = '$process' AND ESTADO = 1";
        echo $sql;
        $rs = executeQuery($sql);

        //JOIN ALL VALOR INTO A STRING SEPARATED BY COMMAS
        $correos = "";

        foreach ($rs as $row) {
            //check if the value is not empty and is a valid email
            if (!empty($row['VALOR']) && filter_var($row['VALOR'], FILTER_VALIDATE_EMAIL)) {
                $correos .= $row['VALOR'] . ",";
            }
            //$correos .= $row['VALOR'].",";
        }
        //correos to string
        $correos = rtrim($correos, ',');

        //get current time


        $inicio_vigencia = @@frm_ds_polizaInicioVigencia;

        //DESARROLLO

        $inicio_vigencia = '01/01/2024 00:00:00';
        //01/01/2024 00:00:00 - DD/MM/YYYY
        $inicio_vigencia = DateTime::createFromFormat('d/m/Y H:i:s', $inicio_vigencia);
        $inicio_vigencia = $inicio_vigencia->format('Y-m-d H:i:s');
        //echo $inicio_vigencia;

        //check how many days have passed since it started (today - inicio_vigencia)
        $today = date('Y-m-d H:i:s');
        $today = new DateTime($today);
        $inicio_vigencia = new DateTime($inicio_vigencia);
        $inicio_vigencia_string = $inicio_vigencia->format('Y-m-d H:i:s');

        $diff = $today->diff($inicio_vigencia);

        $days = $diff->days;
        echo $days;

       /* if ($days > 30) {
            return;
        }*/
        echo "BANDERA";
        @@bandera_frecuencia_siniestro = 1;
        if(@@bandera_alerta_temprana == 1){
            //die();
            return;
        }
        try {
            $app_number = @@APP_NUMBER;
            $categoria_alerta = "Frecuencia de siniestro";
            $causal_alerta = "La póliza registra $siniestros_anio siniestros en el año y $siniestros_mes siniestros en el mes";
            $observaciones = "";
            $de = '';
            //$para = $correos;
            $para = @@tri_destinatarios_copias;
            $cc = '';
            $bcc = @@tri_destinatarios_copias_bcc;
            $asunto = "Notificación de alerta temprana en caso BPM $app_number";
            $texto = '<p align="justify">Estimado(a),&nbsp;Colaborador</p>';
            $texto .= '<p align="justify">Se le notifica que el caso de BPM '
                . $app_number . ' ha registrado una alerta por la frecuencia de siniestros.</p>
    <p align="justify"><b>Categoria de alerta: <b> ' . $categoria_alerta . '</p>
    <p align="justify"><b>Causal de alerta: <b> ' . $causal_alerta . '</p>
    <p align="justify"><b>Observaciones: <b> ' . $observaciones . '</p>

    ';
            $comentario = '';
            $plantilla_rec = 'Mail_alerta_inusual.html';
            $message = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array('tri_texto_mail' => $texto));
            echo "<br> $message <br> ";
            echo "Correo enviado";

            @@bandera_alerta_temprana = 1;
            //die();
        } catch (Exception $e) {
            echo $e->getMessage();
            //die();
        }
    }
    curl_close($ch);
} catch (Exception $e) {
    echo "Error: $e";
}



