

// if(localStorage.getItem("capturarRango")!= null){

// 		$("#daterange-btn span").html(localStorage.getItem("capturarRango"));
// }else{

// 		$("#daterange-btn span").html('<i class="fa fa-calendar"></i>Rango de fecha')
// }

/*=============================================
=  CARGAR LA TABLA DINAMICA DE VENTAS        =
=============================================*/

$.ajax({

	url: "ajax/datatable-ventas.ajax.php",
	success:function(respuesta){

	
	}
})

$('.tablaVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
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
=AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA=
=============================================*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

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


				$(".nuevoProducto").append(
					
					'<div class="row" style="padding:5px 15px">'+

					'<!-- DESCRIPCION DEL PRODUCTO -->'+
                    
                    '<div class="col-sm-6" style="padding-right: 0px">'+
                      
                      '<div class="input-group">'+
                        
                        '<span class="input-group-addon"><button type="button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                        '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+


                      '</div>'+

                    '</div>'+

                    '<!--CANIDAD DEL PRODUCTO -->'+

                    '<div class="col-sm-3 ingresoCantidad">'+
                      
                      '<input type="number" class="form-control nuevaCantidadProducto"  name="nuevaCantidadProducto" min="1" value="'+cantidad+'" stock="'+stock+'" nuevoStock="'+Number(stock-cantidad)+'" required>'+
                    '</div>'+

                    '<!-- PRECIO DEL PRODUCTO -->'+

                     '<div class="col-sm-3 ingresoPrecio" style="padding-left:0px">'+

                      '<div class="input-group">'+
                     
                      '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
                      
                      '<input type="text" min="1" class="form-control nuevoPrecioProducto"  name="nuevoPrecioProducto" value="" required>'+
                                     
                      '</div>'+
                     '</div>'+

                     '<!-- TOTAL DEL PRODUCTO -->'+

	                '<div class="col-sm-3 ingresoTotal" style="padding-left:0px">'+
	  			        '<input type="text" class="form-control nuevoTotalProducto" name="nuevoTotalProducto" value="" readonly required>'+
	  				      '</div>'+

                '<!-- DESCUENTO DEL PRODUCTO -->'+

                        '<div class="col-sm-3 ingresoDescuento" style="padding-left:0px">'+
       				   '<div class="input-group">'+

       			     '<input type="text" min="0" class="form-control nuevoDescuentoProducto" name="nuevoDescuentoProducto" value="0" required>'+
   			         '<span class="input-group-text"><i class="fas fa-percent"></i></span>'+

   				       '</div>'+
   					     '</div>'+

                '<!-- TOTAL DEL PRODUCTO CON DESCUENTO -->'+

                '<div class="col-sm-3 ingresoTotalConDescuento" style="padding-left:0px">'+
        			  '<input type="text" class="form-control nuevoTotalProductoConDescuento" name="nuevoTotalProductoConDescuento" value="" readonly required>'+
      					  '</div>'+



                    '</div>')

		
				// SUMAR TOTAL PRECIOS

				sumarTotalPrecios()


			// AGREGAR PRODUCTOS EN FORMATO  JSON

				listarProductos()


      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto").number(true, 2);

       // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoTotalProducto").number(true, 2);

       // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoTotalProductoConDescuento").number(true, 2);



			}


		})



});
/*=============================================
=CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA=
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

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

function quitarAgregarProducto(){

//Capturamos todos los id de productos que fueron elegidos en la venta
var idProductos = $(".quitarProducto");

//Capturamos todos los botones de agregar que aparecen en la tabla
var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

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

$('.tablaVentas').on( 'draw.dt', function(){

quitarAgregarProducto();

});











	/*=============================================
=QUITAR PRODUCTO DE LA VENTA Y RECUPERAR BOT
ón   nueva actualizacion 
=============================================*/

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

var idProducto = $(this).attr("idProducto");

$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

if($(".nuevoProducto").children().length == 0){

	$("#nuevoImpuestoVenta").val(0);
	$("#nuevoTotalVenta").val(0);
	$("#totalVenta").val(0);
	$("#nuevoTotalVenta").attr("total",0);

}else{

	// SUMAR TOTAL DE PRECIOS

  	sumarTotalPrecios()

	// AGRUPAR PRODUCTOS EN FORMATO JSON
	listarProductos()

}
})



