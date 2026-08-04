<?php
try{
    //validacion por tarea
    switch(@@TASK){
        //tarea 2
        case '309930261615f607b901f74034966395':
        @@frm_fecha_auditoria = date('d-m-Y');
        break;
        //TAREA 3
        case '78637654361d6525d2e3a08010058577':
        @@frm_fecha_amedica = date('d-m-Y');
        @@frm_causa_siniestro = @@frm_diagnostico_medico;
        @@frm_causa_siniestro_label = @@frm_diagnostico_medico_label;
        @@frm_cie_siniestro = @@frm_cie_medico;
        @@frm_cie_siniestro_label = @@frm_cie_medico_label;
        break;
        //Tarea 4
        case '810510287615f607b9b5ca4074139938':
        @@frm_fecha_aprobacion = date('d-m-Y');
        break;
        //Tarea 5
        case '82593904961d6539d3a40c1083663438':
        @@frm_fecha_liquidacion = date('d-m-Y');
        break;
        //Tarea 6
        case '54146797061d7b93a9bcdd0041253461':
        //@@frm_fecha_liquidacion = date('d-m-Y');
        break;
        default:
        //
        break;
    }
} catch (Exception $e) {

    $errorMessage =  $e->getMessage();

}
