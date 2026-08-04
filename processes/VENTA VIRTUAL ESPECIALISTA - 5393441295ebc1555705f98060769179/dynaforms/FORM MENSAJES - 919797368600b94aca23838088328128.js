//ocultar
$(".magnum-summary-action__edit").hide();
function ocultar_todo() {
    $("#magnum-decision").hide();
    $("#magnum-summary").hide();
  	$("#frm_debito_si").hide();
  	$("#frm_pago_si").hide();
  	$("#frm_comentario").hide();
  	$("#btn_continuar").hide();
}

//vinetas
$('.menu').on('click', function () {
    ocultar_todo();
    switch (this.id) {
        case 'decision':
            $("#magnum-decision").show();
            break;

        case 'resumen':
            $("#magnum-summary").show();
            break;
        
        case 'atencion':
            $("#frm_debito_si").show();
            $("#frm_pago_si").show();
            $("#frm_comentario").show();
        	$("#btn_continuar").show();
            break;
    }
});

ocultar_todo();
 $("#magnum-summary").show();
//DESICION
/*var data = $("#tri_decision_magnum").getValue();

var cleanDecisionJSON = data.replace(/\n/g,'');
cleanDecisionJSON = cleanDecisionJSON.replace(/\\/g,'or');       // "Extra mortality \ morbidity" 
var oDecision = JSON.parse(cleanDecisionJSON);


document.querySelector('magnum-decision').data = oDecision;
*/

var data = $("#html_decision_magnum").getValue();
$("#html_decision").html(data);

//SUMMARY
var data_summary = $("#tri_summary_magnum").getValue();

var cleanDecisionJSON_summary = data_summary.replace(/\n/g,'');
cleanDecisionJSON_summary = cleanDecisionJSON_summary.replace("\"over the counter\"","'over the counter'");
var oDecision_summary = JSON.parse(cleanDecisionJSON_summary);


document.querySelector('magnum-summary').data = oDecision_summary;

const container = document.getElementById('html_summary');
const result = container.innerHTML;
//console.log(result);
//$("#tri_summary_magnum_html").setValue(document.querySelector('magnum-summary').data);

if ($("#tri_es_broker").getValue() != 'SI' || $("#frm_pago_terceros").getValue() == 'S'){
	$("#frm_debito_si").setValue("SI");
  	$("#frm_debito_si").getControl().attr('disabled', true);
}

if ($("#tri_es_broker").getValue() == 'SI' || $("#tri_bandera_primera_cuota").getValue() == 'true'){
	$("#frm_pago_si").setValue("NO");
  	$("#frm_pago_si").getControl().attr('disabled', true);
}


if ($("#frm_recibio_deposito").getValue() == 'S'){
	$("#frm_pago_si").setValue("NO");
  	$("#frm_pago_si").getControl().attr('disabled', true);
}