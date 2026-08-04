function valorSalvamento(newVal, oldVal){
    $("#frm_rs_ofertaAseguradoSalvamento").hide();
    if(newVal == "SI"){
        $("#frm_rs_ofertaAseguradoSalvamento").show();
    }
}

valorSalvamento($("#frm_rs_check_ofertaAseguradoSalvamento").getValue(),'');
$("#frm_rs_check_ofertaAseguradoSalvamento").setOnchange(valorSalvamento);