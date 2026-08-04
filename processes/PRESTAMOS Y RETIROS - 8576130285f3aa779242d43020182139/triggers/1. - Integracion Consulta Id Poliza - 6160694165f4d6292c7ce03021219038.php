<?php
//created by Henry
//29-08-2020
//Grabar Informacion SISE
//otro cambio
@@__ERROR__ = '';
@@tri_mes_ConsultaPID = '';

$cod_suc = @@frm_sucursal;
$cod_ramo = @@frm_canal;
$nro_pol = @@frm_numero_poliza;
$nro_endoso = @@frm_numero_endozo_vigente;

$sql = "EXECUTE dbo.spc_PC_ConsultaIdPoliza $cod_suc,$cod_ramo,$nro_pol,$nro_endoso";
$cnx_vida = '1471226895f49403bebfa26089899906';
$rs = executeQuery($sql, $cnx_vida);

if(is_array($rs)){
    foreach($rs as $data){
        if($data['id_pv_cero'] != '0'){
            @@id_pev_cero = $data['id_pv_cero'];
            @@cod_aseg = $data['cod_aseg'];
            @@tri_ban_spc1 = 'true';
        }else{
            //aqui redirect al caso
            @@tri_mes_ConsultaPID = 'No encontro datos de la poliza';
            @@tri_ban_spc1 = '';
            PMFRedirectToStep(@@APPLICATION, @%INDEX, 'DYNAFORM', '7609791745f3ca215c123e4098208396');;
        }
    }
}
