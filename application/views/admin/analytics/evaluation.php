<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Evaluations Chart</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Evaluation Chart</li>
				</ol>
			</nav>

		</div>
		<!-- <div class="my-auto breadcrumb-right">
			<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
			<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button>
			<button class="btn btn-success ml-0"><span class="icon-label"><i class="fa fa-download"></i></span> <span class="btn-text">Export</span></button>
		</div> -->
	</div>
	<!-------------- ---->

<div class="row-xs">
							<div class="card mg-b-20">
								 
								<div class="card-body">
 
 									<div class="table-responsive">
										<table id="example-kk" class="table key-buttons text-md-nowrap">
											
											<thead>
												<tr>
													<th>Uniqueid</th>
													<th>Role</th>
													<th>Name</th>
													<th>Rating</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
									<?php 
										$userData = json_decode($reportTabledata,true);
										foreach ($userData as $users) {	
										$role = $users['tbl_roles_title'];
										if($users['tbl_roles_title']=='SMME'){
											$role = 'MSME';
										}											
									 ?>  
												<tr>
													<td><?=$users['tbl_users_user_uniqueid'] ; ?></td>
													<td><?=$role; ?></td>
													<td><?=$users['tbl_users_firstname'] .' '. $users['tbl_users_lastname'] ; ?></td>
													<td><?=round($users['average_rating']) ; ?></td>
													<td></td>
													
												</tr>
									<?php 
										}	
									?>
																						 
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
<!----- ------->
	<div class="row row-sm">
			<div class="row row-sm">
				<div class="card mg-b-20">
					<div class="card-body">
						<div class="main-content-label mg-b-5">
							Chart Options
						</div>
						<ul id="usersList">
							<li><a href="#">MSME</a>
								<ul>
								<?php 
								$_smmes = json_decode($smmes);
								foreach($_smmes as $smme) {
								?>
									<li onclick='loadChart("MSME", <?= $smme->user_id ?>, this)' class="smmeTreeMenu"><?= $smme->user_fname . ' ' . $smme->user_lname ?></li>
								<?php
								}
								?>
								</ul>
							</li>
							<li><a href="#">INCUBATORS</a>
								<ul>
								<?php 
								$_incubators = json_decode($incubators);
								foreach($_incubators as $incubator) {
								?>
									<li onclick='loadChart("INCUBATORS", <?= $incubator->user_id ?>, this)'><?= $incubator->user_fname . ' ' . $incubator->user_lname ?></li>
								<?php
								}
								?>
								</ul>
							</li>
							<li><a href="#">BDSP</a>
								<ul>
								<?php 
								$_bdsps = json_decode($bdsps);
								foreach ($_bdsps as $bdsp) {
								?>
									<li onclick="loadChart('BDSP', <?= $bdsp->user_id ?>, this)"><?= $bdsp->user_fname . ' ' . $bdsp->user_lname ?></li>
								<?php
								}
								?>
								</ul>
							</li>
						</ul>
					</div>
				</div>	
			</div>		
		<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
			<div class="card">
				<div class="card-body">
					<div class="main-content-label mg-b-5" id="evaluationTitle">
					</div>
					<div class="ht-200 ht-sm-300" id="evaluationChart"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row row-sm">
		<div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">
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

<!-- treeview -->
<link href="../../assets/plugins/treeview/treeview-rtl.css" rel="stylesheet" type="text/css" />
<style type="text/css">
li:hover {
  color: blue;
}	
</style>>
<!-- Flot js -->
<script src="../../assets/plugins/jquery.flot/jquery.flot.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.pie.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.time.js"></script>
<script src="../../assets/plugins/jquery.flot/jquery.flot.resize.js"></script>	
<!-- Chart flot js -->
<script src="../../assets/js/chart.flot.js"></script>

<script src="../../assets/plugins/treeview/treeview.js"></script>

<script type="text/javascript">
$(document).ready(function () {
	$('#usersList').treed();
	smmes = document.getElementsByClassName("smmeTreeMenu");
	if(smmes.length) {
		smmes[0].click();
	}
});
var smmes = <?= $smmes ?>;
var incubators = <?= $incubators ?>;
var bdsps = <?= $bdsps ?>;

function loadChart(type, id, element) {	
    $.ajax({
        method: "post",
        url: '<?= base_url() ?>admin/analytics/getUserEvaluationReport',
        data: {
            'userType': type,
            'userId': id
        },
        success:function(data) {
			$('#evaluationTitle').empty();
			$('#evaluationTitle').append('Evaluation Chart for ' + element.innerHTML);
            updateChart(data);
        }
    });
}
function updateChart(evaluationData) {
	evaluationData = JSON.parse(evaluationData);
	drawChart(evaluationData);
	drawTable(evaluationData);
}

function drawChart(data) {
	evaluationRatings = "";
	for(key in data) {
		rating = Math.round(data[key]);
		var ratingArr = [];
		for(var i = 1; i <= 5; i++) {
			if(rating < i)
				ratingArr.push("");
			else
				ratingArr.push("is--active");
		}
		evaluationRatings += '<h4>' + key + '</h4>' +
		'<div class="rating-stars block" id="rating">' +
			'<input type="number" readonly="readonly" class="rating-value" name="rating-stars-value" id="rating-stars-value" value=' + rating + '>' +
			'<div class="rating-stars-container">';
		for(item in ratingArr) {
				evaluationRatings += '<div class="rating-star ' + ratingArr[item] + '">' +
										'<i class="fa fa-star"></i>' +
									'</div>';
			}
		evaluationRatings += '</div>' +
		'</div>';
	}
	$('#evaluationChart').empty();
	$('#evaluationChart').append(evaluationRatings);
}

function drawTable(data, type){
   var tableContent = "<table id='example' class='table key-buttons text-md-nowrap'>" + 
        '<thead>' +
            '<tr>' +
            '<th scope="col">#</th>' +
            '<th scope="col">Evaluator</th>' + 
            '<th scope="col">Rating</th>' +
            '</tr>' +
        '</thead>' +
	    '<tbody>';
	var index = 1;
	for(var key in data) {
		rating = Math.round(data[key]);
    	tableContent +=	'<tr><td>' + index + '</td>' +
    		'<td>' + key + '</td>' + 
    		'<td>' + rating + '</td></tr>';
    	index++;	
	}
    tableContent +=	'</tbody>' +
   					'</table>';
	$('#data_table').empty();
	$('#data_table').append(tableContent);
}

$(function(e) {
	var table = $('#example-kk').DataTable({
		buttons: [ 'excel','csv', 'pdf' ],
		responsive: true,
		pageLength: 5,
		lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
		searching: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ ',
		}
 	});
 
	table.buttons().container()
	.appendTo( '#example-kk_wrapper .col-md-6:eq(0)' );
	});
</script>
