
 <!-- Navbarmenu nuevo lateral configuracion de modo iscuro y bloqueo de menus flotantes -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">


    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

     <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      
    </ul>
  

  <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        </li>

        <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
                
          <li class="dropdown user user-menu">
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <?php 
              if ($_SESSION["foto"] != ""){

                  echo '<img src="'.$_SESSION["foto"].'" class="user-image">';

                    
                  }else{

                    echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
                  }    

               ?>
              
                

                <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
            </a>

            <!-- /.menu del dropdown usuario administradorsalir -->
             <ul class="dropdown-menu"> 

               <li class="user-body">
                 <div class="pull-right">
            
                       <a href="salir" class="btn btn-default btn-flat">Salir</a>

                  </div>
                </li>
              </ul>
          </li>
        </ul>
      </div>
    </ul>
  </nav>
 
 
  <!-- /.control-sidebar -->



