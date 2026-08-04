function checkGrid(newVal, oldVal) {
    let rowNum = $("#grd_valores_siniestros").getNumberRows();
 
    for (let i = 1; i <= rowNum; i++) {
        // PVP - columna 5
        let pvp = $("#grd_valores_siniestros").getValue(i, 5);
        pvp = Number(pvp);
        pvp = isNaN(pvp) ? 0 : pvp.toFixed(2);
        $("#grd_valores_siniestros").setValue(i, 5, pvp);

        // Días entrega - columna 6
        let dias_entrega = $("#grd_valores_siniestros").getValue(i, 6);
        dias_entrega = Number(dias_entrega);
        dias_entrega = isNaN(dias_entrega) ? 0 : dias_entrega.toFixed(0);
        $("#grd_valores_siniestros").setValue(i, 6, dias_entrega);
    }
}
checkGrid($("#grd_valores_siniestros").getValue(), '');
$('#grd_valores_siniestros').change(checkGrid);