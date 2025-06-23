<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	CREAR PRODUCTOS
	=============================================*/

	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO 		$tabla	(producto,
																		id_categoria,
																		id_proveedor,
																		stock,
																		precio_compra,
																		precio_venta)
																VALUES 	(:producto,
																		:id_categoria,
																		:id_proveedor,
																		:stock,
																		:precio_compra,
																		:precio_venta)");

		$stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";	

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRDUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $tabla2, $tabla3, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT a.id, a.producto, a.id_categoria, b.categoria, a.id_proveedor, c.proveedor, a.stock, a.precio_compra, a.precio_venta FROM $tabla as a LEFT JOIN $tabla2 as b ON a.id_categoria = b.id LEFT JOIN $tabla3 as c ON a.id_proveedor = c.id WHERE a.$item = :$item ORDER BY a.id DESC");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT a.id, a.producto, a.id_categoria, b.categoria, a.id_proveedor, c.proveedor, a.stock, a.precio_compra, a.precio_venta FROM $tabla as a LEFT JOIN $tabla2 as b ON a.id_categoria = b.id LEFT JOIN $tabla3 as c ON a.id_proveedor = c.id ORDER BY a.id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 	SET 	producto 		= :producto,
																		id_categoria	= :id_categoria,
																		stock 			= :stock,
																		precio_compra 	= :precio_compra,
																		precio_venta 	= :precio_venta
																WHERE 	id 				= :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";		

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return true;
		
		}else{

			return false;	

		}

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR CANTIDAD PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item, $valor, $nuevaCantidad){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = $nuevaCantidad WHERE $item = :$item");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";		

		}

		$stmt->close();
		$stmt = null;

	}

}	