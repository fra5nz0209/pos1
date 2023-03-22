
<?php
require "C:/xampp/htdocs/pos1/controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require "C:/xampp/htdocs/pos1/controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require "C:/xampp/htdocs/pos1/controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


if (isset($_POST["procesar_excel"])) {
    //validar el tipo de archivo y su tamaño
    $allowed = array("xls", "xlsx");
    $maxSize = 5 * 1024 * 1024; //5MB
    $file = $_FILES["excel_file"];
    $fileName = $file["name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];
    $fileType = $file["type"];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

    if (!in_array($fileExt, $allowed)) {
        echo "Solo se permiten archivos .xls y .xlsx.";
    } else if ($fileError !== UPLOAD_ERR_OK) {
        echo "Error al subir el archivo.";
    } else if ($fileSize > $maxSize) {
        echo "El archivo no debe ser mayor a 5MB.";
    } else {
        //subir archivo a la carpeta temporal
        $tempFile = $file["tmp_name"];
        //leer el archivo de excel
        $spreadsheet = IOFactory::load($tempFile);
        //obtener la hoja de calculo activa
        $worksheet = $spreadsheet->getActiveSheet();
        //obtener el numero de filas
        $rows = $worksheet->getHighestRow();

        //arreglo para almacenar las ventas
        $ventas = array();
        //variable para almacenar el número de factura actual
        $noActual = "";
        //arreglo para almacenar los detalles de la venta
        $detalles = array();
        //arreglo temporal para almacenar la venta actual
        $ventaActual = array();

    for ($i = $rows; $i >= 2; $i--) {
            //obtener el valor de la columna No
            $no = $worksheet->getCell("A" . $i)->getValue();


            //abrir conexión a la base de datos
             $link = Conexion::conectar();

            //verificar si el número de factura ya existe en la base de datos
            $stmt = $link->prepare("SELECT codigo FROM ventas WHERE codigo = :codigo");
            $stmt->bindParam(":codigo", $no, PDO::PARAM_STR);
            $stmt->execute();
            $facturaExiste = $stmt->fetchColumn();
            if($facturaExiste){

                 echo "<script>

                    swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'La factura con el número' + $no + 'ya existe en la base de datos.'
                        });
                        </script>";

            }else{

             //verificar si cambió el número de factura
        if ($no != $noActual) {
            //si cambió el número de factura, guardar la venta en el arreglo de ventas
            if (!empty($detalles)) {
                $ventaActual["no"] = $noActual;
                $ventaActual["fecha"] = $fechaActual;
                $ventaActual["id_cliente"] = $id_clienteActual;
                $ventaActual["carga"] = $cargaActual;
                $ventaActual["id_vendedor"] = $id_vendedorActual;
                $ventaActual["totalf"] = $totalfActual;
                $ventaActual["detalles"] = $detalles;
                $ventas[] = $ventaActual;
            }
            //limpiar arreglo temporal
            $ventaActual = array();
            $detalles = array();
            //obtener fecha
            $fechaActual = $worksheet->getCell("B" . $i)->getValue();
            //obtener id_cliente
            $codigo_cliente = $worksheet->getCell("C" . $i)->getValue();
            $cliente = ControladorClientes::ctrMostrarClientes("codigo", $codigo_cliente);
            $id_clienteActual = $cliente["id"];
            //obtener carga
            $cargaActual = explode("-", $worksheet->getCell("D" . $i)->getValue())[1];
            //obtener id_vendedor
            $codigo_vendedor = $worksheet->getCell("E" . $i)->getValue();
            $vendedor = ControladorUsuarios::ctrMostrarUsuarios("nombre", $codigo_vendedor);
            $id_vendedorActual = $vendedor["id"];
            //obtener totalf
            $totalfActual = $worksheet->getCell("F" . $i)->getValue();
            $noActual = $no;
        }

            //obtener id del producto
            $codigo_producto = $worksheet->getCell("G" . $i)->getValue();
            $orden = "id";
            $producto = ControladorProductos::ctrMostrarProductos("descripcion", $codigo_producto, $orden);
            $idProducto = $producto["id"];
            $stock_inicial = $producto["stock"];

            //obtener descripcion, cantidad, precio, descuento y total
            $descripcion = $producto["descripcion"];
            $cantidad = $worksheet->getCell("H" . $i)->getValue();
            $precio = $worksheet->getCell("J" . $i)->getValue();
            $totala = $worksheet->getCell("K" . $i)->getValue();
            $descuento = $worksheet->getCell("L" . $i)->getValue();
            $total = $worksheet->getCell("M" . $i)->getValue();

        
        
            //calcular nuevo stock y actualizar en la base de datos
            $nuevoStock = $stock_inicial - $cantidad;
            $actualizarStock = ModeloProductos::mdlActualizarStockProductoM("productos", $nuevoStock, $idProducto);

        if($actualizarStock == "ok"){
            //almacenar el detalle de la venta
            $detalle = array(
            "id" => $idProducto,
            "descripcion" => $descripcion,
            "cantidad" => $cantidad,
            "stock_inicial" => $stock_inicial,
            "stock" => $nuevoStock,
            "precio" => $precio,
            "totala" => $totala,
            "descuento" => $descuento,
            "total" => $total
            );
            $detalles[] = $detalle;
            }else{
                echo"error al actualizarStock";
            }

            }
    }



        //guardar la última venta en el arreglo de ventas
            if (!empty($detalles)) {
            $ventaActual["no"] = $noActual;
            $ventaActual["fecha"] = date("Y-m-d", strtotime(str_replace("/", "-", $fechaActual)));
            $ventaActual["id_cliente"] = $id_clienteActual;
            $ventaActual["carga"] = $cargaActual;
            $ventaActual["id_vendedor"] = $id_vendedorActual;
            $ventaActual["totalf"] = $totalfActual;
            $ventaActual["detalles"] = $detalles;
            $ventas[] = $ventaActual;
            }

                //imprimir el arreglo de ventas
        echo "<pre>";
        print_r($ventas);
        echo "</pre>";
        //aquí puedes insertar las ventas y los detalles en las tablas correspondientes en tu base de datos

        //ciclo para insertar cada venta en la base de datos
        foreach ($ventas as $venta) {
            //verificar si el número de factura ya existe en la base de datos
            $link = Conexion::conectar();

            $stmt = $link->prepare("SELECT codigo FROM ventas WHERE codigo = :codigo");
            $stmt->bindParam(":codigo", $venta["no"], PDO::PARAM_STR);
            $stmt->execute();
            $facturaExiste = $stmt->fetchColumn();
                if($facturaExiste){
                    echo "La factura con el número " . $venta["no"] . " ya existe en la base de datos. <br>";
                    continue;
                }
            //crear una conexion a la base de datos
            $estado = "activa";    
            $link = Conexion::conectar();
            //preparar la consulta
            $stmt = $link->prepare("INSERT INTO ventas (codigo, fechaventa, id_cliente, carga, id_vendedor, productos, total, estado) VALUES (:codigo, :fechaventa, :id_cliente, :carga, :id_vendedor, :productos, :total, :estado)");
            //bindear los parametros
            $stmt->bindParam(":codigo", $venta["no"], PDO::PARAM_STR);
            $stmt->bindParam(":fechaventa", $venta["fecha"], PDO::PARAM_STR);
            $stmt->bindParam(":id_cliente", $venta["id_cliente"], PDO::PARAM_INT);
            $stmt->bindParam(":carga", $venta["carga"], PDO::PARAM_STR);
            $stmt->bindParam(":id_vendedor", $venta["id_vendedor"], PDO::PARAM_INT);
            $stmt->bindParam(":total", $venta["totalf"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
            $detalles_venta = json_encode($venta["detalles"]);
            $stmt->bindParam(":productos", $detalles_venta, PDO::PARAM_STR);
            //ejecutar la consulta
            $stmt->execute();
            //verificar si el stock de algún producto es menor a la cantidad vendida
            foreach ($venta["detalles"] as $detalle) {
            $link = Conexion::conectar();    
            $stmt = $link->prepare("SELECT stock FROM productos WHERE id = :id");
            $stmt->bindParam(":id", $detalle["id"], PDO::PARAM_INT);
            $stmt->execute();
            $stock = $stmt->fetchColumn();
                if($stock < $detalle["cantidad"]){
                echo "El stock del producto " . $detalle["descripcion"] . " es menor a la cantidad vendida. <br>";
                }
            }
        }
            echo "Ventas procesadas exitosamente";
    }

}
              











// <?php
// require "C:/xampp/htdocs/pos1/controladores/clientes.controlador.php";
// require_once "../modelos/clientes.modelo.php";
// require "C:/xampp/htdocs/pos1/controladores/usuarios.controlador.php";
// require_once "../modelos/usuarios.modelo.php";
// require "C:/xampp/htdocs/pos1/controladores/productos.controlador.php";
// require_once "../modelos/productos.modelo.php";
// require "../vendor/autoload.php";

// use PhpOffice\PhpSpreadsheet\IOFactory;

// if (isset($_POST["procesar_excel"])) {
//     //validar el tipo de archivo y su tamaño
//     $allowed = array("xls", "xlsx");
//     $maxSize = 5 * 1024 * 1024; //5MB
//     $file = $_FILES["excel_file"];
//     $fileName = $file["name"];
//     $fileError = $file["error"];
//     $fileSize = $file["size"];
//     $fileType = $file["type"];
//     $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

//     if (!in_array($fileExt, $allowed)) {
//         echo "Solo se permiten archivos .xls y .xlsx.";
//     } else if ($fileError !== UPLOAD_ERR_OK) {
//         echo "Error al subir el archivo.";
//     } else if ($fileSize > $maxSize) {
//         echo "El archivo no debe ser mayor a 5MB.";
//     } else {
//         //subir archivo a la carpeta temporal
//         $tempFile = $file["tmp_name"];
//         //leer el archivo de excel
//         $spreadsheet = IOFactory::load($tempFile);
//         //obtener la hoja de calculo activa
//         $worksheet = $spreadsheet->getActiveSheet();
//         //obtener el numero de filas
//         $rows = $worksheet->getHighestRow();

//         //arreglo para almacenar las ventas
//         $ventas = array();
//         //variable para almacenar el número de factura actual
//         $noActual = "";
//         //arreglo para almacenar los detalles de la venta
//         $detalles = array();
//         //arreglo temporal para almacenar la venta actual
//         $ventaActual = array();

//         for ($i = $rows; $i >= 2; $i--) {
//             //obtener el valor de la columna No
//             $no = $worksheet->getCell("A" . $i)->getValue();

//              //verificar si cambió el número de factura
//         if ($no != $noActual) {
//             //si cambió el número de factura, guardar la venta en el arreglo de ventas
//             if (!empty($detalles)) {
//                 $ventaActual["no"] = $noActual;
//                 $ventaActual["fecha"] = $fechaActual;
//                 $ventaActual["id_cliente"] = $id_clienteActual;
//                 $ventaActual["carga"] = $cargaActual;
//                 $ventaActual["id_vendedor"] = $id_vendedorActual;
//                 $ventaActual["totalf"] = $totalfActual;
//                 $ventaActual["detalles"] = $detalles;
//                 $ventas[] = $ventaActual;
//             }
//             //limpiar arreglo temporal
//             $ventaActual = array();
//             $detalles = array();
//             //obtener fecha
//             $fechaActual = $worksheet->getCell("B" . $i)->getValue();
//             //obtener id_cliente
//             $codigo_cliente = $worksheet->getCell("C" . $i)->getValue();
//             $cliente = ControladorClientes::ctrMostrarClientes("codigo", $codigo_cliente);
//             $id_clienteActual = $cliente["id"];
//             //obtener carga
//             $cargaActual = explode("-", $worksheet->getCell("D" . $i)->getValue())[1];
//             //obtener id_vendedor
//             $codigo_vendedor = $worksheet->getCell("E" . $i)->getValue();
//             $vendedor = ControladorUsuarios::ctrMostrarUsuarios("nombre", $codigo_vendedor);
//             $id_vendedorActual = $vendedor["id"];
//             //obtener totalf
//             $totalfActual = $worksheet->getCell("F" . $i)->getValue();
//             $noActual = $no;
//         }

//         //obtener id del producto
//         $codigo_producto = $worksheet->getCell("G" . $i)->getValue();
//         $orden = "id";
//         $producto = ControladorProductos::ctrMostrarProductos("descripcion", $codigo_producto, $orden);
//         $idProducto = $producto["id"];
//         $stock_inicial = $producto["stock"];

//         //obtener descripcion, cantidad, precio, descuento y total
//         $descripcion = $producto["descripcion"];
//         $cantidad = $worksheet->getCell("H" . $i)->getValue();
//         $precio = $worksheet->getCell("J" . $i)->getValue();
//         $totala = $worksheet->getCell("K" . $i)->getValue();
//         $descuento = $worksheet->getCell("L" . $i)->getValue();
//         $total = $worksheet->getCell("M" . $i)->getValue();
        
//         //calcular nuevo stock y actualizar en la base de datos
//         $nuevoStock = $stock_inicial - $cantidad;
//         $actualizarStock = ModeloProductos::mdlActualizarStockProductoM("productos", $nuevoStock, $idProducto);

//         if($actualizarStock == "ok"){
//         //almacenar el detalle de la venta
//         $detalle = array(
//         "id" => $idProducto,
//         "descripcion" => $descripcion,
//         "cantidad" => $cantidad,
//         "stock_inicial" => $stock_inicial,
//         "stock" => $nuevoStock,
//         "precio" => $precio,
//         "totala" => $totala,
//         "descuento" => $descuento,
//         "total" => $total
//         );
//         $detalles[] = $detalle;
//         }else{
//             echo"error al actualizarStock";
//         }
//         }
//         //guardar la última venta en el arreglo de ventas
//         if (!empty($detalles)) {
//         $ventaActual["no"] = $noActual;
//         $ventaActual["fecha"] = $fechaActual;
//         $ventaActual["id_cliente"] = $id_clienteActual;
//         $ventaActual["carga"] = $cargaActual;
//         $ventaActual["id_vendedor"] = $id_vendedorActual;
//         $ventaActual["totalf"] = $totalfActual;
//         $ventaActual["detalles"] = $detalles;
//         $ventas[] = $ventaActual;
//         }

//                 //imprimir el arreglo de ventas
//         echo "<pre>";
//         print_r($ventas);
//         echo "</pre>";
//         //aquí puedes insertar las ventas y los detalles en las tablas correspondientes en tu base de datos

//         //ciclo para insertar cada venta en la base de datos
//         foreach ($ventas as $venta) {
//             //verificar si el número de factura ya existe en la base de datos
//             $link = Conexion::conectar();

//             $stmt = $link->prepare("SELECT codigo FROM ventas WHERE codigo = :codigo");
//             $stmt->bindParam(":codigo", $venta["no"], PDO::PARAM_STR);
//             $stmt->execute();
//             $facturaExiste = $stmt->fetchColumn();
//             if($facturaExiste){
//                 echo "La factura con el número " . $venta["no"] . " ya existe en la base de datos. <br>";
//                 continue;
//             }
//             //crear una conexion a la base de datos
//             $link = Conexion::conectar();
//             //preparar la consulta
//             $stmt = $link->prepare("INSERT INTO ventas (codigo, fechaventa, id_cliente, carga, id_vendedor, productos, total) VALUES (:codigo, :fechaventa, :id_cliente, :carga, :id_vendedor, :productos, :total)");
//             //bindear los parametros
//             $stmt->bindParam(":codigo", $venta["no"], PDO::PARAM_STR);
//             $stmt->bindParam(":fechaventa", $venta["fecha"], PDO::PARAM_STR);
//             $stmt->bindParam(":id_cliente", $venta["id_cliente"], PDO::PARAM_INT);
//             $stmt->bindParam(":carga", $venta["carga"], PDO::PARAM_STR);
//             $stmt->bindParam(":id_vendedor", $venta["id_vendedor"], PDO::PARAM_INT);
//             $stmt->bindParam(":total", $venta["totalf"], PDO::PARAM_STR);
//             $detalles_venta = json_encode($venta["detalles"]);
//             $stmt->bindParam(":productos", $detalles_venta, PDO::PARAM_STR);
//             //ejecutar la consulta
//             $stmt->execute();
//             //verificar si el stock de algún producto es menor a la cantidad vendida
//             foreach ($venta["detalles"] as $detalle) {
//             $link = Conexion::conectar();    
//             $stmt = $link->prepare("SELECT stock FROM productos WHERE id = :id");
//             $stmt->bindParam(":id", $detalle["id"], PDO::PARAM_INT);
//             $stmt->execute();
//             $stock = $stmt->fetchColumn();
//             if($stock < $detalle["cantidad"]){
//             echo "El stock del producto " . $detalle["descripcion"] . " es menor a la cantidad vendida. <br>";
//             }
//             }
//             }
//             echo "Ventas procesadas exitosamente";
//             }

//             }
              

























/*=============================================
=            CODIGO YA FUNCIONANDO CON ID SOLO FALTA CAMBIO DE STOCK           =
=============================================*/




// <?php

// require "C:/xampp/htdocs/pos1/controladores/clientes.controlador.php";
// require_once "../modelos/clientes.modelo.php";
// require "C:/xampp/htdocs/pos1/controladores/usuarios.controlador.php";
// require_once "../modelos/usuarios.modelo.php";
// require "C:/xampp/htdocs/pos1/controladores/productos.controlador.php";
// require_once "../modelos/productos.modelo.php";
// require "../vendor/autoload.php";

// use PhpOffice\PhpSpreadsheet\IOFactory;

// if (isset($_POST["procesar_excel"])) {
//     //validar el tipo de archivo y su tamaño
//     $allowed = array("xls", "xlsx");
//     $maxSize = 5 * 1024 * 1024; //5MB
//     $file = $_FILES["excel_file"];
//     $fileName = $file["name"];
//     $fileError = $file["error"];
//     $fileSize = $file["size"];
//     $fileType = $file["type"];
//     $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

//     if (!in_array($fileExt, $allowed)) {
//         echo "Solo se permiten archivos .xls y .xlsx.";
//     } else if ($fileError !== UPLOAD_ERR_OK) {
//         echo "Error al subir el archivo.";
//     } else if ($fileSize > $maxSize) {
//         echo "El archivo no debe ser mayor a 5MB.";
//     } else {
//         //subir archivo a la carpeta temporal
//         $tempFile = $file["tmp_name"];
//         //leer el archivo de excel
//         $spreadsheet = IOFactory::load($tempFile);
//         //obtener la hoja de calculo activa
//         $worksheet = $spreadsheet->getActiveSheet();
//         //obtener el numero de filas
//         $rows = $worksheet->getHighestRow();

//         //arreglo para almacenar las ventas
//         $ventas = array();
//         //variable para almacenar el número de factura actual
//         $noActual = "";
//         //arreglo para almacenar los detalles de la venta
//         $detalles = array();
//         //arreglo temporal para almacenar la venta actual
//         $ventaActual = array();

//         for ($i = $rows; $i >= 2; $i--) {
//     //obtener el valor de la columna No
//     $no = $worksheet->getCell("A" . $i)->getValue();

//     //verificar si cambió el número de factura
//     if ($no != $noActual) {
//         //si cambió el número de factura, guardar la venta en el arreglo de ventas
//         if (!empty($detalles)) {
//             $ventaActual["no"] = $noActual;
//             $ventaActual["fecha"] = $fechaActual;
//             $ventaActual["id_cliente"] = $id_clienteActual;
//             $ventaActual["carga"] = $cargaActual;
//             $ventaActual["id_vendedor"] = $id_vendedorActual;
//             $ventaActual["totalf"] = $totalfActual;
//             $ventaActual["detalles"] = $detalles;
//             $ventas[] = $ventaActual;
//         }
//         //limpiar arreglo temporal
//         $ventaActual = array();
//         //obtener fecha
//         $fechaActual = $worksheet->getCell("B" . $i)->getValue();
//         //obtener id_cliente
//         $codigo_cliente = $worksheet->getCell("C" . $i)->getValue();
//         $cliente = ControladorClientes::ctrMostrarClientes("codigo", $codigo_cliente);
//         $id_clienteActual = $cliente["id"];
//         //obtener id_vendedor
//         $codigo_vendedor = $worksheet->getCell("E" . $i)->getValue();
//         $vendedor = ControladorUsuarios::ctrMostrarUsuarios("nombre", $codigo_vendedor);
//         $id_vendedorActual = $vendedor["id"];
//         //obtener totalf
//         $totalfActual = $worksheet->getCell("F" . $i)->getValue();
//         $cargaActual = explode("-", $worksheet->getCell("D" . $i)->getValue())[1];
//         $detalles = array();
//         $noActual = $no;
//         }
//         //obtener detalles de la venta
//         $descripcion = $worksheet->getCell("G" . $i)->getValue();
//         $orden = "id";
//         $producto = ControladorProductos::ctrMostrarProductos("descripcion", $descripcion, $orden);
//         $id_productoActual = $producto["id"];
//         $cantidad = $worksheet->getCell("H" . $i)->getValue();
//         $precio = $worksheet->getCell("J" . $i)->getValue();
//         $totala = $worksheet->getCell("K" . $i)->getValue();
//         $descuento = $worksheet->getCell("L" . $i)->getValue();
//         $total = $worksheet->getCell("M" . $i)->getValue();
//         $productos = array(
//         "id" => $id_productoActual,            
//         "descripcion" => $descripcion,
//         "cantidad" => $cantidad,
//         "precio" => $precio,
//         "totala" => $totala,
//         "descuento" => $descuento,
//         "total" => $total
//         );
//         $detalles[] = $productos;
//         }

//         //guardar la última venta en el arreglo de ventas
//         if (!empty($detalles)) {
//         $ventaActual["no"] = $noActual;
//         $ventaActual["fecha"] = $fechaActual;
//         $ventaActual["id_cliente"] = $id_clienteActual;
//         $ventaActual["carga"] = $cargaActual;
//         $ventaActual["id_vendedor"] = $id_vendedorActual;
//         $ventaActual["totalf"] = $totalfActual;
//         $ventaActual["detalles"] = $detalles;
//         $ventas[] = $ventaActual;
//         }

//         //imprimir el arreglo de ventas
//          echo "<pre>";
//         print_r($ventas);
//         echo "</pre>";

//         }
//         }





























