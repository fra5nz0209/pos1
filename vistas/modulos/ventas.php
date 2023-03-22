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
  <div class="form-group">
    <div class="input-group">
      <a href="crear-venta">
        <button class="btn btn-primary">Agregar Venta</button>
      </a><div class="ml-auto">
      <div class="ml-auto">
        
         
        <select class="form-control" id="nuevoVendedor" name="nuevoVendedor" required>
          <option value="">Seleccionar vendedor</option>
          <?php 
            $item = null;
            $valor = null;

            $categorias = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            foreach ($categorias as $key => $value) {
              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
            }
          ?>
        </select>
      </div>
      </div>
        <button type="button" class="btn btn-default float-right opensright" id="daterange-btn">
          <span>
            <i class="far fa-calendar-alt"></i>Rango de fecha
          </span>
          <i class="fa fa-caret-down"></i>
        </button>
      
    </div>
  </div>
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
                  if(isset($_GET["fechaInicial"]) && isset($_GET["idVendedor"])){

                      $fechaInicial = $_GET["fechaInicial"];
                      $fechaFinal = $_GET["fechaFinal"];
                      $idVendedor = $_GET["idVendedor"];

                    }else{

                      $fechaInicial = null;
                      $fechaFinal = null;
                      $idVendedor = null;
                  }

                  $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal, $idVendedor);

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

                         
                         if($value["cuentas"] == "efec"){

                          echo '<td><button class="btn btn-success btn-xs btncuentas" idCuenta="'.$value["id"].'" nuevaCuenta="cxc" estadoCuenta="efec">Efectivo</button></td>';
                        }elseif($value["cuentas"]== "cxc"){

                           echo '<td><button class="btn btn-success btn-xs btncuentas" idCuenta="'.$value["id"].'" nuevaCuenta="trf" estadoCuenta="cxc">CXC</button></td>';
                        }elseif($value["cuentas"]== "trf"){

                           echo '<td><button class="btn btn-success btn-xs btncuentas" idCuenta="'.$value["id"].'" nuevaCuenta="va" estadoCuenta="trf">TRF</button></td>';
                        }elseif ($value["cuentas"]== "va") {
                          
                           echo '<td><button class="btn btn-success btn-xs btncuentas" idCuenta="'.$value["id"].'" nuevaCuenta="anu" estadoCuenta="va">VA</button></td>';

                        }else{

                           echo '<td><button class="btn btn-success btn-xs btncuentas" idCuenta="'.$value["id"].'" nuevaCuenta="efec" estadoCuenta="anu">ANU</button></td>';

                        }


                          

                        echo '

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
                  if(isset($_GET["fechaInicial"]) && isset($_GET["idVendedor"])){

                      $fechaInicial = $_GET["fechaInicial"];
                      $fechaFinal = $_GET["fechaFinal"];
                      $idVendedor = $_GET["idVendedor"];

                    }else{

                      $fechaInicial = null;
                      $fechaFinal = null;
                      $idVendedor = null;
                  }
                  $totalVentas = ControladorVentas::ctrSumarTotalVentas($fechaInicial, $fechaFinal, $idVendedor);
                  $totalProductos = ControladorVentas::ctrSumarProductosVendidos($fechaInicial, $fechaFinal, $idVendedor);
              ?>



                <table id="example_2" class="table table-bordered table-hover tablaTotales">
                  <thead>
                     <tr>            
                       <th bgcolor="#f5f5f5">CANTIDAD TOTAL PRODUCTOS</th>
                       <th bgcolor="#f5f5f5">VENTA TOTAL DE VENTAS</th>                     
                     </tr>
                  </thead> 
                  <tbody>

                    <tr>

                     <td><?php echo $totalProductos; ?></td>
                     <td><?php echo number_format(($totalVentas && $totalVentas["total"]) ? $totalVentas["total"] : 0,2); ?></td>
                      </tr>

                  </tbody>
                 
                </table>


                <table id="example_2" class="table table-bordered table-hover tablaCuentas">
                <thead>
                  <tr>            
                    <th bgcolor="#f5f5f5">EFECTIVO</th>
                    <th bgcolor="#f5f5f5">CUENTAS POR COBRAR</th>
                    <th bgcolor="#f5f5f5">TRANSFERENCIA</th> 
                    <th bgcolor="#f5f5f5">VENTA ADELANTADA</th>
                    <th bgcolor="#f5f5f5">ANULADA</th>                      
                  </tr>
                </thead> 
                <tbody>
                  <tr>
                    <?php
                      $fechaInicial = null;
                      $fechaFinal = null;
                      $idVendedor = null;

                      if(isset($_GET["fechaInicial"]) && isset($_GET["idVendedor"])){

                        $fechaInicial = $_GET["fechaInicial"];
                        $fechaFinal = $_GET["fechaFinal"];
                        $idVendedor = $_GET["idVendedor"];

                      }

                      $ventasPorCuentas = ControladorVentas::ctrSumarVentasPorCuentas($fechaInicial, $fechaFinal, $idVendedor);
                      if (!empty($ventasPorCuentas)) {
                        $totales = [
                          "efec" => 0,
                          "cxc" => 0,
                          "trf" => 0,
                          "va" => 0,
                          "anu" => 0,
                        ];
                        foreach ($ventasPorCuentas as $cuenta => $total) {
                          $totales[$cuenta] = $total[0]["total"];
                        }
                      } else {
                        $totales = [
                          "efec" => 0,
                          "cxc" => 0,
                          "trf" => 0,
                          "va" => 0,
                          "anu" => 0,
                        ];
                      }
                    ?>

                    
                    <td><?php echo number_format(($totales && $totales["efec"]) ? $totales["efec"] : 0,2); ?></td>
                    <td><?php echo number_format($totales["cxc"],2); ?></td>
                    <td><?php echo number_format($totales["trf"],2); ?></td>
                    <td><?php echo number_format($totales["va"] ,2); ?></td>
                    <td><?php echo number_format($totales["anu"],2); ?></td>
                  </tr>
                </tbody>
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

