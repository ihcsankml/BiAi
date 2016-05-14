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
	<title>Test</title>
</head>
<body>
<canvas id="myChart" width="500" height="500"></canvas>
<script>
$(document).ready(function () {

    $.ajax({
        url: "/static/MOCK_DATA.csv",
        async: false,
	    success: function (csvd) {
	        data = $.csv.toArrays(csvd);
	    },
	    dataType: "text",
	    complete: function () {
	        // call a function on complete 
	    }
    });
    labels = [];
    dataTable = [];
	for (var i = 1; i < data.length; i++) {
	    if(labels.includes(data[i][1])){
	    	//increment data
	  		var index = labels.indexOf(data[i][1]);
			dataTable[index]++;
			// alert('b');
	    }
	    else{
	    	//belom ada, masukin array label
	    	// alert('a');
	    	labels.push(data[i][1]);
	    	dataTable.push(0);
	    }
	}
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Jumlah transaksi',
            data: dataTable,
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
});
</script>
</body>
</html>
@endsection
