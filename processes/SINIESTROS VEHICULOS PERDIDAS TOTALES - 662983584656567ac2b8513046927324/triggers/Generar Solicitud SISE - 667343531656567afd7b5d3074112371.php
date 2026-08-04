<?php
//<?php
//created by Henry
//24-12-2020
//Guardar Documentos Compartida

$pro_uid = @@PROCESS;
//consulto del catalogo
//obtengo el api_key

//estado de la bandera

$sql = "SELECT id, bandera FROM SINIESTRO_VH_CONFIGURACION WHERE id = (SELECT MAX(id) FROM SINIESTRO_VH_CONFIGURACION)";

$rs         = executeQuery($sql);
$app_number = @@APP_NUMBER;

$id_bandera = $rs['1']['bandera'];
if ($id_bandera == "SI") {
    @@bandera_pendiente_actualizacion  = "1";
    $de                                = '';
    $para                              = @@tri_correo_desarrollador_cc;
    $bcc                               = '';
    $asunto                            = "Actualizar reserva - " . $app_number;
    $texto                             = '<p align="justify">Estimado(a),&nbsp;Colaborador</p>';
    $texto                            .= '<p align="justify">Se le notifica que se intentó actualizar una reserva durante el cierre de mes</tipo>
		</p>';
    $comentario     = '';
    $accion         = '';
    $plantilla_rec  = 'Plantilla_mail.html';

    @@envio_mail_t1 = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, ['tri_texto_mail' =>
        $texto]);
    @@frm_accion = "CIERRE_MES";
    return;
}

$id_pv = @@frm_id_pv;

