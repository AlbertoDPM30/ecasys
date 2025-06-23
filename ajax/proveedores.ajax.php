<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class AjaxProveedores
{

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	public $idProveedor;

	public function ajaxEditarProveedor()
	{

		$item = "id";
		$valor = $this->idProveedor;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);
	}

	
	/*=============================================
	ELIMINAR PROVEEDOR
	=============================================*/

	public $idEliminarProveedor;

	public function ajaxEliminarProveedor()
	{

		$respuesta = ControladorProveedores::ctrEliminarProveedor();

		echo json_encode($respuesta);
	}

}

/*=============================================
EDITAR PROVEEDOR
=============================================*/
if (isset($_POST["idProveedor"])) {

	$Editar = new AjaxProveedores();
	$Editar->idProveedor = $_POST["idProveedor"];
	$Editar->ajaxEditarProveedor();
}

/*=============================================
ELMINAR PROVEEDOR
=============================================*/
if (isset($_POST["idEliminarProveedor"])) {

	$Eliminar = new AjaxProveedores();
	$Eliminar->idEliminarProveedor = $_POST["idEliminarProveedor"];
	$Eliminar->ajaxEliminarProveedor();
}
