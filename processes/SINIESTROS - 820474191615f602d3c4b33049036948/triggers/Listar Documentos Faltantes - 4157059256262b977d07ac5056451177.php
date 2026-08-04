<?php
//Created by Henry
//Listar Documentos Faltantes
//22-04-2022

try{

    $list_docs = str_replace('["', '', @@chk_docs_faltantes_label);
    $list_docs = str_replace('"]', '', $list_docs);
    $list_docs = explode('","', $list_docs);

    $html_docs = '<ul>';
    foreach($list_docs as $data_doc){
        $html_docs .= '<li>'.$data_doc.'</li>';
    }
    $html_docs .= '</ul>';

    @@html_chk_docs_faltantes_label = $html_docs;
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

}
