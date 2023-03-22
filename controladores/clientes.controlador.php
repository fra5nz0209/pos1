<?php


class controladorClientes{

	/*=============================================
	=            CREAR CLIENTE                    =
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoCodigo"])){

			if (preg_match('/^[0-9 ]+$/', $_POST["nuevoCodigo"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \/]+$/', $_POST["nuevoCliente"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \/]+$/', $_POST["nuevaDireccion"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \/]+$/', $_POST["nuevaReferencia"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoCelular"]) &&
				preg_match('/^[0-9]+$/', $_POST["nuevoNit"])){

				$tabla = "clientes";

				$datos = array("codigo" => $_POST["nuevoCodigo"],
			   				  "nombre" => $_POST["nuevoCliente"],
			   				  "direccion" => $_POST["nuevaDireccion"],
			   				  "referencia" => $_POST["nuevaReferencia"],
			   				  "celular" => $_POST["nuevoCelular"],
			   				  "nit" => $_POST["nuevoNit"]);


				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "!El Cliente ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "clientes";
							}

						})

				</script>';




				}


			}else{

				echo '<script>

					Swal.fire({

						icon: "error",
						title: "!El Cliente No puede ir vacia llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "clientes";
							}

						})

				</script>';


			}
		}

	}

	/*=============================================
	=            MOSTRAR CLIENTES                 =
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;
		



	}

	/*=============================================
	=            EDITAR CLIENTES                 =
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCodigo"])){

			if (preg_match('/^[0-9 ]+$/', $_POST["editarCodigo"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \/]+$/', $_POST["editarCliente"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \/]+$/', $_POST["editarDireccion"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \/]+$/', $_POST["editarReferencia"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["editarCelular"]) &&
				preg_match('/^[0-9]+$/', $_POST["editarNit"])){

				$tabla = "clientes";

				$datos = array("id" =>$_POST["idCliente"],
							  "codigo" =>$_POST["editarCodigo"],
			   				  "nombre" =>$_POST["editarCliente"],
			   				  "direccion" =>$_POST["editarDireccion"],
			   				  "referencia" =>$_POST["editarReferencia"],
			   				  "celular" =>$_POST["editarCelular"],
			   				  "nit" =>$_POST["editarNit"]);


				$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "!El Cliente ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "clientes";
							}

						})

				</script>';




				}


			}else{

				echo '<script>

					Swal.fire({

						icon: "error",
						title: "!El Cliente No puede ir vacia llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "clientes";
							}

						})

				</script>';


			}
		}

	}

	/*=============================================
	=            ELIMINAR CLIENTES                =
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){


			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){


				echo '<script>

					Swal.fire({

						icon: "success",
						title: "!El Cliente ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "clientes";
							}

						})

				</script>';		

			} 
		}


	}

}


  