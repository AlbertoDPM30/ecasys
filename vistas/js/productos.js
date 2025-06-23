/*=============================================
  CALCULAR PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra").on("input", function () {
  calcularPrecioVenta("#nuevoPrecioCompra", "#nuevoPrecioVenta");
});

$("#editarPrecioCompra").on("input", function () {
  calcularPrecioVenta("#editarPrecioCompra", "#editarPrecioVenta");
});

function calcularPrecioVenta(compra, venta) {
  let precioCompra = $(compra).val();
  if (precioCompra == "") {
    precioCompra = 0;
  }
  let precioVenta = precioCompra * 0.3;
  precioVenta += parseFloat(precioCompra);

  $(venta).val(precioVenta);

  let value = $(precioCompra).val();

  // Remover cualquier carácter que no sea un número o un punto
  value = value.replace(/[^0-9.]/g, "");

  // Actualizar el valor del input
  $(precioCompra).val(value);
}

/*=============================================
  EDITAR PRODUCTO
=============================================*/
$(".DataTable").on("click", "#btnEditarProducto", function () {
  var idProducto = $(this).attr("idProducto");

  var datos = new FormData();

  datos.append("idProducto", idProducto);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#idProducto").val(respuesta["id"]);
        $("#editarProducto").val(respuesta["producto"]);
        $("#editarIDCategoria").val(respuesta["id_categoria"]);
        $("#editarIDProveedor").val(respuesta["id_proveedor"]);
        $("#editarStock").val(respuesta["stock"]);
        $("#editarPrecioCompra").val(respuesta["precio_compra"]);
        $("#editarPrecioVenta").val(respuesta["precio_venta"]);
      }
    },
  });
});

/*=============================================
  ELIMINAR PRODUCTO
=============================================*/
$(".DataTable").on("click", "#btnEliminarProducto", function () {
  var idEliminarProducto = $(this).attr("idEliminarProducto");

  Swal.fire({
    title: "¿Seguro que desea eliminar este Producto?",
    showCancelButton: true,
    confirmButtonText: "Si, borrar",
    confirmButtonColor: "#3CC860",
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = new FormData();

      datos.append("idEliminarProducto", idEliminarProducto);

      $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {},
      });

      window.location = "productos";
    }
  });
});
