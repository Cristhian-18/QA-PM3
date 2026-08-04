/* original henry
var id_op = $("#html_op").html('Id Stro - '+$("#tri_id_stro").getValue()+' | '+'Nro Stro - '+$("#tri_nro_stro").getValue());
*/
$("#id-stro").html(''+$("#tri_id_stro").getValue());
$("#nro-stro").html(''+$("#tri_nro_stro").getValue());


$("#pnl_parcial").hide()
var id_parcial = $("#html_parcial").html("CASO CATALOGADO COMO PARCIAL REVISE EN SISE -"+$("#tri_imp_monto_estimado").getValue()+' | '+$("#tri_imp_monto_pagado").getValue());

if($("#tri_bandera_parcial").getValue() == 'true'){
	$("#pnl_parcial").show();
}