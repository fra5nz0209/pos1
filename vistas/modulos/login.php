 <!-- Preloader    esteeee -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="vistas/img/plantilla/pre.jpg" alt="AdminLTELogo" height="800" width="800">
  </div>

 <!-- esto pertenece a cabezote ordenar mejor  -->


<div id="back"></div>

<div class="login-page">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      
      <a href="#" class="h1"><b>DISTRIBUIDORA</b>
      MANCILLA </a>
   

    </div>

    <div class="card-body">
      <p class="login-box-msg">Ingresar al Sistema </p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user "></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>


        <div class="row">
         
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block text-center">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>


          <?php 

            $login  = new ControladorUsuarios();
            $login -> ctrIngresoUsuario();
            
           ?>

      </form>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->