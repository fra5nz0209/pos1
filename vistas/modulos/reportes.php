<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Reportes de Ventas
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Reportes de ventas</li>
            </ol>
          </div>
        </div>
      </div>

      <!-- /.container-fluid -->
    </section>

<!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

        <div class="card-header">

          <div class="input-group ">

          <button type="button" class="btn btn-default float-left opensleft" id="daterange-btn2">
                   
                    <span>
                      <i class="far fa-calendar"></i>Rango de fecha

                    </span>

                    <i class="fa fa-caret-down"></i>

                 </button>     
              
          </div>

          <div class="card-tools">

            <?php

            if(isset($_GET["fechaInicial"])){

              echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';  


            }else{


                echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

            }

                         
              

              ?>

                <button class="btn btn-success" style="margin-top:5px">Descargar Reporte en Excel</button>
                
              </a>

             
            
          </div>

        </div>
        <div class="card-body">

          <div class="row">
            
            <div class="col-xs-12">
              <?php 

              include "reportes/grafico-ventas.php";
               ?>
              
            </div>
            <div class="col-md-6 col-xs-12">
              

                <?php 

              include "reportes/productos-mas-vendidos.php";
               ?>

            </div>
          </div>

        </div>
        <!-- /.card-body -->
      
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  </div>








