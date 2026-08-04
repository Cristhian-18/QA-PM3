<?php
//Grabar emisión automatica

@@tmp_emision = '';
@@tmp_emision_response = '';
@@tri_emision_respuesta = '';
@@tri_emision_respuesta_label = '';

$cnx = '1479570925ec29f1d8d1d57019959618';
$pro_uid = @@PROCESS;
$sql = "SELECT DESCRIPCION FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'SERVICIOS_WEB'
AND CODIGO =  'EMSION'
AND ESTADO = 1";
$rs  = executeQuery($sql, $cnx);
$url = $rs['1']['DESCRIPCION'];
//$url = 'https://portalconsultasapi.equivida.tv/cu-rest/api/personas/persist';
@@TMP_URL = $url;

$user_ip = $_SERVER['REMOTE_ADDR'];


/* Recupera destinatarios de correo */
$desPARA = '';
$desCC = '';
$desBCC = '';

$sql_correo = "SELECT *
FROM ADMIN_CATALOGOS WHERE
PRO_UID = 'GENERICO'
AND INTEGRACION = '5393441295ebc1555705f98060769179'
AND DESCRIPCION = 'Grabar emision automatica'
";

$rs_correo = executeQuery($sql_correo, $cnx);
$desPARA = $rs_correo[1]['VALOR'];
$desCC = $rs_correo[1]['CAMPO2'];
$desBCC = $rs_correo[1]['CAMPO1'];







// inicializar variableS
// cabecera_solicitud

