<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Administrar Usuarios
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Usuarios</li>
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
                
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
            
              Agregar Usuario

          </button>


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                
                     <tr>
                  
                        <th style="width: 10px;">#</th>
                       <th>Nombre</th>
                       <th>Usuario</th>
                       <th>Foto</th>
                       <th>Perfil</th>
                        <th>Estado</th>
                       <th>Ultimo Login</th>
                       <th>Aciones</th>
                       </tr>
            </thead> 
                  <tbody>
                  
                    <tr>
                  
                   <td>1</td>
                   <td>usuario administrador</td>
                   <td>admin</td>
                   <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px" ></td>
                   <td>Administrador</td>
                   <td><button class="btn btn-success btn-xs">Activado</button></td>
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
                   <td>usuario administrador</td>
                   <td>admin</td>
                   <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px" ></td>
                   <td>Administrador</td>
                   <td><button class="btn btn-success btn-xs">Activado</button></td>
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
                       <th>#</th>
                       <th>Nombre</th>
                       <th>Usuario</th>
                       <th>Foto</th>
                       <th>Perfil</th>
                       <th>Estado</th>
                       <th>Ultimo Login</th>
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

     <!-- /.  MODAL AGREGAR USUARIO -->


  <div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

        <!-- /.  CUERP DEL MODAL  -->
       <div class="modal-body">

        <div class="box-body">

             <!-- /.  ENTRADA PARA EL NOMBRE  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required>
            </div>
          </div>
      

        <!-- /.  INGRESAR USUARIO  -->

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar Usuario" required>
            </div>
          </div>
      
        <!-- /.  INGRESAR CONTRASEÑA -->

            

          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar Contraseña" required>
            </div>
          </div>
   

          <!-- /.  SELECCIONAR PERFIL    -->


              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>
  

          <!-- /.  ENTRADA PARA SUBIR FOTO     -->

          <div class="modal-body">

            <div class="box-body">

             <div class="panel">SUBIR FOTO</div>

                <input type="file" id="nuevaFoto" name="nuevaFoto">

                  <p class="help-block">Peso maximo de la foto de 200 MB</p>

                <img src="vistas/dist/usuarios/default/anonymous.png"  class="img-thumbnail" width="100px">
              
            </div>
            
          </div>

      </div> 


     <!-- /.  PIE DE MODAL  -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>

      <?php   

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearUsuario();




       ?>





    </div>
  </div>

  </div>








