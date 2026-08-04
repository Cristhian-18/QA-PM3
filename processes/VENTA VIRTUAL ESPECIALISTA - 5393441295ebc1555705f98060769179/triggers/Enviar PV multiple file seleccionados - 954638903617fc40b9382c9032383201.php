<?php
// <?php
//copy process PR
//Henry Bautista

@@frm_respuesta_cliente = '';
@@frm_respuesta_cliente_label = '';

$cnx                   = '1479570925ec29f1d8d1d57019959618';
$pro_uid               = 'GENERICO';
$case_id				= @@APPLICATION;

if(@@dana_link_solicitud==null || @@frm_modificar_solicitud[0]=='0'){
    $dana_link_solicitud="";
    $dana_link_cotizacion="";
}

if(@@dana_link_covid==null || @@frm_modificar_covid[0]=='0'){
    $dana_link_covid="";
}

if(@@dana_link_autorizacion==null || @@frm_modificar_debito[0]=='0'){
    $dana_link_autorizacion="";
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
    @@dana_texto_mail="documentación de solicitud de póliza";
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
@@condocs = @@condocs + 1;
@@versionProceso = @@APP_NUMBER.'_SOL_'.@@condocs;
$IdVersionProceso = @@versionProceso;
$Poliza = 'No Aplica';

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
    "LinkAutorizacion"=>$LinkAutorizacion,
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
        'Enviar PV multiple file seleccionados',
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
