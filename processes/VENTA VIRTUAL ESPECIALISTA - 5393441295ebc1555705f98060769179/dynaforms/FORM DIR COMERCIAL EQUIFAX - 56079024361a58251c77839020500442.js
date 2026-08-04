$(function() 
  {

  var m1 =$("#eqfx_cliente_mensaje").getValue();
  var m2 = $("#eqfx_pagador_mensaje").getValue();  

  $("#ajx_eqfx_cliente_estado").hide();
  $("#ajx_eqfx_pagador_estado").hide();
  $("#ajx_eqfx_pagador_tipo").disableValidation();    
  $("#frm_apellidos_pagador").disableValidation();
  $("#frm_cedula_pagador").disableValidation(); 
  $("#frm_conyuge_apellido_paterno").disableValidation(); 
  $("#frm_conyuge_numero_identificacion").disableValidation(); 
  $("#frm_conyuge_primer_nombre").disableValidation(); 
  $("#frm_conyuge_tipo_identificacion").disableValidation(); 
  $("#frm_nombre_pagador").disableValidation(); 
  $("#frm_parentesco").disableValidation();
  $("#frm_tipo_identificacion_pagador").disableValidation(); 
  $("#mensaje_cliente").html(m1);
  $("#mensaje_pagador").html(m2);
  $("#buro").html(comm); 
  var comm = $("#tri_rpt_equifax").getValue();
  var comp = $("#tri_rpt_equifax_pagador").getValue();

  $("#buro").html(comm); 
  $("#buro_pagador").html(comp);   



  ocultar_todo();  
  $("#subtit_cand").show();
  $("#8514610995fbe749293f281014281615").show();    
  $("#subtit_cot").show();
  $("#717835621600ef82bb986d1065323768").show();
  estado_civil();
  pago_tercero();  

});


function estadoCivil(){
  var estado = $("#frm_estado_civil").getControl().val();

  if (estado == 5 || estado == 2) {
    $('#3757104985ec4355abb45c4085575644').show();  

  }
  else {

    $('#3757104985ec4355abb45c4085575644').hide();       
  }	
}


$('.menu').on('click', function(){
  ocultar_todo();
  switch(this.id)
      {
    case 'persona' :
      $("#subtit_cand").show();
      $("#8514610995fbe749293f281014281615").show();    
      $("#subtit_cot").show();
      $("#717835621600ef82bb986d1065323768").show();
      estado_civil();
      pago_tercero();
      break;

    case 'burov' :
      $("#subtit_buro").show();
      $("#pnl_buro").show();    
      var pago = $("#frm_pago_terceros").getControl().val();
      if (pago == 'S') {
        $("#subtit_buro_pagador").show();
        $("#pnl_buro_pagador").show();
      }   
      break;

    case 'aprobacion' :
      $("#subtit_hist").show();
      $("#3659092825f484ded40e690037283996").show();

      $("#subtit_accion").show();
      $("#frm_accion").show();
      $("#frm_comentario").show();
      break;      
  }
});


function ocultar_todo(){
  $("#3659092825f484ded40e690037283996").hide();
  $("#3757104985ec4355abb45c4085575644").hide();
  $("#717835621600ef82bb986d1065323768").hide();
  $("#8514610995fbe749293f281014281615").hide();
  $("#8639320456010cbab579823088697264").hide();
  $("#frm_accion").hide();
  $("#frm_comentario").hide();
  $("#frm_pago_terceros").hide();
  $("#frm_sbt_conyuge_datos").hide();


  $("#subtit_buro").hide();
  $("#subtit_buro_pagador").hide();
  $("#pnl_buro_pagador").hide();
  $("#pnl_buro").hide(); 

  $("#subtit_accion").hide();
  $("#subtit_cand").hide();
  $("#subtit_cot").hide();
  $("#subtit_hist").hide();
  $("#subtit_pagador").hide();
}

function estado_civil(){
  var estado = $("#frm_estado_civil").getControl().val();

  if (estado == 5 || estado == 2) {
    $('#ifrmcony').children().removeClass('glyphicon-minus').addClass('glyphicon-plus');
    $("#frm_sbt_conyuge_datos").show();
    $("#frm_conyuge_tipo_identificacion").enableValidation(); 
    $("#frm_conyuge_numero_identificacion").enableValidation(); 
    $("#frm_conyuge_apellido_paterno").enableValidation(); 
    $("#frm_conyuge_primer_nombre").enableValidation(); 

  }
  else {
    $("#frm_sbt_conyuge_datos").hide();

    $('#3757104985ec4355abb45c4085575644').hide();       
  }	
}

function pago_tercero(){
  var pago = $("#frm_pago_terceros").getControl().val();

  if (pago == 'N') {
    $("#frm_pago_terceros").hide();
    $("#subtit_pagador").hide();
    $('#8639320456010cbab579823088697264').hide();       
  }	
  else
  {
    $("#frm_pago_terceros").show();
    $("#subtit_pagador").show();
    $('#8639320456010cbab579823088697264').show();
    $('#pnl_pagador').show();

  }
}