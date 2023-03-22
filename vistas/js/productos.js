/*=============================================
=            EDITAR   PRODUCTO         =
=============================================*/

$(".btnEditarProducto").click(function(){

	var idProducto =$(this).attr("idProducto");

	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({


		url:"ajax/productos.ajax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

			$("#editarCodigo").val(respuesta["codigo"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#editarMedida").val(respuesta["medida"]);		
			$("#editarUnidad").val(respuesta["unidad"]);			
			$("#editarStock").val(respuesta["stock"]);
			$("#editarPalets").val(respuesta["palets"]);
			respuesta

		}
	})

})


/*=============================================
=            BORRAR   PRODUCTO         =
=============================================*/

$(".btnBorrarProducto").click(function(){

	var idProducto = $(this).attr("idProducto");
	

	  Swal.fire({
	    title: '¿Está seguro de borrar el Producto?',
	    text: "¡Si no lo está puede cancelar la accíón!",
	    icon: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      cancelButtonText: 'Cancelar',
	      confirmButtonText: 'Si, borrar producto!'
	  }).then(function(result){

	    if(result.value){

	      window.location = "index.php?ruta=productos&idProducto="+idProducto;

	    }

	  })

	})
