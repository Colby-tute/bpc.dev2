<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Incubation Progress</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Incubation Progress</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
			<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
			<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button>
			<button class="btn btn-success ml-0"><span class="icon-label"><i class="fa fa-download"></i></span> <span class="btn-text">Export</span></button>
		</div>
	</div>
	<div class="row row-sm">	
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="main-content-label mg-b-5">
						Incubation Progress
					</div>
					<p class="mg-b-20">Chart for Incubation Progress</p>
					<div class="ht-200 ht-sm-300" id="incubationChart"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-body iconfont text-left">
					<div class="table-responsive">
						<div id="data_table">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>
<?= $footer; ?>

<!-- Flot js -->
<script src="../../assets/plugins/jquery.flot/jquery.flot.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.time.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.resize.js"></script>	
<!-- Chart flot js -->
<script src="../../assets/js/chart.flot.js"></script>


<script type="text/javascript">
$(document).ready(function () {
	loadIncubationChart();
});
var incubationProgress = <?= $incubationProgress ?>;

function loadIncubationChart() {
	var chartData = [];
	for(var key in incubationProgress) {
		count = incubationProgress[key];
		chartData.push({
			label: key,
			data: [
				[1, count]
			],
			color: getRandomColor()
		});
	}
	drawChart(chartData);
	drawTable(incubationProgress);
}


function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

function drawChart(chartData) {
	$.plot('#incubationChart', chartData, {
		series: {
			pie: {
				show: true,
				radius: 1,
				innerRadius: 0.5,
				label: {
					show: true,
					radius: 2 / 3,
					formatter: labelFormatter,
					threshold: 0.1
				}
			}
		},
		grid: {
			borderWidth: 1,
			borderColor: 'rgba(171, 167, 167,0.2)',
			hoverable: true
		}
	});
	function labelFormatter(label, series) {
		return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
	}
}

function drawTable(data){
   var tableContent = "<table id='example' class='table key-buttons text-md-nowrap'>" + 
        '<thead>' +
            '<tr>' +
            '<th scope="col">#</th>' +
            '<th scope="col">Phase</th>' +
    		'<th scope="col">Count</th>' +
            '</tr>' +
        '</thead>' +
	    '<tbody>';
	var index = 0;
	for(var key in data) {
		rowData = data[key];
    	tableContent +=	'<tr>' +
    		'<td>'+(parseInt(index,10)+1)+'</td>' +
    		'<td>'+key+'</td>' +
    		'<td>'+rowData+'</td>'+
    		'</tr>';
    	index++;
	}
	tableContent +=	'</tbody>' +
				'</table>';
	$('#data_table').empty();
	$('#data_table').append(tableContent);
}
</script>
