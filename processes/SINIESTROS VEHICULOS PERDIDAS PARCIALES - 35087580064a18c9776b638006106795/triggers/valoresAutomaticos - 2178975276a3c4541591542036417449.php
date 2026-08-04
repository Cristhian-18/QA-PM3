<?php
@@frm_comentario = 'PROCESO AUTOMATICO';
@@frm_accion = 'AUTOMATICO';

@@frm_documentos_check = 'SI';

if(@@frm_requiere_PartePolicial == 'NO' || @@frm_requiere_PartePolicial == ''){
    @@frm_requiere_AsesoriaLegal = 'NO';
}
@@frm_siniestro_seConsidera = 'AFECTADO';
@@frm_siniestro_informacionResponsable = 'NO';
@@frm_analisisCoberturas_fecha = date('Y-m-d H:i:s');

if (empty(@@frm_rp_componente_e))       @@frm_rp_componente_e       = 'NO';
if (empty(@@frm_componente_accesorios)) @@frm_componente_accesorios = 'NO';
if (empty(@@frm_requiere_AsesoriaLegal)) @@frm_requiere_AsesoriaLegal = 'NO';

if (empty(@@frm_siniestro_OtrosVehiculos)) @@frm_siniestro_OtrosVehiculos = 'NO';
if (empty(@@frm_siniestro_Propiedad)) @@frm_siniestro_Propiedad = 'NO';
if (empty(@@frm_siniestro_Personas)) @@frm_siniestro_Personas = 'NO';

if (empty(@@frm_conductor_relacion) || @@frm_conductor_relacion === 0) @@frm_conductor_relacion = '11';

if(empty(@@frm_analisisCobertura_analisisTecnico)) @@frm_analisisCobertura_analisisTecnico = 'SI';



$cobertura = @@nombre_cobertura;
$grid = @@grd_registro_siniestro;

foreach ($grid as $i => $row) {
    $grid[$i]['grd_s_aplicar'] = (trim($row['grd_s_cobertura']) === trim($cobertura)) ? 'SI' : 'NO';
}

@@frm_valoresAprobados_totalProformado = @@frm_valoresAprobados_manoObraProformada + @@frm_valoresAprobados_valorRepuestosProformado;

