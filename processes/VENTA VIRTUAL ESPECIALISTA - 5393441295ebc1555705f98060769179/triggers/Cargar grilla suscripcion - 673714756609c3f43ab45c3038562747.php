<?php
@=grid_suscripcion = array();

@=grid_suscripcion[ 1 ] = array('frm_suscripcion_pregunta' => 'Justificación monto');
@=grid_suscripcion[ 2 ] = array('frm_suscripcion_pregunta' => 'Interés asegurable de beneficiarios');
@=grid_suscripcion[ 3 ] = array('frm_suscripcion_pregunta' => 'Cotización: H/M, Fec.Nac.');
@=grid_suscripcion[ 4 ] = array('frm_suscripcion_pregunta' => 'Auditoría de firmas');
@=grid_suscripcion[ 5 ] = array('frm_suscripcion_pregunta' => 'Cancelaciones previas');
@=grid_suscripcion[ 6 ] = array('frm_suscripcion_pregunta' => 'Revisión base de R - A y N/C');
@=grid_suscripcion[ 7 ] = array('frm_suscripcion_pregunta' => 'Requisitos médicos completos');
@=grid_suscripcion[ 8 ] = array('frm_suscripcion_pregunta' => 'Requisitos para desgravamen');
@=grid_suscripcion[ 9 ] = array('frm_suscripcion_pregunta' => 'Validar respuesta de Magnum por limitaciones o novedades');
@=grid_suscripcion[ 10 ] = array('frm_suscripcion_pregunta' => 'Validar respuesta de Magnum en aplicación de extraprimas o limitantes de Vida y AP');
@=grid_suscripcion[ 11 ] = array('frm_suscripcion_pregunta' => 'Revisión de calificación Discapacidades en CI');
@=grid_suscripcion[ 12 ] = array('frm_suscripcion_pregunta' => 'Pago de tercero admisible');
@=grid_suscripcion[ 13 ] = array('frm_suscripcion_pregunta' => 'Colocación reaseguro');
@=grid_suscripcion[ 14 ] = array('frm_suscripcion_pregunta' => 'Orden en firme reaseguro');
@=grid_suscripcion[ 15 ] = array('frm_suscripcion_pregunta' => 'Requiere Cuestionario de Autocertificación Fiscal');

$grid_suscrip = array();
$i=1;
//cargar datos del grid original
foreach(@=grd_coberturas as $datacober){
    $valorAseg = is_numeric($datacober['valor_asegurado']) ? (float)$datacober['valor_asegurado'] : 0;
    $primaNeta = is_numeric($datacober['prima_neta_anual']) ? (float)$datacober['prima_neta_anual'] : 0;

    if($valorAseg > 0 && $primaNeta > 0){
        // guardar ID en grd_cobertura
        $grid_suscrip[$i]['grd_cobertura'] = $datacober['cobertura'];

        // guardar el NOMBRE en un campo de texto adicional (ej: grd_cobertura_nombre)
        $grid_suscrip[$i]['grd_cobertura_nombre'] = $datacober['cobertura_label'];

        $grid_suscrip[$i]['grd_monto'] = number_format($valorAseg, 2, ',', '.');
        //$grid_suscrip[$i]['grd_tarifa'] = $primaNeta;

        $i++;
    }
}


@=grd_coberturas_suscripcion = $grid_suscrip;


foreach(@=grd_coberturas_suscripcion as $key => &$row){
    foreach(@=grd_coberturas as $datacober){
        if($datacober['cobertura'] == $row['grd_cobertura']){
            $row['grd_cobertura_label'] = $datacober['cobertura_label'];
            break;
        }
    }
}

@@sw_grid_suscripcion = 'ok';


