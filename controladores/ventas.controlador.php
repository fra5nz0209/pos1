<?php


class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR ESTADO VENTA
	=============================================*/

	static public function ctrActualizarVenta($datos){

		$tabla = "ventas";
		$item1 = "estado";
		$valor1 = $datos["estado"];

		$item2 = "id";
		$valor2 = $datos["id"];
		
		$respuesta = ModeloVentas::mdlActualizarVenta($tabla, $item1, $valor1, $item2, $valor2);

		
		if($respuesta == "ok"){

			if($valor1 == "anulada"){

				$tabla = "ventas";
				$item = "id";
				$valor = $datos["id"];
				$orden = "id";

				$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor, $orden);
				//Obtener los productos vendidos en la venta
				$productos = json_decode($traerVenta["productos"], true);

				

				foreach ($productos as $key => $value) {
					//Actualizar el stock en la tabla de productos
					$tablaProductos = "productos";
					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$producto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$nuevoStock = $producto["stock"] + $value["cantidad"];

					$item1 = "stock";
					$valor3 = $nuevoStock;

					$actualizarStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor3, $item, $valor);
				}

			}elseif($valor1 == "activa" || $valor1 == "pendiente"){
				//Obtener los productos vendidos en la venta

				$tabla = "ventas";
				$item = "id";
				$valor = $datos["id"];


				$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);


				$productos = json_decode($traerVenta["productos"], true);

				foreach ($productos as $key => $value) {
					//Actualizar el stock en la tabla de productos
					$tablaProductos = "productos";
					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$producto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$nuevoStock = $producto["stock"] - $value["cantidad"];

					$item1 = "stock";
					$valor3 = $nuevoStock;

					$actualizarStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor3, $item, $valor);
					}
			}
		}
		return $respuesta;


	}



	/*=============================================
	ACTUALIZAR ESTADO VENTA CUENTA 
	=============================================*/




		public static function ctrActualizarCuenta($tabla, $item, $valor, $id){

	    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

	    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	    $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

	    if($stmt->execute()){

	        return "ok";

	    }else{

	        return "error";

	    }

	    $stmt->close();

	    $stmt = null;

	}



	// static public function ctrActualizarVenta($datos){

	// 	$tabla = "ventas";
	// 	$item1 = "estado";
	// 	$valor1 = $datos["estado"];
	// 	$item2 = "id";
	// 	$valor2 = $datos["id"];

	// 	$respuesta = ModeloVentas::mdlActualizarVenta($tabla, $item1, $valor1, $item2, $valor2);

	// 	if($respuesta == "ok"){
	// 		if($valor1 == "anulada"){
	// 			//Obtener los productos vendidos en la venta
	// 			$productos = json_decode($datos["productos"], true);

	// 			foreach ($productos as $key => $value) {
	// 				//Actualizar el stock en la tabla de productos
	// 				$tablaProductos = "productos";
	// 				$item = "id";
	// 				$valor = $value["id"];
	// 				$orden = "id";

	// 				$producto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

	// 				$nuevoStock = $producto["stock"] + $value["cantidad"];

	// 				$item1 = "stock";
	// 				$valor1 = $nuevoStock;

	// 				$actualizarStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item, $valor);
	// 			}
	// 		}elseif($valor1 == "activa" || $valor1 == "pendiente"){
	// 			//Obtener los productos vendidos en la venta
	// 			$productos = json_decode($datos["productos"], true);

	// 			foreach ($productos as $key => $value) {
	// 				//Actualizar el stock en la tabla de productos
	// 				$tablaProductos = "productos";
	// 				$item = "id";
	// 				$valor = $value["id"];
	// 				$orden = "id";

	// 				$producto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

	// 				$nuevoStock = $producto["stock"] - $value["cantidad"];

	// 				$item1 = "stock";
	// 				$valor1 = $nuevoStock;

	// 				$actualizarStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item, $valor);
	// 				}
	// 		}
	// 	}
	// 	return $respuesta;
	// }



	/*=============================================
	MOSTRAR VENTAS AGRUPADAS NUEVO CODIGO 
	=============================================*/

	// static public function ctrMostrarVentasAgrupadasPorCarga($fechaInicial, $fechaFinal){
	// 	   // Realizar la consulta a la base de datos para obtener las ventas y agruparlas según el rango de carga especificado
	// 	   // Ejemplo: 
	// 	    $respuesta = ModeloVentas::mdlMostrarVentasAgrupadasPorCarga($fechaInicial, $fechaFinal);
	// 	    return $respuesta;
	// 	}

		/*=============================================
	MOSTRAR VENTAS AGRUPADAS NUEVO CODIGO parte 2 
	=============================================*/

//     static public function ctrMostrarVentasAgrupadasPorFecha(){
//          if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {
//             if (validarFecha($_GET["fechaInicial"]) && validarFecha($_GET["fechaFinal"])) {
//                 $tabla = "ventas";
//                 $respuesta = ModeloVentas::mdlMostrarVentasAgrupadasPorFecha($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

