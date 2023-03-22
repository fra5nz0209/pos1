

// if(localStorage.getItem("capturarRango")!= null){

// 		$("#daterange-btn span").html(localStorage.getItem("capturarRango"));
// }else{

// 		$("#daterange-btn span").html('<i class="fa fa-calendar"></i>Rango de fecha')
// }

/*=============================================
=  CARGAR LA TABLA DINAMICA DE COMPRAS        =
=============================================*/

$.ajax({

	url: "ajax/datatable-compras.ajax.php",
	success:function(respuesta){

	
	}
})

$('.tablaCompras').DataTable( {
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

/*=============================================
=AGREGANDO PRODUCTOS A LA COMPRA DESDE LA TABLA=
=============================================*/

$(".tablaCompras tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

	var cantidad = 1; // valor por defecto

	var datos=new FormData();
	datos.append("idProducto", idProducto);

		$.ajax({

			url:"ajax/productos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function(respuesta){

				var descripcion = respuesta["descripcion"];
				var stock = respuesta["stock"];
				var palets = respuesta["palets"];

				/*=============================================
				=EVITAR AGREGAR PRODUCTO CUANDO EL STOCK ESTA EN CERO=
				=============================================*/

				if(stock == 0){

					Swal.fire({

						title: "No hay stock disponible",
						icon: "error",
						confirmButton: "!Cerrar!"
					});

					$("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

					return;


				}


				$(".nuevoProductoCompra").append(
					
					'<div class="row" style="padding:5px 15px">'+

					'<!-- DESCRIPCION DEL PRODUCTO -->'+
                    
                    '<div class="col-sm-6" style="padding-right: 0px">'+
                      
                      '<div class="input-group">'+
                        
                        '<span class="input-group-addon"><button type="button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                        '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+


                      '</div>'+

                    '</div>'+

                    '<!--CANIDAD DE PALETS -->'+

                    '<div class="col-sm-2" ingresoPalets>'+

                      '<div class="input-group">'+
                      
                      '<input type="text" class="form-control paletsActual" name="paletsActual"  value="'+palets+'" readonly>'+
                      '</div>'+
                     '</div>'+

                    '<!--CANIDAD DEL PRODUCTO -->'+

                    '<div class="col-sm-2 ingresoCantidad">'+
                      
                      '<input type="number" class="form-control nuevaCantidadProductoC"  name="nuevaCantidadProductoC" min="1" value="" palets="'+palets+'" stock="'+stock+'" nuevoStock="'+Number(stock+cantidad)+'" required>'+
                    '</div>'+
                    

                    '<!--TOTAL DE COMPRA  -->'+

                    '<div class="col-sm-2 totalPedido">'+
                      
                      '<input type="number" class="form-control nuevoPedido"  name="nuevoPedido" value="" readonly required>'+
                    '</div>'+

                    '</div>')

	


			// AGREGAR PRODUCTOS EN FORMATO  JSON

				listarCompras()


      
      $(".nuevoPedido").number(true, 2);

       // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoTotalProductoConDescuento").number(true, 2);



			}


		})



});
/*=============================================
=CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA=
=============================================*/

$(".tablaCompras").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
		}

	}


})

/*=============================================
=FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA=NUEVA VERSION DE CODIGO EN REMPLAZO DE LA QUE ESTA ABAJO
=============================================*/

function quitarAgregarProductoC(){

//Capturamos todos los id de productos que fueron elegidos en la venta
var idProductos = $(".quitarProducto");

//Capturamos todos los botones de agregar que aparecen en la tabla
var botonesTabla = $(".tablaCompras tbody button.agregarProducto");

//Recorremos en cada botón
for(var i = 0; i < botonesTabla.length; i++){

//Capturamos el id del producto en la iteración
var boton = $(botonesTabla[i]).attr("idProducto");

//Hacemos un recorrido por los productos agregados a la venta
for(var j = 0; j < idProductos.length; j++){

//Capturamos el id del producto agregado a la venta en la iteración
var idProducto = $(idProductos[j]).attr("idProducto");

//Si el id del botón es igual al id del producto agregado entonces...
if(boton == idProducto){

//Removemos la clase agregarProducto
$(botonesTabla[i]).removeClass("btn-primary agregarProducto");

//Agregamos la clase btn-default
$(botonesTabla[i]).addClass("btn-default");

}

}

}

}



/*=============================================
=CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:= NUEVA LINEA DE CODIGO 
=============================================*/

$('.tablaCompras').on( 'draw.dt', function(){

quitarAgregarProductoC();

});



	/*=============================================
=QUITAR PRODUCTO DE LA COMPRA Y RECUPERAR BOT
ón   nueva actualizacion 
=============================================*/

$(".formularioCompra").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

var idProducto = $(this).attr("idProducto");

$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

if($(".nuevoProductoCompra").children().length == 0){


	$("#nuevoTotalCompra").val(0);
	$("#totalCompra").val(0);
	$("#nuevoTotalCompra").attr("total",0);

}else{

	// SUMAR TOTAL DE PRECIOS

  	sumarTotalPreciosC()

	// AGRUPAR PRODUCTOS EN FORMATO JSON
	listarCompras()

}
})




