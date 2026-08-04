let numberRows = $("#grd_valores_siniestros").getNumberRows();

$("#grd_valores_siniestros").hideColumn(5);
$("#grd_valores_siniestros").hideColumn(7);
$("#grd_valores_siniestros").hideColumn(8);
$("#grd_valores_siniestros").hideColumn(9);

let rows = $(".pmdynaform-grid-row");
let length = $(".pmdynaform-grid-row").length-1;

let negados = $("option[value='Negado']");
let pendientes = $("option[value='Pendiente']");

for (let i = 0; i <= length; i++) {
    $("#grd_valores_siniestros").getControl(i+1, 3).attr('disabled', true);
    $("#grd_valores_siniestros").getControl(i+1, 4).attr('disabled', true);
    $("#grd_valores_siniestros").getControl(i+1, 5).attr('disabled', true);
    $("#grd_valores_siniestros").getControl(i+1, 6).attr('disabled', true)
    $("#grd_valores_siniestros").getControl(i+1, 7).attr('disabled', true)
    $("#grd_valores_siniestros").getControl(i+1, 8).attr('disabled', true)

    if(($("#grd_valores_siniestros").getValue(i+1, 11))!="Pendiente"){
        $(rows[i]).hide();
    } else {
        $("#grd_valores_siniestros").getControl(i+1, 11).attr('required', true)
        $(negados[i]).hide();
        $(pendientes[i]).hide();
    }

}

/*$("option[value='Negado']").remove();
$("option[value='Pendiente']").remove();*/

let isBoss = confirm("Estimado cliente: \nPor favor, apruebe la importación de los siguientes repuestos o en su defecto solicite su indemnización, en caso de no seleccionar ninguno de los dos se aprobarán por defecto");

document.onload = function () {
alert( isBoss );
}

