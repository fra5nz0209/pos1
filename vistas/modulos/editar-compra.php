<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Editar Compra

            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Editar Compra</li>
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

          <form role="form" method="post" class="formularioCompra">

           <div class="card-body">

              <div class="card">


                <?php

                    $item = "id";
                    $valor = $_GET["idCompra"];

                    $venta = ControladorCompras::ctrMostrarCompras($item, $valor);

                    

                ?>


                <!--=====================================
                  ENTRADA PARA LOS DATOS DE COMPRA  
                  ======================================-->

                <!-- ENTRADA PARA EL CODIGO  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                      <input type="text" class="form-control" id="nuevaCompra" name="editarCompra" value="<?php echo $venta["codigo"]; ?>"  required>
                    </div>
                  </div>

                  <!-- ENTRADA ORIGEN -->

                  <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-truck"></i></span>
                    
                    <input type="text" class="form-control" id="nuevoOrigen" name="editarOrigen" value="<?php echo $venta["origen"]; ?>" placeholder="Ingrese el Origen de la carga" required>
                    
                  </div>

                </div>



                    <!-- ENTRADA PARA LA FECHA  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      <input type="date" class="form-control" id="nuevaFecha" name="editarFecha"value="<?php echo date('Y-m-d'); ?>">
                    </div>
                  </div>

                   <!-- ENTRADA PARA EL VEHICULO  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-truck"></i></span>
                      <input type="text" class="form-control" id="nuevoVehiculo" name="editarVehiculo" value="<?php echo $venta["vehiculo"]; ?>" placeholder="Ingrese el Nombre del Vehiculo" required>
                    </div>
                  </div>

                  <!-- ENTRADA PARA LA PLACA  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-indent"></i></span>
                      <input type="text" class="form-control" id="nuevaPlaca" name="editarPlaca" value="<?php echo $venta["placa"]; ?>" placeholder="Ingrese el numero de la Placa" required>
                    </div>
                  </div>

                  <!-- ENTRADA PARA PROPIETARIO  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" id="nuevoPropietario" name="editarPropietario" value="<?php echo $venta["propietario"]; ?>" placeholder="Ingrese el Nombre del propietario" required>
                    </div>
                  </div>

                  <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
                  ======================================-->

                  <div class="form-group row nuevoProductoCompra">

                    <?php

                $listaCompras = json_decode($venta["productosc"], true);

                foreach ($listaCompras as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";

                   $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguoC = $respuesta["stock"] - $value["cantidad"];

                   echo '<div class="row" style="padding:5px 15px">

          <!-- DESCRIPCION DEL PRODUCTO -->
                    
                    <div class="col-sm-6" style="padding-right: 0px">
                      
                      <div class="input-group">
                        
                        <span class="input-group-addon"><button type="button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                        <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>


                      </div>

                    </div>

                    <!--CANIDAD DE PALETS -->

                    <div class="col-sm-2" ingresoPalets>

                      <div class="input-group">
                      
                      <input type="text" class="form-control paletsActual" name="paletsActual"  value="'.$respuesta["palets"].'" readonly>
                      </div>
                     </div>

                    <!--CANIDAD DEL PRODUCTO -->

                    <div class="col-sm-2 ingresoCantidad">
                      
                      <input type="number" class="form-control nuevaCantidadProductoC"  name="nuevaCantidadProductoC" min="1" value="'.$value["cantidad"].'" palets="'.$respuesta["palets"].'" stock="'.$stockAntiguoC.'" nuevoStock="'.$value["stock"].'" required>
                    </div>
                    

                    <!--TOTAL DE COMPRA  -->

                    <div class="col-sm-2 totalPedido">
                      
                      <input type="number" class="form-control nuevoPedido"  name="nuevoPedido" value="'.$value["total"].'" readonly required>
                    </div>

                    </div>';

                      }

                ?>
            
                  </div>

                  <input type="hidden" id="listaCompras" name="listaCompras">

                  <hr>

                  <div class="row">

                  <!--=====================================
                  ENTRADA TOTAL PALET
                  ======================================-->
                    
                    <div class="col-sm-8 pull-right">
                      
                      <table class="table">
                        
                        <thead>
                          <tr>
                            <th>Total de Palets</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <tr>
                            

                            <td style="width: 50%">
                              
                              <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-cart-plus"></i></span>

                                <input type="number" min="1" class="form-control input-lg"  id="nuevoTotalCompra" name="nuevoTotalCompra" totalC="<?php echo $venta["totalcompra"]; ?>" value="<?php echo $venta["totalcompra"]; ?>" readonly required>

                                <input type="hidden" name="totalCompra" value="<?php echo $venta["totalcompra"]; ?>" id="totalCompra">
                                
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

          $guardarVenta = new ControladorCompras();
          $guardarVenta -> ctrEditarCompra();
          
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

              <table id="example1" class="table table-bordered table-hover dt-responsive tablaCompras tbody">

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


  









