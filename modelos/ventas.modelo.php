<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT v.id, c.nombres AS nombreCliente, c.apellidos AS apellidoCliente, c.cedula AS cedulaCliente, u.nombres AS vendedor, v.productos_vendidos, v.total, v.total_bs, v.fecha FROM $tabla AS v LEFT JOIN clientes AS C ON c.id = v.id_cliente LEFT JOIN usuarios AS u ON u.id = v.id_usuario WHERE v.$item = :$item ORDER BY v.id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT v.id, c.nombres AS nombreCliente, c.apellidos AS apellidoCliente, c.cedula AS cedulaCliente, u.nombres AS vendedor, v.total, v.total_bs, v.fecha FROM $tabla AS v LEFT JOIN clientes AS C ON c.id = v.id_cliente LEFT JOIN usuarios AS u ON u.id = v.id_usuario ORDER BY v.id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	OBTENER ULTIMA VENTA
	=============================================*/

	static public function mdlObtenerUltimaVenta() {

		$stmt = Conexion::conectar()->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1");

		$stmt->execute();
		
		return $stmt->fetch()["id"];
	}
	
	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO 		$tabla	(id_cliente, 
																		id_usuario, 
																		productos_vendidos, 
																		total,
																		total_bs) 
																VALUES 	(:id_cliente, 
																		:id_usuario, 
																		:productos_vendidos, 
																		:total,
																		:total_bs)");

		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":productos_vendidos", $datos["productos_vendidos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":total_bs", $datos["total_bs"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	
}