<?php $__env->startSection('htmlheader_title'); ?>
	Home
<?php $__env->stopSection(); ?>


<?php $__env->startSection('main-content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js" type="text/javascript"></script>

	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Chart</div>

					<!-- <script src="node_modules/chart.js/dist/Chart.min.js" type="text/javascript"></script> -->
					<script>
						
					</script>
									
					<canvas id="myChart" width="400" height="400"></canvas>

					<script type="text/javascript">
					var xAxis = [];
					var yAxis1 = [];
					var yAxis2 = [];
						

						<?php foreach($kotakomp as $komplain): ?>
							xAxis.push('<?php echo e($komplain->tanggal); ?>');
							yAxis1.push('<?php echo e($komplain->komplain); ?>');
						<?php endforeach; ?>
						

						<?php foreach($kotareso as $resolved): ?>
							yAxis2.push('<?php echo e($resolved->resolved); ?>');
						<?php endforeach; ?>	


					var ctx = document.getElementById("myChart").getContext("2d");
					var myChart = new Chart(ctx, {
					    type: 'line',
					    data: {
					        labels: xAxis,
					        datasets: [//{
					            //label: 'Jumlah terselesaikan',
					            //data: yAxis2
					        /*},*/ {
					            label: 'Jumlah komplain',
					            data: yAxis1
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>