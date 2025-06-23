/*=============================================
  EDITAR CLIENTE
=============================================*/
$(".DataTable").on("click", "#btnEditarCliente", function () {
  var idCliente = $(this).attr("idCliente");

  var datos = new FormData();

  datos.append("idCliente", idCliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#idCliente").val(respuesta["id"]);
        $("#editarNombres").val(respuesta["nombres"]);
        $("#editarApellidos").val(respuesta["apellidos"]);
        $("#editarCedula").val(respuesta["cedula"]);
      }
    },
  });
});

/*=============================================
  ELIMINAR CLIENTE
=============================================*/
$(".DataTable").on("click", "#btnEliminarCliente", function () {
  var idEliminarCliente = $(this).attr("idEliminarCliente");

  Swal.fire({
    title: "¿Seguro que desea eliminar este Cliente?",
    showCancelButton: true,
    confirmButtonText: "Si, borrar",
    confirmButtonColor: "#3CC860",
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = new FormData();

      datos.append("idEliminarCliente", idEliminarCliente);

      $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {},
      });

      window.location = "clientes";
    }
  });
});
