<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">  

            <h1>Administrar Productos
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Produtos</li>
            </ol>
          </div>
        </div>
      </div>

  </section>

    
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
            
                Agregar Productos

              </button>


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover tablaProductos tbody">
                  <thead>
                
                     <tr>
                       <th style="width: 10px;">#</th>
                       <th>Codigo</th>
                       <th>Descripcion</th>
                       <th>Medida</th>
                       <th>Unidad</th>
                       <th>Paquete</th>
                       <th>Palets</th>
                       <th>Agregado</th>
                       <th>Aciones</th>
                     </tr>
                  </thead> 


                  <tbody>


                     <?php 

                     $item = null;
                     $valor = null;

                     $orden = "id";

                     $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                    
                     foreach ($respuesta as $key => $value) {

                       echo '<tr>
                  
                        <td>'.($key+1).'</td>
                         <td>'.$value["codigo"].'</td>
                         <td>'.$value["descripcion"].'</td>
                         <td>'.$value["medida"].'</td>
                         <td>'.$value["unidad"].'</td>
                         <td>'.$value["stock"].'</td>
                         <td>'.$value["palets"].'</td>
                         <td>'.$value["fecha"].'</td>
                         <td>
                           <div class="btn-group">
                            
                            <button class="btn btn-warning btnEditarProducto" data-toggle="modal" data-target="#modalEditarProducto" idProducto="'.$value["id"].'"> <i class="fa fa-pencil"></i></button>

                            <button class="btn btn-danger btnBorrarProducto" idProducto="'.$value["id"].'"> <i class="fa fa-times"></i></button>

                           </div>
          
                         </td>

                        </tr>';

                     }


                      ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                       <th style="width: 10px;">#</th>
                       <th>Codigo</th>
                       <th>Descripcion</th>
                       <th>Medida</th>
                       <th>Unidad</th>
                       <th>Paquete</th>
                       <th>Palets</th>
                       <th>Agregado</th>
                       <th>Aciones</th>
                  </tr>
                  </tfoot>


                </table>
              </div>
         
          </div>
       
        </div>
        
      </div>
      
    </div>
   
  </section>

</div>




<!--=====================================
MODAL AGREGAR  CATEGORIA
======================================-->


<div id="modalAgregarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->


        <div class="modal-header" style="background:#3c8dbc; color:white">

        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        </div>

        <!-- /.  CUERP DEL MODAL  -->
       <div class="modal-body">

        <div class="card-body">

          <!-- /.  ENTRADA PARA SELECCIONAR LA CATEGORIA -->

<!--             <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                    <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>  

                      <?php 

                        $item = null;
                        $valor = null;

                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                        foreach ($categorias as $key => $value) {


                          echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                         } 

                       ?>                      

                    </select>

                  </div>

                </div>
 -->
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

                   <!-- /.  ENTRADA PARA LA UNIDAD DE MEDIDA REFERENCIAL  MEDIDA  -->

                    <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-check"></i></span>
                          <input type="number" class="form-control input-lg" name="nuevaMedida" placeholder="Ingresar los litros del contenido" required>
                        </div>
                    </div>
            
                  

                    <!-- /.  ENTRADA PARA LA UNIDAD DE MEDIDA REFERENCIAL  UNIDAD  -->

                    <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-check"></i></span>
                          <input type="number" class="form-control input-lg" name="nuevaUnidad" placeholder="Ingresar Medida del paquete" required>
                        </div>
                    </div>


                    <!-- /.  ENTRADA PARA EL STOK = O ENTENDIDO POR LA CANTIDAD DE PAQUETES EXISTENTES Y SU EQUIVALENTE EN CAMBIO GENERAL DE MEDIDA DE DESCUENTO EH INCREMENTO NAME STOK  -->

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-check"></i></span>
                          <input type="number" class="form-control input-lg" name="nuevoStock"  placeholder="Stock" required>
                        </div>
                      </div>


                     <!-- /.  ENTRADA PARA LA CANTIDAD DE PALETS corregir automatizacion DE ACUERDO A STOK COMO REFERENCIA AL DETALLE-->

                    <div class="form-group">

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                        <input type="number" class="form-control input-lg" name="nuevoPalets" m placeholder="Ingresar cajas por palets" required>
                      </div>
                    </div>

        </div>
       </div>
      

     <!-- /.  PIE DE MODAL  -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar Producto</button>
      </div>

      <?php   

        $crearProducto = new ControladorProductos();
        $crearProducto -> ctrCrearProducto();

       ?>

     </form>

    </div>
  </div>

</div>




<!--=====================================
MODAL EDITAR  PRODUCTO
======================================-->


<div id="modalEditarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->


        <div class="modal-header" style="background:#3c8dbc; color:white">

        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        </div>

        <!-- /.  CUERP DEL MODAL  -->
       <div class="modal-body">

        <div class="card-body">

          <!-- /.  ENTRADA PARA SELECCIONAR LA CATEGORIA -->

<!--             <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                    <select class="form-control input-lg" name="editarCategoria" readonly required>

                      <option id="editarCategoria"></option>                       

                    </select>

                  </div>

                </div>
 -->
                <!-- /.  ENTRADA PARA EL CODIGO  -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-code"></i></span>
                      <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>
                      
                    </div>
                  </div>

                        <!-- /.  ENTRADA PARA LA DESCRIPCION  -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                      <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion"  required>
                    </div>
                  </div>
            
                     <!-- /.  ENTRADA PARA LA UNIDAD DE MEDIDA REFERENCIAL LITROS  -->

                    <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-check"></i></span>
                          <input type="number" class="form-control input-lg" id="editarMedida" name="editarMedida" required>
                        </div>
                    </div>

                    <!-- /.  ENTRADA PARA LA UNIDAD DE MEDIDA REFERENCIAL UNIDAD  -->

                    <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-check"></i></span>
                          <input type="number" class="form-control input-lg" id="editarUnidad" name="editarUnidad" required>
                        </div>
                    </div>


                    <!-- /.  ENTRADA PARA EL STOK = O ENTENDIDO POR LA CANTIDAD DE PAQUETES EXISTENTES Y SU EQUIVALENTE EN CAMBIO GENERAL DE MEDIDA DE DESCUENTO EH INCREMENTO NAME STOK  -->

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-check"></i></span>
                          <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" required>
                        </div>
                      </div>


                     <!-- /.  ENTRADA PARA LA CANTIDAD DE PALETS corregir automatizacion DE ACUERDO A STOK COMO REFERENCIA AL DETALLE-->

                    <div class="form-group">

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                        <input type="number" class="form-control input-lg" id="editarPalets" name="editarPalets" required>
                      </div>
                    </div>

        </div>
       </div>
      

     <!-- /.  PIE DE MODAL  -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>

     </form>

     <?php 

      $editarProducto = new ControladorProductos();
      $editarProducto -> ctrEditarProducto();

      ?>

    </div>
  </div>

</div>



     <?php 

      $eliminarProducto = new ControladorProductos();
      $eliminarProducto -> ctrEliminarProducto();

      ?>













