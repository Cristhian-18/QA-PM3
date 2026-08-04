<?php
//Obtener Datos Friss
//<?php
//Incializar Datos Solicitud
$pro_uid = @@PROCESS;
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'APIKEY'";
$rs_auth = executeQuery($sql_cata_auth);

$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';


$sql_frizz_url = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consulta_Friss'";
$rs_frizz = executeQuery($sql_frizz_url);

$url_frizz = isset($rs_frizz['1']['DESCRIPCION']) ? $rs_frizz['1']['DESCRIPCION'] : '';
$url_frizz_param = $url_frizz;

//get the two first words in @@frm_busqueda_nombres
$apellidos = explode(" ", @@frm_busqueda_nombres);
$apellidos = $apellidos[0] . " " . $apellidos[1];

$array_datos_frizz = array(
    "tipo_endoso" => "COTIZACION",
    "ramo" => @@frm_poliza_ramo,
    "negocio" => @@frm_poliza_LineaNegocio,
    "tipo_persona" => "NATURAL",
    "tipo_agente" => "TRUE",
    "ciudad_agente" => "GUAYAQUIL",
    "aseg_apellidos" => $apellidos,
    "aseg_genero" => "MASCULINO",
    "aseg_identificacion" => @@frm_asegurado_identificacion,
    "aseg_tipo_dentificacion" => "CI",
    "aseg_estado_civil" => "UNION LIBR",
    "aseg_fecha_nac" => "2023-09-06",
    "aseg_telefono" => @@frm_busqueda_celular_1,
    "aseg_celular" => @@frm_busqueda_celular_1,
    "aseg_email" => @@frm_busqueda_mail_1,
    "aseg_tipo_cta_ban" => "",
    "vh_anio_fab" => @@frm_vehiculo_anio,
    "vh_placa" => @@frm_vehiculo_placa,
    "vh_inspeccion" => "TRUE",
    "fecha_emision" => @@frm_taller_fechaIngreso,
    "fecha_fin_vigencia" => @@frm_poliza_FechaFin,
    "fecha_ini_vigencia" => @@frm_poliza_FechaInicio,
    "tipo_uso" => "PRIVADO",
    "pol_estado" => "ACTIVO"
);
$json = json_encode($array_datos_frizz);

try {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_frizz_param);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
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
            "Connection:keep-alive",
            "APIKEY: " . $token
        )
    );

    $res = curl_exec($ch);
    if (curl_errno($ch)) {
        $msg_m = curl_error($ch);
    }
    curl_close($ch);
    $result = json_decode($res);

    PMFBitacoraServicios(@@APP_NUMBER, 'trigger',
    'Obtener datos friss', $url_frizz_param,
    'POST', 'SI', $token, $result, $msg_m);

    @@frm_friss_score = $result->descripcion;
    $data_friss['1'] = array(
        'frm_friss_fecha' => date("d/m/Y"),
        'frm_friss_name' => $result->indicador->name,
        'frm_friss_value' => $result->indicador->value,
        'frm_friss_argumentation' => $result->indicador->descripcionArgumentation
    );
    @=frm_friss_grid = $data_friss;
} catch (Exception $e) {
    echo 'ExcepciÃƒÂ³n capturada: ', $e->getMessage(), "\n";
    die();
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    //@@tri_msg_error = $msg_m;
}


