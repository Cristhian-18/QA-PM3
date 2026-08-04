<?php
//Inicializar Documneto Suscripcion
@@tri_dictamen_suscripcion = '';
$html_suscric = '<table cellspacing="0" cellpadding="4" style="background-color: #00493c; text-transform: uppercase; text-align: center; color: #ffffff; width: 100%;">
  <tr><td><b>Observaciones</b></td></tr>
</table>';

$html_suscric .= '<table cellspacing="0" cellpadding="2" style="width: 100%;">
  <tr>
    <td style="background-color: #ffffff; vertical-align: top;">' . @@frm_comentario . '</td>
  </tr>
</table>';

@@tri_dictamen_suscripcion = $html_suscric;

//informacion para el dictamen de suscripcion
@@grd_cobertura_label_dictamen = '';
@@grd_monto_label_dictamen = '';
@@grd_tarifa_dictamen = '';

//debo leer el array grd_coberturas_suscripcion y llenar cada variable con cada campo, y un salto de linea
if (is_array(@@grd_coberturas_suscripcion)) {
    foreach (@@grd_coberturas_suscripcion as $cobertura) {
        @@grd_cobertura_label_dictamen .= $cobertura['grd_cobertura_label'] . "\n";
        @@grd_monto_label_dictamen .= $cobertura['grd_monto'] . "\n";
        @@grd_tarifa_dictamen .= $cobertura['grd_tarifa'] . "\n";
    }

}
