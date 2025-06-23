<?php

class ControladorProveedores{

	/*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function ctrCrearProveedor(){

		if(isset($_POST["nuevoProveedor"])){

			   	$tabla = "proveedores";

			   	$datos = array(	"proveedor"=>$_POST["nuevoProveedor"],
								"telefono"=>$_POST["nuevoTelefono"]);

			   	$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
						icon: "success",
						title: "Nuevo Proveedor ingresado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "proveedores";
						}
					});

				</script>';

			}else{

				echo '<script>

					Swal.fire({
						icon: "error",
						title: "¡Error al crear el nuevo Proveedor!",
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "proveedores";
						}
					});

				</script>';
			}

		}

	}

	/*=============================================
	CREAR PROVEEDOR DESDE PRODUCTOS
	=============================================*/

	static public function ctrCrearProveedorProductos(){

		if(isset($_POST["nuevoProveedor"])){

			   	$tabla = "proveedores";

			   	$datos = array(	"proveedor"=>$_POST["nuevoProveedor"],
								"telefono"=>$_POST["nuevoTelefono"]);

			   	$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
						icon: "success",
						title: "Nuevo Proveedor ingresado con éxito!",
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
						title: "¡Error al crear el nuevo Proveedor!",
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
	CREAR PROVEEDOR
	=============================================*/

	static public function ctrCrearProveedorVenta(){

		if(isset($_POST["nuevoProveedor"])){

			   	$tabla = "proveedores";

			   	$datos = array(	"proveedor"=>$_POST["nuevoProveedor"],
								"telefono"=>$_POST["nuevoTelefono"]);

			   	$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);

			   	if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
						icon: "success",
						title: "Nuevo Proveedor ingresado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "ventas";
						}
					});

				</script>';

			}else{

				echo '<script>

					Swal.fire({
						icon: "error",
						title: "¡Error al crear el nuevo Proveedor!",
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "ventas";
						}
					});

				</script>';
			}

		}

	}

	/*=============================================
	MOSTRAR PROVEEDOR
	=============================================*/

	static public function ctrMostrarProveedores($item, $valor){

		$tabla = "proveedores";

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function ctrEditarProveedor(){

		if(isset($_POST["idProveedor"])){

			$tabla = "proveedores";

			$datos = array(	"id"=>$_POST["idProveedor"],
							"proveedor"=>$_POST["editarProveedor"],
							"telefono"=>$_POST["editarTelefono"]);

			$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>

					Swal.fire({
						icon: "success",
						title: "Proveedor guardado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "proveedores";
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
							window.location = "proveedores";
						}
					});

				</script>';
			}

		}

	}

	/*=============================================
	ELIMINAR PROVEEDOR
	=============================================*/

	static public function ctrEliminarProveedor(){

		if(isset($_POST["idEliminarProveedor"])){

			$tabla ="proveedores";
			$datos = $_POST["idEliminarProveedor"];

			$respuesta = ModeloProveedores::mdlEliminarProveedor($tabla, $datos);

			return $respuesta;
		}

	}

}



