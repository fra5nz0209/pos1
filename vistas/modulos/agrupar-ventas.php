<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Agrupar Ventas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Agrupar Ventas</li>
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
                  <div class="ml-auto">
                    <div class="ml-auto">
                      <select class="form-control" name="carga" required>
                            <option value="">Seleccionar carga</option>
                            <option value="0365A">0365A</option>
                            <option value="0365B">0365B</option>
                            <option value="0365C">0365C</option>
                            <option value="0365D">0365D</option>
                            <option value="0365E">0365E</option>
                            <option value="0365F">0365F</option>
                            <option value="0365G">0365G</option>
                            <option value="0365H">0365H</option>
                            <option value="0365I">0365I</option>
                            <option value="0365J">0365J</option>
                            <option value="0365K">0365K</option>
                            <option value="0365L">0365L</option>
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
              <table>
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>Cantidad Total</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Aquí se mostrarían las agrupaciones de ventas por descripción -->
                  <tr>
                    <td>Descripción 1</td>
                    <td>10</td>
                  </tr>
                  <tr>
                    <td>Descripción 2</td>
                    <td>15</td>
                  </tr>
                  <tr>
                    <td>Descripción 3</td>
                    <td>5</td>
                  </tr>
                  <!-- Y así sucesivamente -->
                </tbody>
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