/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();		

	

	// var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

	// var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

		  var datos = new FormData();
   		datos.append("nombreProducto", nombreProducto);


	  $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    // $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
      	    $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    // $(nuevoPrecioProducto).attr("value", "precio_venta");
      	    // $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

      	}

      })
})






/*=============================================
=MODIFICAR LA CANTIDAD=NUEVA MODIFICACION 
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

var precioFinal = $(this).parent().parent().children(".ingresoTotal").children(".nuevoTotalProducto");

var descuento = $(this).parent().parent().children(".ingresoDescuento").children().children(".nuevoDescuentoProducto");

var totalConDescuento = $(this).parent().parent().children(".ingresoTotalConDescuento").children(".nuevoTotalProductoConDescuento");

var nuevaCantidad = $(this).val();

// var stock = $(this).attr("stock");


var nuevoStock = Number($(this).attr("stock")) - Number(nuevaCantidad);

// var nuevoStock = Number(stock) - Number(nuevaCantidad);


$(this).attr("nuevoStock", nuevoStock);

// var stockActual = $(this).attr("nuevoStock");

console.log(nuevoStock);
if(Number(nuevaCantidad) > Number($(this).attr("stock"))){
// if(Number(nuevaCantidad) > Number(stockActual)){

	$(this).val(1);
	var nuevoStock = Number($(this).attr("stock")) - 1; 


Swal.fire({

	title: "La cantidad supera el Stock",
	text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	icon: "error",
	confirmButton: "!Cerrar!"
});
}

if(Number(nuevaCantidad) == 0){

	$(this).val(1);

Swal.fire({

	title: "La cantidad no puede ser cero",
	icon: "error",
	confirmButton: "!Cerrar!"
});
}
$(this).attr("nuevoStock", nuevoStock);

precioFinal.val(Number(precio.val()) * Number(nuevaCantidad));

totalConDescuento.val(Number(precioFinal.val()) - Number(descuento.val()));

if(Number($(".nuevoTotalProducto").val()) == 0){
	$("#nuevoImpuestoVenta").val(0);
	$("#nuevoTotalVenta").val(0);
	$("#totalVenta").val(0);
	$("#nuevoTotalVenta").attr("total",0);

}else{
    
	// SUMAR TOTAL DE PRECIOS

sumarTotalPrecios()


// AGRUPAR PRODUCTOS EN FORMATO JSON
listarProductos()

}
});


/*=============================================
MODIFICAR PRECIO NUEVO CAMBIO 
=============================================*/

$(".formularioVenta").on("change", "input.nuevoPrecioProducto", function(){

var precio = $(this).val();

var precioFinal = $(this).parent().parent().parent().children(".ingresoTotal").children(".nuevoTotalProducto");

var descuento = $(this).parent().parent().parent().children(".ingresoDescuento").children().children(".nuevoDescuentoProducto");

var totalConDescuento = $(this).parent().parent().parent().children(".ingresoTotalConDescuento").children(".nuevoTotalProductoConDescuento");

var cantidad = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

precioFinal.val(Number(precio) * Number(cantidad.val()));

totalConDescuento.val(Number(precioFinal.val()) - Number(descuento.val()));

if(Number($(".nuevoTotalProducto").val()) == 0){
$("#nuevoImpuestoVenta").val(0);
$("#nuevoTotalVenta").val(0);
$("#totalVenta").val(0);
$("#nuevoTotalVenta").attr("total",0);

}else{

	// SUMAR TOTAL DE PRECIOS
sumarTotalPrecios()

// AGRUPAR PRODUCTOS EN FORMATO JSON
listarProductos()

}

});

/*=============================================
MODIFICAR DESCUENTO NUEVA LINEA DE CODIGO ...
=============================================*/

