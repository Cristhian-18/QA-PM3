//para el popup de info
$('#b_modal').click();
$('#tri_boton_parcial').setValue("false");
$('#4604882225ecc5fd4812890000861299').show();
//$("#btn_financiera_submit").hide();

$("#8737223465ecdcc194cfea5081700156").setOnSubmit(function(){
 
  
  $("#8737223465ecdcc194cfea5081700156").saveForm() ;
  if(showConfirmDlg()){
    
	return true;
	
 
  
  }
	else{
    	return false;
    }
                                                   
  
});

$("#btn_financiera_save").find("button").on("click" , function() {
  $("#8737223465ecdcc194cfea5081700156").saveForm();
  alert ("Formulario guardado ... Sera redireccionado a su bandeja");  
  $('#tri_boton_parcial').setValue("true");
  top.location="../cases/main"; //redirect to the Inbox in the topmost frame
});


function resume(securitySessionToken) {
  //alert(securitySessionToken);
  $("#8737223465ecdcc194cfea5081700156").showFormModal();
  //alert(securitySessionToken);
  //var securitySessionToken = document.getElementById('security-token').value;
  //var securitySessionToken = tri_securtoken_magnum;
  if ("" == securitySessionToken) {
    alert("Enter the security token!");
    return false;
  }
  
  var urlMagnum = $("#urlResumenMagnum").getValue();
  
  console.log('Aqui Info');
  var encodedToken = encodeURIComponent(securitySessionToken);
  var tmpHtml = urlMagnum+encodedToken;
  
   console.log(tmpHtml);
  
  var html_magnun = '<iframe width="1250" height="3000" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="'+tmpHtml+'"></iframe>';
	//console.log('Aqui Info');
  	//console.log(html_magnun);
	$("#magnum-icw_html").html(html_magnun);
  
  $("#8737223465ecdcc194cfea5081700156").hideFormModal();
  
};

$("#btn_magnun").find("button").on("click" , function() {
  resume($("#tri_securtoken_magnum").getValue());
});

resume($("#tri_securtoken_magnum").getValue());
$("#tri_securtoken_magnum").hide();
$("#btn_magnun").hide();