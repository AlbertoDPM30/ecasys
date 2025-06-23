/*=============================================
  EDITAR PROVEEDOR
=============================================*/
$(".DataTable").on("click", "#btnEditarProveedor", function () {
  var idProveedor = $(this).attr("idProveedor");

  var datos = new FormData();

  datos.append("idProveedor", idProveedor);

  $.ajax({
    url: "ajax/proveedores.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#idProveedor").val(respuesta["id"]);
        $("#editarProveedor").val(respuesta["proveedor"]);
        $("#editarTelefono").val(respuesta["telefono"]);
      }
    },
  });
});

/*=============================================
  ELIMINAR PROVEEDOR
=============================================*/
$(".DataTable").on("click", "#btnEliminarProveedor", function () {
  var idEliminarProveedor = $(this).attr("idEliminarProveedor");

  Swal.fire({
    title: "¿Seguro que desea eliminar este Proveedor?",
    showCancelButton: true,
    confirmButtonText: "Si, borrar",
    confirmButtonColor: "#3CC860",
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = new FormData();

      datos.append("idEliminarProveedor", idEliminarProveedor);

      $.ajax({
        url: "ajax/proveedores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {},
      });

      window.location = "proveedores";
    }
  });
});
