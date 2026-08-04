<?php
try{

    @@frm_accion = '';
    @@frm_accion_label = '';
    @@frm_comentario = '';
    @@fecha_hoy_doc_out = date("Y-m-d");

    if (@@tri_fecha_ultimos_docs === null || @@tri_fecha_ultimos_docs === ""){


        $caseId = @@APPLICATION;

        /*
        SACO FECHA DEL ULTIMO DOCUMENTO SUBIDO

        */

        $sql = "SELECT
        MAX(DATE(APP_DOC_CREATE_DATE)) AS FECHA_ULTIMO_DOC_INPUT
        FROM
        APP_DOCUMENT ad
        WHERE
        APP_UID = '$caseId'
        AND USR_UID NOT IN ('74854626961fc40afdfe5f5035560240', '12876972461fc40868946c1041905650', '78192302861fc3b33d328b1049860158', '30920428261fc409c4e0674049547147', '30572921461fc40c59fcc55033349864','57544886966fc17d06af1c6026269408','835423115636c0c86d5a546053925536')
        AND APP_DOC_TYPE = 'INPUT'";
        $rs = executeQuery($sql);

        if (isset($rs[1]['FECHA_ULTIMO_DOC_INPUT']) && !empty($rs[1]['FECHA_ULTIMO_DOC_INPUT'])) {
            $fecha = $rs[1]['FECHA_ULTIMO_DOC_INPUT'];
        } else {
            $fecha = date('Y-m-d');
        }

        @@tri_fecha_ultimos_docs = $fecha;

        $arr_fecha_noticacion = explode("-", @@frm_fecha_notificacion_label);
        $dia_no = $arr_fecha_noticacion['0'];
        $mes_no = $arr_fecha_noticacion['1'];
        $anio_no = $arr_fecha_noticacion['2'];

        @@frm_fecha_notificacion_negativa = $anio_no.'-'.$mes_no.'-'.$dia_no;

        //validacion para codeudor
        if(@@frm_tipo_asegurado == 'O'){
            @@frm_tipo_asegurado_datos = @@frm_apellido_paterno_fallecido.' '.@@frm_apellido_materno_fallecido.' '.@@frm_nombres_fallecido;
        }else{
            @@frm_tipo_asegurado_datos = 'N/A';
        }
    }
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
