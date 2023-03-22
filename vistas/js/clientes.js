/*=============================================
=            	EDITAR CLIENTE                =
=============================================*/

$(".btnEditarCliente").click(function(){

	var idCliente =$(this).attr("idCliente");

	var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({


		url:"ajax/clientes.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

			$("#idCliente").val(respuesta["id"]);
			$("#editarCodigo").val(respuesta["codigo"]);
			$("#editarCliente").val(respuesta["nombre"]);
			$("#editarDireccion").val(respuesta["direccion"]);
			$("#editarReferencia").val(respuesta["referencia"]);
			$("#editarCelular").val(respuesta["celular"]);
			$("#editarNit").val(respuesta["nit"]);
			

		}
	})

})

/*=============================================
=            	ELIMINAR CLIENTE              =
=============================================*/

$(".btnEliminarCliente").click(function(){

	var idCliente = $(this).attr("idCliente");

		Swal.fire({

		title: 'Esta seguro de borrar el Cliente?',
		text: "!Si no lo esta puede cancelar la accion!",
		icon: 'warning',

		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar categoria!'

	}).then(function(result){
		if(result.value){

			window.location = "index.php?ruta=clientes&idCliente="+idCliente;
		}


	})


})





