<?php
//<?phpcreated by Henry
//Consultar Bandera Mes

$cnx = '11264850561d723f004d5c2072943786';
$process = @@PROCESS;

try{
    //validacion documentos
    $cober_select = @#frm_cober_select;
    $sql = "SELECT CODIGO, DESCRIPCION
            FROM ADMIN_CATALOGOS
            WHERE PRO_UID = '$process'
            AND COD_CATALOGO = 'DOCUMENTOS'
            AND ESTADO = '1'
            AND VALOR = 'O'
            AND FIND_IN_SET('$cober_select', CAMPO2)
            ";
    $rs = executeQuery($sql, $cnx);
    $aux_bandera_enc = array();
    $aux_bandera_fal = array();

	if(is_array($rs) && count($rs) > 0){
    foreach($rs as $datadocs){
        if(isset(@=chk_documentos_web) && count(@=chk_documentos_web) > 0){
            foreach(@=chk_documentos_web as $cod_doc){
                if($datadocs['CODIGO'] == $cod_doc){
                    //encontrado
                    $aux_bandera_enc[$cod_doc] = $datadocs['DESCRIPCION'];
                }else{
                    $aux_bandera_fal[$datadocs['CODIGO']] = $datadocs['DESCRIPCION'];
                }
            }
        }else{
            $aux_bandera_fal[$datadocs['CODIGO']] = $datadocs['DESCRIPCION'];
        }
    }
	}

    $result=array();
    $result=array_diff($aux_bandera_fal,$aux_bandera_enc);



    if(count($result) > 0){
        @@frm_check_documentos = 'NO';
        $html_docs = '<ul>';
        foreach($result as $list_docs_fal){
            $html_docs .= '<li>'.$list_docs_fal.'</li>';
        }
        $html_docs .= '</ul>';

        @@html_chk_docs_faltantes_label = $html_docs;
    }

    //estado de la bandera
    $sql = "SELECT id, bandera FROM SINIESTRO_CONFIGURACION WHERE id = (SELECT MAX(id) FROM SINIESTRO_CONFIGURACION)";

    $rs = executeQuery($sql, $cnx);

    $id_bandera = $rs['1']['bandera'];
    @@tri_bandera_cierreMes = $id_bandera;



    if(@@TASK == '799986505615f607b50a4f4033464318'){
        if($id_bandera == 'SI'){
            @@frm_accion = 'CIERRE';
            @@tri_estado_evento = 10;
        }else{
            @@frm_accion = 'CONTINUAR';
            @@tri_estado_evento = 2;
            if(@@frm_check_documentos == 'NO'){
                @@frm_accion = 'ESPERAR';
                @@tri_estado_evento = 11;
            }
        }
    }else{
        //validacion de bandera cierre mes
        if($id_bandera == 'SI'){
            @@frm_accion = 'CIERRE';
            @@tri_estado_evento = 10;
            if(@@frm_check_documentos == 'NO'){
                @@frm_accion = 'CIERRE_DOCS';
            }
        }else{
            if(@@frm_check_documentos == 'NO'){
                @@frm_accion = 'ESPERAR';
                @@tri_estado_evento = 11;
            }else{
                @@frm_accion = 'CONTINUAR';
                @@tri_estado_evento = 2;
            }
        }
    }


} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}


