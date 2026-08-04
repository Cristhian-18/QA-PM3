function acciones(){
var accion =   $("#frm_accion").getControl().val();
  //alert ("accion");
  	  $("#chk_motivos").hide();
      
  if(accion == 'REGULARIZAR'){
    $("#chk_motivos").show();    
  }
}


$('#frm_accion').setOnchange(acciones);
acciones();