<?php
if (@@tmp_contador_derivacion == '' || @@tmp_contador_derivacion === null) {
    @@tmp_contador_derivacion = 0;
}

@@tmp_contador_derivacion = @@tmp_contador_derivacion + 1;
@@frm_respuesta_cliente = '';