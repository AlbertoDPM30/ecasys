<?php

class ControladorProductos{

	/*=============================================
	CREAR PRODUCTOS
	=============================================*/

	static public function ctrCrearProducto(){

		if(isset($_POST["nuevoProducto"])){

			$tabla = "productos";

			$datos = array(	"producto"=>$_POST["nuevoProducto"],
							"id_categoria"=>$_POST["nuevoIDCategoria"],
							"id_proveedor"=>$_POST["nuevoIDProveedor"],
							"stock"=>$_POST["nuevoStock"],
							"precio_compra"=>number_format($_POST["nuevoPrecioCompra"], 2),
							"precio_venta"=>number_format($_POST["nuevoPrecioVenta"], 2));

			$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>

					Swal.fire({
						icon: "success",
						title: "Nuevo producto ingresado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "productos";
						}
					});

				</script>';

			}else{

				echo '<script>

					Swal.fire({
						icon: "error",
						title: "¡Error al crear el nuevo producto!",
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "productos";
						}
					});

				</script>';
			}

		}

	}

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor){

		$tabla = "productos";
		$tabla2 = "categorias";
		$tabla3 = "proveedores";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $tabla2, $tabla3, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto(){

		if(isset($_POST["idProducto"])){

			$tabla = "productos";

			$datos = array(	"id"=>$_POST["idProducto"],
							"producto"=>$_POST["editarProducto"],
							"id_categoria"=>$_POST["editarIDCategoria"],
							"id_proveedor"=>$_POST["editarIDProveedor"],
							"stock"=>$_POST["editarStock"],
							"precio_compra"=>$_POST["editarPrecioCompra"],
							"precio_venta"=>$_POST["editarPrecioVenta"]);

			$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>

					Swal.fire({
						icon: "success",
						title: "Producto guardado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "productos";
						}
					});

				</script>';

			}else{

				echo '<script>

					Swal.fire({
						icon: "error",
						title: "¡Error al guardar!",
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "productos";
						}
					});

				</script>';
			}

		}

	}

	/*=============================================
	ELIMINAR PRODUCTO
	=============================================*/

	static public function ctrEliminarProducto(){

		if(isset($_POST["idEliminarProducto"])){

			$tabla ="productos";
			$datos = $_POST["idEliminarProducto"];

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			return $respuesta;
		}

	}

}



