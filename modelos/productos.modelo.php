<?php 

 require_once "conexion.php";

 class ModeloProductos{

 	/*=============================================
 	=            	MOSTRAR PRODUCTOS            =
 	=============================================*/

 	static public function mdlMostrarProductos($tabla, $item, $valor, $orden){

 		if($item != null){

 			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item = :$item ORDER BY id DESC");

 			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

 			$stmt -> execute();

 			return $stmt -> fetch();


 		}else{

 			$stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla ORDER BY $orden DESC");

 			$stmt -> execute();

 			return $stmt -> fetchAll();

 		}

 		$stmt -> close();

 		$stmt = null;
 	}


    /*=============================================
    =               REGISTRO DE  PRODUCTOS            =
    =============================================*/

    static public function mdlIngresarProducto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, descripcion, medida, unidad, stock, palets) VALUES (:codigo, :descripcion, :medida, :unidad, :stock, :palets)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":medida", $datos["medida"], PDO::PARAM_STR);       
        $stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":palets", $datos["palets"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return 'error';
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    =               EDITAR DE  PRODUCTOS            =
    =============================================*/

    static public function mdlEditarProducto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, medida = :medida, unidad = :unidad, stock = :stock, palets = :palets WHERE codigo = :codigo");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":medida", $datos["medida"], PDO::PARAM_STR);        
        $stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":palets", $datos["palets"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return 'error';
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    =               BORRAR   PRODUCTOS            =
    =============================================*/

    static public function mdlEliminarProducto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }

        $stmt -> close();

        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR PRODUCTO
    =============================================*/

    static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

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

     /*=============================================
    ACTUALIZAR PRODUCTO EXCEL  
    =============================================*/

 static public function mdlActualizarStockProductoM($tabla, $nuevoStock, $idProducto){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock WHERE id = :id");

        $stmt -> bindParam(":stock", $nuevoStock, PDO::PARAM_INT);
        $stmt -> bindParam(":id", $idProducto, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";
        
        }else{

            return "error"; 

        }

        $stmt -> close();

        $stmt = null;

    }






    /*=============================================
    =               MOSTRAR SUMA VENTAS            =
    =============================================*/

    static public function mdlMostrarSumaVentas($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetch();

            $stmt -> close();

            $stmt = null;

        }
  }