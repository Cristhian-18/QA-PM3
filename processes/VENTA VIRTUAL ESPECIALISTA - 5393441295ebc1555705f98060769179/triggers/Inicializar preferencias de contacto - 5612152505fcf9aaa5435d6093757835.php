<?php
 
if(@@frm_ocupacion_tipo_empleo == 'ESTUDIANTE' or @@frm_ocupacion_tipo_empleo == 'AMA_CASA' or @@frm_ocupacion_tipo_empleo == 'JUBILADO'){
	@@frm_trabajo_envio_correspondencia = 1;
	@@frm_trabajo_envio_correspondencia_label = "Domicilio";

	@@frm_trabajo_contacto_preferido = 1;
	@@frm_trabajo_contacto_preferido_label = "Personal";

	@@frm_trabajo_correo_preferido = 1;
	@@frm_trabajo_correo_preferido_label = "Personal";

}