try {
    @@grd_registro_siniestro = $grid;
$texto = @@tri_condiciones_poliza_label;
$texto = html_entity_decode($texto, ENT_QUOTES, 'UTF-8');
$texto = strip_tags($texto);
$texto = preg_replace('/\s+/', ' ', $texto);

@@frm_deducible_ProcentajeSiniestro = null;
@@frm_deducible_PorcentajeAsegurado = null;
@@frm_deducible_ValorMinimo         = null;

// Paso 1: solo matchea "DEDUCIBLES:" (con S y dos puntos) o "DEDUCIBLE POR EVENTO"
// Ya NO matchea la palabra suelta "DEDUCIBLE" de frases como "EL DEDUCIBLE SE DESCONTARA..."
preg_match('/(?:DEDUCIBLES\s*:|DEDUCIBLE\s+POR\s+EVENTO)[^:]*:?.*?(?=NOTAS ACLARA(?:TORIAS|CIONES)|POLITICAS DE PROTECCION|GARANTIAS DE POLIZA|$)/isu', $texto, $seccionMatch);

if (!empty($seccionMatch[0])) {
    $seccionDeducibles = $seccionMatch[0];

    $corte = '(?=\s*(?:-|Pérdidas?\s+Total(?:es)?|Amparo patrimonial|Taller de convenio multimarca|P[ée]rdidas?\s+Parciales?|$))';

    preg_match('/-?(?:Taller de convenio multimarca|P[ée]rdida(?:\s+Parcial|s\s+Parciales))(?=\s*:|\s*\d)\s*:?\s*(.+?)' . $corte . '/iu', $seccionDeducibles, $bloqueMatch);
    if (!empty($bloqueMatch[1])) {
        $bloque = $bloqueMatch[1];

        preg_match('/(\d+(?:\.\d+)?)\s*%\s*del valor del siniestro/iu', $bloque, $mSiniestro);
        if (isset($mSiniestro[1]) && is_numeric($mSiniestro[1])) {
            @@frm_deducible_ProcentajeSiniestro = (float) $mSiniestro[1];
        }

        preg_match('/(\d+(?:\.\d+)?)\s*%\s*del valor asegurado/iu', $bloque, $mAsegurado);
        if (isset($mAsegurado[1]) && is_numeric($mAsegurado[1])) {
            @@frm_deducible_PorcentajeAsegurado = (float) $mAsegurado[1];
        }

        preg_match('/\$\s*(\d+(?:\.\d+)?)/u', $bloque, $mMinimo);
        if (isset($mMinimo[1]) && is_numeric($mMinimo[1])) {
            @@frm_deducible_ValorMinimo = (float) $mMinimo[1];
        } else {
            preg_match('/no menor a\s*(?:USD\.?)?\s*([\d.,]+)/iu', $bloque, $mMinFb);
            if (!empty($mMinFb[1])) {
                $valorMinimo = str_replace('.', '', $mMinFb[1]);
                $valorMinimo = str_replace(',', '.', $valorMinimo);
                if (is_numeric($valorMinimo)) {
                    @@frm_deducible_ValorMinimo = (float) $valorMinimo;
                }
            }
        }
    }
}
	//debug

    // --- Validación de insumos antes de calcular ---
    @@frm_deducible_ValorAsegurado = @@frm_sumaAseguradaCasco;
    $valor_asegurado = @@frm_deducible_ValorAsegurado;

    $motivos = []; // mismo patrón que tri_resultado_automatico

    if (!is_numeric($valor_asegurado)) {
        $motivos[] = 'Valor asegurado (frm_sumaAseguradaCasco) no numérico o vacío';
    }
    if (@@frm_deducible_ValorMinimo === null) {
        $motivos[] = 'No se pudo extraer valor mínimo de deducible del texto de póliza';
    }
    if (@@frm_deducible_ProcentajeSiniestro === null) {
        $motivos[] = 'No se pudo extraer % deducible sobre siniestro del texto de póliza';
    }
    if (@@frm_deducible_PorcentajeAsegurado === null) {
        $motivos[] = 'No se pudo extraer % deducible sobre valor asegurado del texto de póliza';
    }

    if (!empty($motivos)) {
        // Caso NO apto para cálculo automático -> revisión manual
        @@tri_resultado_automatico = 'NO';
        @@tri_motivo_rechazo = implode(' | ', $motivos);
        @@frm_deducible_Valor = ''; // o el campo que uses para indicar "no calculado"


        $app=@@APPLICATION;
        $usuario = @@tri_usr_analista;

        $sql_usuario = "SELECT USR_ID, USR_EMAIL FROM USERS WHERE USR_UID = '$usuario'";
        $result_usuario = executeQuery($sql_usuario);

        if(is_array($result_usuario) && count($result_usuario) > 0) {
            $analista_id = $result_usuario[1]['USR_ID'];
            $analista_email = $result_usuario[1]['USR_EMAIL'];
 

            @@tri_smart_claims_mensaje = 'Estimado analista, el proceso automático no pudo calcular los valores de deducible debido a que uno o más insumos no son válidos. Por favor, revise el caso y realice el cálculo manualmente. Motivo: ' . @@tri_motivo_rechazo;

            $de     = 'bpm@equisuiza.com';
            $para   = $analista_email;
            $cc     = '';
            $bcc    = '';
            $asunto = "Resultado de valores" . @@APP_NUMBER;
            $plantilla = 'notificacion_smart.html';

            PMFSendMessage(@@APPLICATION, $de, $para, $cc, $bcc, $asunto, $plantilla, array());

        }
            

        return;
    }
	
    // Solo se llega aquí si TODOS los datos son reales y numéricos
    $valor_siniestro_deducible = $valor_asegurado * (@@frm_deducible_ProcentajeSiniestro / 100);
    $valor_asegurado_deducible = $valor_asegurado * (@@frm_deducible_PorcentajeAsegurado / 100);

    $menor = min(
        @@frm_deducible_ValorMinimo,
        $valor_siniestro_deducible,
        $valor_asegurado_deducible
    );

    if($valor_asegurado > $menor) {
      @@frm_analisisCobertura_superaDeducible = 'SI';
    }else{
        @@frm_analisisCobertura_superaDeducible = 'NO';
    }
	


} catch (Exception $e) {
    @@tri_resultado_automatico = 'NO';
    @@tri_motivo_rechazo = 'Error calculando deducible: ' . $e->getMessage();
}