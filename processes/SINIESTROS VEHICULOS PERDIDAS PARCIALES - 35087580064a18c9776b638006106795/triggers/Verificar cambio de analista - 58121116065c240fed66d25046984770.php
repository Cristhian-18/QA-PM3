<?php
@@tri_usr_analista = @@USER_LOGGED;
//@@tri_usr_analista = '68373009865c40019a53ae2032357121';
/*PMFSendVariables('84989467966185f95302656096754403', array(
    'tri_usr_analista'=> '18175013065be6c01d54974071808958'
));*/
return;

die();

//@@frm_accion = "ACTUALIZAR";
//@@frm_accion_2 = '';

$app_uid = @@APPLICATION;
//return;
/*426046274661d83c6ceff04042147578
171930134661d7bd7e7de99042151225
205249976661994ba678dc7014540491
14238313966198aeb3e0750039164995
42538546666194698c6fe19026668560
203456152660ddb7ad99f47096034335*/

$array_errores = [
    '426046274661d83c6ceff04042147578',
    '171930134661d7bd7e7de99042151225',
    '205249976661994ba678dc7014540491',
    '14238313966198aeb3e0750039164995',
    '42538546666194698c6fe19026668560',
    '203456152660ddb7ad99f47096034335',
];

if (in_array($app_uid, $array_errores)) {
    @@tri_msg_error = '';
    $sql            = "SELECT * FROM APP_HISTORY WHERE APP_UID = '$app_uid' ORDER BY HISTORY_DATE DESC";

    $rs = executeQuery($sql);

    $old_data = [
        'frm_id_pv' => '9840807',
    ];
    foreach ($rs as $key => $value) {
        //deserialize History_data
        $history_data = unserialize($value['HISTORY_DATA']);
        //print_r($history_data);
        //echo ('<br>---------------- <br>');
        //GET EACH KEY and value IN ARRAY AND IF IT DOESNT EXIST IN THE ARRAY, ADD IT IN OLD_DATA
        foreach ($history_data as $key => $value) {
            //check if value is not null
            if ($key == 'frm_vafectado_placa') {
                /*echo ('<br>KEY: ' . $key . ' VALUE: ' . $value);
                echo ("PLACAAAA");*/
            }
            if ($value != null) {
                //IF KEY ENDS IN _LABEL, REMOVE _LABEL
                if (! array_key_exists($key, $old_data)) {
                    $old_data[$key] = $value;
                }
                if (substr($key, -6) == '_label') {
                    $key = substr($key, 0, -6);
                }
                if (! array_key_exists($key, $old_data)) {
                    $old_data[$key] = $value;
                }
            }
        }
    }
    foreach ($old_data as $key => $value) {
        //echo ('<br>KEY: ' . $key . ' VALUE: ' . $value);

        PMFSendVariables($app_uid, [
            $key => $value,
        ]);
    }

    //return;
    //Incializar Datos Solicitud
    $pro_uid        = @@PROCESS;
    @@tri_msg_error = '';

    //catalogos de marcas modelos
    //obtengo el token
    $sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
    $rs_auth       = executeQuery($sql_cata_auth);

    $apikey = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

    $sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN'";
    $rs_auth       = executeQuery($sql_cata_auth);

    $token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

    //CONDICIONES PÓLIZA

    $sql_cata_condicionesPoliza = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_Condiciones_Poliza'";
    $rs_condicionesPoliza       = executeQuery($sql_cata_condicionesPoliza);

    $url_condicionesPoliza = isset($rs_condicionesPoliza['1']['DESCRIPCION']) ? $rs_condicionesPoliza['1']['DESCRIPCION'] : '';
    $idPv                  = @@frm_id_pv;

    $url_inCondiciones_param = $url_condicionesPoliza . $idPv;
    /*echo ' URL CONDICIONES POLIZA: ';
    echo $url_inCondiciones_param;
    echo " APIKEY: ";
    echo $apikey;*/
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_inCondiciones_param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "APIKEY:" . $apikey,
                "Authorization: " . $token,

            ]
        );

        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            $msg_m          = curl_error($ch);
            @@tri_msg_error = $msg_m;

        }
        curl_close($ch);
        $result                  = json_decode($res, true);
        @@tri_condiciones_poliza = $result['response']['descripcion'];

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'VCA-SVPP-139',
            $url_inCondiciones_param,
            'GET',
            "APIKEY:" . $apikey . "Authorization: " . $token,
            '',
            json_encode($result),
            json_encode($msg_m));

    } catch (Exception $e) {
        //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
        $result['mensaje']         = 'false';
        $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
        @@tri_msg_error            = $msg_m;
    }
    //MARCAS
    $sql_cata_infoMarcas = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Catalogo_Marcas'";
    $rs_infoMarcas       = executeQuery($sql_cata_infoMarcas);

    $url_infomarcas     = isset($rs_infoMarcas['1']['DESCRIPCION']) ? $rs_infoMarcas['1']['DESCRIPCION'] : '';
    $url_inMarcas_param = $url_infomarcas;
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_inMarcas_param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "Authorization: Bearer " . $token,
                //"APIKEY:". $apikey

            ]
        );

        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            $msg_m          = curl_error($ch);
            @@tri_msg_error = $msg_m;
        }
        curl_close($ch);

        $result = json_decode($res);

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'VCA-SVPP-192',
            $url_inMarcas_param,
            'GET',
            "Authorization: " . $token,
            '',
            json_encode($result),
            json_encode($msg_m));

        $arr_Dtamarcas = [];
        $i             = 1;
        $datos_result  = $result->data;
        //codigoSise
        foreach ($datos_result as $dataMarc) {
            //$arr_Dtamarcas[$i] = array($dataMarc->idMarca, $dataMarc->nombreMarca);
            $arr_Dtamarcas[$i] = [$dataMarc->codigoSise, $dataMarc->nombreMarca];
            $i++;
        }
        $last_id++;
        $arr_Dtaparen[$i] = [$last_id, "Amigo"];
        $i++;
        $last_id++;
        $arr_Dtaparen[$i] = [$last_id, "Empleado"];

        @@arr_Dtamarcas = $arr_Dtamarcas;
    } catch (Exception $e) {
        //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
        $result['mensaje']         = 'false';
        $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
        @@tri_msg_error            = $msg_m;
    }

    //Parentesco
    $sql_cata_infoParen = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Catalogo_Tipo_Parentesco'";
    $rs_infoParen       = executeQuery($sql_cata_infoParen);

    $url_infoParen     = isset($rs_infoParen['1']['DESCRIPCION']) ? $rs_infoParen['1']['DESCRIPCION'] : '';
    $url_inparen_param = $url_infoParen;
    echo "URL PARENTESCO:";
    echo $url_inMarcas_param;

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_inparen_param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                //"Authorization: Bearer ". $token,
                "apikey:" . $apikey,

            ]
        );

        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            $msg_m          = curl_error($ch);
            @@tri_msg_error = $msg_m;
            echo($msg_m);
            die();
        }
        curl_close($ch);

        $result = json_decode($res);

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'VCA-SVPP-268',
            $url_inparen_param,
            'GET',
            "apikey:" . $apikey,
            '',
            json_encode($result),
            json_encode($msg_m));

        $arr_Dtaparen = [];
        $i            = 1;
        $datos_result = $result->data;

        foreach ($datos_result as $dataMarc) {
            $arr_Dtaparen[$i] = [$dataMarc->idParentesco, $dataMarc->txtDesc];
            $i++;
        }
        $last_id++;
        $arr_Dtaparen[$i] = [$last_id, "Amigo"];
        $i++;
        $last_id++;
        $arr_Dtaparen[$i] = [$last_id, "Empleado"];
        @@arr_Dtaparen    = $arr_Dtaparen;
    } catch (Exception $e) {
        //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
        $result['mensaje']         = 'false';
        $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
        @@tri_msg_error            = $msg_m;
    }

    //PAIS
    $sql_cata_infoPais = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Catalogo_Pais'";
    $rs_infoPais       = executeQuery($sql_cata_infoPais);

    $url_infoPais     = isset($rs_infoPais['1']['DESCRIPCION']) ? $rs_infoPais['1']['DESCRIPCION'] : '';
    $url_inPais_param = $url_infoPais = isset($rs_infoPais['1']['DESCRIPCION']) ? $rs_infoPais['1']['DESCRIPCION'] : '';
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_inPais_param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "Authorization: Bearer " . $token,
            ]
        );

        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            $msg_m          = curl_error($ch);
            @@tri_msg_error = $msg_m;
        }
        curl_close($ch);

        $result = json_decode($res);

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'VCA-SVPP-334',
            $url_inPais_param,
            'GET',
            "Authorization: Bearer " . $token,
            '',
            json_encode($result),
            json_encode($msg_m));

        $arr_Dtapais  = [];
        $i            = 1;
        $datos_result = $result->data;

        foreach ($datos_result as $dataPais) {
            $arr_Dtapais[$i] = [$dataPais->codPais, $dataPais->txtDesc];
            $i++;
        }

        @@arr_Dtapais = $arr_Dtapais;
    } catch (Exception $e) {
        //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
        $result['mensaje']         = 'false';
        $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
        @@tri_msg_error            = $msg_m;
    }

    //PROVINCIAS
    @@frm_accidente_provincia = @@frm_accidente_provincia ? @@frm_accidente_provincia : '17';
    @@frm_accidente_ciudad    = @@frm_accidente_ciudad ? @@frm_accidente_ciudad : '1';
    @@frm_accidente_pais      = @@frm_accidente_pais ? @@frm_accidente_pais : '1';
    $pais_portal              = @@frm_accidente_pais;
    $sql_cata_infoProv        = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'consultarProvincias'";
    $rs_infoProv              = executeQuery($sql_cata_infoProv);

    $url_infoProv     = isset($rs_infoProv['1']['DESCRIPCION']) ? $rs_infoProv['1']['DESCRIPCION'] : '';
    $url_inProv_param = $url_infoProv . $pais_portal;
    print_r($url_inProv_param);
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_inProv_param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "Authorization: Bearer " . $token,
            ]
        );

        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            $msg_m          = curl_error($ch);
            @@tri_msg_error = $msg_m;
        }
        curl_close($ch);

        $result = json_decode($res);

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'VCA-SVPP-400',
            $url_inProv_param,
            'GET',
            "Authorization: Bearer " . $token,
            '',
            json_encode($result),
            json_encode($msg_m));

        $arr_Dtaprov  = [];
        $i            = 1;
        $datos_result = $result->data;

        foreach ($datos_result as $dataProv) {
            $arr_Dtaprov[$i] = [$dataProv->codDpto, $dataProv->txtDesc];
            $i++;
        }
        @@arr_Dtaprov = $arr_Dtaprov;
    } catch (Exception $e) {
        //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
        $result['mensaje']         = 'false';
        $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
        @@tri_msg_error            = $msg_m;
    }
    //CANTONES

    $prov_portal       = @@frm_accidente_provincia;
    $id_ciudad         = @@frm_accidente_ciudad;
    $sql_cata_infoCant = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'consultarCantones'";
    $rs_infoCant       = executeQuery($sql_cata_infoCant);

    $url_infoCant      = isset($rs_infoCant['1']['DESCRIPCION']) ? $rs_infoCant['1']['DESCRIPCION'] : '';
    $url_infCant_param = $url_infoCant . $prov_portal;

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_infCant_param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "Authorization: Bearer " . $token,
            ]
        );

        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            $msg_m          = curl_error($ch);
            @@tri_msg_error = $msg_m;
        }
        curl_close($ch);

        $result = json_decode($res);

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'VCA-SVPP-464',
            $url_infCant_param,
            'GET',
            "Authorization: Bearer " . $token,
            '',
            json_encode($result),
            json_encode($msg_m));

        $arr_DtaCant  = [];
        $i            = 1;
        $datos_result = $result;

        foreach ($datos_result as $dataCant) {
            $arr_DtaCant[$i] = [$dataCant->codCanton, $dataCant->txtDesc];
            if ($id_ciudad == $dataCant->codCanton) {
                @@frm_accidente_ciudad_nombre = $dataCant->txtDesc;
            }
            $i++;
        }
        @@arr_DtaCant = $arr_DtaCant;
    } catch (Exception $e) {
        //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
        $result['mensaje']         = 'false';
        $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
        @@tri_msg_error            = $msg_m;
    }
    //AGENTE
    $codagenet_portal     = @@frm_codAgente;
    $codtipoagenet_portal = @@frm_codTipoAgente;

    $sql_cata_infoAgente = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_agente'";
    $rs_infoAgente       = executeQuery($sql_cata_infoAgente);

    $url_infoAgente      = isset($rs_infoAgente['1']['DESCRIPCION']) ? $rs_infoAgente['1']['DESCRIPCION'] : '';
    $url_infAgente_param = $url_infoAgente . 'codigoAgente=' . $codagenet_portal . '&codigoTipoAgente=' . $codtipoagenet_portal;

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_infAgente_param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                "Accept: application/json",
                "Content-Type: application/json",
                "Accept-Language: application/json",
                "Authorization: Bearer " . $token,
                "APIKEY: " . $apikey,
            ]
        );

        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            $msg_m          = curl_error($ch);
            @@tri_msg_error = $msg_m;
        }
        curl_close($ch);

        $result = json_decode($res);

        PMFBitacoraServicios(
            @@APP_NUMBER,
            'trigger',
            'VCA-SVPP-532',
            $url_infAgente_param,
            'GET',
            "Authorization: Bearer " . $token . "APIKEY: " . $apikey,
            '',
            json_encode($result),
            json_encode($msg_m));

        $i            = 1;
        $datos_result = $result->data;

        foreach ($datos_result as $dataAgente) {
            @@frm_busqueda_datosBroker    = $dataAgente->txtApellido1;
            @@frm_busqueda_datosBroker_Id = $dataAgente->nroNit;
        }
        /*echo($url_infAgente_param);
        echo(@@frm_busqueda_datosBroker_Id);
        die();*/
    } catch (Exception $e) {
        echo 'ExcepciÃƒÂ³n capturada: ', $e->getMessage(), "\n";
        $result['mensaje']         = 'false';
        $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
        @@tri_msg_error            = $msg_m;
    }

    $host = @@URL_SERVER_SQL;

    $url = "$host";

    @@tri_url_bpm = $url;
}