/*=============================================
=MODIFICAR  la cantidad total de palets 
=============================================*/
$(".formularioCompra").on("change", "input.nuevaCantidadProductoC", function(){

var paletsfinal = $(this).parent().parent().children(".totalPedido").children(".nuevoPedido");

var nuevaCantidad = $(this).val();

// var stock = $(this).attr("stock");



var nuevoStock = Number($(this).attr("stock")) + Number(nuevaCantidad);
paletsfinal.val(Number(nuevaCantidad) / Number($(this).attr("palets")));

// var nuevoStock = Number(stock) - Number(nuevaCantidad);


$(this).attr("nuevoStock", nuevoStock);

// var stockActual = $(this).attr("nuevoStock");

if(Number(nuevaCantidad) == 0){

	$(this).val(1);

Swal.fire({

	title: "La cantidad no puede ser cero",
	icon: "error",
	confirmButton: "!Cerrar!"
});
}
$(this).attr("nuevoStock", nuevoStock);

if(Number($(".nuevoPedido").val()) == 0){
	
	$("#nuevoTotalCompra").val(0);
	$("#totalCompra").val(0);
	$("#nuevoTotalCompra").attr("totalC",0);

}else{
    
	// SUMAR TOTAL DE PRECIOS

sumarTotalPreciosC()


// AGRUPAR PRODUCTOS EN FORMATO JSON
listarCompras()

}
});



/*=============================================
SUMAR TODOS LOS PRECIOS  NUEVA VERSION DE CODIGO
=============================================*/

function sumarTotalPreciosC(){

var precioItem = $(".nuevoPedido");

var arraySumaPrecio = [];

for(var i = 0; i < precioItem.length; i++){

 arraySumaPrecio.push(Number($(precioItem[i]).val()));


}

function sumaArrayPreciosC(total, numero){


return total + numero;

}

var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPreciosC);

$("#nuevoTotalCompra").val(sumaTotalPrecio);
$("#totalCompra").val(sumaTotalPrecio);
$("#nuevoTotalCompra").attr("totalC",sumaTotalPrecio);

}



/*=============================================
LISTAR AGRUPAR PRODUCTOS EN FORMATO JSON NUEVO CODIGO 
=============================================*/

function listarCompras(){

var listaCompras = [];

var descripcionC = $(".nuevaDescripcionProducto");

var cantidadC = $(".nuevaCantidadProductoC");


var totalC = $(".nuevoPedido");

for(var i = 0; i < descripcionC.length; i++){

listaCompras.push({ "id" : $(descripcionC[i]).attr("idProducto"),
						"descripcion" : $(descripcionC[i]).val(),
					  "cantidad" : $(cantidadC[i]).val(),
					  "stock" : $(cantidadC[i]).attr("nuevoStock"),				
						"total" : $(totalC[i]).val()
					})
}

$("#listaCompras").val(JSON.stringify(listaCompras));

}




/*=============================================
BOTON EDITAR COMPRA NUEVO CODIGO ACTUALIZADO 
=============================================*/

$(".tablas").on("click", ".btnEditarCompra", function(){

var idCompra = $(this).attr("idCompra");

window.location = "index.php?ruta=editar-compra&idCompra="+idCompra;

});




/*=============================================
BORRAR COMPRA  NUEVA LINEA DE CODIGO 
=============================================*/
$(".tablas").on("click", ".btnEliminarCompra", function(){

var idCompra = $(this).attr("idCompra");

Swal.fire({
title: '¿Está seguro de borrar la venta?',
text: "¡Si no lo está puede cancelar la acción!",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'Cancelar',
confirmButtonText: 'Si, borrar venta!'
}).then(function(result){
if (result.value) {

window.location = "index.php?ruta=compras&idCompra="+idCompra;
}

})

});




/*=============================================
=            IMPRIMIR FACTURA           =
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

		var codigoVenta = $(this).attr("codigoVenta");

		window.open("extensiones/tcpdf/examples/factura.php?codigo="+codigoVenta, "blank");     


})


/*=============================================
RANGO DE FECHAS NUEVA LINEA DE CODGIGOOOOOO
=============================================*/

//Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
          'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
          'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
          'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

        var fechaInicial = start.format('YYYY-MM-DD');
        // console.log("fechaInicial", fechaInicial);
				var fechaFinal = end.format('YYYY-MM-DD');
				// console.log("fechaFinal", fechaFinal);

				var capturarRango = $("#daterange-btn span").html();
				
				// console.log("capturarRango", capturarRango);

				localStorage.setItem("capturarRango", capturarRango);

				window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
      }
    )



/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .drp-buttons .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})
/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker-right.opensright .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();



		if(mes < 10){

			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;

		}else if(dia < 10){

			var fechaInicial = año+"-"+mes+"-0"+dia;
			var fechaFinal = año+"-"+mes+"-0"+dia;

		}else if(mes < 10 && dia < 10){

			var fechaInicial = año+"-0"+mes+"-0"+dia;
			var fechaFinal = año+"-0"+mes+"-0"+dia;

		}else{

			var fechaInicial = año+"-"+mes+"-"+dia;
	    	var fechaFinal = año+"-"+mes+"-"+dia;

		}




		dia = ("0"+dia).slice(-2);
		mes = ("0"+mes).slice(-2);

		var fechaInicial = año+"-"+mes+"-"+dia;
		var fechaFinal = año+"-"+mes+"-"+dia;	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})





/*=============================================
ABRIR ARCHIVO XML EN NUEVA PESTAÑA
=============================================*/

$(".abrirXML").click(function(){

	var archivo = $(this).attr("archivo");
	window.open(archivo, "_blank");


})
