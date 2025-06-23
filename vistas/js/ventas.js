/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

$(".tablaVentas").DataTable({
  ajax: "ajax/datatable-ventas.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo: "",
    sInfoEmpty: "",
    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Cargando...",
    oPaginate: {
      sFirst: "Primero",
      sLast: "Último",
      sNext: "Siguiente",
      sPrevious: "Anterior",
    },

    oAria: {
      sSortAscending: ": Activar para ordenar la columna de manera ascendente",
      sSortDescending:
        ": Activar para ordenar la columna de manera descendente",
    },
  },
});

/*=============================================
VALIDAR SI EL CAMPO TASA BS ESTÁ VACIO
=============================================*/

$("#nuevoTasaBs").on("input", function () {
  if ($("#nuevoTasaBs").val() == "") {
    $("small.alert").removeClass("d-none");
    $("button.btnAgregarProducto").attr("disabled", "disabled");
  } else {
    $("small.alert").addClass("d-none");
    $("button.btnAgregarProducto").removeAttr("disabled");
  }
});

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function () {
  var idProducto = $(this).attr("idProducto");

  $(this).removeClass("btn-primary agregarProducto");

  $(this).addClass("btn-default");

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
      var producto = respuesta["producto"];
      var stock = respuesta["stock"];
      var precio = respuesta["precio_venta"];

      /*=============================================
      EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
      =============================================*/

      if (stock == 0) {
        Swal.fire({
          icon: "error",
          title: "¡No hay stock disponible!",
          cancelButtonText: "Ok",
        });

        $("button[idProducto='" + idProducto + "']").addClass(
          "btn-primary agregarProducto"
        );

        return;
      }

      $(".nuevoProducto").append(
        `<div class="row" style="padding:5px 15px">
        <div class="col-sm-6" style="padding-right:0px">
          <div class="input-group">
            <button type="button" class="btn btn-danger quitarProducto" idProducto="${idProducto}">
              <i class="fa fa-times"></i>
            </button>
            <input type="text" class="form-control nuevoProductoSelect" idProducto="${idProducto}" name="agregarProducto" value="${producto}" readonly required>
          </div>
        </div>

        <div class="col-sm-3">
          <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="${stock}" nuevoStock="${Number(
          stock - 1
        )}" required>
        </div>
        
        <div class="col-sm-3 ingresoPrecio" style="padding-left:0px">
          <div class="input-group">
            <span class="input-group-text bg-warning"><i class="fa-solid fa-dollar-sign"></i></span>
            <input type="text" class="form-control nuevoPrecioProducto" precioReal="${formatearNumero(
              precio
            )}" name="nuevoPrecioProducto" value="${formatearNumero(
          precio
        )}" readonly required>
          </div>
        </div>
      </div>`
      );

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPrecios();

      // AGREGAR IMPUESTO

      agregarImpuesto();

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductos();

      localStorage.removeItem("quitarProducto");
    },
  });
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

// $(".tablaVentas").on("draw.dt", function () {
//   if (localStorage.getItem("quitarProducto") != null) {
//     var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

//     for (var i = 0; i < listaIdProductos.length; i++) {
//       $(
//         `button.recuperarBoton[idProducto='"${listaIdProductos[i]["idProducto"]}"']`
//       ).removeClass("btn-default");
//       $(
//         `button.recuperarBoton[idProducto='${listaIdProductos[i]["idProducto"]}']`
//       ).addClass("btn-primary agregarProducto");
//     }
//   }
// });

