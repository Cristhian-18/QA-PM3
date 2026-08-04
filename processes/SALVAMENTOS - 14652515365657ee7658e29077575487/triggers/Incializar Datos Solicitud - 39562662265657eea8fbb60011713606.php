<?php
//<?php
//Incializar Datos Solicitud
$pro_uid = @@PROCESS;
@@tri_msg_error = '';

//catalogos de marcas modelos
//obtengo el token
$sql_cata_auth = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'TOKEN'";
$rs_auth =  executeQuery($sql_cata_auth);

$token = isset($rs_auth['1']['DESCRIPCION']) ? $rs_auth['1']['DESCRIPCION'] : '';

//CONDICIONES PÓLIZA

$sql_cata_condicionesPoliza = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_Condiciones_Poliza'";
$rs_condicionesPoliza=  executeQuery($sql_cata_condicionesPoliza);

$url_condicionesPoliza = isset($rs_condicionesPoliza['1']['DESCRIPCION']) ? $rs_condicionesPoliza['1']['DESCRIPCION'] : '';
$idPv = @@frm_id_pv;
$url_inCondiciones_param = $url_condicionesPoliza.$idPv;

try{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inCondiciones_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
    )
);

$res = curl_exec($ch);

if(curl_errno($ch)){
    $msg_m = curl_error($ch);
    @@tri_msg_error = $msg_m;
}
curl_close($ch);
$result = json_decode($res, true);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger',
'Inicializar datos solicitud', $url_inCondiciones_param,
'GET', 'Si', $token, $result, $msg_m);

@@tri_condiciones_poliza = $result['response']['descripcion'];

}
catch(Exception $e)
{
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
    @@tri_msg_error = $msg_m;
}
//MARCAS
$sql_cata_infoMarcas = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Catalogo_Marcas'";
$rs_infoMarcas=  executeQuery($sql_cata_infoMarcas);

$url_infomarcas = isset($rs_infoMarcas['1']['DESCRIPCION']) ? $rs_infoMarcas['1']['DESCRIPCION'] : '';
$url_inMarcas_param = $url_infomarcas;
try{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inMarcas_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
    )
);

$res = curl_exec($ch);

if(curl_errno($ch)){
    $msg_m = curl_error($ch);
    @@tri_msg_error = $msg_m;
}
curl_close($ch);

$result = json_decode($res);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger',
'Inicializar datos solicitud', $url_inMarcas_param,
'GET', 'NO', $token, $result, $msg_m);

$arr_Dtamarcas = array();
$i = 1;
$datos_result = $result->data;

foreach($datos_result as $dataMarc){
    $arr_Dtamarcas[$i] = array($dataMarc->idMarca, $dataMarc->nombreMarca);
    $i++;
}

@@arr_Dtamarcas = $arr_Dtamarcas;
}
catch(Exception $e)
{
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
    @@tri_msg_error = $msg_m;
}

//Parentesco
$sql_cata_infoParen = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Catalogo_Tipo_Parentesco'";
$rs_infoParen=  executeQuery($sql_cata_infoParen);

$url_infoParen = isset($rs_infoParen['1']['DESCRIPCION']) ? $rs_infoParen['1']['DESCRIPCION'] : '';
$url_inparen_param = $url_infoParen;
try{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inparen_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
    )
);

$res = curl_exec($ch);

if(curl_errno($ch)){
    $msg_m = curl_error($ch);
    @@tri_msg_error = $msg_m;
}
curl_close($ch);

$result = json_decode($res);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger',
'Inicializar datos solicitud', $url_inparen_param,
'GET', 'NO', $token, $result, $msg_m);


$arr_Dtaparen = array();
$i = 1;
$datos_result = $result->data;

foreach($datos_result as $dataMarc){
    $arr_Dtaparen[$i] = array($dataMarc->idParentesco, $dataMarc->txtDesc);
    $i++;
}

@@arr_Dtaparen = $arr_Dtaparen;
}
catch(Exception $e)
{
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
    @@tri_msg_error = $msg_m;
}

//PAIS
$sql_cata_infoPais = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Catalogo_Pais'";
$rs_infoPais=  executeQuery($sql_cata_infoPais);

$url_infoPais = isset($rs_infoPais['1']['DESCRIPCION']) ? $rs_infoPais['1']['DESCRIPCION'] : '';
$url_inPais_param = 	$url_infoPais = isset($rs_infoPais['1']['DESCRIPCION']) ? $rs_infoPais['1']['DESCRIPCION'] : '';
;
try{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inPais_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
    )
);

$res = curl_exec($ch);

if(curl_errno($ch)){
    $msg_m = curl_error($ch);
    @@tri_msg_error = $msg_m;
}
curl_close($ch);

