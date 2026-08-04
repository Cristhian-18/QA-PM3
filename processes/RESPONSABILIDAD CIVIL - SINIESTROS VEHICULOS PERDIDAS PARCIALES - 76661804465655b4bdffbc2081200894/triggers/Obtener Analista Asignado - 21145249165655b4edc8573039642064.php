<?php
//Obtener Datos Directores
//26-09-2023
//Henry

$data_user = PMFInformationUser(@@USER_LOGGED);
@@frm_busqueda_ejecutivoAsignado = $data_user['firstname']. ' ' .$data_user['lastname'];

/*echo(@@frm_busqueda_fechaSiniestro);
$fecha = date('Y/m/d',@@frm_busqueda_fechaSiniestro);
echo($fecha);
die();*/
/* solicitado por frm_datosSolicitud_solicitante
frm_datosSolicitud_directorComercial
frm_datosSolicitud_directorEspecialista*/