if ($id_pv == '' || $id_pv == null) {

    $cobertura_aplicada = @@frm_cobertura_aplicada;
    echo 'Cobertura aplicada sin IDPV: ' . $cobertura_aplicada . '<br>';
    $placa = @@frm_vehiculo_placa;
    $URL   = 'https://apimgr.equinoccialonline.com/v1/traductor/gestionproductos/poliza/vehiculo/validarVigencia?placa=' . $placa . '&codUsuario=USRPORTALDIGITAL';
    echo $URL;


    try{

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL            => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => [
            'Sesa-Key: 20aa9c2054a642939bbd3e9cc30f72e9',
            'apikey: eyJ4NXQiOiJPREUzWTJaaE1UQmpNRE00WlRCbU1qQXlZemxpWVRJMllqUmhZVFpsT0dJeVptVXhOV0UzWVE9PSIsImtpZCI6ImdhdGV3YXlfY2VydGlmaWNhdGVfYWxpYXMiLCJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJJbmZyYWVzdHJ1Y3R1cmFAY2FyYm9uLnN1cGVyIiwiYXBwbGljYXRpb24iOnsib3duZXIiOiJJbmZyYWVzdHJ1Y3R1cmEiLCJ0aWVyUXVvdGFUeXBlIjpudWxsLCJ0aWVyIjoiVW5saW1pdGVkIiwibmFtZSI6IlBvcnRhbCBkZSBTZXJ2aWNpb3MiLCJpZCI6NSwidXVpZCI6ImZmYTVlMWQ3LWFiYjctNGMwNy1iODRiLTJhY2FkN2QwOTIyNSJ9LCJpc3MiOiJodHRwczpcL1wvMTAuMTAuMTEuMjQzOjk0NDNcL29hdXRoMlwvdG9rZW4iLCJ0aWVySW5mbyI6eyJVbmxpbWl0ZWQiOnsidGllclF1b3RhVHlwZSI6InJlcXVlc3RDb3VudCIsImdyYXBoUUxNYXhDb21wbGV4aXR5IjowLCJncmFwaFFMTWF4RGVwdGgiOjAsInN0b3BPblF1b3RhUmVhY2giOnRydWUsInNwaWtlQXJyZXN0TGltaXQiOjAsInNwaWtlQXJyZXN0VW5pdCI6bnVsbH19LCJrZXl0eXBlIjoiUFJPRFVDVElPTiIsInBlcm1pdHRlZFJlZmVyZXIiOiIiLCJzdWJzY3JpYmVkQVBJcyI6W3sic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJHQ19BbGlhbnphQ29tZXJjaW9zX0F1dG9wYWdvIiwiY29udGV4dCI6IlwvdjFcL0dlc3Rpb25DbGllbnRlXC9BbGlhbnphc0NvbWVyY2lvc1wvQXV0b3BhZ28iLCJwdWJsaXNoZXIiOiJkb3ZpZWRvIiwidmVyc2lvbiI6InYxIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJHQ19NYW50ZW5pbWllbnRvX0NvbnRyYXRhbnRlIiwiY29udGV4dCI6IlwvdjFcL0dlc3Rpb25DbGllbnRlXC9NYW50ZW5pbWllbnRvXC9Db250cmF0YW50ZSIsInB1Ymxpc2hlciI6ImRvdmllZG8iLCJ2ZXJzaW9uIjoidjEiLCJzdWJzY3JpcHRpb25UaWVyIjoiVW5saW1pdGVkIn0seyJzdWJzY3JpYmVyVGVuYW50RG9tYWluIjoiY2FyYm9uLnN1cGVyIiwibmFtZSI6IkdDX01hbnRlbmltaWVudG9fUGVyc29uYVVuaWNhIiwiY29udGV4dCI6IlwvdjFcL0dlc3Rpb25DbGllbnRlXC9NYW50ZW5pbWllbnRvXC9QZXJzb25hVW5pY2EiLCJwdWJsaXNoZXIiOiJkb3ZpZWRvIiwidmVyc2lvbiI6InYxIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJHQ19TZXJ2aWNpb0NsaWVudGVfUG9ydGFsU2VydmljaW9zX0JhY2tFbmQiLCJjb250ZXh0IjoiXC92MVwvR2VzdGlvbkNsaWVudGVcL1BvcnRhbFNlcnZpY2lvc1wvQmFja2VuZCIsInB1Ymxpc2hlciI6ImRvdmllZG8iLCJ2ZXJzaW9uIjoidjEiLCJzdWJzY3JpcHRpb25UaWVyIjoiVW5saW1pdGVkIn0seyJzdWJzY3JpYmVyVGVuYW50RG9tYWluIjoiY2FyYm9uLnN1cGVyIiwibmFtZSI6IkdDX1NlcnZpY2lvQ2xpZW50ZV9Qb3J0YWxTZXJ2aWNpb3NfQmFja2VuZFZpZGEiLCJjb250ZXh0IjoiXC92MVwvR2VzdGlvbkNsaWVudGVcL1BvcnRhbFNlcnZpY2lvc1wvQmFja2VuZFZpZGEiLCJwdWJsaXNoZXIiOiJkb3ZpZWRvIiwidmVyc2lvbiI6InYxIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJHUF9TaW5pZXN0cm9zX1ZlaGljdWxvIiwiY29udGV4dCI6IlwvdjFcL0dlc3Rpb25Qcm9kdWN0b3NcL1Npbmllc3Ryb3NcL1ZlaGljdWxvIiwicHVibGlzaGVyIjoiZG92aWVkbyIsInZlcnNpb24iOiJ2MSIsInN1YnNjcmlwdGlvblRpZXIiOiJVbmxpbWl0ZWQifSx7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiTUNQX0JwbV9TZWd1cmlkYWQiLCJjb250ZXh0IjoiXC92MVwvTWVqb3JhQ29udGludWFQcm9jZXNvc1wvQnBtXC9TZWd1cmlkYWQiLCJwdWJsaXNoZXIiOiJkb3ZpZWRvIiwidmVyc2lvbiI6InYxIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJNQ1BfQnBtX05lZ29jaW8iLCJjb250ZXh0IjoiXC92MVwvTWVqb3JhQ29udGludWFQcm9jZXNvc1wvQnBtXC9OZWdvY2lvIiwicHVibGlzaGVyIjoiZG92aWVkbyIsInZlcnNpb24iOiJ2MSIsInN1YnNjcmlwdGlvblRpZXIiOiJVbmxpbWl0ZWQifSx7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiTUNQX0JwbV9WaWRhX05lZ29jaW8iLCJjb250ZXh0IjoiXC92MVwvTWVqb3JhQ29udGludWFQcm9jZXNvc1wvQnBtXC9WaWRhXC9OZWdvY2lvIiwicHVibGlzaGVyIjoiZG92aWVkbyIsInZlcnNpb24iOiJ2MSIsInN1YnNjcmlwdGlvblRpZXIiOiJVbmxpbWl0ZWQifSx7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiTUNQX0JwbV9WaWRhX1NlZ3VyaWRhZCIsImNvbnRleHQiOiJcL3YxXC9NZWpvcmFDb250aW51YVByb2Nlc29zXC9CcG1cL1ZpZGFcL1NlZ3VyaWRhZCIsInB1Ymxpc2hlciI6ImRvdmllZG8iLCJ2ZXJzaW9uIjoidjEiLCJzdWJzY3JpcHRpb25UaWVyIjoiVW5saW1pdGVkIn0seyJzdWJzY3JpYmVyVGVuYW50RG9tYWluIjoiY2FyYm9uLnN1cGVyIiwibmFtZSI6IkNfRW1haWxfTm90aWZpY2FjaW9uTWlkZGxld2FyZSIsImNvbnRleHQiOiJcL3YxXC9DYW5hbGVzXC9FbWFpbFwvTm90aWZpY2FjaW9uTWlkZGxld2FyZSIsInB1Ymxpc2hlciI6ImRvdmllZG8iLCJ2ZXJzaW9uIjoidjEiLCJzdWJzY3JpcHRpb25UaWVyIjoiVW5saW1pdGVkIn0seyJzdWJzY3JpYmVyVGVuYW50RG9tYWluIjoiY2FyYm9uLnN1cGVyIiwibmFtZSI6IkdDX01hbnRlbmltaWVudG9fUGVyc29uYV9DYXRhbG9nbyIsImNvbnRleHQiOiJcL3YxXC9HZXN0aW9uQ2xpZW50ZVwvTWFudGVuaW1pZW50b1wvUGVyc29uYVwvQ2F0YWxvZ28iLCJwdWJsaXNoZXIiOiJkb3ZpZWRvIiwidmVyc2lvbiI6InYxIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJHSUFfVHJhZHVjdG9yIiwiY29udGV4dCI6IlwvdjFcL3RyYWR1Y3RvciIsInB1Ymxpc2hlciI6ImRvdmllZG8iLCJ2ZXJzaW9uIjoidjEiLCJzdWJzY3JpcHRpb25UaWVyIjoiVW5saW1pdGVkIn1dLCJ0b2tlbl90eXBlIjoiYXBpS2V5IiwicGVybWl0dGVkSVAiOiIiLCJpYXQiOjE3MDY5MDU0ODksImp0aSI6IjA5MTg4NmM4LTEwMTYtNGQ2OS1iNDJiLWI1MDQ3NWY1YWIyNCJ9.Adqiiao13HJ2QEHIam2ZAmYEw6U4PR45Sffi643m5dBDO5EEcyE86wlRb8wJexv4Mv987tCJsViL70WxLzo1sP6gKWoaBZ9N0QX129l6fKu5FweM2MwcdbrIEVSRl51o0d4EpSwbDkzWy8QmVuEKqnVvSyt4KmN1fWuXzuwQqd4wFs7NJBwND6dDGXpKlDN9ZQyq10WqHdvFXSIzIqbnrwqPdQWCmqZTl_OJt9M0JO3rnIXXqayCZ2O54y2XZhradDIv7Rin9B2BAiFlDqVJRXkWQE08TtRAPt_0DmtJww6AxeWBokS7AEgqdeOHuqz6IDEtVyaL7Lg1z7AM8vrmNQ==',
            'Authorization: 3Y5hdcFZecClx4vOCwW0lYeCWRvePePB',
        ],
    ]);

    $response = curl_exec($curl);

    $response = json_decode($response);

    echo $URL;

    if (curl_errno($curl)) {
        throw new Exception(curl_error($curl));
    }
    curl_close($curl);

    $id_pv = $response->data[0]->id_pv;
    @@frm_id_pv = $id_pv;
    echo $id_pv;



    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'GSS-SVPT-80',
        $URL,
        'GET',
        "Sesa-Key " . "apikey",
        "",
        json_encode($response),
        json_encode($msg_m));

    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        return ;

    }

     return;
}

