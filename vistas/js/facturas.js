        // //Agrega el evento "submit" al formulario
        // var formulario = document.getElementsByTagName("form")[0];
        // formulario.addEventListener("submit", procesarFactura);

        // //Función para procesar la factura
        // function procesarFactura(e){
        // e.preventDefault();
        // //Valida que se haya seleccionado un archivo
        // if(document.getElementsByName("factura")[0].files.length == 0){
        //     document.getElementById("error").innerHTML = "Selecciona un archivo";
        //     return;
        // }

        // //Envía el formulario al servidor
        // var formData = new FormData(formulario);

        // var xhr = new XMLHttpRequest();
        // xhr.open("POST", "facturas.controlador.php", true);
        // xhr.onload = function(){
        //     if(this.status === 200){
        //         //Muestra el contenido del PDF en pantalla
        //         document.getElementById("contenidoPdf").innerHTML = this.responseText;
        //     }else{
        //         document.getElementById("error").innerHTML = "Error al procesar la factura";
        //     }
        // }
        // xhr.send(formData);
        // }