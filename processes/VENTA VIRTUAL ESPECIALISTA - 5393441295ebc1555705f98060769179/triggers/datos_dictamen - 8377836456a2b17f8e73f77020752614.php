<?php
$html_preguntas = '<b>Pregunta</b><br>';
$html_respuestas = '<b>Respuesta</b><br>';

for ($i = 1; $i <= count(@@grid_suscripcion); $i++) {
    $html_preguntas  .= @@grid_suscripcion[$i]['frm_suscripcion_pregunta'] . '<br>';
    $html_respuestas .= @@grid_suscripcion[$i]['frm_suscripcion_respuesta_label'] . '<br>';
}

@@frm_suscripcion_pregunta_html  = $html_preguntas;
@@frm_suscripcion_respuesta_html = $html_respuestas;