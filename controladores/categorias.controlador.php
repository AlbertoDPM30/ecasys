<?php

class ControladorCategorias{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function ctrCrearCategoria(){

		if(isset($_POST["nuevoCategoria"])){

			   	$tabla = "categorias";

			   	$datos = array(	"categoria"=>$_POST["nuevoCategoria"],
								"descripcion"=>$_POST["nuevoDescripcion"]);

			   	$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

			   	if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
						icon: "success",
						title: "Nueva Categoría ingresada con éxito!",
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
						title: "¡Error al crear el nueva Categoría!",
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
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;

	}

}



