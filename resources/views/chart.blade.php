@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js" type="text/javascript"></script>

	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Chart</div>

					<form action="postUpload" method="post" enctype="multipart/form-data">
						<input type='hidden' name="_token" value="<?php echo csrf_token(); ?>">
						<input type="file" name="file">
						<input type="submit" value="Submit">
					</form>

					<!-- <script src="node_modules/chart.js/dist/Chart.min.js" type="text/javascript"></script> -->
					<script>
						
					</script>
									
					<canvas id="myChart" width="400" height="400"></canvas>

					<script type="text/javascript">
					var xAxis = [];
					var yAxis = [];
						@foreach($kotaunresolved as $kota)
							xAxis.push('{{$kota->kota}}');
							yAxis.push('{{$kota->jumlah_komplain}}');
						@endforeach	
					var ctx = document.getElementById("myChart").getContext("2d");
					var myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					        labels: xAxis,
					        datasets: [{
					            label: 'Jumlah komplain yang tidak selesai',
					            data: yAxis
					        }]
					    },
					    options: {
					        scales: {
					            yAxes: [{
					                ticks: {
					                    beginAtZero:true
					                }
					            }]
					        }
					    }
					});
					</script>
				</div>
			</div>
		</div>
	</div>
@endsection
