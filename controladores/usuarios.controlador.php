<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario()
	{

		if (isset($_POST["ingUsuario"])) {

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])) {

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if (is_array($respuesta) && $respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {

					session_start();

					$_SESSION["iniciarSesion"] = "ok";
					$_SESSION["id"] = $respuesta["id"];
					$_SESSION["nombres"] = $respuesta["nombres"];
					$_SESSION["usuario"] = $respuesta["usuario"];
					$_SESSION["perfil"] = $respuesta["id_rol"];

					/*=============================================
					REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
					=============================================*/

					date_default_timezone_set('America/Caracas');

					$fecha = date('Y-m-d');
					$hora = date('H:i:s');

					$fechaActual = $fecha . ' ' . $hora;

					$item1 = "ultimo_login";
					$valor1 = $fechaActual;

					$item2 = "id";
					$valor2 = $respuesta["id"];

					$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

					if ($ultimoLogin == "ok") {
						

						return header("Location: inicio");
					}
					
				} else {

					$_SESSION["iniciarSesion"] = null;
					$_SESSION["id"] = null;
					$_SESSION["nombres"] = null;
					$_SESSION["usuario"] = null;
					$_SESSION["perfil"] = null;
					
					echo '<br><div class="alert alert-danger position-absolute bottom-0">Error al ingresar, vuelve a intentarlo</div>';
					session_abort();
				}
			}
		}
	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario()
	{

		if (isset($_POST["nuevoUsuario"])) {

			$tabla = "usuarios";
			
			$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$datos = array(
				"nombres" => trim($_POST["nuevoNombres"]),
				"usuario" => strtolower(trim($_POST["nuevoUsuario"])),
				"email" => strtolower(trim($_POST["nuevoEmail"])),
				"password" => $encriptar,
				"id_rol" => trim($_POST["nuevoRolUsuario"]));

			$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					Swal.fire({
						icon: "success",
						title: "Nuevo Usuario ingresado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "usuarios";
						}
					});
				

					</script>';
			} else {

				echo '<script>

					Swal.fire({
						icon: "error",
						title: "¡Error al crear el nuevo Usuario!",
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "usuarios";
						}
					});
				

					</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario()
	{

		if (isset($_POST["editarUsuario"])) {

			$tabla = "usuarios";

			if ($_POST["editarPassword"] != "") {

				$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			} else {

				
				$encriptar = $_POST["passwordActual"];
			}

			$datos = array(
				"id" => $_POST["idUsuario"],
				"nombres" => $_POST["editarNombres"],
				"usuario" => strtolower($_POST["editarUsuario"]),
				"email" => strtolower($_POST["editarEmail"]),
				"password" => $encriptar,
				"id_rol" => $_POST["editarRoles"]
			);

			$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					Swal.fire({
						icon: "success",
						title: "usuario editado con éxito!",
						timer: 1500,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "usuarios";
						}
					});

					</script>';
			} else {

				echo '<script>

					Swal.fire({
						icon: "error",
						title: "¡Error al Editar el usuario!",
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading();
						}
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							window.location = "usuarios";
						}
					});

				</script>';
			}
		}
	}

	/*=============================================
	ELIMINAR USUARIO
	=============================================*/

	static public function ctrEliminarUsuario(){

		if(isset($_POST["idEliminarUsuario"])){

			$tabla ="usuarios";
			$datos = $_POST["idEliminarUsuario"];

			$respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla, $datos);

			return $respuesta;
		}

	}

}