//                 if (!empty($respuesta)){
//     return $respuesta;
//   } else{
//     echo 'No se encontraron ventas en el rango de fechas seleccionado';
//   }
//                 return $respuesta;
//             }else {
//                 echo 'Ingrese un rango de fechas valido.';
//             }
//         }else {
//             echo 'Ingrese un rango de fechas.';
//         }
//     }

// function validarFecha($fecha){
//     $regex = '/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/';
//     return preg_match($regex, $fecha);
// }
	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			date_default_timezone_set('America/La_Paz');

		  	$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";

			$datos = array("codigo"=>$_POST["nuevaVenta"],
						   "fechaventa"=>$_POST["nuevaFecha"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "carga"=>$_POST["nuevaCarga"],
						   "id_vendedor"=>$_POST["nuevoVendedor"],
						   "productos"=>$_POST["listaProductos"],
						   "total"=>$_POST["totalVenta"],
						   );

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];
			$orden = "id";

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor, $orden);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					// $item1a = "ventas";
					// $valor1a = $traerProducto["ventas"] - $value["cantidad"];

					// $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "clientes";

				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);
 
				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

					// $item1a_2 = "ventas";
					// $valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					// $nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $value["stock"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/La_Paz');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("codigo"=>$_POST["editarVenta"],
						   "fechaventa"=>$_POST["editarFecha"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "carga"=>$_POST["editarCarga"],
						   "id_vendedor"=>$_POST["nuevoVendedor"],		   
						   "productos"=>$listaProductos,						   						   
						   "total"=>$_POST["totalVenta"],
						   );



			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				// $item1a = "ventas";
				// $valor1a = $traerProducto["ventas"] - $value["cantidad"];

				// $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
		}

	}

	/*=============================================
	RANGO FECHAS NUEVO CODIGO LA PRIMERA SECCION 
	=============================================*/

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal, $idVendedor){

	$tabla = "ventas";

        $respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal, $idVendedor);

        return $respuesta;

    }

// 	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

//     $tabla = "ventas";

//     $respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

//     return $respuesta;

// }



    /*=============================================
	REPORTE SUMA TOTAL DE PRODUCTOS VENDIDOS DE ACUERDO A LA FECHA Y VENDEDOR 
	=============================================*/
		public static function ctrSumarTotalVentas($fechaInicial = null, $fechaFinal = null, $idVendedor = null) {

			  $tabla = "ventas";

			  if ($fechaInicial == null && $fechaFinal == null && $idVendedor == null) {
			    return 0;
			  }

			  $respuesta = ModeloVentas::mdlSumarTotalVentas($tabla, $fechaInicial, $fechaFinal, $idVendedor);

			  return $respuesta;

			}

	 /*=============================================
	REPORTE SUMA TOTAL DE cantidades PRODUCTOS VENDIDOS DE ACUERDO A LA FECHA Y VENDEDOR  
	=============================================*/

	 public static function ctrSumarProductosVendidos($fechaInicial, $fechaFinal, $idVendedor){

    $tabla = "ventas";

    if($idVendedor != null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaventa >= '$fechaInicial' AND fechaventa <= '$fechaFinal' AND id_vendedor = '$idVendedor'");

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaventa >= '$fechaInicial' AND fechaventa <= '$fechaFinal'");

    }

    $stmt -> execute();

    $ventas = $stmt -> fetchAll();

    $totalProductos = 0;

    foreach ($ventas as $venta) {
      if ($venta["estado"] == "activa" || $venta["estado"] == "pendiente") {
        $detalles = json_decode($venta["productos"], true);
        foreach ($detalles as $detalle) {
          $totalProductos += $detalle["cantidad"];
        }
      }
    }

    return $totalProductos;
  }

