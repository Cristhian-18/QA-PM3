//created By Henry
var is_broker = $("#tri_es_broker").getValue();

if(is_broker == 'SI'){
	$("#frm_vendedor_nombre").hide();
  	$("#frm_vendedor_cargo").disableValidation();
  	$("#frm_vendedor_cargo").hide();
}else{
	$("#frm_aps_nombre").disableValidation();
  	$("#frm_aps_nombre").hide();
  	$("#frm_aps_cargo").disableValidation();
  	$("#frm_aps_cargo").hide();
  	$("#frm_aps_ec_nombre").hide();
}