$(".tablaVentas").on("draw.dt", function () {
  if (localStorage.getItem("quitarProducto") != null) {
    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

    for (var i = 0; i < listaIdProductos.length; i++) {
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto"] +
          "']"
      ).addClass("btn-primary agregarProducto");
    }
  }
  quitarAgregarProducto();
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

// var idQuitarProducto = [];

// localStorage.removeItem("quitarProducto");

// $(".formularioVenta").on("click", "button.quitarProducto", function () {
//   $(this).parent().parent().parent().parent().remove();

//   var idProducto = $(this).attr("idProducto");

//   /*=============================================
// 	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
// 	=============================================*/

//   if (localStorage.getItem("quitarProducto") == null) {
//     idQuitarProducto = [];
//   } else {
//     idQuitarProducto = JSON.parse(localStorage.getItem("quitarProducto"));
//   }

//   idQuitarProducto.push({ idProducto: idProducto });

//   localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

//   $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass(
//     "btn-default"
//   );

//   $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass(
//     "btn-primary agregarProducto"
//   );

//   if ($(".nuevoProducto").children().length == 0) {
//     $("#nuevoImpuestoVenta").val(0);
//     $("#nuevoTotalVenta").val(0);
//     $("#totalVenta").val(0);
//     $("#nuevoTotalVenta").attr("total", 0);
//     $("#nuevoPrecioNeto").val(0);
//   } else {
//     // SUMAR TOTAL DE PRECIOS

//     sumarTotalPrecios();

//     // AGREGAR IMPUESTO

//     agregarImpuesto();

//     // AGRUPAR PRODUCTOS EN FORMATO JSON

//     listarProductos();
//   }
// });

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function () {
  $(this).closest(".row").remove();

  var idProducto = $(this).attr("idProducto");

  // Almacenar en el localStorage el ID del producto a quitar
  if (localStorage.getItem("quitarProducto") == null) {
    idQuitarProducto = [];
  } else {
    idQuitarProducto = JSON.parse(localStorage.getItem("quitarProducto"));
  }

  idQuitarProducto.push({ idProducto: idProducto });

  localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

  $("button[idProducto='" + idProducto + "']").removeClass("btn-default");
  $("button[idProducto='" + idProducto + "']").addClass(
    "btn-primary agregarProducto"
  );

  if ($(".nuevoProducto").children().length == 0) {
    $("#nuevoImpuestoVenta").val(0);
    $("#nuevoTotalVenta").val(0);
    $("#totalVenta").val(0);
    $("#nuevoTotalVenta").attr("total", 0);
    $("#nuevoPrecioNeto").val(0);
  } else {
    // SUMAR TOTAL DE PRECIOS
    sumarTotalPrecios();

    // AGREGAR IMPUESTO
    agregarImpuesto();

    // AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProductos();
  }
});

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevoProducto", function () {
  var nombreProducto = $(this).val();

  var nuevoProducto = $(this)
    .parent()
    .parent()
    .parent()
    .children()
    .children()
    .children(".nuevoProducto");

  var nuevoPrecioProducto = $(this)
    .parent()
    .parent()
    .parent()
    .children(".ingresoPrecio")
    .children()
    .children(".nuevoPrecioProducto");

  var nuevaCantidadProducto = $(this)
    .parent()
    .parent()
    .parent()
    .children(".ingresoCantidad")
    .children(".nuevaCantidadProducto");

  var datos = new FormData();

  datos.append("nombreProducto", nombreProducto);

  $.ajax({
    url: "ajax/productos.ajax.php",

    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $(nuevoProducto).attr("idProducto", respuesta["id"]);
      $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      $(nuevaCantidadProducto).attr(
        "nuevoStock",
        Number(respuesta["stock"]) - 1
      );
      $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
      $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductos();
    },
  });
});

$(".formularioVenta").on("input", "input.nuevaCantidadProducto", function () {
  var cantidad = parseInt($(this).val());
  var stock = parseInt($(this).attr("stock"));
  var precioInput = $(this)
    .parent()
    .parent()
    .children(".ingresoPrecio")
    .children()
    .children(".nuevoPrecioProducto");
  var precioReal = parseFloat(precioInput.attr("precioReal"));
  var precioFinal = cantidad * precioReal;
  var nuevoStock = stock - cantidad;

  if (cantidad > stock) {
    $(this).val(stock);
    nuevoStock = 0;
    precioFinal = stock * precioReal;
    Swal.fire({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay " + stock + " unidades!",
      icon: "error",
      confirmButtonText: "¡Cerrar!",
    });
  }

  precioInput.val(formatearNumero(precioFinal));
  $(this).attr("nuevoStock", nuevoStock);

  sumarTotalPrecios();
  agregarImpuesto();
  listarProductos();
});

