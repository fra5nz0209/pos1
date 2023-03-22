<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Administrar Categorias
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Categorias</li>
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
                
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
            
              Agregar Categoria

          </button>


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                
                     <tr>
                  
                       <th style="width: 10px;">#</th>
                       <th>Categorias</th>
                       <th>Aciones</th>
                     </tr>
                  </thead> 
                  <tbody>
                  
                   <tr>
                  
                   <td>1</td>
                   <td>RESFRESCOS</td>
                   
                   <td>
                     <div class="btn-group">
                      
                      <button class="btn btn-warning"> <i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger"> <i class="fa fa-times"></i></button>

                     </div>
    
                    </td>

                   </tr>
                   <tr>
                  
                   <td>1</td>
                   <td>ABARROTES</td>
                   
                   <td>
                     <div class="btn-group">
                      
                      <button class="btn btn-warning"> <i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger"> <i class="fa fa-times"></i></button>

                     </div>
    
                    </td>

                   </tr>

                    <tr>
                  
                   <td>1</td>
                   <td>RESFRESCOS</td>
                   
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
                       <th>Categoria</th>
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
MODAL AGREGAR  CATEGORIA
======================================-->


<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->


        <div class="modal-header" style="background:#3c8dbc; color:white">

        <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        </div>

        <!-- /.  CUERP DEL MODAL  -->
       <div class="modal-body">

        <div class="box-body">

             <!-- /.  ENTRADA PARA CATEGORIA  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar Categoria" required>
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








