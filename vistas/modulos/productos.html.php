<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Administrar Productos
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="productos">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Productos</li>
            </ol>
          </div>
        </div>
      </div>

      <!-- /.container-fluid -->
    </section>

<!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
            
              Agregar Producto

          </button>


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                
                     <tr>
                  
                        <th style="width: 10px;">#</th>
                       <th>Codigo</th>
                       <th>Descripcion</th>
                       <th>Categoria</th>
                       <th>Unidad</th>
                       <th>Paquete</th>
                        <th>Palets</th>
                       <th>Agregado</th>
                       <th>Aciones</th>
                       </tr>
            </thead> 
                  <tbody>
                  
                    <tr>
                  
                   <td>1</td>
                   <td>146</td>
                   <td>COCA-COLA 3.0 L NR</td>
                   <td>COCA COLA</td>
                   <td>6</td>
                   <td>60</td>
                   <td>1</td>
                   <td>2017-12-11 12:05:32</td>
                   <td>
                     <div class="btn-group">
                      
                      <button class="btn btn-warning"> <i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger"> <i class="fa fa-times"></i></button>

                     </div>
    
                   </td>

                </tr>

                <tr>
                  
                   <td>1</td>
                   <td>146</td>
                   <td>COCA-COLA 3.0 L NR</td>
                   <td>COCA COLA</td>
                   <td>6</td>
                   <td>60</td>
                   <td>1</td>
                   <td>2017-12-11 12:05:32</td>
                   <td>
                     <div class="btn-group">
                      
                      <button class="btn btn-warning"> <i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger"> <i class="fa fa-times"></i></button>

                     </div>
    
                   </td>

                </tr>

                <tr>
                  
                   <td>1</td>
                   <td>146</td>
                   <td>COCA-COLA 3.0 L NR</td>
                   <td>COCA COLA</td>
                   <td>6</td>
                   <td>60</td>
                   <td>1</td>
                   <td>2017-12-11 12:05:32</td>
                   <td>
                     <div class="btn-group">
                      
                      <button class="btn btn-warning"> <i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger"> <i class="fa fa-times"></i></button>

                     </div>
    
                   </td>

                </tr>

                  </tbody>
                  <tfoot>
                  <tr>
                      <th style="width: 10px;">#</th>
                       <th>Codigo</th>
                       <th>Descripcion</th>
                       <th>Categoria</th>
                       <th>Unidad</th>
                       <th>Paquete</th>
                        <th>Palets</th>
                       <th>Agregado</th>
                       <th>Aciones</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

   </div>

<!--=====================================
MODAL AGREGAR  PRODUCTO
======================================-->


  <div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
         CABEZA DEL MODAL 
        ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

        <!--=====================================
         CUERPO DEL MODAL 
        ======================================-->

       <div class="modal-body">

        <div class="box-body">

             <!-- /.  ENTRADA PARA EL CODIGO  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-code"></i></span>
              <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" required>
            </div>
          </div>
      

            <!-- /.  ENTRADA PARA LA DESCRIPCION  -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripcion" required>
              </div>
            </div>
      
            <!-- /.  ENTRADA PARA SELECCIONAR LA CATEGORIA -->

            <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                    <select class="form-control input-lg" name="nuevoCategoria">
                      
                      <option value="">Selecionar Categoria</option>

                      <option value="cocacola">Coca cola</option>

                      <option value="andamios">andamios</option>

                      <option value="equipos si">equipos si</option>

                    </select>

                  </div>

                </div>

              <!-- /.  ENTRADA PARA LA UNIDAD DE MEDIDA REFERENCIAL  -->

              <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                    <input type="number" class="form-control input-lg" name="nuevaUnidad" placeholder="Ingresar Descripcion" required>
                  </div>
              </div>


              <!-- /.  ENTRADA PARA EL STOK = O ENTENDIDO POR LA CANTIDAD DE PAQUETES EXISTENTES Y SU EQUIVALENTE EN CAMBIO GENERAL DE MEDIDA DE DESCUENTO EH INCREMENTO NAME STOK  -->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                    <input type="number" class="form-control input-lg" name="nuevoStock" min="0"  placeholder="Stock" required>
                  </div>
                </div>


               <!-- /.  ENTRADA PARA LA CANTIDAD DE PALETS corregir automatizacion DE ACUERDO A STOK COMO REFERENCIA AL DETALLE-->

              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" class="form-control input-lg" name="nuevoPalets" min="0" placeholder="Ingresar Palets" required>
                </div>
              </div>

      </div> 


        <!--=====================================
         PIE DEL MODAL 
        ======================================-->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button type="button" class="btn btn-primary">Guardar Producto</button>
      </div>
    </form>



    </div>
  </div>

</div>








