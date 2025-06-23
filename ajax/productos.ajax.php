<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos
{

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	public $idProducto;

	public function ajaxEditarProducto()
	{

		$item = "id";
		$valor = $this->idProducto;

		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

		echo json_encode($respuesta);
	}

	
	/*=============================================
	ELIMINAR PRODUCTO
	=============================================*/

	public $idEliminarProducto;

	public function ajaxEliminarProducto()
	{

		$respuesta = ControladorProductos::ctrEliminarProducto();

		echo json_encode($respuesta);
	}

}

/*=============================================
EDITAR PRODUCTOS
=============================================*/
if (isset($_POST["idProducto"])) {

	$Editar = new AjaxProductos();
	$Editar->idProducto = $_POST["idProducto"];
	$Editar->ajaxEditarProducto();
}

/*=============================================
ELMINAR PRODUCTOS
=============================================*/
if (isset($_POST["idEliminarProducto"])) {

	$Eliminar = new AjaxProductos();
	$Eliminar->idEliminarProducto = $_POST["idEliminarProducto"];
	$Eliminar->ajaxEliminarProducto();
}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

	$traerProductos = new AjaxProductos();
	$traerProductos -> traerProductos = $_POST["traerProductos"];
	$traerProductos -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreProducto"])){

	$traerProducto = new AjaxProductos();
	$traerProducto -> nombreProducto = $_POST["nombreProducto"];
	$traerProducto -> ajaxEditarProducto();

}
