<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cargar Venta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Cargar Venta</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cargar Excel</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div id="error"></div>
                                <div class="form-group">
                                    <div class="panel">SUBIR ARCHIVO DE EXCEL</div>
                                    <input type="file" name="excel_file" class="excel_file">
                                    <p>Archivos permitidos .xls, .xlsx</p>
                                    <p>Tamaño máximo de archivo 5MB</p>
                                </div>
                                <input type="hidden" name="procesar_excel" value="procesar_excel">
                                <button type="submit" class="btn btn-primary">Procesar Archivo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- <table id="example1" class="table table-bordered table-hover  tbody">
    <thead>
        <tr>
            <th>No.</th>
            <th>Fecha</th>
            <th>Cod. Cliente</th>
            <th>Carga Nro.</th>
            <th>Vendedor</th>
            <th>TOTAL A COBRAR</th>
        </tr>
    </thead> -->
<!--     <tbody id="tabla-excel">

        
    </tbody> -->
<!-- </table> -->

<script>
$("form").submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "controladores/excel.controlador.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success:function(respuesta){
if(respuesta != "valido"){
$("#error").html(respuesta);
}else{
$("#tabla-excel").html(respuesta);
}
}
});
});
</script>