function agregarImpuesto() {
  var impuesto = parseFloat($("#nuevoImpuestoVenta").val());
  var precioTotal = parseFloat($("#nuevoTotalVenta").attr("total"));
  var tasaBS = parseFloat($("#nuevoTasaBs").val());
  var precioTotalBS = precioTotal * tasaBS;
  var precioImpuesto = (precioTotalBS * impuesto) / 100;
  var totalConImpuesto = precioImpuesto + precioTotalBS;

  $("#nuevoTotalVenta").val(formatearNumero(precioTotal));
  $("#nuevoTotalVentaBS").val(formatearNumero(totalConImpuesto));
  $("#totalVenta").val(formatearNumero(precioTotal));
  $("#totalVentaBS").val(formatearNumero(totalConImpuesto));
  $("#nuevoPrecioImpuesto").val(formatearNumero(precioImpuesto));
  $("#nuevoPrecioNeto").val(formatearNumero(precioTotalBS));
}

function formatearNumero(numero) {
  return parseFloat(numero).toFixed(2);
}

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios() {
  var precioItem = $(".nuevoPrecioProducto");

  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
  }

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

  $("#nuevoTotalVenta").val(sumaTotalPrecio);
  $("#totalVenta").val(sumaTotalPrecio);
  $("#nuevoTotalVenta").attr("total", formatearNumero(sumaTotalPrecio));
}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto() {
  var impuesto = $("#nuevoImpuestoVenta").val();
  var precioTotal = $("#nuevoTotalVenta").attr("total");
  var tasaBS = $("#nuevoTasaBs").val();
  var precioTotalBS = Number(precioTotal * tasaBS);
  var precioImpuesto = Number((precioTotalBS * impuesto) / 100);
  var totalConImpuesto = Number(precioImpuesto) + Number(precioTotalBS);

  $("#nuevoTotalVenta").val(formatearNumero(precioTotal));

  $("#nuevoTotalVentaBS").val(formatearNumero(totalConImpuesto));

  $("#totalVenta").val(formatearNumero(precioTotal));

  $("#totalVentaBS").val(formatearNumero(totalConImpuesto));

  $("#nuevoPrecioImpuesto").val(formatearNumero(precioImpuesto));

  $("#nuevoPrecioNeto").val(formatearNumero(precioTotalBS));
}

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

function formatearNumero(numero) {
  return parseFloat(numero).toFixed(2);
}

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos() {
  var listaProductos = [];

  // var producto = $(".nuevaproductoProducto");
  var producto = $(".nuevoProductoSelect");

  var cantidad = $(".nuevaCantidadProducto");

  var precio = $(".nuevoPrecioProducto");

  for (var i = 0; i < producto.length; i++) {
    listaProductos.push({
      id: $(producto[i]).attr("idProducto"),
      producto: $(producto[i]).val(),
      cantidad: $(cantidad[i]).val(),
      stock: $(cantidad[i]).attr("nuevoStock"),
      precio: $(precio[i]).attr("precioReal"),
      total: $(precio[i]).val(),
    });
  }

  $("#listaProductos").val(JSON.stringify(listaProductos));
}

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto() {
  //Capturamos todos los id de productos que fueron elegidos en la venta

  var idProductos = $(".quitarProducto");

  //Capturamos todos los botones de agregar que aparecen en la tabla

  var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta

  for (var i = 0; i < idProductos.length; i++) {
    //Capturamos los Id de los productos agregados a la venta

    var boton = $(idProductos[i]).attr("idProducto");

    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar

    for (var j = 0; j < botonesTabla.length; j++) {
      if ($(botonesTabla[j]).attr("idProducto") == boton) {
        $(botonesTabla[j]).removeClass("btn-primary agregarProducto");

        $(botonesTabla[j]).addClass("btn-default");
      }
    }
  }
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$(".tablaVentas").on("draw.dt", function () {
  quitarAgregarProducto();
  formatearNumero($("#nuevoTotalVenta"));
});

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".DataTable").on("click", "#btnImprimirVenta", function () {
  var idVenta = $(this).attr("idVenta");

  window.open(
    `vistas/plugins/tcpdf/examples/factura.php?idVenta=${idVenta}`,
    "_blank"
  );
});
