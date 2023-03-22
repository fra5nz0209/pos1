<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR VENTAS AGRUPADAS NUEVO CODIGO 
	=============================================*/

// 	static public function mdlMostrarVentasAgrupadasPorCarga($fechaInicial, $fechaFinal){
//    //Realizar la consulta a la base de datos para obtener las ventas y agruparlas según el rango de carga especificado
//    // ejemplo
//    $stmt = Conexion::conectar()->prepare("SELECT carga, SUM(cantidad) as cantidad, descripcion FROM ventas WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY carga ");
//     $stmt->execute();
//     return $stmt->fetchAll();
// }

	/*=============================================
	MOSTRAR VENTAS AGRUPADAS NUEVO CODIGO parte 2
	=============================================*/

 // static public  function mdlMostrarVentasAgrupadasPorFecha($tabla, $fechaInicial, $fechaFinal)
 //    {
 //        $stmt = Conexion::conectar()->prepare("SELECT carga, descripcion, SUM(cantidad) as cantidad 
 //                                                            FROM $tabla 
 //                                                            WHERE fechaventa BETWEEN '$fechaInicial' and '$fechaFinal'
 //                                                            GROUP BY carga;");
 //        $stmt -> execute();
 //        return $stmt -> fetchAll();
 //        $stmt -> close();
 //        $stmt = null;
 //    }


	/*=============================================
	ACTUALIZAR ESTADO VENTA NUEVO CODIGO 
	=============================================*/
	public static function mdlActualizarVenta($tabla, $item1, $valor1, $item2, $valor2){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{


			return "error";
		}

		$stmt -> close();
		$stmt = null;
		}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, fechaventa, id_cliente, carga, id_vendedor, productos, total) VALUES (:codigo, :fechaventa, :id_cliente, :carga, :id_vendedor, :productos, :total)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaventa", $datos["fechaventa"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":carga", $datos["carga"], PDO::PARAM_STR);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  fechaventa = :fechaventa, id_cliente = :id_cliente, carga = :carga, id_vendedor = :id_vendedor, productos = :productos, total= :total WHERE codigo = :codigo");



		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaventa", $datos["fechaventa"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":carga", $datos["carga"], PDO::PARAM_STR);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

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
	RANGO FECHAS     NUEVO CODIGO NUEVA OPCION 
	=============================================*/	


    static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal, $idVendedor){

        if($fechaInicial == null){

            if($idVendedor == null){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fechaventa ASC");
                $stmt -> execute();
                return $stmt -> fetchAll();
            }else{
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_vendedor = :idVendedor ORDER BY fechaventa ASC");
                $stmt -> bindParam(":id_vendedor", $idVendedor, PDO::PARAM_INT);
                $stmt -> execute();
                return $stmt -> fetchAll();
            }

        }else{

            if($idVendedor == null){
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaventa BETWEEN :fechaInicial AND :fechaFinal");
                $stmt -> bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
                $stmt -> bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
                $stmt -> execute();
                return $stmt -> fetchAll();
            }else{
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaventa BETWEEN :fechaInicial AND :fechaFinal AND id_vendedor = :idVendedor");
                $stmt -> bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
                $stmt -> bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
                $stmt -> bindParam(":idVendedor", $idVendedor, PDO::PARAM_INT);
                $stmt -> execute();
                return $stmt -> fetchAll();
            }

        }

    

}

		/*=============================================
		MODELO PARA SUMAR LAS CANTIDADES TOTALES DE LAS FACTURAS DE ACUERDO A LA FECHA Y EL VENDEDOR 
		=============================================*/	

		public static function mdlSumarTotalVentas($tabla, $fechaInicial, $fechaFinal, $idVendedor) {
		$query = "SELECT SUM(total) as total FROM $tabla WHERE fechaventa BETWEEN '$fechaInicial' AND '$fechaFinal' AND estado IN ('activa', 'pendiente')";
		if ($idVendedor != null) {
		$query .= " AND id_vendedor = '$idVendedor'";
		}

		$stmt = Conexion::conectar()->prepare($query);
		  $stmt->execute();

		  return $stmt->fetch();
		}





	// 	public static function mdlSumarTotalVentas($tabla, $fechaInicial, $fechaFinal, $idVendedor) {
	//   $query = "SELECT SUM(total) as total FROM $tabla WHERE fechaventa BETWEEN '$fechaInicial' AND '$fechaFinal'";
	//   if ($idVendedor != null) {
	//     $query .= " AND id_vendedor = '$idVendedor'";
	//   }

	//   $stmt = Conexion::conectar()->prepare($query);
	//   $stmt->execute();

	//   return $stmt->fetch();
	// }

	/*=============================================
	MODELO PARA SUMAR DE ACUERDO AL ESTADO DE LA CUENTA  
	=============================================*/	

			// public static function mdlSumarVentasPorCuentas($tabla, $fechaInicio = null, $fechaFin = null, $idVendedor = null) {
			//   $sentencia = "SELECT cuentas, SUM(total) as total FROM $tabla";

			//   if ($fechaInicio && $fechaFin) {
			//     $sentencia .= " WHERE fechaventa BETWEEN '$fechaInicio' AND '$fechaFin'";
			//   }

			//   if ($idVendedor) {
			//     $sentencia .= " AND id_vendedor = '$idVendedor'";
			//   }

			//   $sentencia .= " GROUP BY cuentas";

			//   $stmt = Conexion::conectar()->prepare($sentencia);

			//   $stmt->execute();

			//   return $stmt->fetchAll();
			// }