// 	public static function ctrSumarProductosVendidos($fechaInicial, $fechaFinal, $idVendedor){

  //   $tabla = "ventas";

  //   if($idVendedor != null){

  //     $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaventa >= '$fechaInicial' AND fechaventa <= '$fechaFinal' AND id_vendedor = '$idVendedor'");

  //   }else{

  //     $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaventa >= '$fechaInicial' AND fechaventa <= '$fechaFinal'");

  //   }

  //   $stmt -> execute();

  //   $ventas = $stmt -> fetchAll();

  //   $totalProductos = 0;

  //   foreach ($ventas as $venta) {
  //     $detalles = json_decode($venta["productos"], true);
  //     foreach ($detalles as $detalle) {
  //       $totalProductos += $detalle["cantidad"];
  //     }
  //   }

  //   return $totalProductos;
  // }


  	 /*=============================================
	REPORTE SUMA DE ACUERDO AL ESTADO CUENTAS
	=============================================*/


	public static function ctrSumarVentasPorCuentas($fechaInicial = null, $fechaFinal = null, $idVendedor = null) {
    
    if ($fechaInicial == null && $fechaFinal == null && $idVendedor == null) {
			    return 0;
			  }
    $sql = "SELECT cuentas, SUM(total) as total FROM ventas WHERE";
    if ($fechaInicial && $fechaFinal) {
      $sql .= " fechaventa BETWEEN '$fechaInicial' AND '$fechaFinal'";
    }
    if ($idVendedor) {
      $sql .= " AND id_vendedor = '$idVendedor'";
    }
    $sql .= " GROUP BY cuentas";
    
    $stmt = Conexion::conectar()->prepare($sql);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_GROUP);
  }


	// 	public static function ctrSumarVentasPorCuentas($fechaInicial, $fechaFinal, $idVendedor){
	//     $tabla = "ventas";
	//     $respuesta = ModeloVentas::mdlSumarVentasPorCuentas($tabla, $fechaInicial, $fechaFinal, $idVendedor);
	//     return $respuesta;
	// }





	/*=============================================
	DESCARGAR EXCEL 
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){
			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);



			}else{

				$item = null;
				$valor = null;
				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);


			}

				/*=============================================
				CREAR ARCHIVO  EXCEL 
				=============================================*/

				$Name = $_GET["reporte"].'.xls';

				header('Expires: 0');
				header('Cache-control: private');
				header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
				header("Cache-Control: cache, must-revalidate"); 
				header('Content-Description: File Transfer');
				header('Last-Modified: '.date('D, d M Y H:i:s'));
				header("Pragma: public"); 
				header('Content-Disposition:; filename="'.$Name.'"');
				header("Content-Transfer-Encoding: binary");

				echo utf8_decode("<table border='0'>


					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CODIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>			
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>		
					</tr>");

				foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		$formatted_number = $item["total"];
				$formatted_number = str_replace('.', ',', $formatted_number);

		 		echo utf8_decode("</td>	
					<td style='border:1px solid #eee;'>".$formatted_number."</td>
					<td style='border:1px solid #eee;'>".$item["fechaventa"]."</td>
					<td style='border:1px solid #eee;'>".$item["estado"]."</td		
		 			</tr>");


			}
				
				echo "</table>";


		}

	}









	/*=============================================
	CARGAR VENTA PDF 
	=============================================*/

	// 	static public function ctrProcesarFactura(){
	//     if(isset($_FILES["factura"])){
	//         $file = $_FILES["factura"];
	//         $filename = $file["name"];
	//         $mimetype = $file["type"];

	// 	         if($mimetype == "application/pdf"){
	//         $pdf = new \Spatie\PdfToText\Pdf(file_get_contents($file["tmp_name"]));
	//         $text = $pdf->getText();
	//         $datosFactura = [];
	//         //aquí puedes usar una expresión regular o algún otro método para extraer los datos de la factura del string $text
	//         //ejemplo: $datosFactura["total"] = preg_match("/Total: (\d+\.\d+)/", $text, $coincidencias) ? $coincidencias[1] : 0;
	//         echo json_encode($datosFactura);
	//     } else {
	//         echo "Por favor sube un archivo PDF";
	//     }
	//   }
	// }

	// 			static public function ctrGuardarDatos(){
	// 			if(isset($_POST)){
	// 			$tabla = "ventas";
	// 			$datos = array(
	// 			"codigo" => $_POST["codigo"],
	// 			"fechaventa" => $_POST["fechaventa"],
	// 			"id_cliente" => $_POST["id_cliente"],
	// 			"carga" => $_POST["carga"],
	// 			"id_vendedor" => $_POST["id_vendedor"],
	// 			"productos" => $_POST["productos"],
	// 			"total" => $_POST["total"]
	// 			);
	// 			$respuesta = ModeloVentas::mdlIngresarFactura($tabla, $datos);
	// 			echo $respuesta;
	// 			}
	// 			}


// static public function ctrProcesarFactura(){
//     if(isset($_FILES["factura"])){

//     	$pdf = new \Spatie\PdfToText\Pdf(file_get_contents($file["tmp_name"]));
// 		$text = $pdf->getText();
// 		echo $text;
        // $file = $_FILES["factura"];
        // $filename = $file["name"];
        // $mimetype = $file["type"];
        // if($mimetype == "application/pdf"){
        //     $pdf = new \Spatie\PdfToText\Pdf(file_get_contents($file["tmp_name"]));
        //     $text = $pdf->getText();
        //     var_dump($text);
        //     echo $text;

        // } else {
        //     echo "Por favor sube un archivo PDF";
        // }
    // }
// }





	/*=============================================
	AGRUPAR VENTAS
	=============================================*/

	 public function verVentasAgrupadas() {
        $medidas = ModeloVentas::mdlMostrarVentasAgrupadas();
        require_once 'vistas/ventas-agrupadas.php';
    }

}

 