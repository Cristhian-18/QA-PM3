<?php
//Obtener Datos Directores
//26-09-2023
//Henry

//Suscriptor
$data_user = PMFInformationUser(@@USER_LOGGED);
@@frm_datosSolicitud_suscriptor = $data_user['firstname']. ' ' .$data_user['lastname'];