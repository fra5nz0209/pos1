<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Editar Venta Interna
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Editar Venta Interna</li>
            </ol>
          </div>
        </div>
      </div>

      <!-- /.container-fluid -->
    </section>

<!-- Main content -->
    <section class="content">

      <div class="row">
        <!--=====================================
        EL FORMULARIO
        ======================================-->
  
       <div class="col-lg-5 col-xs-12">

        <div class="card card-success">

          <div class="card-header with-border"></div>

          <form role="form" method="post" class="formularioVentaInterna">

           <div class="card-body">

              <div class="card">

                <?php

                    $item = "id";
                    $valor = $_GET["idVenta"];

                    $venta = ControladorVentasi::ctrMostrarVentas($item, $valor);

                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];

                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    // $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"];


                ?>

                 <!--=====================================
                  ENTRADA DEL CODIGO DE FACTURA   COLOCAR QUE LA FACTURA SEA UNICA !!!!!!!!! OBSERVACIONES 1 
                  ======================================-->

                  <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                    
                    <input type="text" class="form-control" id="nuevaVenta" name="editarVentai" value="<?php echo $venta["codigo"]; ?>"  required>
                    
                  </div>

                </div>

                  <!--=====================================
                  ENTRADA PARA EDITAR FECHA
                  ======================================-->

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      <input type="date" class="form-control" id="nuevaFecha" name="editarFecha" value="<?php echo date("Y-m-d", strtotime($venta["fechaventa"])); ?>">
                    </div>
                  </div>


                   <!--=====================================
                  ENTRADA DEL CLIENTE
                  ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-users"></i></span>

                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                      <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>

                      <span class="input-group-text"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>
     
                  </div>

                </div>

                  <!--=====================================
                  ENTRADA PARA EL NUMERO DE CARGA 
                  ======================================-->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-text"><i class="fa fa-number"></i></span>
                      
                      <input type="text" class="form-control" id="nuevaCarga" name="editarCarga" value="<?php echo $venta["carga"]; ?>" required>
                      
                    </div>

                  </div>






                  <!--=====================================
                  ENTRADA DEL VENDEDOR
                  ======================================-->


                  <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-user"></i></span>

                    <select class="form-control" id="nuevoVendedor" name="nuevoVendedor" required>

                      <option value="<?php echo $vendedor["id"]; ?>"><?php echo $vendedor["nombre"]; ?></option>
                     

                      <?php 
                        $item = null;
                        $valor = null;

                        $categorias = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                        foreach ($categorias as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        }


                       ?>

                    </select>

                    
                                    
                  </div>

                </div>

