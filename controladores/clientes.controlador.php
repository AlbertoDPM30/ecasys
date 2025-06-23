<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoNombres"])){

			   	$tabla = "clientes";

			   	$datos = array(	"nombres"=>$_POST["nuevoNombres"],
								"apellidos"=>$_POST["nuevoApellidos"],
								"cedula"=>$_POST["nuevoCedula"]);

			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
						icon: "success",
						title: "Nuevo Cliente ingresado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "clientes";
						}
					});

				</script>';

			}else{

				echo '<script>

					Swal.fire({
						icon: "error",
						title: "¡Error al crear el nuevo Cliente!",
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "clientes";
						}
					});

				</script>';
			}

		}

	}

	/*=============================================
	CREAR CLIENTE DESDE VENTAS
	=============================================*/

	static public function ctrCrearClienteVenta(){

		if(isset($_POST["nuevoNombres"])){

			   	$tabla = "clientes";

			   	$datos = array(	"nombres"=>$_POST["nuevoNombres"],
								"apellidos"=>$_POST["nuevoApellidos"],
								"cedula"=>$_POST["nuevoCedula"]);

			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
						icon: "success",
						title: "Nuevo Cliente ingresado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "crear-venta";
						}
					});

				</script>';

			}else{

				echo '<script>

					Swal.fire({
						icon: "error",
						title: "¡Error al crear el nuevo Cliente!",
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "crear-venta";
						}
					});

				</script>';
			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTES
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["idCliente"])){

			$tabla = "clientes";

			$datos = array(	"id"=>$_POST["idCliente"],
							"nombres"=>$_POST["editarNombres"],
							"apellidos"=>$_POST["editarApellidos"],
							"cedula"=>$_POST["editarCedula"]);

			$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>

					Swal.fire({
						icon: "success",
						title: "Cliente guardado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "clientes";
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
							window.location = "clientes";
						}
					});

				</script>';
			}

		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_POST["idEliminarCliente"])){

			$tabla ="clientes";
			$datos = $_POST["idEliminarCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			return $respuesta;
		}

	}

}