$(".formularioVenta").on("change", "input.nuevoDescuentoProducto", function(){



var precio = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

var precioFinal = $(this).parent().parent().parent().children(".ingresoTotal").children(".nuevoTotalProducto");

var descuento = $(this).val();

var totalConDescuento = $(this).parent().parent().parent().children(".ingresoTotalConDescuento").children(".nuevoTotalProductoConDescuento");

var cantidad = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

totalConDescuento.val(Number(precioFinal.val()) - Number(descuento));

if(Number($(".nuevoTotalProducto").val()) == 0){
$("#nuevoImpuestoVenta").val(0);
$("#nuevoTotalVenta").val(0);
$("#totalVenta").val(0);
$("#nuevoTotalVenta").attr("total",0);


}else{

sumarTotalPrecios()


// AGRUPAR PRODUCTOS EN FORMATO JSON
listarProductos()

}

});




/*=============================================
FUNCIÓN AGREGAR IMPUESTO  NUEVA VERSION DE CODIGO 
=============================================*/

// function agregarImpuesto(){

// var impuesto = $("#nuevoImpuestoVenta").val();
// var precioTotal = $("#nuevoTotalVenta").attr("total");

// var precioImpuesto = Number(precioTotal * impuesto/100);

// var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

// $("#nuevoTotalVenta").val(totalConImpuesto);

// $("#totalVenta").val(totalConImpuesto);

// $("#nuevoPrecioImpuesto").val(precioImpuesto);

// $("#nuevoPrecioNeto").val(precioTotal);

// }

/*=============================================
SUMAR TODOS LOS PRECIOS  NUEVA VERSION DE CODIGO
=============================================*/

function sumarTotalPrecios(){

var precioItem = $(".nuevoTotalProductoConDescuento");

var arraySumaPrecio = [];

for(var i = 0; i < precioItem.length; i++){

 arraySumaPrecio.push(Number($(precioItem[i]).val()));


}

function sumaArrayPrecios(total, numero){


return total + numero;

}

var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

$("#nuevoTotalVenta").val(sumaTotalPrecio);
$("#totalVenta").val(sumaTotalPrecio);
$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);

}



/*=============================================
LISTAR AGRUPAR PRODUCTOS EN FORMATO JSON NUEVO CODIGO 
=============================================*/

function listarProductos(){

var listaProductos = [];

var descripcion = $(".nuevaDescripcionProducto");

var cantidad = $(".nuevaCantidadProducto");

var precio = $(".nuevoPrecioProducto");

var totala = $(".nuevoTotalProducto");

var descuento = $(".nuevoDescuentoProducto");

var total = $(".nuevoTotalProductoConDescuento");

for(var i = 0; i < descripcion.length; i++){

listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"),
						"descripcion" : $(descripcion[i]).val(),
					  "cantidad" : $(cantidad[i]).val(),
					  "stock" : $(cantidad[i]).attr("nuevoStock"),
						"precio" : $(precio[i]).val(),
						"totala" : $(totala[i]).val(),
						"descuento" : $(descuento[i]).val(),
						"total" : $(total[i]).val()
					})
}

$("#listaProductos").val(JSON.stringify(listaProductos));

}




/*=============================================
BOTON EDITAR VENTA NUEVO CODIGO ACTUALIZADO 
=============================================*/

$(".tablas").on("click", ".btnEditarVenta", function(){

var idVenta = $(this).attr("idVenta");

window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;

});




/*=============================================
BORRAR VENTA  NUEVA LINEA DE CODIGO 
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

var idVenta = $(this).attr("idVenta");

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

window.location = "index.php?ruta=ventas&idVenta="+idVenta;
}

})

});



/*=============================================
=            IMPRIMIR FACTURA           =NUEVA LINEA DE CODIGO
=============================================*/

// $(".tablas").on("click", ".btnImprimirFactura", function(){

// var idVenta = $(this).attr("idVenta");

// window.open("extensiones/tcpdf/pdf/factura.php?id="+idVenta, "_blank");

// });

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

        var idVendedor = $("#nuevoVendedor").val();
		    console.log("idVendedor", idVendedor);

		    localStorage.setItem("idVendedor", idVendedor);

        var fechaInicial = start.format('YYYY-MM-DD');
        // console.log("fechaInicial", fechaInicial);
				var fechaFinal = end.format('YYYY-MM-DD');
				// console.log("fechaFinal", fechaFinal);

				var capturarRango = $("#daterange-btn span").html();
				
				// console.log("capturarRango", capturarRango);

				localStorage.setItem("capturarRango", capturarRango);

				window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&idVendedor="+idVendedor;
      }
    )


