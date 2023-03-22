<?php


class ControladorCompras{

	/*=============================================
	MOSTRAR COMPRAS
	=============================================*/

	static public function ctrMostrarCompras($item, $valor){

		$tabla = "compras";

		$respuesta = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);

		return $respuesta;

	}

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

	static public function ctrCrearCompra(){

		if(isset($_POST["nuevaCompra"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			$listaCompras = json_decode($_POST["listaCompras"], true);

			$totalProductosComprados = array();

			foreach ($listaCompras as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "compras";
				$valor1a = $value["cantidad"] + $traerProducto["compras"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "compras";

			$datos = array("codigo"=>$_POST["nuevaCompra"],
						   "origen"=>$_POST["nuevoOrigen"],
						   "fechacompra"=>$_POST["nuevaFecha"],
						   "vehiculo"=>$_POST["nuevoVehiculo"],
						   "placa"=>$_POST["nuevaPlaca"],
						   "propietario"=>$_POST["nuevoPropietario"],
						   "productosc"=>$_POST["listaCompras"],
						   "totalcompra"=>$_POST["totalCompra"],
						   );

			$respuesta = ModeloCompras::mdlIngresarCompra($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La Compra ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "compras";

								}
							})

				</script>';

			}

		}

	}





	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarCompra(){

		if(isset($_POST["editarCompra"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "compras";

			$item = "codigo";
			$valor = $_POST["editarCompra"];
			$orden = "id";

			$traerVenta = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor, $orden);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaCompras"] == ""){

				$listaCompras = $traerVenta["productosc"];
				$cambioProducto = false;


			}else{

				$listaCompras = $_POST["listaCompras"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["productosc"], true);

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
					$valor1b = $traerProducto["stock"] - $value["cantidad"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				
				
				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaCompras, true);

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

				
				// $item1a_2 = "compras";
				// $valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				// $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("codigo"=>$_POST["editarCompra"],
						   "origen"=>$_POST["editarOrigen"],
						   "fechacompra"=>$_POST["editarFecha"],
						   "vehiculo"=>$_POST["editarVehiculo"],
						   "placa"=>$_POST["editarPlaca"],
						   "propietario"=>$_POST["editarPropietario"],
						   "productosc"=>$listaCompras,
						   "totalcompra"=>$_POST["totalCompra"],
						   
						   );



			$respuesta = ModeloCompras::mdlEditarCompra($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La compra ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "compras";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarCompra(){

		if(isset($_GET["idCompra"])){

			$tabla = "compras";

			$item = "id";
			$valor = $_GET["idCompra"];

			$traerCompra = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);

			
			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerCompra["productosc"], true);

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
				$valor1b = $traerProducto["stock"] - $value["cantidad"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloCompras::mdlEliminarCompra($tabla, $_GET["idCompra"]);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "La Compra ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "compras";

								}
							})

				</script>';

			}		
		}

	}

	/*=============================================
	RANGO FECHAS NUEVO CODIGO LA PRIMERA SECCION 
	=============================================*/

	static public function ctrRangoFechasCompras($fechaInicial, $fechaFinal){

	$tabla = "compras";

	$respuesta = ModeloCompras::mdlRangoFechasCompras($tabla, $fechaInicial, $fechaFinal);

	return $respuesta;

}

// 	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

//     $tabla = "ventas";

//     $respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

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
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CODIGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTALACOBRAR</td>			
					<td style='font-weight:bold; border:1px solid #eee;'>CAJAS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>P</td>		
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




}

 