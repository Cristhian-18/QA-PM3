$("#bl_hist_mag").hide();
$("grd_datos_magnum").hide();

if($("#tri_bandera_magnum").getValue() == 'true'){
	$("#bl_hist_mag").show();
  	$("grd_datos_magnum").show();
}

var numRows = $("#grd_datos_magnum").getNumberRows();
for (var i=1; i <= numRows; i++) {
	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_num_caso\\]").css("color", "green");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_num_caso\\]").css("border", "green solid 2px");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_fecha_magnum\\]").css("color", "green");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_fecha_magnum\\]").css("border", "green solid 2px");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_decision_magnum\\]").css("color", "green");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_decision_magnum\\]").css("border", "green solid 2px");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_canal_entrada\\]").css("color", "green");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_canal_entrada\\]").css("border", "green solid 2px");
  	/*$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_resumen_link\\]").css("color", "green");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_resumen_link\\]").css("border", "green solid 2px");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_decision_link\\]").css("color", "green");
  	$("#form\\[grd_datos_magnum\\]\\["+i+"\\]\\[grd_decision_link\\]").css("border", "green solid 2px");
  */  
}