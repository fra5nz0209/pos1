<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/compras.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/ventasi.controlador.php";


require_once "vendor/autoload.php";

set_include_path(get_include_path() . PATH_SEPARATOR . 'vendor');


require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/compras.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/ventasi.modelo.php";



$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();

 
 