<?php
//Consultar Datos Solicitud

$pro_uid        = @@PROCESS;
@@tri_msg_error = '';

//campo fecha
@@tri_fecha_actual = date('Y-m-d');

//grid de coberturas
/*
@=grd_registro_siniestro = array(
   '1' => array('grd_s_cobertura'=>'PERDIDA PARCIAL POR ROBO', 'grd_s_sumaAsegurada'=>0.00, 'grd_s_montoSolicitado'=>'0.00'),
   '2' => array('grd_s_cobertura'=>'PERDIDA PARCIAL POR DAÑO', 'grd_s_sumaAsegurada'=>0.00, 'grd_s_montoSolicitado'=>'0.00'),
   '3' => array('grd_s_cobertura'=>'PERDIDA TOTAL ROBO','grd_s_sumaAsegurada'=>0.00, 'grd_s_montoSolicitado'=>'0.00'),
   '4' => array('grd_s_cobertura'=>'PERDIDA TOTAL DAÑO','grd_s_sumaAsegurada'=>0.00, 'grd_s_montoSolicitado'=>'0.00'),
	'5' => array('grd_s_cobertura'=>'RESPONSABILIDAD CIVIL','grd_s_sumaAsegurada'=>0.00, 'grd_s_montoSolicitado'=>'0.00')
);*/
//catalogos de marcas modelos
//obtengo el token
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN'";
$rs_auth       = executeQuery($sql_cata_auth);

$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

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
    curl_setopt($ch, CURLOPT_HTTPHEADER,
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
        'GSS-RC-61',
        $url_inMarcas_param,
        'GET',
        "Authorization: Bearer " . $token,
        json_encode($json),
        json_encode($result),
        json_encode($msg_m));

    $arr_Dtamarcas = [];
    $i             = 1;
    $datos_result  = $result->data;

    foreach ($datos_result as $dataMarc) {
        $arr_Dtamarcas[$i] = [$dataMarc->idMarca, $dataMarc->nombreMarca];
        $i++;
    }

    @@arr_Dtamarcas = $arr_Dtamarcas;
} catch (Exception $e) {
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje']         = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error            = $msg_m;
}

//Parenteco
$sql_cata_infoParen = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Catalogo_Tipo_Parentesco'";
$rs_infoParen       = executeQuery($sql_cata_infoParen);

$url_infoParen     = isset($rs_infoParen['1']['DESCRIPCION']) ? $rs_infoParen['1']['DESCRIPCION'] : '';
$url_inparen_param = $url_infoParen;
try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inparen_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
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

    $arr_Dtaparen = [];
    $i            = 1;
    $datos_result = $result->data;

    foreach ($datos_result as $dataMarc) {
        $arr_Dtaparen[$i] = [$dataMarc->idParentesco, $dataMarc->txtDesc];
        $i++;
    }

    @@arr_Dtaparen = $arr_Dtaparen;
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
    curl_setopt($ch, CURLOPT_HTTPHEADER,
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