$sql_cata_auth = "SELECT DESCRIPCION, CAMPO2, CAMPO1 FROM ADMIN_CATALOGOS WHERE CODIGO = 'Crear_reserva'";
$rs_auth       = executeQuery($sql_cata_auth);
$token         = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

$url_reserva = isset($rs_auth['1']['CAMPO1']) ? $rs_auth['1']['CAMPO1'] : '';

$sql_webhook = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE CODIGO = 'WEBHOOK_CREAR_RESERVA'";
$rs_webhook  = executeQuery($sql_webhook);
$webhook     = isset($rs_webhook['1']['DESCRIPCION']) ? $rs_webhook['1']['DESCRIPCION'] : '';

/*echo($token);
	echo($url_reserva);*/
//consulto los documento
//output document
$caseUID = @@APPLICATION; //set to the Output Document's unique ID
//find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table

$g = new G();

$sn_muestra = -1;
$cod_suc    = @@frm_poliza_codSucursal;
$cod_ramo   = intval(@@frm_codRamo);
$nro_pol    = intval(@@frm_poliza_numero);
$id_pv      = intval(@@frm_id_pv);
$cod_aseg   = intval(@@frm_cod_aseg);
//$fec_hora_reclamo = @@frm_busqueda_fechaSiniestro."T00:00:00Z";
$fec_hora_reclamo = @@frm_busqueda_fechaSiniestro . "T00:00:00Z";
$fec_inspec       = @@frm_busqueda_fechaSiniestro . "T00:00:00Z";
$cod_item         = @@frm_codItem ? intval(@@frm_codItem) : 0;

