<?php

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		if(isset($_POST["totalVenta"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

					echo'<script>

				swal({
					  type: "error",
					  title: "La venta no se ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "crear-venta";

								}
							})

				</script>';

				return;
			}


			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);

				$tablaProductos = "productos";
				$tablaCategorias = "categorias";
				$tablaProveedores = "proveedores";

				$item = "id";
				$valor = $value["id"];

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $tablaCategorias, $tablaProveedores, $item, $valor);

				if ($traerProducto) {

					$nuevaCantidad = intval($traerProducto["stock"]) - intval($value["cantidad"]);

					if ($nuevaCantidad >= 0) { 

						$actualizarStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item, $valor, $nuevaCantidad);

						if ($actualizarStock != "ok") {
							die('Error al actualizar el stock del producto con ID ' . $value["id"]);
						}
					} else {
						die('Stock insuficiente para el producto con ID ' . $value["id"]);
					}
				} else {
					die('El producto con ID ' . $value["id"] . ' no fue encontrado en la base de datos.');
				}

			}

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";

			$datos = array(	"id_usuario"=>$_SESSION["id"],
							"id_cliente"=>$_POST["seleccionarCliente"],
							"productos_vendidos"=>$_POST["listaProductos"],
							"total"=>$_POST["totalVenta"],
							"total_bs"=>$_POST["totalVentaBS"]);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){

				$idVenta = ModeloVentas::mdlObtenerUltimaVenta();

				if($idVenta) {

					echo '<script>

					Swal.fire({
						icon: "success",
						title: "venta realizada con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.open("vistas/plugins/tcpdf/examples/factura.php?idVenta='.$idVenta.'", "_blank");
							window.location = "crear-venta";
						}
					});

				</script>';

				}

			}else{

				echo '<script>

					Swal.fire({
						icon: "error",
						title: "¡Error generar la venta, revise todos los campos!",
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location.close;
						}
					});

				</script>';
			}

		}

	}

	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	static public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

}