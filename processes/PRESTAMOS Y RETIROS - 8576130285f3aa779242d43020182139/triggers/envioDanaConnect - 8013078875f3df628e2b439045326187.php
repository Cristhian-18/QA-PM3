<?php
$cnx = '4647520625f3ca6ed2d2621030136501';
$pro_uid = @@PROCESS;

//OBTENER LA URL Y KEY AUTORIZACION DE DEBITO
$sql = "SELECT CODIGO, DESCRIPCION, VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'INTEGRACION_DANA'
AND ESTADO = 1
AND PRO_UID = '$pro_uid'";
$rs  = executeQuery($sql,$cnx);

foreach($rs as $data_dana){
    if($data_dana['CODIGO'] == 'WS'){
        $conversation_id = $data_dana['DESCRIPCION'];
        $conversation_key = $data_dana['VALOR'];
        @@conversation_key=$conversation_key;
        @@conversation_url=$conversation_id;
    }

    if($data_dana['CODIGO'] == 'ASUNTO'){
        $AsuntoMail = $data_dana['VALOR'];
    }

    if($data_dana['CODIGO'] == 'CLIENT_PM_PWD'){
        $password = $data_dana['VALOR'];
    }

    if($data_dana['CODIGO'] == 'CLIENT_PM_ID'){
        $client_id = $data_dana['VALOR'];
    }

    if($data_dana['CODIGO'] == 'TEXTO'){
        $TextoMail = $data_dana['VALOR'];
    }

    if($data_dana['CODIGO'] == 'SERVER_PM'){
        $ServerPM = $data_dana['VALOR'];
    }

    if($data_dana['CODIGO'] == 'CLIENT_PM_USER'){
        $username = $data_dana['VALOR'];
    }
    if($data_dana['CODIGO'] == 'CLIENT_PM_SECRET'){
        $client_secret = $data_dana['VALOR'];
    }

}

$TipoSolicitud = @@frm_tipo_solicitud;
$TipoId=@@frm_tipo_identificacion;
$Identificacion=@@frm_numero_identificacion;
$Nombres=@@frm_primer_nombre;
$Apellidos=@@frm_apellido_paterno." ".@@frm_apellido_materno;
$Celular=	@@frm_celular_receptor;
$Email = @@frm_correo_electronico_receptor;
$NombreEjecutivo = @@USR_USERNAME;
$EmailEjecutivo = PMFGetUserEmailAddress('-1', @@APPLICATION);
$CelularEjecutivo = '';
$CanalEjecutivo = @@frm_tipo_solicitud_label;
//LINKS
$LinkSolicitud = @@link_dana_retiro;
$LinkAutorizacion = @@link_dana_prestamo1;
$LinkAutTransferencia = @@link_dana_prestamo2;
//
$IdProceso = @@APPLICATION;
$num = rand(1, 20);
$IdVersionProceso = @@APPLICATION.'_'.$num;

$conversation_url=@@conversation_url;

$data = array(
    "TipoSolicitud"=>$TipoSolicitud,
    "TipoId"=>$TipoId,
    "Identificacion"=>$Identificacion,
    "Nombres"=>$Nombres,
    "Apellidos"=>$Apellidos,
    "Celular"=>$Celular,
    "Email"=>$Email,
    "NombreEjecutivo"=>$NombreEjecutivo,
    "EmailEjecutivo"=>$EmailEjecutivo,
    "AsuntoMail"=>$AsuntoMail,
    "TextoMail"=>$TextoMail,
    "LinkSolicitud"=>$LinkSolicitud,
    "LinkAutorizacion"=>$LinkAutorizacion,
    "LinkAutTransferencia"=>$LinkAutTransferencia,
    "IdProceso"=>@@APPLICATION,
    "IdVersionProceso"=>$IdVersionProceso,
    "client_id"=>$client_id,
    "client_secret"=>$client_secret,
    "ServerPM"=>$ServerPM,
    "username"=>$username,
    "password"=>$password
);

//$url = @@conversation_debito_url1.$conversation_id.@@conversation_debito_url2;
$url = $conversation_url;

//@@tmp_dj_url = $url;
$usr=$conversation_key;

$data= json_encode($data);

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
  'TRIGGER',
  'ENVIO DANA CONECT',
  $url,
  'POST',
  "Authorization: Basic ". $usr,
  $data,
  $response,
  $err
);

    //	@@tmp_res = $response;
    $datos['data'] = json_decode($response,true);
    //	@@tmp_dj = 'entro ac';

    @@result_dana=$datos['data'];
    if(isset($datos['data']['wsError']))
    @@resultado_dana=$datos['data']['wsError']['errorDescription'];
    else
    if(isset($datos['data']['wsResult']))
    @@resultado_dana=$datos['data']['wsResult']['resultDescription'];


    if(@@resultado_dana!="OK"){
        $result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='3344220625f3aa7f69c4e00045814586' and STEP_POSITION = 1");
        @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
        $g = new G();
        $g->SendMessageText("Error al enviar al cliente try-".@@resultado_dana, "WARNING");
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
    }
}
catch(SoapFault $result){

    @@resultado_dana=$result;
    $result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='3344220625f3aa7f69c4e00045814586' and STEP_POSITION = 1");
    @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
    $g = new G();
    $g->SendMessageText("Error al enviar al cliente catch", "WARNING");
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
}