// $('#daterange-btn').daterangepicker(
//   {
//     ranges   : {
//       'Hoy'       : [moment(), moment()],
//       'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//       'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
//       'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
//       'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
//       'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//     },
//     startDate: moment(),
//     endDate  : moment()
//   },
//   function (start, end) {
//     $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

//     var fechaInicial = start.format('YYYY-MM-DD');

//     var fechaFinal = end.format('YYYY-MM-DD');

//     var capturarRango = $("#daterange-btn span").html();
   
//    	localStorage.setItem("capturarRango", capturarRango);

//    	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

//   }

// )


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


// /*=============================================
// CAPTURAR HOY NUEVA LINEA DE CODGIGO 
// =============================================*/

// $(".daterangepicker.opensleft .ranges li").on("click", function(){

// var textoHoy = $(this).attr("data-range-key");

// if(textoHoy == "Hoy"){

// var d = new Date();

// var dia = d.getDate();
// var mes = d.getMonth()+1;
// var año = d.getFullYear();

// if(dia < 10){
// 	dia = "0"+dia;
// }

// if(mes < 10){
// 	mes = "0"+mes;
// }

// var fechaInicial = año+"-"+mes+"-"+dia;
// var fechaFinal = año+"-"+mes+"-"+dia;

// localStorage.setItem("capturarRango", "Hoy");

// window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

// }

// });



/*=============================================
ABRIR ARCHIVO XML EN NUEVA PESTAÑA
=============================================*/

$(".abrirXML").click(function(){

	var archivo = $(this).attr("archivo");
	window.open(archivo, "_blank");


})

/*=============================================
ACTUALIZAR ESTADO VENTA
=============================================*/


  // var idVenta = $(this).attr("idVenta");
  // var nuevoEstado = $(this).attr("nuevoEstado");
  // var estadoActual = $(this).attr("estadoActual");

  // var datos = new FormData();
  // datos.append("activaid", idVenta);
  // datos.append("activarEstado", nuevoEstado);
$(".btnCambiarEstado").click(function(){



	var idVenta = $(this).attr("idVenta");
	var estado = $(this).attr("nuevoEstado");
	var estadoActual = $(this).attr("estadoActual");

	var datos = new FormData();
	datos.append("id", idVenta);
	datos.append("estado", estado);

	$.ajax({
    url: "ajax/ventas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta){
    	if(respuesta == "ok"){
				Swal.fire({
				icon: 'success',
				title: "¡El estado ha sido cambiado correctamente!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"
				}).then(function(result){
				if(result.value){
				// Recargar la página
				window.location.reload();
				}
				});
				}
					}
					})

					if(estadoActual == "activa"){
					$(this).removeClass('btn-success');
					$(this).addClass('btn-warning');
					$(this).html('Pendiente');
					$(this).attr('estadoActual', 'pendiente');
					} else if(estadoActual == "pendiente"){
					$(this).removeClass('btn-warning');
					$(this).addClass('btn-danger');
					$(this).html('Anulada');
					$(this).attr('estadoActual', 'anulada');
					} else {
					$(this).addClass('btn-success');
					$(this).removeClass('btn-danger');
					$(this).html('Activa');
					$(this).attr('estadoActual', 'activa');
					}
					})


		
		/*=============================================
		ACTUALIZAR ESTADO VENTA CUENTA
		=============================================*/
	
			$(".btncuentas").click(function(){
  var idCuenta = $(this).attr("idCuenta");
  var cuenta = $(this).attr("nuevaCuenta");
  var estadoCuenta = $(this).attr("estadoCuenta");

  var datos = new FormData();
  datos.append("idc", idCuenta);
  datos.append("cuenta", cuenta);

  $.ajax({

		url:"ajax/ventas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
    	if(respuesta == "ok"){
				Swal.fire({
				icon: 'success',
				title: "¡La cuenta ha sido cambiado correctamente!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"
				}).then(function(result){
				if(result.value){
				// Recargar la página
				window.location.reload();
				}
				});
				}
					}

	})

 if(estadoCuenta == "efec"){
    $(this).html("CXC");
    $(this).attr("estadoCuenta", "cxc");
  } else if(estadoCuenta == "cxc"){
    $(this).html("TRF");
    $(this).attr("estadoCuenta", "trf");
  } else if(estadoCuenta == "trf"){
    $(this).html("VA");
    $(this).attr("estadoCuenta", "va");
  } else if(estadoCuenta == "va"){
    $(this).html("ANU");
    $(this).attr("estadoCuenta", "anu");
  } else {
    $(this).html("EFEC");
    $(this).attr("estadoCuenta", "efec");
  }







});

 


