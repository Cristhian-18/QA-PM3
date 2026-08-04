var formId = $("form").prop("id");
  
//Set an onchange event handler for the form. When the value of a field changes in the Dynaform, 
//check whether the changed field is the hasDiscount field in the grid. 
//If so, then if hasDiscount is set to "Discount", then enable the discountRate field in the same row. 
//If set to "No Discount", then disable the discountRate field.
$( "#" + formId ).setOnchange( function(fieldId, newVal, oldVal) {
	var aMatches_vsolicitado = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_valor_aprobado\]$/);
	//grid de coberturas monto solicitado
	if (aMatches_vsolicitado) {
		var rowNo_gv = aMatches_vsolicitado[1];
		//$("#frm_monto_liquidar").setValue(0);

		if (newVal != "") {
			var total = $("#grd_coberturas").getSummary(12);
			if (total === null || total === "" || isNaN(total)) {
				$("#frm_monto_liquidar").setValue(0);
			} else {
				$("#frm_monto_liquidar").setValue(total);
			}              
		}
	}

	var aMatches_vaproba = fieldId.match(/^\[grd_coberturas\]\[(\d+)\]\[grd_txt_valor\]$/);
	//grid de coberturas monto solicitado
	if (aMatches_vaproba) {
		var rowNo_gv = aMatches_vaproba[1];
		//$("#frm_monto_liquidar").setValue(0);

		if (newVal != "") {
			var total = $("#grd_coberturas").getSummary(11);
			if (total === null || total === "" || isNaN(total)){
				$("#frm_monto_reportado").setValue(0);
			}
			else{
				$("#frm_monto_reportado").setValue(total);
			}
		}
	}
});