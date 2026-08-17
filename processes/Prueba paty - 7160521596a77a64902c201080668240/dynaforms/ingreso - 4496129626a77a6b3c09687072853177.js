//var host = PMDynaform.getHostName();
//var ws = PMDynaform.getWorkSpaceName();
var token = '3Y5hdcFZecClx4vOCwW0lYeCWRvePePB';
var user = PMDynaform.getUserInfo();
var codUsuario = user.username; 


function getUserInfo(){
var nroCedula =$("#cedula").getControl().val();
	var x =[];
$.ajax({
    url: 'https://apisprd.equinoccialonline.com/api/v1.1/gestioncliente/mantenimiento/cliente/consultarInformacion',
    type: 'POST',
    contentType: 'application/json; charset=utf-8',
    dataType: 'json',
    data: JSON.stringify({
        sCodUsuario: codUsuario,
        sValorParametro: nroCedula,
        iTipoParametro: 0,
        bConsultarEstado: false,
        bConsultarLA: false
    }),
    beforeSend: function(xhr) {
        xhr.setRequestHeader(
            'Authorization',
            'Bearer 3Y5hdcFZecClx4vOCwW0lYeCWRvePePB'
        );
    },
        success: function(cedula) {
        console.log(cedula);
        x.push(cedula.data.cli_apellido1);
        var price = x[0];  
        getFieldById('nombre').setText(price);

        }

    });
}

$("#btnconsultar").click(getUserInfo);

  /*

function convertPrice{
var ape = $("#cedula").getControl().val();
var x =[];

$.ajax({
url: 'http://apilayer.net/api/live?access_key=0eceb5178b5e02f7548cdb8503753cb2&currencies=EUR' , type:"GET", data: {
},
success: function(amount){
x.push(amount.quotes.USDEUR);
var price = x[0] * $("#cedula").getValue();
console.log(price);
getFieldById("nombre").setText(price);
}
});
}

$("#consultar").click(convertPrice);
  */
