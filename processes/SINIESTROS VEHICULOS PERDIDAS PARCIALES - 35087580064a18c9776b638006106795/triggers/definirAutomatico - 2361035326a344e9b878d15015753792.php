<?php
try {
    @@tri_resultado_automatico = 'NO';
    @@tri_motivo_rechazo = '';
    @@tri_categoria_rechazo = '';
    @@rpt_resultado_ia = 'NO';
    @@rpt_categoria_rechazo = '';

    $taller = strtoupper(trim(@$frm_taller));
    $cobertura = @@nombre_cobertura;
    $fecha_ocurrencia = @@frm_busqueda_fechaSiniestro;
    $hora_ocurrencia = @@frm_busqueda_horaSiniestro;
    $app_uid = @@APPLICATION;

    $motivos = [];    // acumulador de texto (para trazabilidad/debug)
    $categorias = []; // acumulador de categorías (sin duplicados, para reporting)

    $agregarMotivo = function($texto, $categoria) use (&$motivos, &$categorias) {
        $motivos[] = $texto;
        if (!in_array($categoria, $categorias, true)) {
            $categorias[] = $categoria;
        }
    };

    // --- Fecha de aviso ---
    $sql_creacion_date = "SELECT a.APP_CREATE_DATE FROM APPLICATION a where a.APP_UID = '$app_uid'";
    $sql_creacion_date_result = executeQuery($sql_creacion_date);
    $fecha_aviso = $sql_creacion_date_result[1]['APP_CREATE_DATE'] ?? null;

    if (empty($fecha_aviso)) {
        $agregarMotivo('No se pudo determinar la fecha de aviso (APP_CREATE_DATE)', 'ERROR_DATOS');
    }

    // --- Fecha/hora de ocurrencia vs aviso (max 15 dias) ---
    if (!empty($fecha_aviso) && !empty($fecha_ocurrencia) && !empty($hora_ocurrencia)) {
        try {
            $fecha_hora_ocurrencia = new DateTime($fecha_ocurrencia . ' ' . $hora_ocurrencia);
            $fecha_hora_aviso = new DateTime($fecha_aviso);
            $intervalo = $fecha_hora_aviso->diff($fecha_hora_ocurrencia);
            if ($intervalo->days > 15 || ($intervalo->days == 15 && ($intervalo->h > 0 || $intervalo->i > 0))) {
                $agregarMotivo('Fecha y hora de ocurrencia exceden los 15 días desde el aviso', 'FUERA_PLAZO');
            }
        } catch (\Throwable $e) {
            $agregarMotivo('Formato de fecha/hora de ocurrencia inválido (valor: ' . $fecha_ocurrencia . ' ' . $hora_ocurrencia . ')', 'ERROR_DATOS');
        }
    }

    // --- Responsabilidad civil ---
    $codigos_aplicados = array_map('trim', explode(',', (string) @@frm_cobertura_aplicada));
    $tiene_responsabilidad_civil = false;
    foreach (@@grd_registro_siniestro as $fila) {
        $codigo = (string) ($fila['grd_s_codCobertura'] ?? '');
        $nombre = strtoupper(trim($fila['grd_s_cobertura'] ?? ''));
        if (in_array($codigo, $codigos_aplicados, true) && strpos($nombre, 'RESPONSABILIDAD CIVIL') !== false) {
            $tiene_responsabilidad_civil = true;
            break;
        }
    }
    if ($tiene_responsabilidad_civil) {
        $agregarMotivo('Cobertura no elegible: RESPONSABILIDAD CIVIL', 'COBERTURA_NO_ELEGIBLE');
    }

    // --- Cobertura ---
    if ($cobertura !== 'PERDIDA PARCIAL POR DAÑO') {
        $agregarMotivo('Cobertura no elegible: ' . $cobertura, 'COBERTURA_NO_ELEGIBLE');
    }

    // --- Taller ---
    if (strpos($taller, 'MUNDO MOTRIZ') === false) {
        $agregarMotivo('Taller no elegible: ' . $taller, 'TALLER_NO_ELEGIBLE');
    } else {
        $frissValido       = strtoupper(trim(@$frm_friss_score)) === 'VERDE';
        $inundado          = @$frm_inundado;
        $partePolicial     = @$frm_requiere_PartePolicial;
        $responsable       = @$frm_siniestro_informacionResponsable;
        $fechaFin          = @$frm_poliza_FechaFin;
        $inundadoValido    = empty($inundado) || strtoupper(trim($inundado)) === 'NO';
        $policialValido    = empty($partePolicial) || strtoupper(trim($partePolicial)) === 'NO';
        $responsableValido = strtoupper(trim($responsable)) === 'SI';
        $policyValido = false;
        if (!empty($fechaFin)) {
            try {
                $policyValido = (new DateTime($fechaFin)) > (new DateTime());
            } catch (\Throwable $e) {
                $policyValido = false;
            }
        }

        // --- Búsqueda de documentos requeridos ---
        $licencia  = null;
        $matricula = null;
        $sqlDocs = "SELECT APP_DOC_UID, APP_DOC_FILENAME, APP_DOC_COMMENT
                    FROM APP_DOCUMENT
                    WHERE APP_UID = '$app_uid'
                      AND DOC_UID = '739729238652a772f7814b7025820719'
                    ORDER BY APP_DOC_CREATE_DATE DESC";
        $docs = executeQuery($sqlDocs);

        if (!empty($docs)) {
            foreach ($docs as $doc) {
                $comentario = (string) ($doc['APP_DOC_COMMENT'] ?? '');
                $ext  = pathinfo($doc['APP_DOC_FILENAME'], PATHINFO_EXTENSION);
                $ruta = getRutaDocumentoPM($app_uid, $doc['APP_DOC_UID'], $ext);
                if (!file_exists($ruta)) continue;
                if ($licencia === null && strpos($comentario, 'LICENCIA') !== false) {
                    $licencia = ['ruta' => $ruta, 'nombre' => $doc['APP_DOC_FILENAME'], 'ext' => $ext];
                } elseif ($matricula === null && strpos($comentario, 'MATRICULA') !== false) {
                    $matricula = ['ruta' => $ruta, 'nombre' => $doc['APP_DOC_FILENAME'], 'ext' => $ext];
                }
                if ($licencia !== null && $matricula !== null) break;
            }
        }
        $documentosValidos = ($licencia !== null && $matricula !== null);

        // --- Acumular motivos de rechazo ---
        if (!$frissValido)       $agregarMotivo('FRISS no es VERDE (valor: ' . trim(@$frm_friss_score) . ')', 'ANALISIS_DOCUMENTAL');
        if (!$inundadoValido)    $agregarMotivo('Vehiculo inundado (valor: ' . $inundado . ')', 'ANALISIS_DOCUMENTAL');
        if (!$policialValido)    $agregarMotivo('Requiere parte policial (valor: ' . $partePolicial . ')', 'ANALISIS_DOCUMENTAL');
        if (!$responsableValido) $agregarMotivo('Responsable no confirmado (valor: ' . $responsable . ')', 'ANALISIS_DOCUMENTAL');
        if (!$policyValido)      $agregarMotivo('Poliza vencida o sin fecha (valor: ' . $fechaFin . ')', 'ANALISIS_DOCUMENTAL');
        if (!$documentosValidos) {
            $docFaltantes = [];
            if ($licencia === null)  $docFaltantes[] = 'LICENCIA';
            if ($matricula === null) $docFaltantes[] = 'MATRICULA';
            $agregarMotivo('Documentos faltantes: ' . implode(', ', $docFaltantes), 'DOCUMENTACION_TALLER');
        }
    }

    // --- Resultado final ---
    if (empty($motivos)) {
        @@tri_resultado_automatico = 'SI';
        @@tri_motivo_rechazo = '';
        @@tri_categoria_rechazo = '';
    } else {
        @@tri_resultado_automatico = 'NO';
        @@tri_motivo_rechazo = implode(' | ', $motivos);
        @@tri_categoria_rechazo = implode(' | ', $categorias);
    }

    // --- Snapshot exclusivo para reporting (no se debe modificar en otros triggers) ---
    @@rpt_resultado_ia = @@tri_resultado_automatico;
    @@rpt_categoria_rechazo = @@tri_categoria_rechazo;

} catch (\Throwable $e) {
    @@tri_resultado_automatico = 'NO';
    @@tri_motivo_rechazo = 'Excepcion PHP: ' . $e->getMessage();
    @@tri_categoria_rechazo = 'ERROR_EJECUCION';
    @@rpt_resultado_ia = 'NO';
    @@rpt_categoria_rechazo = 'ERROR_EJECUCION';
}