<div class="content-wrapper">

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

  </section>

    
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


                     <?php 

                     $item = null;
                     $valor = null;


                     $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    
                     foreach ($categorias as $key => $value) {

                       echo '<tr>
                  
                        <td>'.($key+1).'</td>
                         <td class = "text-uppercase">'.$value["categoria"].'</td>
                         
                         <td>
                           <div class="btn-group">
                            
                            <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"> <i class="fa fa-pencil"></i></button>

                            <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"> <i class="fa fa-times"></i></button>

                           </div>
             
                         </td>

                        </tr>';

                     }


                      ?>
                  
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
         
          </div>
       
        </div>
        
      </div>
      
    </div>
   
  </section>

</div>




<!--=====================================
MODAL AGREGAR  CATEGORIA
======================================-->


<div id="modalAgregarCategoria" class="modal fade" role="dialog">

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

        $crearCategoria = new ControladorCategorias();
        $crearCategoria -> ctrCrearCategoria();

       ?>

     </form>

    </div>
  </div>

</div>









<!--=====================================
MODAL EDITAR  CATEGORIA
======================================-->


<div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->


        <div class="modal-header" style="background:#3c8dbc; color:white">

        <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>

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
              <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria"  required>
              <input type="hidden" name="idCategoria" id="idCategoria"  required>

            </div>
          </div>
        </div>
       </div>
      

     <!-- /.  PIE DE MODAL  -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>


              <?php   

        $editarCategoria = new ControladorCategorias();
        $editarCategoria -> ctrEditarCategoria();

       ?>

     </form>



    </div>
  
  </div>

</div>


      <?php   

        $borrarCategoria = new ControladorCategorias();
        $borrarCategoria -> ctrBorrarCategoria();

       ?>












