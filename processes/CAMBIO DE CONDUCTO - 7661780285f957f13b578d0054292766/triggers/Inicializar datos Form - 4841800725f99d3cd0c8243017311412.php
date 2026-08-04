<?php
//created by Henry B
echo 'llege aqui';
@@frm_nombres_completos= @@frm_nombre_pagador.' '.@@frm_apellidos_pagador.' '.@@frm_apellidos_pagador_m;
@@tri_tipo_tarjeta= (@@frm_tipo_tarjeta == '' ? 'NO APLICA --------------------------------------------------------' : @@frm_tipo_tarjeta_label);
@@tri_fecha_caducidad_tarjeta= (@@frm_fecha_caducidad_tarjeta == '' ? 'NO APLICA --------------------------------------------------------' : @@frm_fecha_caducidad_tarjeta);
@@tri_entidad_financiera= (@@frm_entidad_financiera == '' ? 'NO APLICA --------------------------------------------------------' : @@frm_entidad_financiera_label);
@@tri_polizaanombrede= (@@frm_polizaanombrede == '' ? 'NO APLICA --------------------------------------------------------' : @@frm_polizaanombrede);
@@tri_parentesco= (@@frm_parentesco == '' ? 'NO APLICA --------------------------------------------------------' : @@frm_parentesco_label);

@@frm_fecha_solictud= getCurrentDate();