$coberturas = [];
//separated by comma from @@frm_cobertura_aplicada

$coberturas    = explode(",", @@frm_cobertura_aplicada);
$cod_cobertura = @@tri_cod_cobertura;

//$cod_ind_cob = $cod_cobertura;
// $cod_ind_cob = intval($coberturas[0]);
$cod_ind_cob = @@tri_cod_ind_cob;

if ($cod_ind_cob == null) {
    $cod_ind_cob = intval(@@grd_registro_siniestro[1]['grd_s_codConsecutivo']);
}
echo "Causa";
$cod_causa = 0;
if ($cod_cobertura == 1 || $cod_cobertura == 38) { //PARCIAL ROBO
    $cod_causa = 22;
}
if ($cod_cobertura == 2 || $cod_cobertura == 36) { //PARCIAL DAÑO
    $cod_causa = 27;
}
if ($cod_cobertura == 3 || $cod_cobertura == 39) { //TOTAL ROBO
    $cod_causa = 23;
}
if ($cod_cobertura == 4 || $cod_cobertura == 37) { //TOTAL DAÑO
    $cod_causa = 26;
}
if ($cod_cobertura == 5 || $cod_cobertura == 35) { //SOLO RC
    $cod_causa = 28;
}
echo "Cod_causa " . $cod_causa;

if ($cod_causa == 0) {
    echo 'Cobertura seleccionada: ' . @@frm_cobertura_aplicada . '<br>';
    if (@@frm_cobertura_aplicada == 39) {
        $app_number = @@APP_NUMBER;
        //max = 10234 , min = 10060
        echo 'Cobertura seleccionada: ' . @@frm_cobertura_aplicada . '<br>';
        if ($app_number >= 10060 && $app_number <= 10234) {
            @@frm_cobertura_aplicada = 3;
            echo 'Nueva cobertura';
            return;
        }
    }
    if (@@frm_cobertura_aplicada == '39') {
        $app_number = @@APP_NUMBER;
        //max = 10234 , min = 10060
        echo 'Cobertura seleccionada: ' . @@frm_cobertura_aplicada . '<br>';
        if ($app_number >= 10060 && $app_number <= 10234) {
            @@frm_cobertura_aplicada = 3;
            echo 'Nueva cobertura';
            return;
        }
    }
    echo 'No se ha seleccionado una cobertura - No se ha encontrado';
    echo '<br>';
    echo 'Cobertura: ' . $cod_ind_cob;
    echo '<br>';
    echo 'Cobertura: ' . $cod_cobertura;

}

$cod_causa = intval($cod_causa);
//get usr analista
$id_analista           = @@tri_user_totales;
$sql                   = "SELECT USR_USERNAME FROM USERS WHERE USR_UID = '$id_analista'";
$rs                    = executeQuery($sql);
$cod_ajustador_inicial = isset($rs['1']['USR_USERNAME']) ? $rs['1']['USR_USERNAME'] : '';
$txt_reportado         = "USRVBPMSINIESTROS";
$cod_ajustador         = intval(@@tri_codigo_analista_sise);

//$cod_taller = @@datos_taller['1']['id_sise'];
$cod_taller = @@id_taller ? intval(@@id_taller) : 0;

