<?php


$pro_uid = @@PROCESS;
$cnx_rp = '4647520625f3ca6ed2d2621030136501';
$caseUID = @@APPLICATION;
$query = "SELECT APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
FROM APP_DOCUMENT
WHERE APP_UID='$caseUID'
AND APP_DOC_TYPE = 'OUTPUT' AND APP_DOC_STATUS = 'ACTIVE'
ORDER BY DOC_VERSION DESC";
$outDoc = executeQuery($query);

$query_i = "SELECT APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME, APP_DOC_FIELDNAME
FROM APP_DOCUMENT
WHERE APP_UID='$caseUID'
AND APP_DOC_TYPE = 'INPUT' AND APP_DOC_STATUS = 'ACTIVE'
ORDER BY DOC_VERSION DESC";
$inDoc = executeQuery($query_i);

$folder = @#frm_tipo_solicitud.'_'.date('Ymd').'_'.@#frm_numero_poliza;
//$folder='prueba';
//echo "Valor \$folder: " . $folder;

$tipo_sol_nombre="PR";
if (@@frm_tipo_solicitud_label == "PRESTAMO"){
    $tipo_sol_nombre="PR";
} elseif (@@frm_tipo_solicitud_label == "RETIRO"){
    $tipo_sol_nombre="RET";
}else {
    $tipo_sol_nombre="PR";
}


$year_mes = date('Y').PATH_SEP.date('M').PATH_SEP.@@frm_tipo_solicitud_label.PATH_SEP.$folder;
$sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'RUTA'";
$rs =  executeQuery($sql_cata, $cnx_rp);
$url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';
$structure = $url.$year_mes.'/';

//echo "Valor \$url: " . $url;

$g = new G();
if (is_array($outDoc)) {
    $cont = 1;
    foreach ($outDoc as $dataoutDoc) {
        $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . 'outdocs'. PATH_SEP .
        $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
        //$filename = $cont.'_'.@#frm_tipo_solicitud.'_'.date('Y-m-d').'_'.@#frm_numero_poliza;
        $fecha = date('Ymd');
        switch($dataoutDoc['FILENAME']){
            case 'terminos_y_condiciones':
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-Terminos';
            break;
            case 'Solicitud_de_prestamo_autorizacion':
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-Solicitud';
            break;
            case 'Solicitud_de_retiro_autorizacion':
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-Solicitud_Retiro';
            break;
            case 'autorizacion_debito':
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-Autorizacion';
            break;

            default;
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-Respaldo_'.$cont;
            break;
        }

        //$aAttachFiles[$filename . '.pdf'] = $path . '.pdf';
        if (!file_exists($structure)) {
            mkdir($structure, 0777, true);
        }
        if(copy($path . '.pdf', $structure. $filename . '.pdf')){
            @@tri_msg_file = 'Archivo Copiado';
        }
        else{
            @@tri_msg_file = 'Error al copiar archivo';
            $g = new G();
            $g->SendMessageText("Error al copiar los archivos", "WARNING");
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '9481145465f4ad60e1ee257073187698');
        }
        $cont++;
    }
}
if (is_array($inDoc)) {
    $cont_i = 1;
    $i = 1;
    foreach ($inDoc as $datainDoc) {
        $d = new AppDocument();
        $aDoc = $d->Load($datainDoc['APP_DOC_UID'], $datainDoc['DOC_VERSION']);
        $filename_aux = $aDoc['APP_DOC_FILENAME'];
        $ext = pathinfo($filename_aux, PATHINFO_EXTENSION);
        $fecha = date('Ymd');
        switch($aDoc['APP_DOC_FIELDNAME']){
            case 'frm_documentos_natural_cedula':
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-Cedula.'.$ext;
            break;
            case 'frm_documentos_nombramiento':
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-Nombramineto.'.$ext;
            break;
            case 'frm_documentos_natural_representante_cedula':
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-Cedula.'.$ext;
            break;
            case 'fle_transferencia':
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-Transferencia-'.$i.'.'.$ext;
            $i++;
            break;

            default;
            $name = 'respaldo';
            $filename = $tipo_sol_nombre.'-'.@@frm_numero_poliza.'-'.$fecha.'-'.$name.'-'.$i.'.'.$ext;
            $i++;
            break;
        }

        $g = new G();
        $filePath = PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP .
        $datainDoc['APP_DOC_UID'] .'_'. $datainDoc['DOC_VERSION'] .'.'. $ext;
        if (!file_exists($structure)) {
            mkdir($structure, 0777, true);
        }
        if(copy($filePath, $structure. $filename)){
            @@tri_msg_file_i = 'Se copio';
        }
        else{
            @@tri_msg_file_i = 'NO se copio';
            $g = new G();
            $g->SendMessageText("Error al copiar los archivos", "WARNING");
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '9481145465f4ad60e1ee257073187698');
        }
        $cont_i++;
    }
}
