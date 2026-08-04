<?php
@@frm_respuesta_cliente="";
@@frm_dana_observacion_cliente = '';
@@frm_respuesta_cliente_label="";
$task = @@TASK;

$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;

//OBTENER LA URL Y KEY AUTORIZACION DE DEBITO
$sql = "SELECT VALOR,DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'CONVERSATION_DEBITO_URL'
AND ESTADO = 1";
$rs  = executeQuery($sql,$cnx);
$conversation_id = $rs['1']['DESCRIPCION'];
$conversation_key = $rs['1']['VALOR'];
@@conversation_debito_key=$conversation_key;
@@conversation_debito_url=$conversation_id;
$fecha_inicio = date('Y-m-d H:i:s');

//Setear por defecto datos para autorización de debitO
$conversation_url=@@conversation_debito_url;
$usr=@@conversation_debito_key;

@@sw_sol = @@sw_sol +10;
@@id_proceso_version = @@APP_NUMBER.'ESPA'.@@sw_sol;

$dana_texto_mail="la autorización de débito";
$dana_asunto_mail="Autorización de débito";
$TipoId=@@frm_tipo_identificacion_pagador_label;
$Identificacion=@@frm_cedula_pagador;
$Nombres=@@frm_nombre_pagador;
$Apellidos=@@frm_apellidos_pagador;

$data = array(
    "TipoId"=>$TipoId,
    "Identificacion"=>$Identificacion,
    "Nombres"=>$Nombres,
    "Apellidos"=>$Apellidos,
    "Celular"=>@@frm_celular_debito,
    "Email"=>@@frm_correo_electronico_debito,
    "NombreEjecutivo"=>@@frm_vendedor_nombre,
    "EmailEjecutivo"=>@@frm_vendedor_email,
    "CelularEjecutivo"=>@@frm_vendedor_telefono,
    "CanalEjecutivo"=>"Especialista",
    "AsuntoMail"=>$dana_asunto_mail,
    "TextoMail"=>$dana_texto_mail,
    "LinkSolicitud"=>"",
    "LinkAutorizacion"=>@@dana_link_autorizacion,
    "LinkCotizacion"=>"",
    "LinkCovid"=>"",
    "IdProceso"=>@@APPLICATION,
    "IdVersionProceso"=>@@id_proceso_version,
    "client_id"=>@@client_pm_id,
    "client_secret"=>@@client_pm_secret,
    "ServerPM"=>@@server_pm,
    "username"=>@@dana_pagador_usr,
    "password"=>@@dana_pagador_pwd,
    "Index_Tarea"=>(int)@@INDEX + 2
);

$url = $conversation_url;

@@tmp_dj_aurl = $url;
//$usr=$usuario.":".$clave;

$data= json_encode($data);
@@tmp_dj_adata = $data;
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

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'autorizacion de debito',
        $url,
        'POST',
        $usr,
        $data,
        "",
        ""
    );

    $response = curl_exec($curl);
    $err      = curl_error($curl);


    curl_close($curl);

    //	@@tmp_res = $response;
    $datos['data'] = json_decode($response,true);
    //	@@tmp_dj = 'entro ac';
    @@result_dana=$datos['data'];
    @@resultado_dana=$datos['data']['wsResult']['resultDescription'];


}
catch(SoapFault $result){
    @@resultado_dana=$result;
    //$result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='$task' and STEP_POSITION = 1");
    @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
    $g = new G();
    $g->SendMessageText("Error al enviar al cliente catch", "WARNING");
    //PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
}

// grabacion en tabla de log ws
$cnx = "1479570925ec29f1d8d1d57019959618";
$app_uid = @@APPLICATION;
$app_number = @@APP_NUMBER;
$ws = $url;
$nombre_ws = 'DANA 1 DOC';
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

