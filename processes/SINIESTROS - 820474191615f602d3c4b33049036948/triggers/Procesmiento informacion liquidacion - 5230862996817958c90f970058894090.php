<?php
try{


$_SESSION['PROCESS'] = '820474191615f602d3c4b33049036948';
$aResultados = json_decode(@@respuestaApiLiquidacion, true);
$aGrid = @=grdDetallePago;

foreach ($aGrid as $i => $fila) {
    if ($fila["txtProcesado"] == 1) {
        continue; // Saltamos si ya está procesado
    }
    if ($fila["grdTxtAT"] === null || $fila["grdTxtAT"] === "") {
        $codigoContratante = $fila["grdtxtCodigoContratante"];
        $valorAPagar = $fila["grdtxtValorPagar"];
        $tipoPago = (strtoupper($fila['grdtxtTipoPago']) === "TOTAL") ? 2 : 1;
        $observaciones = $fila["grdtxtObservaciones"];
        $procesado = 0;
        $swRegistro = false;
        $nroAt = '';

        foreach ($aResultados as $resultado) {
            if (!is_array($resultado)) {continue;}
            $codAbona = $resultado['cod_abona_vrs'];
            //obtenemos la trama devuelta en la respuesta
            $resTrama = json_decode($resultado['trama'], true);

            $txt_desc = isset($resTrama['txt_desc']) ? $resTrama['txt_desc'] : '';

            $detalleSiniestros = (isset($resTrama['detalleSiniestroCobertura']) && is_array($resTrama['detalleSiniestroCobertura']))
                    ? $resTrama['detalleSiniestroCobertura'] : array();
            foreach ($detalleSiniestros as $detalle) {
                $codTipoPago = $detalle['cod_tipo_pago'];
                $valorPagado = $detalle['imp_cpto'];
                // Comparamos con el código del grid
                if ($codAbona == $codigoContratante && $valorPagado == $valorAPagar && $codTipoPago == $tipoPago && $observaciones == $txt_desc) {
                    $respuesta = json_decode($resultado['respuesta'], true);
                    if (isset($respuesta['code']) && $respuesta['code'] == 0) {
                        $swRegistro = true;
                        $procesado = 1; // Proceso exitoso
                        $nroAt = $respuesta['data'][0]['nro_aut_tec'];
                    }
                    break;
                }
            }
            if ($swRegistro) {
                break; // Salimos del bucle si ya encontramos el registro
            }
        }
        if ($swRegistro) {
            $aGrid[$i]["txtProcesado"] = $procesado;
            $aGrid[$i]["txtProcesado_label"] = $procesado;
            $aGrid[$i]["grdTxtAT"] = $nroAt;
        }
    }
}
@=grdDetallePago = $aGrid;
@@frm_accion='CONTINUAR';
 } catch (Exception $e) {

	$errorMessage =  $e->getMessage();


}
