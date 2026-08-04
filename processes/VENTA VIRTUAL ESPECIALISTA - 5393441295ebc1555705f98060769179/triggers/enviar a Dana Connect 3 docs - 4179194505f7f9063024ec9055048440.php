<?php
$tarea = @@TASK;
@@frm_respuesta_cliente="";
@@frm_dana_observacion_cliente = '';
@@frm_respuesta_cliente_label="";

$TipoId=@@frm_tipo_identificacion_label;
$Identificacion=@@frm_numero_identificacion;
$Nombres=@@frm_primer_nombre.' '.@@frm_segundo_nombre;
$Apellidos=@@frm_apellido_paterno.' '.@@frm_apellido_materno;
$url=@@conversation_tresfile_url;
$usr=@@conversation_tresfile_key;
$dana_texto_mail="la solicitud de tu póliza";
$dana_asunto_mail="Solicitud de Póliza";

$swSolActual = @@sw_sol;
if ($swSolActual === '' || $swSolActual === null || !is_numeric($swSolActual)) {
    $swSolActual = 0;
}
@@sw_sol = (int)$swSolActual + 10;

$id_proceso_version = @@APP_NUMBER.'ESP3D'.@@sw_sol;

if(@@dana_link_covid==null){
    @@dana_link_covid="";
}
if(@@dana_link_cotizacion==null){
    @@dana_link_cotizacion="";
}
if(@@dana_link_autorizacion==null){
    @@dana_link_autorizacion="";
}
$fecha_inicio = date('Y-m-d H:i:s');

$indexActual = @@INDEX;
$indexActual = trim((string)$indexActual);
if (!is_numeric($indexActual)) {
    $indexActual = 0;
}
$proximo_index = (int)$indexActual + 1;


$data = array(
    "TipoId"=>$TipoId,
    "Identificacion"=>$Identificacion,
    "Nombres"=>$Nombres,
    "Apellidos"=>$Apellidos,
    "Celular"=>@@telefono_preferido,
    "Email"=>@@correo_preferido,
    "NombreEjecutivo"=>@@frm_vendedor_nombre,
    "EmailEjecutivo"=>@@frm_vendedor_email,
    "CelularEjecutivo"=>@@frm_vendedor_telefono,
    "CanalEjecutivo"=>"Especialista",
    "AsuntoMail"=>$dana_asunto_mail,
    "TextoMail"=>$dana_texto_mail,
    "LinkSolicitud"=>@@dana_link_solicitud,
    "LinkFormulario"=>@@dana_link_formulario,
    "LinkAutorizacion"=>"",//@@dana_link_autorizacion,
    "LinkCotizacion"=>@@dana_link_cotizacion,
    "LinkCovid"=>@@dana_link_covid,
    "IdProceso"=>@@APPLICATION,
    "IdVersionProceso"=>$id_proceso_version,
    "client_id"=>@@client_pm_id,
    "client_secret"=>@@client_pm_secret,
    "ServerPM"=>@@server_pm,
    "username"=>@@client_pm_user,
    "password"=>@@client_pm_pwd,
    "Index_Tarea"=>$proximo_index
);

@@tmp_dj_url = $url;
//$usr=$usuario.":".$clave;

$data= json_encode($data);
@@tmp_dj_data = $data;
//@@tmp_usr=$usr;
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL            => $url,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Basic ". $usr
    ),
    CURLOPT_POSTFIELDS	=>	$data
));

try{
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    curl_close($curl);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'Enviar a Dana Connect 3 docs',
        $url,
        'POST',
        "Authorization: Basic . $usr",
        $data,
        $response,
        $err
    );

    //	@@tmp_res = $response;
    $datos['data'] = json_decode($response,true);
    //	@@tmp_dj = 'entro ac';
    @@result_dana=$datos['data'];
    @@resultado_dana=$datos['data']['wsResult']['resultDescription'];

    if(@@resultado_dana!="OK"){
        $result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='$tarea' and STEP_POSITION = 1");
        @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
        $g = new G();
        $g->SendMessageText("Error al enviar al cliente try 3d", "WARNING");
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
    }
}
catch(SoapFault $result){
    @@resultado_dana=$result;
    $result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='$tarea' and STEP_POSITION = 1");
    @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
    $g = new G();
    $g->SendMessageText("Error al enviar al cliente catch", "WARNING");
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
}

// grabacion en tabla de log ws
$cnx = "1479570925ec29f1d8d1d57019959618";
$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;
$ws = $url;
$nombre_ws = 'DANA 3 DOCS';
$id_consultada = $Identificacion;
$tipo_interviniente = 'Cliente';
$respuesta = @@resultado_dana;
$fecha_fin = date('Y-m-d H:i:s');

$sql = "INSERT INTO VV_LOG_WS (
    APP_UID,
    APP_NUMBER,
    WS,
    NOMBRE_WS,
    ID_CONSULTADA,
    TIPO_INTERVINIENTE,
    RESPUESTA,
    FECHA_INICIO,
    FECHA_FIN
)
VALUES
(
    '$app_uid',
    '$app_number',
    '$ws',
    '$nombre_ws',
    '$id_consultada',
    '$tipo_interviniente',
    '$respuesta',
    '$fecha_inicio',
    '$fecha_fin'
)" ;
$rs   = executeQuery($sql,$cnx);
