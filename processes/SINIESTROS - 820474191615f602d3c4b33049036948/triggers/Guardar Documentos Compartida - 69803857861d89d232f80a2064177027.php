<?php
//created by Henry
//24-12-2020
//Guardar Documentos Compartida

try{
    $task = @@TASK;
    switch($task){
        case '54146797061d7b93a9bcdd0041253461':
        $dyn_id = '76609892961dad976510814085203779';
        break;
        case '309930261615f607b901f74034966395':
        $dyn_id = '19704822661d89a84dc5eb6067966042';
        break;
        default:
        //datos
        break;
    }

    $cnx_rp = '11264850561d723f004d5c2072943786';
    $pro_uid = @@PROCESS;

    //consulto los documento
    //output document
    $caseUID = @@APPLICATION; //set to the Output Document's unique ID
    //find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table
    $query = "SELECT APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME
    FROM APP_DOCUMENT
    WHERE APP_UID='$caseUID'
    AND APP_DOC_TYPE = 'OUTPUT' AND APP_DOC_STATUS = 'ACTIVE'
    ORDER BY DOC_VERSION DESC";
    $outDoc = executeQuery($query);

    //input document
    //find the generated Output Document in the wf_&<WORKSPACE>.APP_DOCUMENT table
    $query_i = "SELECT APP_DOC_UID, DOC_VERSION, APP_DOC_FILENAME AS FILENAME, APP_DOC_FIELDNAME
    FROM APP_DOCUMENT
    WHERE APP_UID='$caseUID'
    AND APP_DOC_TYPE = 'INPUT' AND APP_DOC_STATUS = 'ACTIVE'
    ORDER BY DOC_VERSION DESC";
    $inDoc = executeQuery($query_i);

    $folder = @#tri_nro_stro.'_'.@#APP_NUMBER;

    $year_mes = date('Y').PATH_SEP.date('M').PATH_SEP.$folder;

    //para la ruta
    $sql_cata = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS WHERE PRO_UID = '$pro_uid' AND CODIGO = 'RUTA'";
    $rs =  executeQuery($sql_cata, $cnx_rp);
    $url = isset($rs['1']['DESCRIPCION']) ? $rs['1']['DESCRIPCION'] : '';

    //para saber si va a negados o aprobados
    if(@@frm_accion == 'FINALIZAR' && @@TASK != '359772973624db81b5141e6050784057')
    $structure = $url.'Aprobados/'.$year_mes.'/';
    else
    $structure = $url.'Negados/'.$year_mes.'/';

    $g = new G();
    if (is_array($outDoc)) {
        $cont = 1;
        foreach ($outDoc as $dataoutDoc) {
            $path = PATH_SEP . PATH_DOCUMENT . $g->getPathFromUID($caseUID) . PATH_SEP . 'outdocs'. PATH_SEP .
            $dataoutDoc['APP_DOC_UID'] . '_' . $dataoutDoc['DOC_VERSION'];
            $filename = 'Hoja_de_auditoria';
            $aAttachFiles[$filename . '.pdf'] = $path . '.pdf';


            if (!file_exists($structure)) {
                mkdir($structure, 0777, true);
            }
            if(copy($path . '.pdf', $structure. $filename . '.pdf')){
                @@tri_msg_file = 'Se copio';
            }
            else{
                $error = error_get_last();
                @@tri_msg_file = 'NO se copio';
                @@tri_msg_error = $error['message'];
                $g = new G();
                $g->SendMessageText("Error al copiar los archivos", "WARNING");
                PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', $dyn_id);
            }
            $cont++;
        }
    }
    //input
    if (is_array($inDoc)) {
        $cont_i = 1;
        $i = 1;
        $j = 1;
        foreach ($inDoc as $datainDoc) {
            $d = new AppDocument();
            $aDoc = $d->Load($datainDoc['APP_DOC_UID'], $datainDoc['DOC_VERSION']);
            $filename_aux = $aDoc['APP_DOC_FILENAME'];
            $ext = pathinfo($filename_aux, PATHINFO_EXTENSION);
            $fecha = date('Ymd');
            switch($aDoc['APP_DOC_FIELDNAME']){
                case 'frm_documentos_natural_cedula':
                $filename = 'Fotocopia_DI_RUC_Asegurado.'.$ext;
                break;
                case 'fle_finiquitos':
                $name = 'Finiquito';
                $filename = $name.'-'.$j.'.'.$ext;
                $j++;
                break;
                case 'fle_negativa':
                $filename = 'Carta_negativa.'.$ext;
                break;
                case 'frm_documentos_fvida':
                $filename = 'Formulario_Vida.'.$ext;
                break;
                case 'frm_documentos_fdesempleo':
                $filename = 'Formulario_Desempleo.'.$ext;
                break;
                case 'frm_documentos_fgastos':
                $filename = 'Formulario_Gastos.'.$ext;
                break;
                case 'frm_documentos_otros':
                $filename = 'Requisitos.'.$ext;
                break;
                case 'frm_documentos_hc':
                $filename = 'Historia_Clinica.'.$ext;
                break;
                case 'fle_medico':
                $filename = 'Ficha_Medica.'.$ext;
                break;

                default;
                $name = 'Requisitos';
                $filename = $name.'-'.$i.'.'.$ext;
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
                $error_i = error_get_last();
                @@tri_msg_file_i = 'NO se copio';
                @@tri_msg_error_i = $error_i['message'];
                $g = new G();
                $g->SendMessageText("Error al copiar los archivos", "WARNING");
                PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', $dyn_id);
            }
            $cont_i++;
        }
    }



} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

}

@@tri_user_auditor_mail = 'villanodaniel8@gmail.com';
@@frm_asegurado_mail =  'villanodaniel8@gmail.com';
