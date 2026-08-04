function consultar_proveedor(ruc, valor)
{
  var ruc = $("#frm_proveedor_ruc").getValue();
 
  $.ajax({
    url  : '../beesmartec/services/solicitud_pago/ajax_pagos.php',
    data : {
      'funcion' : 'consultar_proveedor',
      'ruc'  : ruc
    },
    type : 'POST',
    dataType : 'json',
    beforeSend : function(){
      $("#9891392165d09b15744efe8017167361").showFormModal();
    },
    success : function(respuesta) {
      $("#9891392165d09b15744efe8017167361").hideFormModal(); // cierra el loader

      if (respuesta.ERROR !== "EXITO" || !respuesta.ID_PERSONA) {
        alert("El proveedor seleccionado no esta registrado en el sistema de Proveedores");
        return;
      }

      var nombre = respuesta.NOMBRE;
      var email  = '';
      var ruc    = respuesta.IDENTIIFICACION;
      var estado = respuesta.ESTADO;
      var tipo   = respuesta.TIPOPERSONA;
      var dir    = (respuesta.direccion_lista && respuesta.direccion_lista.length > 0)
                     ? respuesta.direccion_lista[0].DIRECCION
                     : '';

      $("#frm_proveedor_ruc").setValue(ruc);
      $("#frm_proveedor_email").setValue(email);
      $("#frm_proveedor_nombre").setValue(nombre);
      $("#frm_proveedor_estado").setValue(estado);
      $("#frm_proveedor_dir").setValue(dir);
      $("#frm_tipo_proveedor").setValue(tipo);
    },
    error : function(xhr, status) {
      $("#9891392165d09b15744efe8017167361").hideFormModal(); // también cerrar en error HTTP
    },
    complete : function(xhr, status) {
      // sin acción adicional necesaria
    }
  });
}

$('#btn_ruc').on('click', function(){
  inicializar_proveedor();
  consultar_proveedor();
});

function inicializar_proveedor(){
  $("#frm_proveedor_nombre").setValue('');
  $("#frm_proveedor_email").setValue('');
  $("#frm_proveedor_estado").setValue('');
  $("#frm_proveedor_dir").setValue('');
  $("#frm_tipo_proveedor").setValue('');
}