$result = json_decode($res);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger',
'Inicializar datos solicitud', $url_inPais_param,
'GET', 'NO', $token, $result, $msg_m);

$arr_Dtapais = array();
$i = 1;
$datos_result = $result->data;

foreach($datos_result as $dataPais){
    $arr_Dtapais[$i] = array($dataPais->codPais, $dataPais->txtDesc);
    $i++;
}

@@arr_Dtapais = $arr_Dtapais;
}
catch(Exception $e)
{
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
    @@tri_msg_error = $msg_m;
}

//PROVINCIAS
$pais_portal = @@frm_accidente_pais;
$sql_cata_infoProv = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'consultarProvincias'";
$rs_infoProv=  executeQuery($sql_cata_infoProv);

$url_infoProv = isset($rs_infoProv['1']['DESCRIPCION']) ? $rs_infoProv['1']['DESCRIPCION'] : '';
$url_inProv_param = 	$url_infoProv.$pais_portal;

try{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_inProv_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
    )
);

$res = curl_exec($ch);

if(curl_errno($ch)){
    $msg_m = curl_error($ch);
    @@tri_msg_error = $msg_m;
}
curl_close($ch);

$result = json_decode($res);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger',
'Inicializar datos solicitud', $url_inProv_param,
'GET', 'NO', $token, $result, $msg_m);

$arr_Dtaprov = array();
$i = 1;
$datos_result = $result->data;

foreach($datos_result as $dataProv){
    $arr_Dtaprov[$i] = array($dataProv->codDpto, $dataProv->txtDesc);
    $i++;
}
@@arr_Dtaprov = $arr_Dtaprov;
}
catch(Exception $e)
{
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
    @@tri_msg_error = $msg_m;
}
//CANTONES
$prov_portal = @@frm_accidente_provincia;
$sql_cata_infoCant = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'consultarCantones'";
$rs_infoCant=  executeQuery($sql_cata_infoCant);

$url_infoCant = isset($rs_infoCant['1']['DESCRIPCION']) ? $rs_infoCant['1']['DESCRIPCION'] : '';
$url_infCant_param = 	$url_infoCant.$prov_portal;

try{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_infCant_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
    )
);

$res = curl_exec($ch);



if(curl_errno($ch)){
    $msg_m = curl_error($ch);
    @@tri_msg_error = $msg_m;
}
curl_close($ch);

$result = json_decode($res);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger',
'Inicializar datos solicitud', $url_infCant_param,
'GET', 'NO', $token, $result, $msg_m);

$arr_DtaCant = array();
$i = 1;
$datos_result = $result->data;

foreach($datos_result as $dataCant){
    $arr_DtaCant[$i] = array($dataCant->codCanton, $dataCant->txtDesc);
    $i++;
}
@@arr_DtaCant = $arr_DtaCant;
}
catch(Exception $e)
{
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
    @@tri_msg_error = $msg_m;
}
//AGENTE
$codagenet_portal = @@frm_codAgente;
$codtipoagenet_portal = @@frm_codTipoAgente;

$sql_cata_infoAgente = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'Consultar_agente'";
$rs_infoAgente=  executeQuery($sql_cata_infoAgente);

$url_infoAgente = isset($rs_infoAgente['1']['DESCRIPCION']) ? $rs_infoAgente['1']['DESCRIPCION'] : '';
$url_infAgente_param = 	$url_infoAgente.'codigoAgente='.$codagenet_portal.'&codigoTipoAgente='.$codtipoagenet_portal;

try{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_infAgente_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Accept-Language: application/json",
        "Authorization: Bearer ". $token
    )
);

$res = curl_exec($ch);

if(curl_errno($ch)){
    $msg_m = curl_error($ch);
    @@tri_msg_error = $msg_m;
}
curl_close($ch);

$result = json_decode($res);

PMFBitacoraServicios(@@APP_NUMBER, 'trigger',
'Inicializar datos solicitud', $url_infAgente_param,
'GET', 'NO', $token, $result, $msg_m);

$i = 1;
$datos_result = $result->data;

foreach($datos_result as $dataAgente){
    @@frm_busqueda_datosBroker = $dataAgente->txtApellido1;
    @@frm_busqueda_datosBroker_Id = $dataAgente->nroNit;
}
}
catch(Exception $e)
{
    //echo 'ExcepciÃƒÂ³n capturada: ',  $e->getMessage(), "\n";
    $result['mensaje'] = 'false';
    $result['mensaje_mostrar'] = 'Excepción capturada: Error al consultar la Base de Datos, comuniquese con el administrador.- '.$e->getMessage();
    @@tri_msg_error = $msg_m;
}
