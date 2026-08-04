<?php
//<?php
// dental exequial
/////////////

$cnx_rp = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
$producto = @@frm_producto;

@@frm_provisional_saldo_inicial = (@@frm_provisional_saldo_inicial == '0,00' ? '0.00' : @@frm_provisional_saldo_inicial);
@@frm_seguro_exequial = 'N';
@@frm_incluye_dental = 'N';



foreach (@@grd_coberturas as $row)
{
    $cob = $row['cobertura_label'];
    @@tmp_cob .= ' '.$cob;
    //cambio por Henry
    if (substr_count($cob,'EXEQUIAL') > 0)
    {
        if($cob != 'SEGURO EXEQUIAL - ASEGURADOS CUBIERTOS: 0')
        @@frm_seguro_exequial = 'S';
    }
    if (substr_count($cob,'PLAN DENTAL') > 0)
    {
        @@frm_incluye_dental = $row['valor_asegurado'];
    }
}

@@frm_incluye_dental = (@@frm_incluye_dental == '0' || @@frm_incluye_dental == '' ? 'N' : @@frm_incluye_dental);

// para identificar el num de registros en el grid
//dental y exequial
foreach (@=grd_coberturas as $row_c)
{
    $cob_id = $row_c['cobertura'];
    $cob = $row_c['cobertura_label'];
    //cambio por Henry
    if (substr_count($cob,'EXEQUIAL') > 0)
    {
        $sql_ex = "SELECT CAMPO1 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'PRODUCTO_COBERTURA' AND CODIGO = '$cob_id' AND VALOR = '$producto'" ;
        $rs_ex = executeQuery($sql_ex, $cnx_rp);
        @@tri_bandera_exquial = $rs_ex['1']['CAMPO1'];
    }
    if (substr_count($cob,'PLAN DENTAL') > 0)
    {
        $sql_den = "SELECT CAMPO1 FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'PRODUCTO_COBERTURA' AND CODIGO = '$cob_id' AND VALOR = '$producto'" ;
        $rs_den = executeQuery($sql_den, $cnx_rp);
        @@tri_bandera_dental = $rs_den['1']['CAMPO1'];


    }
}
