<?php
$host = @@URL_SERVER_SQL;


try {

    $vars = array("frm_txt_inicial" => @@frm_txt_inicial, "frm_numero_identificacion_aux" => @@frm_numero_identificacion_aux, "frm_nombres_completos" => @@frm_nombres_completos, "frm_nombres_completos_aux" => @@frm_nombres_completos_aux, "frm_fecha_solictud" => @@frm_fecha_solictud, "tri_ban_cuenta_A" => @@tri_ban_cuenta_A, "tri_ban_cuenta_C" => @@tri_ban_cuenta_C, "frm_monto_prestamo_letras" => @@frm_monto_prestamo_letras, "frm_monto_retiro_letras" => @@frm_monto_retiro_letras, "frm_monto_prestamo_unidad" => @@frm_monto_prestamo_unidad, "frm_monto_retiro_unidad" => @@frm_monto_retiro_unidad, "frm_costo_retiro_unidad" => @@frm_costo_retiro_unidad, "frm_derecho_retiro_unidad" => @@frm_derecho_retiro_unidad, "frm_val_descontado_unidad" => @@frm_val_descontado_unidad, "frm_cedula_pagador_aux" => @@frm_cedula_pagador_aux, "frm_cedula_receptor_aux" => @@frm_cedula_receptor_aux);
    $result = PMFSendVariables(@@APPLICATION, $vars);

    @@tri_ban_spc2 = '';
    @@tri_ban_spc3 = '';
    $doc_id_r = "2632469175f5d7a06d88cf9044746958"; //solicitud
    $doc_id_p1 = "6032337655f5e1b5a243c97092604442";
    $doc_id_p2 = "8286123355f3df479d57952009945749";
    $doc_id_p3 = "6050967925f5e1bb92c03d3060559573";
    $case_id = @@APPLICATION;
    if (@@frm_tipo_solicitud == 'R') {
        PMFGenerateOutputDocument($doc_id_r, '', '', '');
    } else {
        PMFGenerateOutputDocument($doc_id_p1, '', '', '');
        PMFGenerateOutputDocument($doc_id_p2, '', '', '');
        PMFGenerateOutputDocument($doc_id_p3, '', '', '');
    }

    $query = "SELECT
    DOC_UID,
    APP_DOC_UID,
    APP_DOC_FILENAME AS FILENAME,
    DOC_VERSION
    FROM
    APP_DOCUMENT
    WHERE APP_UID = '$case_id'
    AND APP_DOC_TYPE='OUTPUT'";
    $result = executeQuery($query);
    if (empty($result)) {
        die("Error: Unable to find Output Document file for case $case_id.");
    }

    foreach ($result as $datadoc) {
        if ($datadoc['DOC_UID'] == $doc_id_r) {
            $fileId = $datadoc['APP_DOC_UID'];
            $version = $datadoc['DOC_VERSION'];
            @@link_dana_retiro = "$host/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
        }
        if ($datadoc['DOC_UID'] == $doc_id_p1) {
            $fileId = $datadoc['APP_DOC_UID'];
            $version = $datadoc['DOC_VERSION'];
            @@link_dana_retiro = "$host/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
        }
        if ($datadoc['DOC_UID'] == $doc_id_p2) {
            $fileId = $datadoc['APP_DOC_UID'];
            $version = $datadoc['DOC_VERSION'];
            @@link_dana_prestamo1 = "$host/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
        }
        if ($datadoc['DOC_UID'] == $doc_id_p3) {
            $fileId = $datadoc['APP_DOC_UID'];
            $version = $datadoc['DOC_VERSION'];
            @@link_dana_prestamo2 = "$host/syscertificacion/es/3sesa/cases/cases_ShowOutputDocument?a=$fileId&v=$version&ext=pdf";
        }
    }
} catch (Exception $e) {
    // Capturar cualquier error general
    @@error_message = "Error en el proceso: " . $e->getMessage();
    @@error_line = "Línea: " . $e->getLine();
    @@error_file = "Archivo: " . $e->getFile();

    die("Error crítico en el proceso: " . $e->getMessage());
}