$id_bpm = @#APP_NUMBER;
$cod_suc = (@#frm_Sucursal == '' ? 0 : @#frm_Sucursal);
$cod_ramo =      @#frm_ramo;
//producto
$frm_producto = @@frm_producto;
$sql_p = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'producto_vida'
AND CODIGO =  '$frm_producto'
AND ESTADO = 1";
$rs_p  = executeQuery($sql_p, $cnx);
$cod_producto =     $rs_p['1']['INTEGRACION'];


@@fec_suscripcion = date('Y-m-d');
$fec_suscripcion = @@fec_suscripcion;
@@vig_desde = date('Y-m-d');
$vig_desde =         @@vig_desde;
$cod_motivo_seguro =     @@frm_motivo_seguro;
$frm_frecuencia_pago =  @@frm_frecuencia_cotizacion;
//$frm_frecuencia_pago =                 @@frm_frecuencia_pago;
$cod_usuario = 'BPM_VENTA_VIRTUAL_ESPECIALISTA';
@@sn_aplica_cob = 0;
$sn_aplica_cob = @@sn_aplica_cob;

$mail_ejecutivo_comercial = '';
$mail_broker = '';

if(@@tri_es_broker == 'SI'){
    $mail_ejecutivo_comercial = @@tri_jefe_email;
    $mail_broker = @@frm_vendedor_email;
}else{
    $mail_broker = "";
    $mail_ejecutivo_comercial =@@frm_vendedor_email;
}

//asegurado
$cod_contrantante =         @@tri_CodAseg_SISE;
@@cod_vinculo_aseg = 1; //siempre va 1
$cod_vinculo_aseg =    @@cod_vinculo_aseg;

//conducto de pago
//primero evaluo el metodo de pago
if(@@frm_medio_pago != 'TARJETA'){
    $frm_entidad_financiera = (@@frm_entidad_financiera == '' ? 1 : @@frm_entidad_financiera);
    $sql_cp = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
    WHERE
    COD_CATALOGO = 'BANCOS' AND PRO_UID IN ('GENERICO','5393441295ebc1555705f98060769179')
    AND CODIGO =  '$frm_entidad_financiera'
    AND ESTADO = 1";
    $rs_cp  = executeQuery($sql_cp, $cnx);
    $cod_conducto_pago =     ($rs_cp['1']['INTEGRACION'] == '' ? 1 :  $rs_cp['1']['INTEGRACION']);
}else{
    $frm_tipo_tarjeta = @@frm_tipo_tarjeta;
    $sql_cp = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
    WHERE
    COD_CATALOGO = 'tconducto_tarjeta'
    AND CODIGO =  '$frm_tipo_tarjeta'
    AND ESTADO = 1";
    $rs_cp  = executeQuery($sql_cp, $cnx);
    $cod_conducto_pago =     $rs_cp['1']['INTEGRACION'];
}

$nro_cta_tarj = (@@frm_numero_tarjeta == '' ? '' : @@frm_numero_tarjeta);
$fecha_tarjeta = (@@frm_fecha_caducidad_tarjeta == '' ? '0000-00-00' : @@frm_fecha_caducidad_tarjeta);
$arr_tarjeta = explode("-", $fecha_tarjeta);
$envio_trama_fecha = $arr_tarjeta[0].$arr_tarjeta[1];
$aaaa_mm_vto_tarj = $envio_trama_fecha;
$cod_aseg  = @@tri_seq_persona;
@@cod_riesgo = 1; //siempre va 1
$cod_riesgo_aseg = @@cod_riesgo;
$cod_condicion_aseg = @@frm_declaracion_h_combo == 'S' ? "1" : "2";

$sn_tipo_cta_deb = (@@frm_medio_pago == 'CTAAHO' ? 0 : -1);

/*$frm_vitality_banco = @@frm_vitality_banco;
$sql_bcn = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
WHERE
COD_CATALOGO = 'BANCOS'
AND CODIGO =  '$frm_vitality_banco'";
$rs_bcn  = executeQuery($sql_bcn, $cnx);*/
//$cod_banco_cred =     $rs_bcn['1']['INTEGRACION'];
//$cod_banco_cred =     @@frm_vitality_banco;
$cod_banco_cred = is_null(@@frm_vitality_banco)? 0:@@frm_vitality_banco;

$sn_tipo_cta_cred = (@@frm_vitality_tipo_cuenta == 'CTAAHO' ? 0 : -1);
$nro_cta_cred = @@frm_vitality_numero_cuenta;
$mail_cred = @@correo_preferido;
$nro_documento_benef = @@frm_vitality_identificacion;
$nombre_benef = @@frm_vitality_titular.' '.@@frm_vitality_titular_apellidos;

//beneficiarios principales
$array_beneficiarios = array();
$datBeneficiariosArray = array();
$beneficiarios = @@grd_beneficiario;

foreach ($beneficiarios as $dataBeneficiarios) {
    if (!empty($dataBeneficiarios['frm_tipo_id_beneficiario']) &&
    !empty($dataBeneficiarios['frm_plan_numero_identificacion_beneficiario']) &&
    !empty($dataBeneficiarios['frm_plan_primer_apellido']) &&
    $dataBeneficiarios['frm_tipo_id_beneficiario'] != 'N/A' &&
    $dataBeneficiarios['frm_plan_numero_identificacion_beneficiario'] != 'N/A' &&
    $dataBeneficiarios['frm_plan_primer_apellido'] != 'N/A')

    {
        $apellido_1	= $dataBeneficiarios['frm_plan_primer_apellido'];
        $apellido_2	= $dataBeneficiarios['frm_plan_segundo_apellido'];
        $nombres	= $dataBeneficiarios['frm_plan_primer_nombre'].' '.$dataBeneficiarios['frm_plan_segundo_nombre'];
        $cod_tipo_doc	= $dataBeneficiarios['frm_tipo_id_beneficiario'];
        $nro_doc	= $dataBeneficiarios['frm_plan_numero_identificacion_beneficiario'];
        $cod_tipo_persona	= 'F';
        $frm_plan_prentesco	= $dataBeneficiarios['frm_plan_prentesco'];
        $sql_par = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
        WHERE
        COD_CATALOGO = 'PARENTESCO'
        AND CODIGO =  '$frm_plan_prentesco'";
        $rs_par  = executeQuery($sql_par, $cnx);

        $cod_parentesco =     $rs_par['1']['INTEGRACION'];

        if (empty($cod_parentesco)) {
            continue; // Saltar este beneficiario
        }

        $cod_beneficiario	= $dataBeneficiarios['frm_plan_numero_identificacion_beneficiario'];
        $pje_participacion	= $dataBeneficiarios['frm_plan_porcentaje'];
        //if nro_doc contains letters, 3, if it's 13 chars, 2, if it's 10 chars, 1
        if (preg_match('/[a-zA-Z]/', $nro_doc)) {
            $cod_tipo_doc = 3;
        } elseif (strlen($nro_doc) == 13) {
            $cod_tipo_doc = 2;
        } elseif (strlen($nro_doc) == 10) {
            $cod_tipo_doc = 1;
        }

        if ($cod_tipo_doc == 'P'){
            $cod_tipo_doc = 3;
        }

        $datBeneficiariosArray = [
            "apellido_1" => (string)$apellido_1,
            "apellido_2" => (string)$apellido_2,
            "nombres" => (string)$nombres,
            "cod_tipo_doc" => intval($cod_tipo_doc),
            "nro_doc" => (string)$nro_doc,
            "cod_tipo_persona" => (string)$cod_tipo_persona,
            "cod_parentesco" => intval($cod_parentesco),
            "cod_beneficiario" => intval(1), // Cambiar a int (no string)
            "pje_participacion" => floatval($pje_participacion) // Cambiar a float
        ];
        //add to array
        array_push($array_beneficiarios, $datBeneficiariosArray);
    }
}

//beneficiarios contingentes
$array_beneficiarios_c = array();
$datBeneficiariosArray_c = array();
$beneficiarios_c = @@grid_beneficiarios_contingentes;

foreach ($beneficiarios_c as $dataBeneficiarios_c) {
    if (!empty($dataBeneficiarios_c['frm_tipo_id_contingente']) &&
    !empty($dataBeneficiarios_c['frm_plan_numero_identificacion_beneficiario_contingente']) &&
    !empty($dataBeneficiarios_c['frm_plan_primer_apellido_contingente']) &&
    $dataBeneficiarios_c['frm_tipo_id_contingente'] != 'N/A' &&
    $dataBeneficiarios_c['frm_plan_numero_identificacion_beneficiario_contingente'] != 'N/A' &&
    $dataBeneficiarios_c['frm_plan_primer_apellido_contingente'] != 'N/A')

    {
        $apellido_1	= $dataBeneficiarios_c['frm_plan_primer_apellido_contingente'];
        $apellido_2	= $dataBeneficiarios_c['frm_plan_segundo_apellido_contingente'];
        $nombres	= $dataBeneficiarios_c['frm_plan_primer_nombre_contingente'].' '.$dataBeneficiarios_c['frm_plan_segundo_nombre_contingente'];
        $cod_tipo_doc	= $dataBeneficiarios_c['frm_tipo_id_contingente'];
        $nro_doc	= $dataBeneficiarios_c['frm_plan_numero_identificacion_beneficiario_contingente'];
        $cod_tipo_persona	= 'F';

        $frm_plan_prentesco_contingente	= $dataBeneficiarios_c['frm_plan_prentesco_contingente'];
        $sql_par = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
        WHERE
        COD_CATALOGO = 'PARENTESCO'
        AND CODIGO =  '$frm_plan_prentesco_contingente'";
        $rs_par  = executeQuery($sql_par, $cnx);

        $cod_parentesco =     $rs_par['1']['INTEGRACION'];

        if (empty($cod_parentesco)) {
            continue; // Saltar este beneficiario
        }


        $cod_beneficiario	= $dataBeneficiarios_c['frm_plan_numero_identificacion_beneficiario_contingente'];
        $pje_participacion	= $dataBeneficiarios_c['frm_plan_porcentaje_contingente'];

        //if nro_doc contains letters, 3, if it's 13 chars, 2, if it's 10 chars, 1
        if (preg_match('/[a-zA-Z]/', $nro_doc)) {
            $cod_tipo_doc = 3;
        } elseif (strlen($nro_doc) == 13) {
            $cod_tipo_doc = 2;
        } elseif (strlen($nro_doc) == 10) {
            $cod_tipo_doc = 1;
        }

        if ($cod_tipo_doc == 'P'){
            $cod_tipo_doc = 3;
        }

        $datBeneficiariosArray_c = [
            "apellido_1" => "$apellido_1",
            "apellido_2" => "$apellido_2",
            "nombres" => "$nombres",
            "cod_tipo_doc" => $cod_tipo_doc,
            "nro_doc" => "$nro_doc",
            "cod_tipo_persona" => "$cod_tipo_persona",
            "cod_parentesco" => $cod_parentesco,
            "cod_beneficiario" => 3,
            "pje_participacion" => $pje_participacion
        ];
        //add to array
        array_push($array_beneficiarios_c, $datBeneficiariosArray_c);
    }
}

if (count($array_beneficiarios_c) > 0) {
    foreach($array_beneficiarios as $databen){
        array_push($array_beneficiarios_c, $databen);
    }
    $array_beneficiarios_c = array_reverse($array_beneficiarios_c);
}

//coberturas
$array_coberturas = array();
$array_coberturas_dental = array();
$array_coberturas_exq = array();
$datCoberturasArray = array();
$coberturas = @@grd_coberturas;
$bandera_asistencia = 0; $bandera_asistencia_exe = 0;
$frm_frecuencia_cotizacion = @#frm_frecuencia_cotizacion*1;

foreach ($coberturas as $datCoberturas) {
    if ($datCoberturas['cobertura'] != '' && $datCoberturas['valor_asegurado'] != '' && $datCoberturas['valor_asegurado'] != '-' && $datCoberturas['valor_asegurado'] != '0') {
        $cod_deducible = 0;

        $cod_riesgo	= $datCoberturas['cobertura'];

        if( $cod_riesgo == 7 || $cod_riesgo == 18 || $cod_riesgo == 24 || $cod_riesgo == 25 || $cod_riesgo == 26 ||
        $cod_riesgo == 27 || $cod_riesgo == 28 || $cod_riesgo == 29 || $cod_riesgo == 30 || $cod_riesgo == 31 ||
        $cod_riesgo == 32 || $cod_riesgo == 12 || $cod_riesgo == 17 ||
        $cod_riesgo == 5800 || $cod_riesgo == 5801 || $cod_riesgo == 5802 || $cod_riesgo == 5803 || $cod_riesgo == 5804 ||
        $cod_riesgo == 5805 || $cod_riesgo == 5806 || $cod_riesgo == 5807 || $cod_riesgo == 5808 || $cod_riesgo == 5809 ||
        $cod_riesgo == 5810 || $cod_riesgo == 5811 || $cod_riesgo == 5812 || $cod_riesgo == 5813 || $cod_riesgo == 5814 ||
        $cod_riesgo == 5815 || $cod_riesgo == 5816 || $cod_riesgo == 5817 || $cod_riesgo == 5818 || $cod_riesgo == 5819 ||
        $cod_riesgo == 5820 || $cod_riesgo == 5821 || $cod_riesgo == 5822 || $cod_riesgo == 5823 || $cod_riesgo == 5824 ||
        $cod_riesgo == 5825 || $cod_riesgo == 5826 || $cod_riesgo == 5827 || $cod_riesgo == 5828 || $cod_riesgo == 5829 ||
        $cod_riesgo == 5830){
            $datCoberturas['valor_asegurado'] = 0;
            if($cod_riesgo == 5800 || $cod_riesgo == 5801 || $cod_riesgo == 5802 || $cod_riesgo == 5803 || $cod_riesgo == 5804 ||
            $cod_riesgo == 5805 || $cod_riesgo == 5806 || $cod_riesgo == 5807 || $cod_riesgo == 5808 || $cod_riesgo == 5809 ||
            $cod_riesgo == 5810 || $cod_riesgo == 5811 || $cod_riesgo == 5812 || $cod_riesgo == 5813 || $cod_riesgo == 5814 ||
            $cod_riesgo == 5815 || $cod_riesgo == 5816 || $cod_riesgo == 5817 || $cod_riesgo == 5818 || $cod_riesgo == 5819 ||
            $cod_riesgo == 5820 || $cod_riesgo == 5821 || $cod_riesgo == 5822 || $cod_riesgo == 5823 || $cod_riesgo == 5824 ||
            $cod_riesgo == 5825 || $cod_riesgo == 5826 || $cod_riesgo == 5827 || $cod_riesgo == 5828 || $cod_riesgo == 5829 ||
            $cod_riesgo == 5830){
                $cod_riesgo	= 58;
                if($datCoberturas['valor_asegurado'] == 'SERVICIO'){
                    $bandera_asistencia_exe = 1;
                }
            }
            else
            if($cod_riesgo == 7){
                $bandera_asistencia = 1;
            }
        }
        if($cod_riesgo == 600){
            $cod_riesgo = 19;
        }
        if($cod_riesgo == 500){
            $cod_riesgo = 5;
        }
        if($cod_riesgo == 700){
            $cod_riesgo = 23;
        }
        if($cod_riesgo == 5 || $cod_riesgo == 6 || $cod_riesgo == 19){
            if($cod_riesgo == 5){
                if($datCoberturas['cobertura_label'] == 'GASTOS MEDICOS POR ACCIDENTE - CON DEDUCIBLE')
                $cod_deducible = 2;
                else
                $cod_deducible = 1;
            }
            else{
                $cod_deducible = 3;
            }
        }

        if($cod_ramo == 59 && ($cod_producto == 215 || $cod_producto == 216)){
            if($frm_frecuencia_cotizacion == 6){$frm_frecuencia_cotizacion = 12; }
            $datCoberturas['prima_neta_anual'] = $datCoberturas['prima_neta_anual']*$frm_frecuencia_cotizacion;
        }

        $imp_suma_asegurada	= $datCoberturas['valor_asegurado'];
        $imp_extraprima	= 0;
        $pje_extraprima	= 0;
        $cnt_anios_extraprima	= 0;
        $imp_prima	= $datCoberturas['prima_neta_anual'];
        $sn_incremento	= 0;
        $pje_incremento	= 0;


        $datCoberturasArray = [
            "cod_riesgo" => intval($cod_riesgo),
            "imp_suma_asegurada" => floatval($imp_suma_asegurada), // Cambiar a float
            "imp_extraprima" => floatval($imp_extraprima), // Cambiar a float (no string)
            "pje_extraprima" => floatval($pje_extraprima), // Cambiar a float
            "cnt_anios_extraprima" => intval($cnt_anios_extraprima),
            "imp_prima" => floatval($imp_prima), // Cambiar a float (no string)
            "sn_incremento" => intval($sn_incremento), // Cambiar a int (no string)
            "pje_incremento" => floatval($pje_incremento), // Cambiar a float (no string)
            "cod_deducible" => intval($cod_deducible)
        ];
        
        if($cod_riesgo == 58){
            $datCoberturasArray_exq = [
                "cod_riesgo" => $cod_riesgo,
                "imp_suma_asegurada" => 0,
                "imp_extraprima" => "0",
                "pje_extraprima" => 0,
                "cnt_anios_extraprima" => 0,
                "imp_prima" => "0",
                "sn_incremento" => "0",
                "pje_incremento" => "0",
                "cod_deducible" => 0
            ];
            //add to exequial
            array_push($array_coberturas_exq, $datCoberturasArray_exq);
        }
        if($cod_riesgo == 24 || $cod_riesgo == 25 || $cod_riesgo == 26 || $cod_riesgo == 27 || $cod_riesgo == 28 || $cod_riesgo == 29 || $cod_riesgo == 30 || $cod_riesgo == 31 || $cod_riesgo == 32){
            $datCoberturasArray_dental = [
                "cod_riesgo" => $cod_riesgo,
                "imp_suma_asegurada" => 0,
                "imp_extraprima" => "0",
                "pje_extraprima" => 0,
                "cnt_anios_extraprima" => 0,
                "imp_prima" => "0",
                "sn_incremento" => "0",
                "pje_incremento" => "0",
                "cod_deducible" => 0
            ];
            //add to dental
            array_push($array_coberturas_dental, $datCoberturasArray_dental);
        }
        //add to array
        if($bandera_asistencia == 1 && $datCoberturas['prima_neta_anual'] == '0.00'){
            $bandera_asistencia = 0;
        }else{
            if($bandera_asistencia_exe == 1 && $datCoberturas['prima_neta_anual'] == '0.00'){
                $bandera_asistencia_exe = 1;
            }
            else{
                if($cod_riesgo == 18 && ($cod_producto == 110 || $cod_producto == 115)){
                    $bandera_riesgo_producto = 1;
                }
                else{
                    array_push($array_coberturas, $datCoberturasArray);
                }
            }
        }
    }
}

//dependientes sise
$array_dependientes = array();
$datCoberturasArray = array();
$dependientes = @=grd_dependientes_sise;


foreach ($dependientes as $datadepensise) {
    if (!empty($datadepensise['identificacion']) &&
    !empty($datadepensise['codigoAsegurado']) &&
    !empty($datadepensise['parentesco'])) {

        $frm_codigoAsegurado = $datadepensise['codigoAsegurado'];
        $frm_parentesco = $datadepensise['parentesco'];

        $sql_par_e = "SELECT INTEGRACION FROM ADMIN_CATALOGOS
        WHERE
        COD_CATALOGO = 'PARENTESCO'
        AND CODIGO =  '$frm_parentesco'";
        $rs_par_e  = executeQuery($sql_par_e, $cnx);
        $cod_parentesco_den =     $rs_par_e['1']['INTEGRACION'];

        if (empty($cod_parentesco_den)) {
            continue; // Saltar este dependiente
        }

        $cod_condicion = "2";
        $datCoberturasArray = [
            "cod_dependiente" => $frm_codigoAsegurado,
            "cod_parentesco" => $cod_parentesco_den,
            "cod_condicion" => "$cod_condicion"
        ];

        if($datadepensise['tipo'] == 'DENTAL'){
            $datCoberturasArray['coberturas'] = $array_coberturas_dental;
        }

        if($datadepensise['tipo'] == 'EXEQUIAL'){
            $datCoberturasArray['coberturas'] = $array_coberturas_exq;
        }

        if($datadepensise['tipo'] == 'DENTAL-EXEQUIAL'){
            $datCoberturasArray['coberturas'] = array_merge($array_coberturas_dental, $array_coberturas_exq);
            //array_push($array_dependientes, $datCoberturasArray);
        }
        if(isset($datCoberturasArray['coberturas']) && count($datCoberturasArray['coberturas']) > 0) {
            array_push($array_dependientes, $datCoberturasArray);
        }
    }
}


//importe
$imp_seg_campesino = 0;
$imp_super_bancos = 0;
$imp_deremi = 0;
if($cod_ramo == 59){
    $imp_recargo_financiero = 0;
    if(@@frm_prima_subtt*1 == @@frm_prima_total*1)
    {
        $imp_aporte_adicional = 0;
    }else{
        if(@@frm_frecuencia_cotizacion == '1'){
            $imp_aporte_adicional = @#frm_prima_total*1 - @#frm_prima_subtt*1;
        }
        if(@@frm_frecuencia_cotizacion == '2'){
            $imp_aporte_adicional = (@#frm_prima_total*1 - @#frm_prima_subtt*1)*(@#frm_frecuencia_cotizacion*1);
        }
        if(@@frm_frecuencia_cotizacion == '4'){
            $imp_aporte_adicional = (@#frm_prima_total*1 - @#frm_prima_subtt*1)*(@#frm_frecuencia_cotizacion*1);
        }
        if(@@frm_frecuencia_cotizacion == '6'){
            $imp_aporte_adicional = (@#frm_prima_total*1 - @#frm_prima_subtt*1)*12;
        }
    }
}else{
    $imp_aporte_adicional = @#frm_aporte_adicional;
    if(@@frm_frecuencia_cotizacion != '1'){
        $imp_recargo_financiero = @#frm_prima_recargo;
    }else{
        $imp_recargo_financiero = 0;
    }
}
$imp_premio = 0;

//agente
$cod_tipo_agente = @@frm_aps_codigo_tipoAgente;
$cod_agente = @@frm_aps_codigo_agente;
$pje_participacion = 100;

//pago
$cod_forma_pago = 0;
$fecha = '';
$valor = 0;
$txt_descripcion = '';
$id_banco = 0;
$cod_conducto = 0;
$nro_tarjeta = '';
$nro_autorizacion = 0;
$nro_lote = '';
$nro_referencia = '';
$cod_banco_establecimiento = 0;
$nro_establecimiento = 0;
$cod_plan_pago = 0;
$id_plan_cobro_cuota = 0;
$imp_descuento = 0;
$imp_saldo_inicial_vu = 0;
$txt_observacion = '';

//beneficio
if($cod_ramo == 59){
    $cod_opcion_ben = @@frm_beneficio;
    /*if($cod_producto == 216){
        $cod_opcion_ben = 1;
    }else{
        $cod_opcion_ben = 2;
    }*/
}else{
    $cod_opcion_ben = 0;
}
//$cod_opcion_ben = ($cod_ramo == 59 &&  ? 1 : 0);
if(@@frm_opcion_liquidacion_valor == 'PAGOUNICO'){
    $imp_super_bancos_ben = 1;
    $imp_deremi_ben = 100;
    $imp_recargo_financiero_ben = 0;
    $nro_cuotas_ben = 0;
}
if(@@frm_opcion_liquidacion_valor == 'PAGOCUOTAS'){
    $imp_super_bancos_ben = 2;
    $imp_deremi_ben = 0;
    $imp_recargo_financiero_ben = 100;
    $nro_cuotas_ben = @#frm_plazo_cuotas_liquidacion;
}
if(@@frm_opcion_liquidacion_valor == 'COMBINADA'){
    $imp_super_bancos_ben = 3;
    $imp_deremi_ben = @#frm_pago_unico_porcentaje;
    $imp_recargo_financiero_ben = @#frm_pago_cuota_porcentaje;
    $nro_cuotas_ben = @#frm_plazo_cuotas_liquidacion_combinada;
}

$var_json = [
    "solicitud" => [

        "cabecera_solicitud" => [
            "id_bpm" => (string)$id_bpm, // en la antigua viene como string
            "cod_suc" => intval($cod_suc),
            "cod_ramo" => intval($cod_ramo),
            "cod_producto" => intval($cod_producto),
            "fec_suscripcion" => (string)$fec_suscripcion,
            "vig_desde" => (string)$vig_desde,
            "cod_motivo_seguro" => intval($cod_motivo_seguro),
            "cod_forma_pago" => intval($frm_frecuencia_pago),
            "cod_usuario" => (string)$cod_usuario,
            "sn_aplica_cob" => intval($sn_aplica_cob),
            "mail_ejecutivo_comercial" => (string)$mail_ejecutivo_comercial,
            "mail_broker" => (string)$mail_broker
        ],

        "asegurado" => [
            "cod_contrantante" => intval($cod_contrantante),
            "cod_vinculo_aseg" => intval($cod_vinculo_aseg),
            "cod_conducto_pago" => intval($cod_conducto_pago),
            "nro_cta_tarj" => (string)$nro_cta_tarj,
            "aaaa_mm_vto_tarj" => intval($aaaa_mm_vto_tarj), // en la antigua es 0
            "cod_aseg" => intval($cod_contrantante),
            "cod_riesgo" => intval($cod_riesgo_aseg),
            "cod_condicion" => intval($cod_condicion_aseg),

            // estos NO existen en la trama antigua → se dejan como string/int según uso
            "sn_tipo_cuenta_deb" => intval($sn_tipo_cta_deb),
            "cod_banco_cred" => intval($cod_banco_cred),
            "sn_tipo_cuenta_cred" => intval($sn_tipo_cta_cred),
            "nro_cta_cred" => (string)$nro_cta_cred,
            "mail_cred" => (string)$mail_cred,
            "nro_documento_benef" => (string)$nro_documento_benef,
            "nombre_benef" => (string)$nombre_benef
        ],

        "importe" => [
            "imp_seg_campesino" => floatval($imp_seg_campesino),
            "imp_super_bancos" => floatval($imp_super_bancos),
            "imp_deremi" => floatval($imp_deremi),
            "imp_aporte_adicional" => floatval($imp_aporte_adicional),
            "imp_recargo_financiero" => floatval($imp_recargo_financiero),
            "imp_premio" => floatval($imp_premio)
        ],

        "agente" => [
            [
                "cod_tipo_agente" => intval($cod_tipo_agente),
                "cod_agente" => intval($cod_agente),
                "pje_participacion" => floatval($pje_participacion)
            ]
        ],

        "pago" => [
            [
                "cod_forma_pago" => intval($cod_forma_pago),
                "fecha" => (string)$fecha,
                "valor" => floatval($valor),
                "txt_descripcion" => (string)$txt_descripcion,
                "id_banco" => intval($id_banco),
                "cod_conducto" => intval($cod_conducto),
                "nro_tarjeta" => (string)$nro_tarjeta,
                "nro_autorizacion" => intval($nro_autorizacion),
                "nro_lote" => (string)$nro_lote,
                "nro_referencia" => (string)$nro_referencia,
                "cod_banco_establecimiento" => intval($cod_banco_establecimiento),
                "nro_establecimiento" => intval($nro_establecimiento),
                "cod_plan_pago" => intval($cod_plan_pago),
                "id_plan_cobro_cuota" => intval($id_plan_cobro_cuota),
                "imp_descuento" => floatval($imp_descuento),
                "imp_saldo_inicial_vu" => floatval($imp_saldo_inicial_vu),
                "txt_observacion" => (string)$txt_observacion
            ]
        ],

        "beneficio" => [
            "cod_opcion" => intval($cod_opcion_ben),
            "cod_liquidacion" => intval($imp_super_bancos_ben),
            "pje_pago_unico" => floatval($imp_deremi_ben),
            "pje_pago_cuotas" => floatval($imp_recargo_financiero_ben),
            "nro_cuotas" => intval($nro_cuotas_ben)
        ]

    ]
];


if (count($array_coberturas) > 0) {
    $var_json['solicitud']['asegurado']['coberturas'] = $array_coberturas;
}

if (count($array_beneficiarios) > 0) {
    $var_json['solicitud']['asegurado']['beneficiarios'] = $array_beneficiarios;
}

if (count($array_beneficiarios_c) > 0) {
    $var_json['solicitud']['asegurado']['beneficiarios'] = $array_beneficiarios_c;
}

if (count($array_dependientes) > 0) {
    $var_json['solicitud']['asegurado']['dependiente'] = $array_dependientes;
}

$var_json = json_encode($var_json);


@@tmp_json_EmisionAut = $var_json;

$curl = curl_init();

if(@@rutat7 == 'SUSCRIPCION_MANUAL'){
    echo 'Poliza manual - sin emisión automatica';
    return;
}

curl_setopt_array($curl, array(
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST  => 'POST',
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POSTFIELDS     => $var_json,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

PMFBitacoraServicios(
    @@APP_NUMBER,
    'trigger',
    'grabacion emision automatica',
    $url,
    'POST',
    'NO APLICA',
    $var_json,
    $response,
    $err
);


$status = curl_getinfo($curl);
$respuesta = json_decode($response, true);
//echo json_encode($status, JSON_PRETTY_PRINT);

@@tmp_emision_response = $response;
if (empty($response)) {
    $de = '';
    //$para = 'pcapuz@segurosequinoccial.com';
    //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
    //$bcc = 'victor.cortez@beesmart.ec';
    $para = $desPARA;
    $cc = $desCC;
    $bcc = $desBCC;
    $plantilla_rec = 'Notificacion_manual.html';
    $asunto = 'Problemas en la generacion de Poliza con SISE Caso BPM: ' . @#APP_NUMBER;
    $html_decision_notificacion = 'No existen valores de respuesta';
    @@html_decision_notificacion = $html_decision_notificacion;
    @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
    echo '<h3><br>Problemas en la generacion de Poliza con SISE<br>Comuniquese con el administrador del sistema</h3>';
    die();
}



if (curl_errno($curl)) {
    @@frm_accion_emisiona = 'ERROR';
    $cod_mensaje =  'Error de comunicación con el servicio web:'. $error_msg;
    echo '<br>';
    echo $cod_mensaje;
    $de = '';
    //$para = 'pcapuz@segurosequinoccial.com';
    //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
    //$bcc = 'victor.cortez@beesmart.ec';
    $para = $desPARA;
    $cc = $desCC;
    $bcc = $desBCC;
    $plantilla_rec = 'Notificacion_manual.html';
    $asunto = 'Error de comunicacion con el servicio web - Caso BPM: '.@#APP_NUMBER;
    $html_decision_notificacion = $cod_mensaje;
    @@html_decision_notificacion = $html_decision_notificacion;
    @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
    die();
}
curl_close($curl);

$cod_mensaje =  $respuesta['errorNumber'] ? $respuesta['errorNumber'] : 'NO';

@@tri_emision_respuesta = $respuesta['errorNumber'];
@@tri_emision_respuesta_label = $respuesta['Message'];

// inicializar variables previamente creadas
//$respuesta['errorNumber'] = -2;

if ($respuesta['errorNumber'] == 0) {
    if (stripos(strtoupper(@@tmp_emision_response),'REQUEST ERROR') === false){
        @@nro_asiento = $respuesta['nro_asiento'];
        @@nro_factura = $respuesta['nro_factura'];
        @@nro_imputacion = $respuesta['nro_imputacion'];
        @@nro_poliza = $respuesta['nro_poliza'];
        @@nro_recibo =     $respuesta["nro_recibo"];
        @@nro_solicitud =  $respuesta["nro_solicitud"];
        @@frm_accion_emisiona = 'CONTINUAR';
    }else {
        //aqui no debe haber CODIGO
        echo '<br>Problemas en la emision de la poliza<br>Comuniquese con el administrador del sistema<br>';
        @@frm_accion_emisiona = 'ERROR';
        @@nro_asiento = '';
        @@nro_factura = '';
        @@nro_imputacion = '';
        @@nro_poliza = '';
        @@nro_recibo = '';
        @@nro_solicitud = '';

        $de = '';
        //$para = 'pcapuz@segurosequinoccial.com';
        //$cc = 'pmartinez@segurosequinocial.com,jyacelga@segurosequinoccial.com,mguaman@segurosequinoccial.com';
        //$bcc = 'victor.cortez@beesmart.ec';
        $para = $desPARA;
        $cc = $desCC;
        $bcc = $desBCC;
        $plantilla_rec = 'Notificacion_manual.html';
        $asunto = 'Problemas en la emision de poliza Caso BPM: '.@#APP_NUMBER;
        $html_decision_notificacion = $respuesta['Message'];
        @@html_decision_notificacion = $html_decision_notificacion;
        @@envio_mail_ejec = PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla_rec, array());
        //die();
    }
} else {
    //aqui no debe haber CODIGO
    //echo $respuesta['Message'];
    @@frm_accion_emisiona = 'ERROR';
    @@frm_accion ='EMISION';
    @@nro_asiento = '';
    @@nro_factura = '';
    @@nro_imputacion = '';
    @@nro_poliza = '';
    @@nro_recibo = '';
    @@nro_solicitud = '';
}
