<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Administrar Clientes
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Clientes</li>
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
                
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
            
              Agregar Cliente

          </button>


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                
                     <tr>
                  
                       <th style="width: 10px;">#</th>
                       <th>Codigo</th>
                       <th>Nombre</th>
                       <th>Direccion</th>
                       <th>Referencia</th>
                       <th>Celular</th>
                       <th>Nit_Ci</th>
                       <th>Total Compras</th>
                       <th>Ultima Compra</th>
                       <th>Ingreso al Sistema</th>
                       <th>Acciones</th>


                       <th></th>
                     </tr>
                  </thead> 
                  <tbody>
                  
                   <tr>
                  
                   <td>1</td>
                   <td>3405064</td>
                   <td>MERY OSINAGA CAMBARA</td>
                   <td>DORA RIBERO ESPAÑOLA</td>
                   <td>FRENTE COLEGIO JORGE PRESTEL</td>
                   <td>74944190</td>
                   <td>8165301</td>
                   <td>35</td>
                   <td>2017-12-11 12:05:32</td>
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
                   <td>3405064</td>
                   <td>MERY OSINAGA CAMBARA</td>
                   <td>DORA RIBERO ESPAÑOLA</td>
                   <td>FRENTE COLEGIO JORGE PRESTEL</td>
                   <td>74944190</td>
                   <td>8165301</td>
                   <td>35</td>
                   <td>2017-12-11 12:05:32</td>
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
                       <th>Nombre</th>
                       <th>Direccion</th>
                       <th>Referencia</th>
                       <th>Celular</th>
                       <th>Nit_Ci</th>
                       <th>Total Compras</th>
                       <th>Ultima Compra</th>
                       <th>Ingreso al Sistema</th>
                       <th>Acciones</th>
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
MODAL AGREGAR  CATEGORIA
======================================-->


<div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required>
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
              <input type="number" class="form-control input-lg" name="nuevoCi" placeholder="Ingresar CI/NIT" required>
            </div>
          </div>

            

        </div>
       </div>
      

     <!-- /.  PIE DE MODAL  -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar Categoria</button>
      </div>

      <?php   

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearUsuario();




       ?>





    </div>
  </div>

  </div>








