<?php

$data_user = PMFInformationUser(@@USER_LOGGED);
@@frm_informacion_nombreAbogado = $data_user['firstname'] . ' ' . $data_user['lastname'];
@@correo_abogado = $data_user['mail'];

$data_analista = PMFInformationUser(@@tri_usr_analista);
@@frm_busqueda_ejecutivoAsignado_1 = $data_analista['firstname'] . ' ' . $data_analista['lastname'];

@@correo_analista = $data_analista['mail'];