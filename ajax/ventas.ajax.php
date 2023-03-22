<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../modelos/productos.modelo.php";

class AjaxVentas{

    /*=============================================
    ACTUALIZAR VENTA
    =============================================*/

    public $id;
    public $estado;
    

    public function ajaxActualizarVenta(){

        $datos = array("id" => $this->id,
                       "estado" => $this->estado);

        $respuesta = ControladorVentas::ctrActualizarVenta($datos);

        echo $respuesta;

        

    }



     /*=============================================
    ACTUALIZAR VENTA CUENTAS
    =============================================*/
   
    public $cuenta;
    public $idc;


    public function ajaxActualizarCuenta(){

        $tabla = "ventas";
        $item = "cuentas";
        $id = $this->idc;

        $valor = $this->cuenta;

        $respuesta = ControladorVentas::ctrActualizarCuenta($tabla, $item, $valor, $id);

        echo $respuesta;

    }

}
    
/*=============================================
ACTUALIZAR VENTA
=============================================*/

if(isset($_POST["id"])){

    $venta = new AjaxVentas();
    $venta -> id = $_POST["id"];
    $venta -> estado = $_POST["estado"];
    $venta -> ajaxActualizarVenta();

}

/*=============================================
ACTUALIZAR CUENTA
=============================================*/
if(isset($_POST["cuenta"])){

    $cuenta = new AjaxVentas();
    $cuenta -> idc = $_POST["idc"];
    $cuenta -> cuenta = $_POST["cuenta"];
    $cuenta -> ajaxActualizarCuenta();

}

// <?php

// require_once "../controladores/ventas.controlador.php";
// require_once "../modelos/ventas.modelo.php";
// require_once "../modelos/productos.modelo.php";

// class AjaxVentas{

//     /*=============================================
//     ACTUALIZAR VENTA
//     =============================================*/

//     public $id;
//     public $estado;
//     public $productos;

//     public function ajaxActualizarVenta(){

//         $datos = array("id" => $this->id,
//                        "estado" => $this->estado,
//                        "productos" => $this->productos);

//         $respuesta = ControladorVentas::ctrActualizarVenta($datos);

//         echo $respuesta;

//     }

// }

// /*=============================================
// ACTUALIZAR VENTA
// =============================================*/

// if(isset($_POST["id"])){

//     $venta = new AjaxVentas();
//     $venta -> id = $_POST["id"];
//     $venta -> estado = $_POST["estado"];
//     $venta -> productos = $_POST["productos"];
//     $venta -> ajaxActualizarVenta();

// }







// // Importar los controladores y modelos necesarios
// require_once "../modelos/ventas.modelo.php";
// require_once "../modelos/productos.modelo.php";


// class ajaxVentas {

//   public $activarEstado; 
//   public $activaid;

//   public function ajaxCambiarEstado(){

//     // Obtener el estado actual de la venta
//     $venta = ModeloVentas::mdlMostrarVentas("ventas", $this->activaid, "id");
//     $estadoActual = $venta["estado"];

//     // Si la venta está cambiando de estado "Activa" a otro estado
//     if ($estadoActual != "activa" && $this->activarEstado == "activa") {

//         // Obtener el detalle de la venta
//         $detalle = ModeloVentas::mdlMostrarDetalleVenta($this->activaid);

//         foreach ($detalle as $key => $value) {

//             // Obtener la cantidad de productos vendidos
//             $cantidadVendida = $value["cantidad"];

//             // Obtener el id del producto
//             $productoId = $value["id_producto"];

//             // Obtener el stock actual del producto
//             $producto = ModeloProductos::mdlMostrarProducto("productos", $productoId, "id");
//             $stock = $producto["stock"];

//             // Restar el stock
//             $nuevoStock = $stock - $cantidadVendida;
//             ModeloProductos::mdlActualizarProducto("productos", "stock", $nuevoStock, "id", $productoId);

//         }

//     }

//     // Si la venta está cambiando a estado "Activa" desde otro estado
//     if ($estadoActual == "activa" && $this->activarEstado != "activa") {

//         // Obtener el detalle de la venta
//         $detalle = ModeloVentas::mdlMostrarDetalleVenta($this->activaid);

//         foreach ($detalle as $key => $value) {

//             // Obtener la cantidad de productos vendidos
//             $cantidadVendida = $value["cantidad"];

//             // Obtener el id del producto
//             $productoId = $value["id_producto"];

//             // Obtener el stock actual del producto
//             $producto = ModeloProductos::mdlMostrarProducto("productos", $productoId, "id");
//             $stock = $producto["stock"];

//             // Devolver el stock
//             $nuevoStock = $stock + $cantidadVendida;
//             ModeloProductos::mdlActualizarProducto("productos", "stock", $nuevoStock, "id", $productoId);

//         }

//     }

//     // Actualizar el estado de la venta
//     $tabla = "ventas";

//     $dato = "estado";
//     $valor = $this->activarEstado;
//     $respuesta = ModeloVentas::mdlActualizarVenta($tabla, $dato, $valor, "id", $this->activaid);

//       echo $respuesta;

//       }

// }



// // Activar la instancia de la clase ajaxVentas
// $activarEstado = new ajaxVentas();
// $activarEstado -> activarEstado = $_POST["estado"];
// $activarEstado -> activaid = $_POST["id"];
// $activarEstado -> ajaxCambiarEstado();













// // Importar los controladores y modelos necesarios
// require_once "../modelos/ventas.modelo.php";

// // Crear la clase AJAX
// class ajaxVentas {

//   public $activarEstado; 
//   public $activaid;
 

//     public function ajaxCambiarEstado(){



//         $tabla = "ventas";

//         $item1 = "estado";

//         $valor1 = $this->activarEstado;

//         $item2 = "id";

//         $valor2 = $this->activaid;


//         $respuesta = ModeloVentas::mdlActualizarVenta($tabla, $item1, $valor1, $item2, $valor2);

//         echo $respuesta;   

       
//         }


//     }

// /*=============================================
// =            CAMBIAR ESTADO VENTA             =
// =============================================*/

// if(isset($_POST["activarEstado"])){

//     $activarEstado = new ajaxVentas();
//     $activarEstado -> activarEstado = $_POST["activarEstado"];
//     $activarEstado -> activaid = $_POST["activaid"];
//     $activarEstado -> ajaxCambiarEstado();

// }
