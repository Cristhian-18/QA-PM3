<?php
$idStro = 1;
$codItem = 1;
$codTercero = 1;

die("No fue posible generar la reserva del siniestro. "
        . "Por favor verifique los datos ingresados o contacte al equipo de soporte."
        . "<br>----- Información técnica (soporte) -----<br>"
        . "idStro=" . var_export($idStro, true)
        . ", codItem=" . var_export($codItem, true)
        . ", codTercero=" . var_export($codTercero, true));