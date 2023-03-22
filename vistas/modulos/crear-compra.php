<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Crear Compra

            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Crear Compra</li>
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


                <!--=====================================
                  ENTRADA PARA LOS DATOS DE COMPRA  
                  ======================================-->

                <!-- ENTRADA PARA EL CODIGO  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                      <input type="text" class="form-control" id="nuevaCompra" name="nuevaCompra" placeholder="Ingrese el codigo de la compra">
                    </div>
                  </div>

                  <!-- ENTRADA ORIGEN -->

                  <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-truck"></i></span>
                    
                    <input type="text" class="form-control" id="nuevoOrigen" name="nuevoOrigen" placeholder="Ingrese el Origen de la carga" required>
                    
                  </div>

                </div>



                    <!-- ENTRADA PARA LA FECHA  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      <input type="date" class="form-control" id="nuevaFecha" name="nuevaFecha"value="<?php echo date('Y-m-d'); ?>">
                    </div>
                  </div>

                   <!-- ENTRADA PARA EL VEHICULO  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-truck"></i></span>
                      <input type="text" class="form-control" id="nuevoVehiculo" name="nuevoVehiculo" placeholder="Ingrese el Nombre del Vehiculo" required>
                    </div>
                  </div>

                  <!-- ENTRADA PARA LA PLACA  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-indent"></i></span>
                      <input type="text" class="form-control" id="nuevaPlaca" name="nuevaPlaca" placeholder="Ingrese el numero de la Placa" required>
                    </div>
                  </div>

                  <!-- ENTRADA PARA PROPIETARIO  -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" id="nuevoPropietario" name="nuevoPropietario" placeholder="Ingrese el Nombre del propietario" required>
                    </div>
                  </div>

                  <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
                  ======================================-->

                  <div class="form-group row nuevoProductoCompra">
                  
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

                                <input type="number" min="1" class="form-control input-lg"  id="nuevoTotalCompra" name="nuevoTotalCompra" totalC="" placeholder="000000" readonly required>

                                <input type="hidden" name="totalCompra" id="totalCompra">
                                
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
          $guardarVenta -> ctrCrearCompra();
          
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


  









