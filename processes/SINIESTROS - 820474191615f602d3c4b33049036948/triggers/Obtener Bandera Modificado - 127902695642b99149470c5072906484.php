<?php


try{

    @@tri_bandera_modificado = '';

    foreach(@=grd_coberturas as $data){
        if($data['grd_txt_modificar'] == 'SI'){
            @@tri_bandera_modificado = 'true';
        }
    }




} catch (Exception $e) {

    $errorMessage =  $e->getMessage();


}
