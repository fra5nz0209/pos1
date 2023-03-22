<?php

use thiagoalessio\TesseractOCR\src\TesseractOCR;
             
class ControladorFacturas{
static public function ctrProcesarFactura(){
$respuesta = "";
if(isset($_FILES["factura"]["tmp_name"])){
$archivo = $_FILES["factura"]["tmp_name"];
$extension = pathinfo($_FILES["factura"]["name"], PATHINFO_EXTENSION);
if($extension == "pdf"){
    $tesseract = new TesseractOCR();
    $text = $tesseract->recognize($archivo);
    echo "<pre>";
    print_r($text);
    echo "</pre>";
}else{
    $respuesta = "Solo se permiten archivos pdf";
}
}
return $respuesta;
}
}