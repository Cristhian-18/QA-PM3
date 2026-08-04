function nombreDoc(newValue, oldValue) {
  $("#frm_emisionNegativa_nombreUltimoDoc2").hide();
  if(newValue == 'OTROS'){
    $("#frm_emisionNegativa_nombreUltimoDoc2").show();
  } 
}

nombreDoc($("#frm_emisionNegativa_nombreUltimoDoc").getValue(), '');
$("#frm_emisionNegativa_nombreUltimoDoc").setOnchange(nombreDoc);