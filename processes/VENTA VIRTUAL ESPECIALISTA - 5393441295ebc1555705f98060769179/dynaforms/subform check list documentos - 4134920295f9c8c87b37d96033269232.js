/*$("#grd_obligatorios").hide();*/
$("#fle_mas_docs").hide();
$("#fle_otros_docs").hide();
$("#fle_docs_repro").hide();
/*$("#grd_especificos").hide();*/
$("#fle_docs_aprobar").hide();

$("#fle_mas_docs").find("button").html("Seleccionar archivos");
$("#fle_otros_docs").find("button").html("Seleccionar archivos");
$("#fle_docs_repro").find("button").html("Seleccionar archivos");
$("#fle_docs_aprobar").find("button").html("Seleccionar archivos");

/*var numopcional =  $("#grd_especificos").getNumberRows();
if (numopcional == 0){
  $("#subtit_opc").getNumberRows();
  $("#grd_especificos").hide();
}*/

if($("#TASK").getValue() == '4033495885f982c8ce12631090926236'){
	$("#fle_mas_docs").show();
}

if($("#TASK").getValue() == '9625228685f982cb3eaa338037581251'){
	$("#fle_otros_docs").show();
}

if($("#TASK").getValue() == '9938028895f0f3574ab7db1043599014'){
	$("#fle_docs_repro").show();
}
//t09
if($("#TASK").getValue() == '5378516815f96e3b7bf1699006176801' && $("#tri_es_broker").getValue() == 'SI'){
	$("#fle_docs_aprobar").show();
}

/*$("#grd_especificos").hideColumn(2);*/