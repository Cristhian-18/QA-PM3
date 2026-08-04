<?php
//Condicion si en el chk_docs_faltantes ha seleccionado o no el "Documento Adicional"
//$outputUID = '96223436366f4cce893a8d2024359858'; //ID doc de salida SOLICUTD
try{

    $outputUID = '288996193625f705922b301060222767'; //ID doc de salida SOLICITUD
    $array = @@chk_docs_faltantes;
    if(in_array(40, $array)){
        $outputUID = '96223436366f4cce893a8d2024359858';

    }else{

    }
    $application = @@APPLICATION;
    $delIndex = @@INDEX;
    $userUID = @@USER_LOGGED;
    /*EJEMPLO DE PMFGenerateOutputDocument
    PMFGenerateOutputDocument ( string outputUID, string caseUID = null, integer delIndex = null, string userUID = null)
    */
    $generaOutDoc = PMFGenerateOutputDocument($outputUID, $application, $delIndex, $userUID);

} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
