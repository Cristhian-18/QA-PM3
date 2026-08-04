//HENRY
function pep(){
  var valor = $('#frm_trabajo_expuesta_politicamente').getControl().val();
  if (valor == 'S') {
    	$('#frm_expuesta_especifique').show();
        $('#frm_expuesta_insttucion').show();
    	$('#frm_expuesta_fecha').show();   
    	$("#frm_expuesta_especifique").enableValidation();
    	$("#frm_expuesta_insttucion").enableValidation();
    	$('#frm_expuesta_fecha').enableValidation();
  }
  else {
  		$('#frm_expuesta_especifique').hide();
        $('#frm_expuesta_insttucion').hide();
    	$('#frm_expuesta_fecha').hide();   
    	$("#frm_expuesta_especifique").disableValidation();
    	$("#frm_expuesta_insttucion").disableValidation();
    	$('#frm_expuesta_fecha').disableValidation();  
  }
 }

pep();
$('#frm_trabajo_expuesta_politicamente').on('change', function () {
  pep();
});



function pep_familiar(){
  var valor = $('#frm_trabajo_expuesta_politicamente_familiar').getControl().val();
  if (valor == 'S') {
    	$('#frm_expuesta_especifique_cargo').show();
        $('#frm_expuesta_especifique_nombre').show();
    	$('#frm_expuesta_parentesco').show();   
    	$("#frm_expuesta_especifique_cargo").enableValidation();
    	$("#frm_expuesta_especifique_nombre").enableValidation();
    	$('#frm_expuesta_parentesco').enableValidation();
  }
  else {
  		$('#frm_expuesta_especifique_cargo').hide();
        $('#frm_expuesta_especifique_nombre').hide();
    	$('#frm_expuesta_parentesco').hide();   
    	$("#frm_expuesta_especifique_cargo").disableValidation();
    	$("#frm_expuesta_especifique_nombre").disableValidation();
    	$('#frm_expuesta_parentesco').disableValidation();  
  }
 }

pep_familiar();
$('#frm_trabajo_expuesta_politicamente_familiar').on('change', function () {
  pep_familiar();
});


function pep_relacion_detalle(){
  var valor = $('#frm_trabajo_expuesta_politicamente_familiar').getControl().val();
  var valor1 = $('#frm_expuesta_parentesco').getControl().val();
  if (valor == 'S' && valor1=='Otros') {
    	$('#frm_expuesta_parentesco_detalle').show();
        $('#frm_expuesta_parentesco_detalle').enableValidation();
  }
  else {
  		$('#frm_expuesta_parentesco_detalle').hide();
        $("#frm_expuesta_parentesco_detalle").disableValidation();
    	}
 }

pep_relacion_detalle();
$('#frm_expuesta_parentesco').on('change', function () {
  pep_relacion_detalle();
});