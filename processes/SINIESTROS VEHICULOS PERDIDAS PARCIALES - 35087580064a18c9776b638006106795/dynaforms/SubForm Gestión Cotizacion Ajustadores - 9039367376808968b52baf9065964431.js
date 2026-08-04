function checkGrid(newVal, oldVal) {
    let rowNum = 0;
    rowNum = $("#grd_valores_siniestros").getNumberRows();
    console.log(rowNum);
    valorAprobado = 0;
    for (let i = 1; i <= rowNum; i++) {
        let disponibilidad = $("#grd_valores_siniestros").getValue(i, 7);
        let estado = $("#grd_valores_siniestros").getValue(i, 11);
        //if disponibilidad = IMPORTACIÓN AND ESTADO = ''
        //set estado to pendiente
        if (disponibilidad == "IMPORTACIÓN" && estado == "") {

            $("#grd_valores_siniestros").setValue("Pendiente", i, 11);
        }

        console.log(disponibilidad);
        console.log(estado);
        let pvp = $("#grd_valores_siniestros").getValue(i, 5);
        pvp = roundToFixed(pvp, 2);
        //check if $("#grd_valores_siniestros").getValue(i, 11) == "Aprobado" || Indemnizacion )
        if ($("#grd_valores_siniestros").getValue(i, 11) == "Aprobado" || $("#grd_valores_siniestros").getValue(i, 11) == "Indemnizacion") {
            valorAprobado = valorAprobado + parseFloat(pvp);
        }
        $("#grd_valores_siniestros").setValue(pvp, i, 5);

        let dias_entrega = $("#grd_valores_siniestros").getValue(i, 6);
        dias_entrega = roundToFixed(dias_entrega, 0);
        $("#grd_valores_siniestros").setValue(dias_entrega, i, 6);
        //IF ($("#grd_valores_siniestros").getValue(i, 1) != "") && ($("#grd_valores_siniestros").getValue(i, 2) != "")
        //DISABLE EACH COLUMN
        console.log("ROW 5 VALUE", $("#grd_valores_siniestros").getValue(i, 5));
        console.log("ROW 6 VALUE", $("#grd_valores_siniestros").getValue(i, 6));
        console.log("ROW 7 VALUE", $("#grd_valores_siniestros").getValue(i, 7));

        if (($("#grd_valores_siniestros").getValue(i, 5) != "0.00")
            && ($("#grd_valores_siniestros").getValue(i, 7) != "")) {
            for (let j = 1; j <= 8; j++) {
                $("#grd_valores_siniestros").getControl(i, j).attr('disabled', true);
                //delete the pmdynaform-grid-removerow-responsive remove-row class inside the grid
                $("#grd_valores_siniestros-body")
                    .find(".glyphicon-trash[data-row='" + i + "']")
                    .closest(".pmdynaform-grid-removerow-responsive")
                    .hide();
                //check if 11 is == '' and enable it
                if ($("#grd_valores_siniestros").getValue(i, 11) == "") {
                    $("#grd_valores_siniestros").getControl(i, 11).attr('disabled', false);
                }
            }
        } else {
            for (let j = 4; j <= 8; j++) {
                $("#grd_valores_siniestros").getControl(i, j).attr('disabled', true);
            }
            $("#grd_valores_siniestros").getControl(i, 11).attr('disabled', true);
        }

    }
    console.log("Valor aprobados", valorAprobado);
    $("#frm_valoresAprobados_valoresRepuestos1").setValue(valorAprobado);

}

checkGrid($("#grd_valores_siniestros").getValue(), '');
$('#grd_valores_siniestros').change(checkGrid);
