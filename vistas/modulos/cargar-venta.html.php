<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Cargar venta</h3>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="factura">Subir factura (PDF):</label>
                    <input type="file" class="form-control-file" id="factura" name="factura" required>
                </div>
                <button type="button" class="btn btn-primary" id="procesarFactura">Procesar factura</button>
                <button type="submit" class="btn btn-success" id="guardarDatos" style="display: none;">Guardar datos</button>
            </form>
            <br>
            <div id="resultados"></div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#procesarFactura", function(){
        var formData = new FormData();
        formData.append("factura", $("#factura")[0].files[0]);

        $.ajax({
            url: "index.php?ruta=ventas&cargarfactura",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
                $("#resultados").html(respuesta);
                $("#guardarDatos").show();
            }
        });
    });

    $(document).on("click", "#guardarDatos", function(){
        var formData = new FormData();
        formData.append("codigo", $("#codigo").val());
        formData.append("fechaventa", $("#fechaventa").val());
        formData.append("id_cliente", $("#id_cliente").val());
        formData.append("carga", $("#carga").val());
        formData.append("id_vendedor", $("#id_vendedor").val());
        formData.append("productos", $("#productos").val());
        formData.append("total", $("#total").val());

        $.ajax({
            url: "index.php?ruta=ventas&guardardatos",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
                if(respuesta == "ok"){
                  alert("Datos guardados correctamente");
            } else {
            alert("Error al guardar los datos");
            }
            }
            });
            });
            </script>

      <!-- /.container-fluid -->
</section>
</div>