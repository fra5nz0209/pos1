<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Crear Venta
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Crear Venta</li>
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

          <form role="form" method="post">

           <div class="card-body">

              <div class="card">

                  <!--=====================================
                  ENTRADA DEL VENDEDOR
                  ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="UsuarioAdministrador" readonly>
                    
                  </div>

                </div>

                  <!--=====================================
                  ENTRADA DEL CODIGO DE FACTURA
                  ======================================-->

                  <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                    
                    <input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10002343" readonly>
                    
                  </div>

                </div>

 

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-users"></i></span>

                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                      <option value="">Seleccionar cliente</option>

                    </select>

                      <span class="input-group-text"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>
     
                  </div>

                </div>

                  <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
                  ======================================-->

                  <div class="form-group row nuevoProducto">

                    <!-- DESCRIPCION DEL PRODUCTO -->
                    
                    <div class="col-sm-6" style="padding-right: 0px">
                      
                      <div class="input-group">
                        
                        <span class="input-group-text"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

                        <input type="text" class="form-control" id="agregarProducto" name="agregarProducto" placeholder="descripcion del producto" required>


                      </div>
                    </div>

                    <!--CANIDAD DEL PRODUCTO -->

                    <div class="col-sm-3">
                      
                      <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required>
                    </div>

                    <!-- PRECIO DEL PRODUCTO -->

                     <div class="col-sm-3" style="padding-left:0px">

                      <div class="input-group">
                     
                      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                      
                      <input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" placeholder="000000" readonly required>
                                     
                      </div>

                    </div>
                  
                  </div>

                    <hr>

                  <!--=====================================
                  BOTON AGREGAR PRODUCTOS
                  ======================================-->

                  <button type="button" class="btn btn-default hidden-lg">Agregar Producto</button>

                  <hr>

                  <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                    
                    <div class="col-sm-8 pull-right">
                      
                      <table class="table">
                        
                        <thead>
                          <tr>
                            <th>Impuesto</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <tr>
                            
                            <td style="width: 50%">
                              
                              <div class="input-group">
                                
                                <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0"required>
                                <span class="input-group-text"><i class="fa fa-percent"></i></span>
                              </div>
                            </td>

                            <td style="width: 50%">
                              
                              <div class="input-group">

                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

                                <input type="number" min="1" class="form-control"  id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="000000" readonly required>
                                
                              </div>
                            </td>


                          </tr>


                        </tbody>
                      </table>

                    </div>
                  </div>

                  <hr>
                  <!--=====================================
                  BOTON AGREGAR PRODUCTOS
                  ======================================-->

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <div class="input-group">
                        <select class="form-control" name="NuevoMetodoPago" id="nuevoMetodoPago" required>
                          
                          <option value="">Seleccione Medoto de Pago</option>
                          <option value="">Efectivo</option>
                          <option value="">Targeta Credito</option>
                          <option value="">Targeta de Debito</option>

                        </select>
                    

                      </div>

                    </div>

                    <div class="col-sm-6" style="padding-right:0px">
                      <div class="input-group">

                        <input type="text" class="form-control" id="nuevoCodigoTransaccin" name="nuevoCodigoTransaccion" placeholder="Codigo Transaccion" required>
                        
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>



                      </div>
                    </div>
                  </div>

              </div>
      
          </div>

              <div class="card-footer">

                <button type="submit" class="btn btn-primary pull-right">Guardar Venta</button>
                

              </div>

        </form>

        </div>
         

       </div>
        <!--=====================================
        EL FORMULARIO
        ======================================-->

        <div class="col-lg-7 hidden-md hidden-xs hidden-sm">

          <div class="card card-warning">

            <div class="card-header with-border"></div>

            <div class="card-body">

              <table id="example1" class="table table-bordered table-hover tablaProductos tbody">

                <thead>
                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Acciones</th>

                  </tr>

                </thead>

                <tbody>
                  <tr>
                    <td>1</td>
                    <td>000123</td>
                    <td>coca cola 3L</td>
                    <td>40</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Agregar</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
   
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
  









