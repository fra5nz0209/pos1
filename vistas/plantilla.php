<?php  
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DISTRIBUIDORA MANCILLA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Incluir jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Incluir Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
 
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

    <!-- daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">


  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->
  
<!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="vistas/plugins/jszip/jszip.min.js"></script>
<script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
<script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>

<!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="vistas/plugins/sweetalert2/sweetalert2.js"></script>
  <script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- InputMask -->
<script src="vistas/plugins/moment/moment.min.js"></script>
<script src="vistas/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
<!-- <script src="vistas/plugins/daterangepicker/daterangepicker.min.js"></script> -->
<!-- bootstrap color picker -->
<script src="vistas/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<!-- ChartJS -->
<script src="vistas/plugins/chart.js/Chart.min.js"></script>

<!-- internet explorer -->
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>



<!-- AdminLTE for demo purposes  TENER EN CUENTA ESTE SE OMITIO Y CREAR EN OTRA CARPETA JS/PLANTILLA.JS -->
<script src="vistas/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  $(function () {
    // //Initialize Select2 Elements
    // $('.select2').select2()

    // //Initialize Select2 Elements
    // $('.select2bs4').select2({
    //   theme: 'bootstrap4'
    // })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    // //Date picker
    // $('#reservationdate').datetimepicker({
    //     format: 'L'
    // });

    // //Date and time picker
    // $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    // //Date range as a button
    // $('#daterange-btn').daterangepicker(
    //   {
    //     ranges   : {
    //       'Today'       : [moment(), moment()],
    //       'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //       'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    //       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //       'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    //       'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //     },
    //     startDate: moment().subtract(29, 'days'),
    //     endDate  : moment()
    //   },
    //   function (start, end) {
    //     $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    //   }
    // )

    // //Timepicker
    // $('#timepicker').datetimepicker({
    //   format: 'LT'
    // })

    // //Bootstrap Duallistbox
    // $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  // document.addEventListener('DOMContentLoaded', function () {
  //   window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  // })

  // // // DropzoneJS Demo Code Start
  // // Dropzone.autoDiscover = false

  // // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  // var previewNode = document.querySelector("#template")
  // previewNode.id = ""
  // var previewTemplate = previewNode.parentNode.innerHTML
  // previewNode.parentNode.removeChild(previewNode)

  // var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
  //   url: "/target-url", // Set the url
  //   thumbnailWidth: 80,
  //   thumbnailHeight: 80,
  //   parallelUploads: 20,
  //   previewTemplate: previewTemplate,
  //   autoQueue: false, // Make sure the files aren't queued until manually added
  //   previewsContainer: "#previews", // Define the container to display the previews
  //   clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  // })

  // myDropzone.on("addedfile", function(file) {
  //   // Hookup the start button
  //   file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  // })

  // // Update the total progress bar
  // myDropzone.on("totaluploadprogress", function(progress) {
  //   document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  // })

  // myDropzone.on("sending", function(file) {
  //   // Show the total progress bar when upload starts
  //   document.querySelector("#total-progress").style.opacity = "1"
  //   // And disable the start button
  //   file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  // })

  // // Hide the total progress bar when nothing's uploading anymore
  // myDropzone.on("queuecomplete", function(progress) {
  //   document.querySelector("#total-progress").style.opacity = "0"
  // })

  // // Setup the buttons for all transfers
  // // The "add files" button doesn't need to be setup because the config
  // // `clickable` has already been specified.
  // document.querySelector("#actions .start").onclick = function() {
  //   myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  // }
  // document.querySelector("#actions .cancel").onclick = function() {
  //   myDropzone.removeAllFiles(true)
  // }
  // // DropzoneJS Demo Code End
</script>















</head>


<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition sidebar-mini">



  <?php

    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){



      echo  '<div class="wrapper">';
    


    /*=============================================
    =                 CABEZOTE                    =
    =============================================*/

    include "modulos/cabezote.php";


    /*=============================================
    =                 MENU                        =
    =============================================*/

    include "modulos/menu.php";
  /*=============================================
    =                 CONTENIDO                   =
    =============================================*/

    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "categorias" ||
        $_GET["ruta"] == "productos" ||
        $_GET["ruta"] == "clientes" ||
        $_GET["ruta"] == "cargar-venta" ||
        $_GET["ruta"] == "ventasi" ||
        $_GET["ruta"] == "crear-ventai" ||
        $_GET["ruta"] == "editar-ventai" ||        
        $_GET["ruta"] == "ventas" ||
        $_GET["ruta"] == "crear-venta" ||
        $_GET["ruta"] == "editar-venta" ||
        $_GET["ruta"] == "reportes" ||
        $_GET["ruta"] == "agrupar-ventas" ||
        $_GET["ruta"] == "compras" ||
        $_GET["ruta"] == "crear-compra" ||
        $_GET["ruta"] == "editar-compra" ||
        $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";
      
      }elseif($_GET["ruta"] == "cargar-venta" && $_GET["procesarfactura"]== "procesarfactura"){
    ControladorFacturas::ctrProcesarFactura();
    include "modulos/cargar-venta.php";
  }else {

    include "modulos/404.php";
  }
  }else{

    include "modulos/inicio.php";

  }
    

    

    

  /*=============================================
    =                 FOOTER                   =
    =============================================*/

    include "modulos/footer.php";

   echo '</div>';
  }else{

    include "modulos/login.php";

  }


  ?>  



    <script src="vistas/js/plantilla.js"></script>
    <script src="vistas/js/usuarios.js"></script>
    <script src="vistas/js/categorias.js"></script>
    <script src="vistas/js/compras.js"></script>
    <script src="vistas/js/productos.js"></script>    
    <script src="vistas/js/clientes.js"></script>
    <script src="vistas/js/ventasi.js"></script>
    <script src="vistas/js/ventas.js"></script>
    <script src="vistas/js/reportes.js"></script>
    <script src="vistas/js/facturas.js"></script>


   




</body>
</html>
