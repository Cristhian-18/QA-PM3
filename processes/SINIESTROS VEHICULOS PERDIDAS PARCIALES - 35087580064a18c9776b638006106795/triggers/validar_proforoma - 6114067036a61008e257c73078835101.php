<?php
if (empty(@@tri_resultado_automatico_original)) {
    @@tri_resultado_automatico_original = @@tri_resultado_automatico;
}

// 2. Trabajar siempre sobre el respaldo para evaluar el grid,
//    así cada vuelta parte del valor real, no del 'NO' forzado antes
@@tri_resultado_automatico = @@tri_resultado_automatico_original;

@@tra_validar_proforma = @@tri_resultado_automatico;

foreach (@@grd_valores_siniestros as $key => $value) {
    if ($value['frm_gvs_disponibilidad'] != 'DISPONIBLE') {
        @@tri_resultado_automatico = 'NO';
        break;
    }
}