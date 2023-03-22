<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Administrar Compras
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Compras</li>
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
                
                <a href="crear-compra">
                    <button class="btn btn-primary">
                
                    Agregar compra

                    </button>
                </a>

                 <button type="button" class="btn btn-default float-right opensright" id="daterange-btn">
                   
                    <span>
                      <i class="far fa-calendar-alt"></i>Rango de fecha

                    </span>

                    <i class="fa fa-caret-down"></i>

                 </button>      

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover tablas">
                  <thead>
                
                     <tr>
                  
                       <th style="width: 10px;">#</th>
                       <th>Codigo</th>
                       <th>Origen</th>
                       <th>Fecha</th>   
                       <th>Vehiculo</th>
                       <th>Placa</th>
                       <th>Propietario</th>
                       <th>TOTAL</th>
                       <th>Acciones</th>
                     </tr>
                  </thead> 
                  <tbody>

                <?php
                  if(isset($_GET["fechaInicial"])){

                    $fechaInicial = $_GET["fechaInicial"];
                    $fechaFinal = $_GET["fechaFinal"];

                  }else{

                    $fechaInicial = null;
                    $fechaFinal = null;

                  }

                  $respuesta = ControladorCompras::ctrRangoFechasCompras($fechaInicial, $fechaFinal);

              // $item = null;
              // $valor = null;

              // $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

              foreach ($respuesta as $key => $value) {
               

               echo '<tr>

                      <td>'.($key+1).'</td>

                      <td>'.$value["codigo"].'</td>

                      <td>'.$value["origen"].'</td>

                      <td>'.$value["fechacompra"].'</td>

                      <td>'.$value["vehiculo"].'</td>

                      <td>'.$value["placa"].'</td>

                      <td>'.$value["propietario"].'</td>

                      <td> '.number_format($value["totalcompra"],2).'</td>;

                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-info btnImprimirFactura" codigoCompra="'.$value["codigo"].'">

                          <i class="fa fa-print"></i>

                          </button>

                          <button class="btn btn-warning btnEditarCompra" idCompra="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btnEliminarCompra" idCompra="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
                       <th>Origen</th>
                       <th>Fecha</th>   
                       <th>Vehiculo</th>
                       <th>Placa</th>
                       <th>Propietario</th>
                       <th>TOTAL</th>
                       <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>

                <?php

                  $eliminarVenta = new ControladorCompras();
                  $eliminarVenta -> ctrEliminarCompra();

                  ?>
                   

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

