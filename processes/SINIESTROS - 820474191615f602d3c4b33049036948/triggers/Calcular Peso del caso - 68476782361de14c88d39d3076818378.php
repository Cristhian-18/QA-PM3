<?php
try {
    $cnx     = '11264850561d723f004d5c2072943786';
    $pro_uid = @@PROCESS;

    //EXPLODE DEL CAMPO POLIZAS
    $arr_poliza = explode('|', @@frm_polizas);

    @@frm_id_cns                     = $arr_poliza[0];
    @@frm_id_pv                      = $arr_poliza[1];
    @@frm_id_pv_cero                 = $arr_poliza[2];
    @@frm_cod_tercero                = $arr_poliza[3];
    @@frm_cod_aseg                   = $arr_poliza[4];
    @@frm_nro_aseg                   = $arr_poliza[5];
    @@frm_nro_pariente               = $arr_poliza[6];
    @@frm_numero_poliza              = $arr_poliza[7];
    @@frm_ramo                       = $arr_poliza[8];
    @@frm_sucursal                   = $arr_poliza[9];
    @@frm_tipo_poliza                = $arr_poliza[10];
    @@frm_linea_negocio              = $arr_poliza[10];
    @@frm_fecha_ingreso_poliza       = $arr_poliza[11];
    @@frm_fecha_ingreso_poliza_aux   = $arr_poliza[11];
    @@frm_broker                     = $arr_poliza[12];
    @@frm_contratante                = $arr_poliza[13];
    @@frm_contratante_identificacion = $arr_poliza[14];
    @@frm_poliza_NumCertificado      = $arr_poliza[15];
    @@frm_poliza_ValidFrom           = $arr_poliza[16];
    @@frm_poliza_ValidTo             = $arr_poliza[17];

    //peso por monto
    $monto_reportado = @@frm_monto_reportado;
    //codigo de la tabla
    $sql              = "SELECT CODIGO FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'RANGO_MONTOS' AND PRO_UID = '$pro_uid' AND ESTADO = 1 AND VALOR <= $monto_reportado AND INTEGRACION > $monto_reportado ";
    $rs               = executeQuery($sql, $cnx);
    @@tri_rango_monto = ($rs['1']['CODIGO'] == '' ? 0 : $rs['1']['CODIGO']);

    //peso por tipo de poliza
    $frm_tipo_poliza = @@frm_tipo_poliza;
    //codigo de la tabla
    $sql               = "SELECT CODIGO FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'RANGO_POLIZA' AND PRO_UID = '$pro_uid' AND ESTADO = 1 AND DESCRIPCION = '$frm_tipo_poliza'";
    $rs                = executeQuery($sql, $cnx);
    @@tri_rango_poliza = ($rs['1']['CODIGO'] == '' ? 0 : $rs['1']['CODIGO']);

    //peso por cobertura madre
    $iaux = 'false';
    foreach (@=grd_coberturas as $datagrid_cober) {
        if ($datagrid_cober['grd_txt_aplicar'] == 'SI' && $iaux == 'false') {
            @@frm_cobertura_madre = $datagrid_cober['grd_cob_madre'];
            $iaux                 = 'true';
        }
    }

    $frm_cobertura_madre = @@frm_cobertura_madre;
    //codigo de la tabla
    $sql = "SELECT CAMPO1, DESCRIPCION, VALOR FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'COBERTURA_MADRE' AND PRO_UID = '$pro_uid' AND ESTADO = 1 AND CODIGO = $frm_cobertura_madre ";

    echo "SQL Cobertura madre: " . $sql;

    $rs                   = executeQuery($sql, $cnx);
    @@tri_rango_cobertura = ($rs['1']['CAMPO1'] == '' ? 0 : $rs['1']['CAMPO1']);

    echo "tri_rango_cobertura " . @@tri_rango_cobertura;

    $tri_valor_cobertura_madre  = ($rs['1']['VALOR'] == '' ? 18 : $rs['1']['VALOR']);
    @@tri_valor_cobertura_madre = $tri_valor_cobertura_madre;



    @@frm_cobertura_madre_label = $rs['1']['DESCRIPCION'];



    @@tri_peso_caso = @#tri_rango_cobertura + @#tri_rango_poliza + @#tri_rango_monto;

    echo "Peso del caso: " . @@tri_peso_caso;

} catch (Exception $e) {

    $errorMessage = $e->getMessage();

}

