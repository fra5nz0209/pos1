
<?php




class ControladorCategorias{

	/*=============================================
	=            CREAR CATEGORIAS        	     =
	=============================================*/
	
	static public function ctrCrearCategoria(){


		if(isset($_POST["nuevaCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){

				$tabla = "categorias";

				$datos = $_POST["nuevaCategoria"];

				$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
							  position: "top-end",
							  icon: "success",
							  title: "Your work has been saved",
							  showConfirmButton: false,
							  timer: 1500
							})

				</script>';

				}


			}else{

				echo '<script>

					Swal.fire({

						icon: "error",
						title: "!La Categoria No puede ir vaci o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "categorias";
							}

						})

				</script>';
			}



		}
	}


	/*=============================================
	=            MOSTRAR CATEGORIAS        	     =
	=============================================*/

	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;



	}

	/*=============================================
	=            EDITAR CATEGORIAS        	     =
	=============================================*/
	
	static public function ctrEditarCategoria(){


		if(isset($_POST["editarCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

				$tabla = "categorias";

				$datos = array("categoria"=>$_POST["editarCategoria"],
								"id"=>$_POST["idCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
							  position: "top-end",
							  icon: "success",
							  title: "La categoria ah sido cambiada correctamente",
							  showConfirmButton: false,
							  timer: 1500
							})

				</script>';

				}


			}else{

				echo '<script>

					Swal.fire({

						icon: "error",
						title: "!La Categoria No puede ir vaci o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result)=>{

							if(result.value) {

								window.location = "categorias";
							}

						})

				</script>';
			}



		}
	}

	/*=============================================
	=            BORRAR CATEGORIAS        	     =
	=============================================*/

	static public function ctrBorrarCategoria(){

		if(isset($_GET["idCategoria"])){

			$tabla ="categorias";
			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){

				echo '<script>

					Swal.fire({
							  position: "top-end",
							  icon: "success",
							  title: "La categoria ah sido Borrada correctamente",
							  showConfirmButton: false,
							  timer: 1500
							}).then((result) =>{

								if(result.value){

									window.location = "categorias";
								}

							})

				</script>';   




			}

		}





	}

}



  