<!--                 <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-user"></i></span>

 
                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>">

                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">
                                    
                  </div>

                </div> -->


                 
                  <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
                  ======================================-->

                  <div class="form-group row nuevoProducto">

                    <?php

                $listaProducto = json_decode($venta["productos"], true);

                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";

                   $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                  
                  echo '<div class="row" style="padding:5px 15px">
            
                        <div class="col-sm-6" style="padding-right:0px">
            
                          <div class="input-group">
                
                            <span class="input-group-text"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                            <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>

                          </div>

                        </div>

                        <!--CANIDAD DEL PRODUCTO -->

                        <div class="col-sm-3">
              
                          <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>

                        </div>

                        <!-- PRECIO DEL PRODUCTO -->


                        <div class="col-sm-3 ingresoPrecio" style="padding-left:0px">

                          <div class="input-group">

                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                   
                            <input type="text" class="form-control nuevoPrecioProducto"  name="nuevoPrecioProducto" value="'.$value["precio"].'"  required>

                            </div>
                            </div>

                            <!-- TOTAL DEL PRODUCTO -->

                          <div class="col-sm-3 ingresoTotal" style="padding-left:0px">
                          <input type="text" class="form-control nuevoTotalProducto" name="nuevoTotalProducto" value="'.$value["totala"].'" readonly required>
                          </div>

                        <!-- DESCUENTO DEL PRODUCTO -->

                                <div class="col-sm-3 ingresoDescuento" style="padding-left:0px">
                         <div class="input-group">

                         <input type="text" min="0" class="form-control nuevoDescuentoProducto" name="nuevoDescuentoProducto" value="'.$value["descuento"].'" required>
                         <span class="input-group-text"><i class="fas fa-percent"></i></span>

                         </div>
                         </div>

                        <!-- TOTAL DEL PRODUCTO CON DESCUENTO -->

                        <div class="col-sm-3 ingresoTotalConDescuento" style="padding-left:0px">
                        <input type="text" class="form-control nuevoTotalProductoConDescuento" name="nuevoTotalProductoConDescuento" value="'.$value["total"].'" readonly required>
                          </div>

   
                          

                      </div>';
                }


                ?>
                  
                  </div>

                  <input type="hidden" id="listaProductos" name="listaProductos">


                  <hr>

                  <div class="row">

                  <!--=====================================
                  ENTRADA  TOTAL
                  ======================================-->
                    
                    <div class="col-sm-8 pull-right">
                      
                      <table class="table">
                        
                        <thead>
                          <tr>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <tr>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-dollar-usd"></i></span>

                              <input type="number" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["total"]; ?>" value="<?php echo $venta["total"]; ?>" readonly required>

                              <input type="hidden" name="totalVenta" value="<?php echo $venta["total"]; ?>" id="totalVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                        </tbody>
                      </table>

                    </div>
                  </div>

                  <hr>
              

              </div>
      
          </div>

              <div class="card-footer">

                <button type="submit" class="btn btn-primary pull-right">Guardar Venta</button>
                

              </div>

        </form>

        <?php

          $editarVentai = new ControladorVentasi();
          $editarVentai -> ctrEditarVenta();
          
        ?> 

        </div>
         
       </div>
        <!--=====================================
        TABLA DE PRODUCTOS
        ======================================-->

        <div class="col-lg-7 hidden-md hidden-xs hidden-sm">

          <div class="card card-warning">

            <div class="card-header with-border"></div>

            <div class="card-body">

              <table id="example1" class="table table-bordered table-hover dt-responsive tablaVentasi tbody">

                <thead>
                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Acciones</th>

                  </tr>

                </thead>
 
              </table>
              
            </div>

          </div>
          
        </div>

      </div>



    </section>
   <!-- /.content-wrapper -->
  </div>


<!--=====================================
MODAL AGREGAR  CLIENTE
======================================-->


<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->


        <div class="modal-header" style="background:#3c8dbc; color:white">

        <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        </div>

        <!-- /.  CUERP DEL MODAL  -->
       <div class="modal-body">

        <div class="box-body">

             <!-- /.  ENTRADA PARA CODIGO  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="number" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" required>
            </div>
          </div>


            <!-- /.  ENTRADA PARA NOMBRE  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar Nombre" required>
            </div>
          </div>


            <!-- /.  ENTRADA PARA DIRECCION  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar Direccion" required>
            </div>
          </div>


            <!-- /.  ENTRADA PARA REFERENCIA  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input type="text" class="form-control input-lg" name="nuevaReferencia" placeholder="Ingresar Referencia" required>
            </div>
          </div>


            <!-- /.  ENTRADA PARA CELULAR  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" class="form-control input-lg" name="nuevoCelular" placeholder="Ingresar Celular" data-inputmask="'mask':'999-999-99'" data-mask required>
            </div>
          </div>
 


            <!-- /.  ENTRADA PARA NIT/CI  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="number" class="form-control input-lg" name="nuevoNit" placeholder="Ingresar CI/NIT" required>
            </div>
          </div>

            

        </div>
       </div>
      

     <!-- /.  PIE DE MODAL  -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar Cliente</button>
      </div>

  

      <?php   

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();




       ?>

    </form> 



    </div>

  </div>

</div>
  