$sn_DT          = -1;
$txt_conductor  = @@frm_conductor_nombres;
$txt_telefono   = @@frm_conductor_telefono;
$cod_marca      = intval(@@frm_vehiculo_codMarca);
$cod_modelo     = intval(@@frm_vehiculo_codMdelo);
$txt_motor      = @@frm_vehiculo_motor;
$txt_chasis     = @@frm_vehiculo_chasis;
$txt_patente    = @@frm_vehiculo_placa;
$txt_lugar_insp = @@frm_taller_ciudad;
$txt_contacto   = @@frm_taller_telefonoContacto;
$txt_direccion  = @@frm_siniestro_direccion;
//trim max 200 chars
$txt_direccion           = substr($txt_direccion, 0, 200);
$txt_telefono1           = @@frm_asegurado_telefono;
$fec_hora_recepcion      = @@frm_busqueda_fechaSiniestro . "T00:00:00Z";
$cod_usuario             = "CTITUANA";
$txt_anio                = intval(@@frm_vehiculo_anio);
$aaaa_inspeccion         = intval(date('Y'));
$txt_deducible           = "";
$cod_ajustador_dt        = 6;
$cod_evento_catastrofico = 0;
$operation_id            = @@APPLICATION;

@@fecha_hora_recepcion = null;
$fec_hora_recepcion    = @@fecha_hora_recepcion;
if ($fecha_hora_recepcion == '' || $fecha_hora_recepcion == null) {
    @@fecha_hora_recepcion = date('Y-m-d\TH:i:s\Z');
    $fec_hora_recepcion    = @@fecha_hora_recepcion;
}
$txt_reportado = @@APPLICATION;

$json_param = [
    "sn_muestra"              => $sn_muestra,
    "cod_suc"                 => $cod_suc,
    "cod_ramo"                => $cod_ramo,
    "nro_pol"                 => $nro_pol,
    "id_pv"                   => $id_pv,
    "cod_aseg"                => $cod_aseg,
    "fec_hora_reclamo"        => $fec_hora_reclamo,
    "fec_inspec"              => $fec_inspec,
    "cod_item"                => $cod_item,
    "cod_ind_cob"             => $cod_ind_cob,
    "cod_causa"               => $cod_causa,
    "cod_ajustador_inicial"   => $cod_ajustador_inicial,
    "txt_reportado"           => $txt_reportado,
    "cod_ajustador"           => $cod_ajustador,
    "cod_taller"              => $cod_taller,
    "sn_DT"                   => $sn_DT,
    "txt_conductor"           => $txt_conductor,
    "txt_telefono"            => $txt_telefono,
    "cod_marca"               => $cod_marca,
    "cod_modelo"              => $cod_modelo,
    "txt_motor"               => $txt_motor,
    "txt_chasis"              => $txt_chasis,
    "txt_patente"             => $txt_patente,
    "txt_lugar_insp"          => $txt_lugar_insp,
    "txt_contacto"            => $txt_contacto,
    "txt_direccion"           => $txt_direccion,
    "txt_telefono1"           => $txt_telefono1,
    "fec_hora_recepcion"      => $fec_hora_recepcion,
    "cod_usuario"             => $cod_usuario,
    "txt_anio"                => $txt_anio,
    "aaaa_inspeccion"         => $aaaa_inspeccion,
    "txt_deducible"           => $txt_deducible,
    "cod_ajustador_dt"        => $cod_ajustador_dt,
    "cod_evento_catastrofico" => $cod_evento_catastrofico,
    "operation_id"            => $operation_id,
    "webHookUrl"              => $webhook,

];
$json = json_encode($json_param);

@@tri_datos_sise = $json;

echo "URL: " . $url_reserva . "<br>";

try {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url_reserva);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            "Accept: */*",
            "Content-Type: application/json",
            //"Accept-Language: application/json",
            //"Sesa-Key : 20aa9c2054a642939bbd3e9cc30f72e9",
            "Connection: keep-alive",
            "apikey: " . $token,
            //"Authorization : Bearer ". $token,
            "Webhook-Endpoint: " . $webhook,
        ]
    );

    $res = curl_exec($ch);

    if (curl_errno($ch)) {
        $msg_m = curl_error($ch);

        echo($msg_m);
        echo($url_reserva);

        print_r($json);

        @@tri_msg_error        = $msg_m;
        @@tri_bandera_recupera = 'true';
    }

    curl_close($ch);
    $result = json_decode($res);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'GSS-SVPT-323',
        $url_reserva,
        'POST',
        "apikey: " . $token . "Webhook-Endpoint: " . $webhook,
        json_encode($json),
        json_encode($result),
        json_encode($msg_m));

    //@@sise_id_stro = $result['operation_id'];
    $sise_id       = $result->operation_id;
    @@sise_id_stro = $sise_id;
    echo json_encode([
        'tri_nro_stro' => $sise_id,
    ]);

    print_r($result);
    //die();

} catch (Exception $e) {
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje']         = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- ' . $e->getMessage();
    @@tri_msg_error            = $msg_m;
}
