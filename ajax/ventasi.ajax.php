<?php 

// // Importar los controladores y modelos necesarios
// require_once "../modelos/ventasi.modelo.php";

// // Crear la clase AJAX
// class ajaxVentas {

//   public $activarEstado; 
//   public $activaid;
 

//     public function ajaxCambiarEstado(){



//         $tabla = "ventasi";

//         $item1 = "estado";

//         $valor1 = $this->activarEstado;

//         $item2 = "id";

//         $valor2 = $this->activaid;


//         $respuesta = ModeloVentasi::mdlActualizarVenta($tabla, $item1, $valor1, $item2, $valor2);

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
