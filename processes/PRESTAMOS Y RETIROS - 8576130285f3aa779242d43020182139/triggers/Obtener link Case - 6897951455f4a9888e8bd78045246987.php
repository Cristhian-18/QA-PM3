<?php
//created by Henry
//29-08-2020
//Obtener link Case

$app_link = PMFCaseLink(@@APPLICATION, 'certificacion', 'es', '3sesa');

@@app_link_html = '<p>Por favor para ingresar al caso <a href="'.$app_link.'" title="link" target="_blank">link</a></p>';