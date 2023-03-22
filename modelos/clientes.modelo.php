<?php

require_once "conexion.php";

class ModeloClientes{

	/*=============================================
	=            CREAR CLIENTES                   =
	=============================================*/


	static public function mdlIngresarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, nombre, direccion, referencia, celular, nit) VALUES (:codigo, :nombre, :direccion, :referencia, :celular, :nit)");


		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":referencia", $datos["referencia"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}


		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	=            MOSTRAR CLIENTES                   =
	=============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor){

			if($item != null){

				$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item = :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();


			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

				$stmt -> execute();

				return $stmt -> fetchAll();

			}

			$stmt -> close();

			$stmt = null;

	}

	/*=============================================
	=            EDITAR CLIENTES                   =
	=============================================*/


	static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, nombre = :nombre, direccion = :direccion, referencia = :referencia, celular = :celular, nit = :nit WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":referencia", $datos["referencia"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}


		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	=            ELIMINAR CLIENTES                =
	=============================================*/


	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);
	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}


		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



}
