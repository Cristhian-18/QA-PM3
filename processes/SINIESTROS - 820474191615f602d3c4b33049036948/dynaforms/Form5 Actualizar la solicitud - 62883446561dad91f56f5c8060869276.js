//created by Henry

$("#frm_sbt_medico").hide()
$("#71422138261da327fe6a4d5053466166").hide()

if($("#tri_bandera_analista").getValue() == 'true'){
	$("#frm_sbt_medico").show()
	$("#71422138261da327fe6a4d5053466166").show()
}

$("#62883446561dad91f56f5c8060869276").setOnSubmit(function(){
  const confirmar = confirm("Desea realizar el pago al asegurado/contratante?");
    if (confirmar) {
    }
});