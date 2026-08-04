<?php
@@dana_texto_mail="la Autorización de Débito";
@@dana_asunto_mail="Autorización de Débito";

@@frm_tipo_tarjeta_label_temp=@@frm_tipo_tarjeta_label;
@@frm_fecha_caducidad_tarjeta_temp=@@frm_fecha_caducidad_tarjeta;
@@frm_entidad_financiera_label_temp=@@frm_entidad_financiera_label;
@@frm_polizaanombrede_temp=@@frm_polizaanombrede;
@@frm_parentesco_temp=@@frm_parentesco;


if(strlen(@@frm_tipo_tarjeta)==0){@@frm_tipo_tarjeta_label="N/A";}
if(strlen(@@frm_fecha_caducidad_tarjeta)==0){@@frm_fecha_caducidad_tarjeta_temp="N/A";}
if(strlen(@@frm_entidad_financiera)==0){@@frm_entidad_financiera_label="N/A";}
if(strlen(@@frm_polizaanombrede)==0){@@frm_polizaanombrede="N/A";}
if(strlen(@@frm_parentesco)==0){@@frm_parentesco_label="N/A";}

if(strlen(@@frm_concepto_pago)==0){@@frm_concepto_pago="N/A";}



