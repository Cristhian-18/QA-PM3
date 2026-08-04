<?php
$pro_uid = '35087580064a18c9776b638006106795';
$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS' AND DESCRIPCION = 'COPIA_GENERICA' AND PRO_UID = '$pro_uid' ";
$rs_mails_copias = executeQuery($sql_mails_copias);
$destinatarios_copias = ',';
$destinatarios_copias = ',';
if(!empty($rs_mails_copias)){
    @@tri_destinatarios_copias_cc = ',';
    @@tri_destinatarios_copias_cc .= $rs_mails_copias[1]['CAMPO1'];
    $destinatarios_copias .= $rs_mails_copias[1]['CAMPO1'];
    @@tri_destinatarios_copias_bcc = ',';
    @@tri_destinatarios_copias_bcc .= $rs_mails_copias[1]['CAMPO2'];
    //CONCAT CAMPO2
    $destinatarios_copias .= ','.$rs_mails_copias[1]['CAMPO2'];
}

@@tri_destinatarios_copias = $destinatarios_copias;

$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS' AND DESCRIPCION = 'MUNDO_MOTRIZ' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
@@tri_destinatarios_copias_mundo_motriz_cc = ',';
@@tri_destinatarios_copias_mundo_motriz_cc .= $rs_mails_copias[1]['CAMPO1'];
$destinatarios_copias_mundo_motriz = ',';
$destinatarios_copias_mundo_motriz .= $rs_mails_copias[1]['CAMPO1'];
//CONCAT CAMPO2
@@tri_destinatarios_copias_mundo_motriz_bcc = ',';
@@tri_destinatarios_copias_mundo_motriz_bcc .= $rs_mails_copias[1]['CAMPO2'];
$destinatarios_copias_mundo_motriz .= ','.$rs_mails_copias[1]['CAMPO2'];
@@tri_destinatarios_copias_mundo_motriz = $destinatarios_copias_mundo_motriz;


$sql_mails_copias = "SELECT CAMPO1, CAMPO2 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'DESTINATARIOS_COPIAS' AND DESCRIPCION = 'DESARROLLADOR' AND PRO_UID = '$pro_uid'";
$rs_mails_copias = executeQuery($sql_mails_copias);
@@tri_correo_desarrollador_cc = ',';
if(!empty($rs_mails_copias)){
    @@tri_correo_desarrollador_cc .= $rs_mails_copias[1]['CAMPO1'];
}
@@tri_correo_desarrollador_bcc = ',';
if(!empty($rs_mails_copias)){
    @@tri_correo_desarrollador_bcc .= $rs_mails_copias[1]['CAMPO2'];
}



unset(@@grd_vehiculos_afectados['accesorios']);

@@tri_bot_cliente = '90331897265bdbf82f35100009622465';
$sql_bot_cliente = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = 'BOT_CLIENTE'";
$rs_bot_cliente = executeQuery($sql_bot_cliente);
if(!empty($rs_bot_cliente)){
    @@tri_bot_cliente = $rs_bot_cliente['1']['USR_UID'];
} else {
    @@tri_bot_cliente = '90331897265bdbf82f35100009622465';
}
$curl = curl_init();

$host = @@URL_SERVER_SQL;


$url = "$host";

$app_number = @@APP_NUMBER;


if(@@nro_inspeccion != null && @@nro_inspeccion != '' ){
    @@tri_id_stro = @@nro_inspeccion. " - ". date("Y");
}

if(@@id_stro_insp != null && @@id_stro_insp != '' ){
    @@tri_nro_stro = @@id_stro_insp;
}

$case_uid_padre = @@app_padre_totales;


$analista = @@tri_usr_analista;

if($analista == '95282121465bdc1213b5351076915024'){
    @@tri_usr_analista = "289826748664bb06d8b1a82010029742";

}

$analista_negativas = @@frm_emisionNegativa_jefatura;
if(@@frm_emisionNegativa_jefatura == '23731403865bdbfaf88b4b1029849752'
|| @@frm_emisionNegativa_jefatura == ''
|| @@frm_emisionNegativa_jefatura == 'mmatute@segurosequinoccial.com'
||  @@frm_emisionNegativa_jefatura == 'fibarra@segurosequinoccial.com')
{
    @@frm_emisionNegativa_jefatura = "69530880965be3fb9140bc8043898088";
}

 
$app_uid = @@APPLICATION;

$sql = "SELECT TASK_UID AS tarea,
USR_UID_ACTUAL AS usuario,
FECHA_DERIVACION AS f_tranferencia,
FECHA_INICIO AS f_inicio,
FECHA_FIN AS f_fin,
ACCION AS accion,
COMENTARIO AS txt_comentario
FROM certificacion.SINIESTRO_VH_BITACORA WHERE APP_UID = '$app_uid' order by ID_BITACORA";

$rs_comentarios = executeQuery($sql);

$grd_historial = array();

$i=1;
if ($case_uid_padre != '' && $case_uid_padre != null) {
    $sql2 = "SELECT TASK_UID AS tarea,
    USR_UID_ACTUAL AS usuario,
    FECHA_DERIVACION AS f_tranferencia,
    FECHA_INICIO AS f_inicio,
    FECHA_FIN AS f_fin,
    ACCION AS accion,
    COMENTARIO AS txt_comentario
    FROM certificacion.SINIESTRO_VH_BITACORA_TOTAL WHERE APP_UID = '$case_uid_padre' order by ID_BITACORA";

    $rs_comentarios2 = executeQuery($sql2);

    foreach($rs_comentarios2 as $data){
        $grd_historial[$i]['tarea'] = PMFGetTaskName($data['tarea'],'es');
        $grd_historial[$i]['usuario'] = NomUsuario($data['usuario']);
        $grd_historial[$i]['f_tranferencia'] = $data['f_tranferencia'];
        $grd_historial[$i]['f_inicio'] = $data['f_inicio'];
        $grd_historial[$i]['f_fin'] = $data['f_fin'];
        $grd_historial[$i]['accion'] = $data['accion'];
        $grd_historial[$i]['txt_comentario'] = $data['txt_comentario'];
        $i++;
    }
}
foreach($rs_comentarios as $data){
    $grd_historial[$i]['tarea'] = PMFGetTaskName($data['tarea'],'es');
    $grd_historial[$i]['usuario'] = NomUsuario($data['usuario']);
    $grd_historial[$i]['f_tranferencia'] = $data['f_tranferencia'];
    $grd_historial[$i]['f_inicio'] = $data['f_inicio'];
    $grd_historial[$i]['f_fin'] = $data['f_fin'];
    $grd_historial[$i]['accion'] = $data['accion'];
    $grd_historial[$i]['txt_comentario'] = $data['txt_comentario'];
    $i++;
}




@=grd_historial_caso = $grd_historial;

$case_id=@@APPLICATION;
$aVars = array(
    'grd_historial_caso' => $grd_historial);

    $result = PMFSendVariables($case_id, $aVars);

