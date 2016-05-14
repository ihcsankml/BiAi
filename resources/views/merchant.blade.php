@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<!--
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Home</div>

					<div class="panel-body">
						You are logged in!
					</div>
				</div>
			</div>
		</div>
	</div>
-->
<html>
<head>
	<script src="/static/jquery-1.12.3.js" type="text/javascript"></script>
	<script src="/static/jquery-csv.js" type="text/javascript"></script>
	<script src="/static/Chart.js"></script>
	<script src="/static/d3.min.js"></script>
	<title>Test</title>
</head>
<body>
<canvas id="myChart" width="500" height="500"></canvas>
<script>
// tes d3
	var test = [];
	var test2 = [];
	var xAxis = [];
	var yAxis = [];
	d3.csv("upload/MOCK_DATA_MERCHANT.csv", function(data) {
		// data.forEach(function(line) {
  //               line.Tanggal = in_format.parse(line.Tanggal);
  //           })
		olahDataMerchant(data);
	});
	function olahDataMerchant(data){
		window.test = data;
		window.test2 = d3.nest()
		  .key(function(d) { return d.merchant; })
		  .rollup(function(v) { return v.length; })
		  .entries(data);
		window.test2.forEach(function(d) {
		  xAxis.push(d.key);
		  yAxis.push(d.values);
		});
		var ctx = document.getElementById("myChart");
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: window.xAxis,
		        datasets: [{
		            label: 'Jumlah transaksi',
		            data: window.yAxis,
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
	}
</script>
</body>
</html>
@endsection