// $(".btnCambiarEstado").click(function(){

// var idVenta = $(this).attr("idVenta");
// var estadoActual = $(this).attr("estadoActual");
// var nuevoEstado = $(this).attr("nuevoEstado");

// var datos = new FormData();
// datos.append("idVenta", idVenta);
// datos.append("estadoActual", estadoActual);
// datos.append("nuevoEstado", nuevoEstado);

// $.ajax({

//     url:"ajax/ventas.ajax.php",
//     method: "POST",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     success: function(respuesta){
//     	if(respuesta == "ok"){
// 				Swal.fire({
// 				type: "success",
// 				title: "¡El estado ha sido cambiado correctamente!",
// 				showConfirmButton: true,
// 				confirmButtonText: "Cerrar"
// 				}).then(function(result){
// 				if(result.value){
// 				// Recargar la página
// 				window.location.reload();
// 				}
// 				});
// 				}
// 					}
// 					})

// 					if(estadoActual == "activa"){
// 					$(this).removeClass('btn-success');
// 					$(this).addClass('btn-warning');
// 					$(this).html('Pendiente');
// 					$(this).attr('estadoActual', 'pendiente');
// 					} else if(estadoActual == "pendiente"){
// 					$(this).removeClass('btn-warning');
// 					$(this).addClass('btn-danger');
// 					$(this).html('Anulada');
// 					$(this).attr('estadoActual', 'anulada');
// 					} else {
// 					$(this).addClass('btn-success');
// 					$(this).removeClass('btn-danger');
// 					$(this).html('Activa');
// 					$(this).attr('estadoActual', 'activa');
// 					}
// 					})









// // $(document).on("click", ".btnCambiarEstado", function(){
// $(".btnCambiarEstado").click(function(){
//   var idVenta = $(this).attr("idVenta");
//   var nuevoEstado = $(this).attr("nuevoEstado");
//   var estadoActual = $(this).attr("estadoActual");

//   var datos = new FormData();
//   datos.append("activaid", idVenta);
//   datos.append("activarEstado", nuevoEstado);

//   $.ajax({
//     url: "ajax/ventas.ajax.php",
//     method: "POST",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     success: function(respuesta){
//     	if(respuesta == "ok"){
// 				Swal.fire({
// 				type: "success",
// 				title: "¡El estado ha sido cambiado correctamente!",
// 				showConfirmButton: true,
// 				confirmButtonText: "Cerrar"
// 				}).then(function(result){
// 				if(result.value){
// 				// Recargar la página
// 				window.location.reload();
// 				}
// 				});
// 				}
// 					}
// 					})

// 					if(estadoActual == "activa"){
// 					$(this).removeClass('btn-success');
// 					$(this).addClass('btn-warning');
// 					$(this).html('Pendiente');
// 					$(this).attr('estadoActual', 'pendiente');
// 					} else if(estadoActual == "pendiente"){
// 					$(this).removeClass('btn-warning');
// 					$(this).addClass('btn-danger');
// 					$(this).html('Anulada');
// 					$(this).attr('estadoActual', 'anulada');
// 					} else {
// 					$(this).addClass('btn-success');
// 					$(this).removeClass('btn-danger');
// 					$(this).html('Activa');
// 					$(this).attr('estadoActual', 'activa');
// 					}
// 					})


/*=============================================
carga de datos para nuevo agrupar ventas 
=============================================*/


// function validarFecha($fecha){
//     $regex = '/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/';
//     return preg_match($regex, $fecha);
// }


/*=============================================
Cargar facturas PDF
=============================================*/