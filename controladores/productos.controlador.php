<?php

class ControladorProductos{

	/*=============================================
	=           MOSTRAR PRODUCTOS                =
	=============================================*/

	static public function ctrMostrarProductos($item, $valor, $orden){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;
	}

	/*=============================================
	=       CREAR PRODUCTOS                       =
	=============================================*/

	static public function ctrCrearProducto(){

		if(isset($_POST["nuevoCodigo"])){

			// Comprobar si el código de producto ya existe
    $tabla = "productos";
    $item = "codigo";
    $valor = $_POST["nuevoCodigo"];
    $orden = "id";
    $producto = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

    if($producto){
      // Si encontramos un producto con el mismo código, mostramos un mensaje de error
      echo '<script>

      Swal.fire({

        icon: "error",
        title: "¡El código de producto ya existe!",
        text: "Por favor, ingrese un código de producto diferente",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false
        }).then((result)=>{

          if(result.value) {

            window.location = "productos";
          }

        })

      </script>';
    }else{
      // Si no encontramos ningún producto con el mismmo codigo proseguimos con la adicion a la base de datos 



			
		if (preg_match('/^[0-9 ]+$/', $_POST["nuevoCodigo"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\. \/-]+$/', $_POST["nuevaDescripcion"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["nuevaMedida"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["nuevaUnidad"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["nuevoStock"]) &&
				preg_match('/^[0-9]+$/', $_POST["nuevoPalets"])){

				$tabla = "productos";

				$datos = array("codigo" => $_POST["nuevoCodigo"],
			   				  "descripcion" => $_POST["nuevaDescripcion"],
			   				  "medida" => $_POST["nuevaMedida"],
			   				  "unidad" => $_POST["nuevaUnidad"],
			   				  "stock" => $_POST["nuevoStock"],
			   				  "palets" => $_POST["nuevoPalets"]);


				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "!El Producto ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "productos";
							}

						})

				</script>';

				}


			}else{

				echo '<script>

					Swal.fire({

						icon: "error",
						title: "!El Producto No puede ir vacia llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "productos";
							}

						})

				</script>';


			}
		}

	  }
	}


	/*=============================================
	=       EDITAR PRODUCTOS                       =
	=============================================*/

	static public function ctrEditarProducto(){

		if(isset($_POST["editarCodigo"])){

			
		if (preg_match('/^[0-9 ]+$/', $_POST["editarCodigo"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\. \/-]+$/', $_POST["editarDescripcion"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["editarMedida"]) &&				
				preg_match('/^[0-9 ]+$/', $_POST["editarUnidad"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["editarStock"]) &&
				preg_match('/^[0-9]+$/', $_POST["editarPalets"])){

				$tabla = "productos";

				$datos = array(
			   				  "codigo" => $_POST["editarCodigo"],
			   				  "descripcion" => $_POST["editarDescripcion"],
			   				  "medida" => $_POST["editarMedida"],			   				  
			   				  "unidad" => $_POST["editarUnidad"],
			   				  "stock" => $_POST["editarStock"],
			   				  "palets" => $_POST["editarPalets"]);


				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "!El Producto ha sido Editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "productos";
							}

						})

				</script>';

				}


			}else{

				echo '<script>

					Swal.fire({

						icon: "error",
						title: "!El Producto No puede ir vacia llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "productos";
							}

						})

				</script>';


			}
		}
	}


	/*=============================================
	=       BORRAR PRODUCTOS                       =
	=============================================*/

	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla = "productos";
			$datos = $_GET["idProducto"];

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>

					Swal.fire({

						icon: "success",
						title: "!El Producto ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "productos";
							}

						})

				</script>';



			}


		}



	}


	/*=============================================
	=     MOSTRAR SUMA VENTAS                       =
	=============================================*/
		static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);


			return $respuesta;

		}




		/*=============================================
		=       ACTUALIZAR PRODUCTOS                       =
		=============================================*/

	 static public function ctrActualizarStockProducto($nuevoStock, $idProducto){

	        $respuesta = ModeloProductos::mdlActualizarStockProductoM("productos", $nuevoStock, $idProducto);

	        return $respuesta;

	    }
}



  