<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes
{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	public $idCliente;

	public function ajaxEditarCliente()
	{

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);
	}

	
	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	public $idEliminarCliente;

	public function ajaxEliminarCliente()
	{

		$respuesta = ControladorClientes::ctrEliminarCliente();

		echo json_encode($respuesta);
	}

}

/*=============================================
EDITAR Clientes
=============================================*/
if (isset($_POST["idCliente"])) {

	$Editar = new AjaxClientes();
	$Editar->idCliente = $_POST["idCliente"];
	$Editar->ajaxEditarCliente();
}

/*=============================================
ELMINAR Clientes
=============================================*/
if (isset($_POST["idEliminarCliente"])) {

	$Eliminar = new AjaxClientes();
	$Eliminar->idEliminarCliente = $_POST["idEliminarCliente"];
	$Eliminar->ajaxEliminarCliente();
}