// 	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

//     if($fechaInicial == null){

//         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
//         $stmt -> execute();
//         return $stmt -> fetchAll();

//     }else if($fechaInicial == $fechaFinal){

//         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");
//     var_dump($fechaInicial);
//     var_dump($fechaFinal);
//         $stmt->bindParam(':fecha', $fechaFinal, PDO::PARAM_STR);
//                 var_dump($stmt);
//         $stmt->execute(); 
//          var_dump($stmt);
//         return $stmt -> fetchAll();

//     }else{

//     	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '%$fechaInicial%' AND '%$fechaFinal%'");
//  var_dump($fechaInicial);
//     var_dump($fechaFinal);

//     	$stmt->execute();
//     	var_dump($stmt);
//         return $stmt -> fetchAll();

//     }
// }


	/*=============================================
	CARGAR VENTAS PDF
	=============================================*/	

	static public function mdlIngresarFactura($tabla, $datos){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo, fechaventa, id_cliente, carga, id_vendedor, productos, total) VALUES (:codigo, :fechaventa, :id_cliente, :carga, :id_vendedor, :productos, :total)");
    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
    $stmt->bindParam(":fechaventa", $datos["fechaventa"], PDO::PARAM_STR);
    $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
    $stmt->bindParam(":carga", $datos["carga"], PDO::PARAM_INT);
    $stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
    $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
    $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

    if($stmt->execute()){
        return "ok";
    } else {
        return "error";
    }
    $stmt->close();
    $stmt = null;
}



	/*=============================================
	ACTUALIZAR  STOCK DE ACUERDO AL ESTADO DE VENTA 
	=============================================*/

	public static function mdlActualizarStockProducto($tabla, $item1, $valor1, $item2, $valor2){
  	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

	$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);
	$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_INT);

	if($stmt->execute()){
	return "ok";
	} else {
	return "error";
	}

	$stmt->close();
	$stmt = null;
	}


	/*=============================================
	VENTAS AGRUPADAS
	=============================================*/

	 public static function mdlMostrarVentasAgrupadas() {
        $medidas = array();
        $query = "SELECT productos.medida, ventas.descripcion, SUM(ventas.cantidad) AS cantidad
                  FROM ventas
                  INNER JOIN productos ON ventas.id_producto = productos.id
                  GROUP BY productos.medida, ventas.descripcion";
        $stmt = Conexion::conectar()->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $medidas[] = $row;
        }
        return $medidas;
    }


}
