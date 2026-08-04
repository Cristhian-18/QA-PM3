<?php
//Obtener Catalogo Gestión INVEC

$sql = "SELECT DESCRIPCION as frm_documentos FROM ADMIN_CATALOGOS WHERE COD_CATALOGO = 'GESTION_IMVEC' AND ESTADO= 1 ORDER BY DESCRIPCION";

$rs = executeQuery($sql);

@=frm_legalInvec_gridDocumentos = $rs;
