//estilo del checkbox
$("#chk_documentos").children("div").eq(0).removeClass()
$("#chk_documentos").children("div").eq(0).addClass("col-sm-8.col-md-8.col-lg-8")
$("#chk_documentos").children("div").eq(0).find("label").css("float", "left")
$("#chk_documentos").children("div").eq(1).removeClass()
$("#chk_documentos").children("div").eq(1).addClass("col-sm-4 col-md-4 col-lg-4 pmdynaform-field-control")
$("#chk_documentos").children("div").eq(1).css("float", "left")
$("#chk_documentos").children("div").eq(1).css("padding-left", "0")
$("#chk_documentos").find("span.textlabel").css("font-size", "16px");
$("#frm_cober_select").hide();

function get_documentos(newValue, oldValue){
  $("#frm_cober_select").setValue('');
  var datagrid = '';
     	var rows = $("#grd_coberturas").getNumberRows();
       for (var i=1; i <= rows; i++) {
         	if($("#grd_coberturas").getValue(i, 3) == 'SI')
           		datagrid = $("#grd_coberturas").getValue(i, 13)+'|'+datagrid;
        }
       var datagrid1 = datagrid.substring(0, datagrid.length - 1);
        $("#frm_cober_select").setValue(datagrid1);
  
  $("#chk_documentos_web").disableValidation();
  $("#frm_documentos").disableValidation();
  
  
	 if(newValue == 'SI'){
       $("#chk_documentos_web").enableValidation();
       $("#frm_documentos").enableValidation();
     }
}

$("#frm_check_documentos").setOnchange(get_documentos);