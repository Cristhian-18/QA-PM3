<?php
// <?php
//copy process PR
//Henry Bautista

$tarea = @@TASK;
@@frm_respuesta_cliente="";
@@frm_dana_observacion_cliente = '';
@@frm_respuesta_cliente_label="";

$cnx                   = '1479570925ec29f1d8d1d57019959618';
$pro_uid               = 'GENERICO';
$case_id				= @@APPLICATION;

if(@@dana_link_covid==null){
    @@dana_link_covid="";
}
if(@@dana_link_cotizacion==null){
    @@dana_link_cotizacion="";
}
if(@@dana_link_autorizacion==null){
    @@dana_link_autorizacion="";
}

//OBTENER LA URL Y KEY AUTORIZACION DE DEBITO
$sql = "SELECT CODIGO, DESCRIPCION, VALOR FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'INTEGRACION_PVIDA'
AND ESTADO = 1
AND PRO_UID = '$pro_uid'";
$rs  = executeQuery($sql,$cnx);

foreach($rs as $data_pv){
    if($data_pv['CODIGO'] == 'WS'){
        $url = $data_pv['VALOR'];
    }
    /*if($data_pv['CODIGO'] == 'ASUNTO'){
        $AsuntoMail = $data_pv['VALOR'];
    }*/
    @@dana_asunto_mail="Solicitud de Póliza";
    $AsuntoMail = @@dana_asunto_mail;
    if($data_pv['CODIGO'] == 'CLIENT_PM_PWD'){
        $password = $data_pv['VALOR'];
    }
    if($data_pv['CODIGO'] == 'CLIENT_PM_ID'){
        $client_id = $data_pv['VALOR'];
    }
    /*if($data_pv['CODIGO'] == 'TEXTO'){
        $TextoMail = $data_pv['VALOR'];
    }
    */
    @@dana_texto_mail="solicitud de póliza ";
    $TextoMail = @@dana_texto_mail;
    if($data_pv['CODIGO'] == 'SERVER_PM'){
        $ServerPM = $data_pv['VALOR'];
    }
    if($data_pv['CODIGO'] == 'CLIENT_PM_USER'){
        $username = $data_pv['VALOR'];
    }
    if($data_pv['CODIGO'] == 'CLIENT_PM_SECRET'){
        $client_secret = $data_pv['VALOR'];
    }
    if($data_pv['CODIGO'] == 'ENTORNO'){
        $entorno = $data_pv['VALOR'];
    }
    if($data_pv['CODIGO'] == 'GET_TOKEN_URL'){
        $GetTokenURL = $data_pv['VALOR'];
    }
    if($data_pv['CODIGO'] == 'SEND_VARIABLES_URL'){
        $SendVariablesURL = str_replace("99999",$case_id,$data_pv['VALOR']);
    }
    if($data_pv['CODIGO'] == 'ROUTE_CASE_URL'){
        $RouteCaseURL = str_replace('99999',$case_id,$data_pv['VALOR']);
    }
}

$TipoProceso = 'V';//Otros
$TipoId=@@frm_tipo_identificacion_label;
$Identificacion=@@frm_numero_identificacion;
$Nombres=@@frm_primer_nombre.' '.@@frm_segundo_nombre;
$Apellidos=@@frm_apellido_paterno.' '.@@frm_apellido_materno;
$prefijo = '+593';
$fonoset = substr(@@telefono_preferido,1);
$Celular=$prefijo.$fonoset;
$Email = @@correo_preferido;
$NombreEjecutivo = @@frm_vendedor_nombre;
$EmailEjecutivo = @@frm_vendedor_email;
$CelularEjecutivo = @@frm_vendedor_telefono;
$CanalEjecutivo = "Especialista";
//LINKS
$LinkSolicitud = @@dana_link_solicitud;
$LinkAutorizacion = @@dana_link_autorizacion;
$LinkCovid = @@dana_link_covid;
$LinkCotizacion = @@dana_link_cotizacion;
//
$IdProceso = @@APPLICATION;
@@sw_sol = @@sw_sol +10;
@@versionProceso = @@APP_NUMBER.'ESP'.@@sw_sol;
$IdVersionProceso = @@versionProceso;
$Poliza = 'No Aplica';
$fecha_inicio = date('Y-m-d H:i:s');

$data = array(
    "TipoProceso"=>$TipoProceso,
    "TipoId"=>$TipoId,
    "Identificacion"=>$Identificacion,
    "Nombres"=>$Nombres,
    "Apellidos"=>$Apellidos,
    "Celular"=>$Celular,
    "Email"=>$Email,
    "NombreEjecutivo"=>$NombreEjecutivo,
    "EmailEjecutivo"=>$EmailEjecutivo,
    "CelularEjecutivo"=>$CelularEjecutivo,
    "CanalEjecutivo"=>$CanalEjecutivo,
    "AsuntoMail"=>$AsuntoMail,
    "TextoMail"=>$TextoMail,
    "LinkSolicitud"=>$LinkSolicitud,
    "LinkCovid"=>$LinkCovid,
    "LinkCotizacion"=>$LinkCotizacion,
    "IdProceso"=>$IdProceso,
    "IdVersionProceso"=>$IdVersionProceso,
    "client_id"=>$client_id,
    "client_secret"=>$client_secret,
    "ServerPM"=>$ServerPM,
    "username"=>$username,
    "password"=>$password,
    "entorno"=>$entorno,
    'Poliza'=>$Poliza,
    "GetTokenURL"=>$GetTokenURL,
    "SendVariablesURL"=>$SendVariablesURL,
    "RouteCaseURL"=>$RouteCaseURL,
    "Index_Tarea"=>@@INDEX
);

$data_json= json_encode($data);

@@data_json = $data_json;

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL            => $url,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json"
    ),
    CURLOPT_POSTFIELDS	=>	$data_json
));

try{
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    curl_close($curl);

    PMFBitacoraServicios(
        @@APP_NUMBER,
        'trigger',
        'Enviar PV 3 Docs',
        $url,
        'POST',
        'NO APLICA',
        $data_json,
        $response,
        $err
    );

    //	@@tmp_res = $response;
    $datos['data'] = json_decode($response,true);
    //	@@tmp_dj = 'entro ac';

    @@result_pv=$datos['data'];
    if(isset($datos['data']['OperationStatus']))
    @@resultado_dana=$datos['data']['OperationStatus'];
    else
    if(isset($datos['data']['OperationStatus']))
    @@resultado_dana=$datos['data']['OperationStatus'];

    if(@@resultado_dana!="Ok"){
        //verificar q se hace
        /*$result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='3344220625f3aa7f69c4e00045814586' and STEP_POSITION = 1");
        @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
        $g = new G();
        $g->SendMessageText("Error al enviar al cliente try-".@@resultado_dana, "WARNING");
        PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
        */
    }
}
catch(SoapFault $result){

    @@resultado_dana=$result;
    /*$result = executeQuery("SELECT * FROM STEP WHERE TAS_UID='3344220625f3aa7f69c4e00045814586' and STEP_POSITION = 1");
    @@stepUIDObj= $result[1]["STEP_UID_OBJ"];
    $g = new G();
    $g->SendMessageText("Error al enviar al cliente catch", "WARNING");
    PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', @@stepUIDObj);
    */
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
