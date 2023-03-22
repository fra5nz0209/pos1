<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1>Administrar Ventas
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Ventas</li>
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
                
                <a href="crear-venta">
                    <button class="btn btn-primary">
                
                    Agregar Venta

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
                       <th>Fecha</th>
                       <th>Vendedor</th>
                       <th>Cliente</th>   
                       <th>No.Factura</th>
                       <th>Total</th>
                       <th>Estado</th>
                       <th>Cuentas</th>
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

                  $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

              // $item = null;
              // $valor = null;

              // $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

              foreach ($respuesta as $key => $value) {
               

               echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["fechaventa"].'</td>';

                    $itemUsuario = "id";
                    $valorUsuario = $value["id_vendedor"];

                    $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    echo '<td>'.$respuestaUsuario["nombre"].'</td>';

                    $itemCliente = "id";
                    $valorCliente = $value["id_cliente"];

                    $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    echo '<td>'.$respuestaCliente["nombre"].'</td>

                    <td>'.$value["codigo"].'</td>

                    <td>$ '.number_format($value["total"],2).'</td>';

                    if($value["estado"] == "activa"){
                            echo '<td><button class="btn btn-success btn-xs btnCambiarEstado" idVenta="'.$value["id"].'" nuevoEstado="pendiente" estadoActual="activa">Activa</button></td>';
                          } elseif($value["estado"] == "pendiente"){
                            echo '<td><button class="btn btn-warning btn-xs btnCambiarEstado" idVenta="'.$value["id"].'" nuevoEstado="anulada" estadoActual="pendiente">Pendiente</button></td>';
                          } else {
                            echo '<td><button class="btn btn-danger btn-xs btnCambiarEstado" idVenta="'.$value["id"].'" nuevoEstado="activa" estadoActual="anulada">Anulada</button></td>';
                          }

                         echo '

                         <td><button class="btn btn-success btn-xs btncuentas" idVenta="">CXC</button></td>



                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">

                          <i class="fa fa-print"></i>

                          </button>

                          <button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        </div>  

                      </td>

                      </tr>';
 
                }

            ?>


                  </tbody>
                  <tfoot>
                  <tr>
                       <th style="width: 10px;">#</th>
                       <th>Fecha</th>
                       <th>Vendedor</th>
                       <th>Cliente</th>   
                       <th>No.Factura</th>
                       <th>Total</th>
                       <th>Estado</th>
                       <th>Cuentas</th>
                       <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>

                <?php

                  $eliminarVenta = new ControladorVentas();
                  $eliminarVenta -> ctrEliminarVenta();

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

