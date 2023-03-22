<?php 
error_reporting(0);
if(isset($_GET["fechaInicial"])){

					

                    $fechaInicial = $_GET["fechaInicial"];
                    $fechaFinal = $_GET["fechaFinal"];

                  }else{

                    $fechaInicial = null;
                    $fechaFinal = null;

                  }

                  $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

                  $arrayFechas = array();

                  $arrayVentas = array();

                  $sumaPagoMes = array();

                  foreach ($respuesta as $key => $value) {

                  	#capturamos solo el a;o y el mes 
                  	$fecha = substr($value["fechaventa"],0,7);           

                  	#Introducir las fechas en un arrayFechas 

                  	array_push($arrayFechas, $fecha);


                  	#capturamos las ventas
                  	$arrayVentas = array($fecha => $value["total"]);

                  	#sumamos los pagos que ocurrieron el mismo mes 
                  	foreach ($arrayVentas as $key => $value) {

                  		$sumaPagoMes[$key] +=$value;
                  	}
					
                  }
				var_dump($sumaPagoMes);

				$noRepetirFechas = array_unique($arrayFechas);

				var_dump($noRepetirFechas);
?>



<div class="card bg-gradient-info">
	
	<div class="card-header border-0">

		
		<h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Grafico de Ventas
                </h3>
		
		<div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
         </div>

	</div>

	        <div class="card-body">
            <canvas class="chart" id="line-chart-ventas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
           </div>




</div>



<script>

// Sales graph chart
  var salesGraphChartCanvas = $('#line-chart-ventas').get(0).getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    labels: [

    	<?php

    	if($noRepetirFechas != null){

    	foreach ($noRepetirFechas as $key) {
    	// foreach ($arrayFechas as $key => $value) {
    	
    	echo "'".$key."',";
    	}
    	// echo "'".$key."'"
		}else{

		echo "'".'0'."',";	
		}

 		?>


    	],
    datasets: [
      {
        label: 'ventas',
        fill: false,
        borderWidth: 2,
        lineTension: 0,
        spanGaps: true,
        borderColor: '#efefef',
        pointRadius: 3,
        pointHoverRadius: 7,
        pointColor: '#efefef',
        pointBackgroundColor: '#efefef',
        data: [

        	<?php

        	if($noRepetirFechas != null){

    	foreach ($noRepetirFechas as $key) {
    	// foreach ($arrayFechas as $key => $value) {
    	
    	echo "".$sumaPagoMes[$key].",";
    	}
    	// echo "".$sumaPagoMes[$key].""

		}else{

			echo "".'0'.",";

		}		
        ?>

        ],

      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        ticks: {
          fontColor: '#efefef'
        },
        gridLines: {
          display: false,
          color: '#efefef',
          drawBorder: false
        }
      }],
      yAxes: [{
        ticks: {
          stepSize: 5000,
          fontColor: '#efefef'
        },
        gridLines: {
          display: true,
          color: '#efefef',
          drawBorder: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesGraphChartData,
    options: salesGraphChartOptions
  })

</script>		



 