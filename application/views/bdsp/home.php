<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>

<div class="container">
	<p><?php if ($this->session->flashdata('danger')) { ?>
	<div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
	<?php } else if ($this->session->flashdata('success')) { ?>
	<div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
	<?php }
	//echo count($tdata);
	//print_r($tdata);?></p>
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Dashboard</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/Home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring</li>
				</ol>
			</nav>

		</div>
		 <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('bdsp/application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('bdsp/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
	</div>

	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<div class="d-flex justify-content-between">
							<h4 class="card-title mb-3">REFERENCE NUMBER</h4>
							<i class="mdi mdi-dots-horizontal text-gray"></i>
						</div>
						<div class="d-flex mb-0">
							<div class="">
								<h4 class="mb-1 font-weight-bold"><?php echo $this->session->userdata('user_type_name').'-'.$this->session->userdata('user_unique_id');?></h4>
								<p class="mb-2 tx-12 text-muted">Registered: <?php echo $user_data[0]->tbl_users_insertdate;?></p>
							</div>
							<div class="card-chart bg-primary-transparent brround ml-auto mt-0">
								<i class="typcn typcn-star text-primary tx-24"></i>
							</div>
						</div>

						<!-- <div class="progress progress-sm mt-2">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-primary wd-70p" role="progressbar"></div>
						</div>
						<small class="mb-0  text-muted">Monthly<span class="float-right text-muted">70%</span></small> -->
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<div class="d-flex justify-content-between">
							<h4 class="card-title mb-3">TOTAL TEAM MEMBERS</h4>
							<i class="mdi mdi-dots-horizontal text-gray"></i>
						</div>
						<div class="d-flex mb-0">
							<div class="">
								<h4 class="mb-1 font-weight-bold"><?php echo $total_count_team;?></h4>
								
								<p class="mb-2 tx-12 text-muted">Staff working in the incubator</p>
							</div>
							<div class="card-chart bg-pink-transparent brround ml-auto mt-0">
								<a href="<?=site_url('bdsp/team') ?>"><i class="typcn typcn-group text-pink tx-24"></i></a>
							</div>
						</div>

						<!-- <div class="progress progress-sm mt-2">
							<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-pink wd-50p" role="progressbar"></div>
						</div>
						<small class="mb-0  text-muted">Monthly<span class="float-right text-muted">50%</span></small> -->
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">INCUBATION APPLICATIONS</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $smmeApps ?><!-- <span class="text-success tx-13 ml-2">(<?php echo $role['app_active'];?>)</span> --></h4>
												 <p class="mb-2 tx-12 text-muted">Total active incubation applications</p>
											</div>
											<div class="card-chart bg-teal-transparent brround ml-auto mt-0">
												<a href="<?=site_url('bdsp/application') ?>"><i class="typcn typcn-folder-add  text-teal tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
                             <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-3">DECLINED APPLICATIONS</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <div class="d-flex mb-0">
                                            <div class="">
                                                <h4 class="mb-1 font-weight-bold"><?php echo $declinedApps?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total declined applications.</p>
                                            </div>
                                            <div class="card-chart bg-pink-transparent brround ml-auto mt-0">
                                                <a href="<?=site_url('bdsp/application') ?>"><i class="typcn typcn-cancel text-pink tx-24"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<div class="d-flex justify-content-between">
							<h4 class="card-title mb-3">TOTAL ASSIGNED MSMES</h4>
							<i class="mdi mdi-dots-horizontal text-gray"></i>
						</div>
						<div class="d-flex mb-0">
							<div class="">
								<h4 class="mb-1 font-weight-bold"><?php echo $assigned_smmes; ?></h4>
								<p class="mb-2 tx-12 text-muted">Total number of assigned MSMEs</p>
							</div>
							<div class="card-chart bg-teal-transparent brround ml-auto mt-0">
								<a href="<?=site_url('bdsp/Operations/index') ?>"><i class="typcn typcn-user  text-teal tx-24"></i></a>
							</div>
						</div>

						
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">MSMES IN INCUBATION</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $incSmmes ?></h4>
												 <p class="mb-2 tx-12 text-muted">Total number of MSMEs in incubation</p>
											</div>
											<div class="card-chart bg-purple-transparent brround ml-auto mt-0">
												<a href="<?=site_url('bdsp/Operations/index') ?>"><i class="typcn typcn-group text-purple tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>

			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">FEMALES IN INCUBATION</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $graduated ?></h4>
												 <p class="mb-2 tx-12 text-muted">Total female MSMEs in incubation.</p>
											</div>
											<div class="card-chart bg-warning-transparent brround ml-auto mt-0">
												<a href="<?=site_url('bdsp/Operations/index') ?>"><i class="typcn typcn-user-delete  text-warning tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">MALES IN INCUBATION</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $msAchieved ?></h4>
												 <p class="mb-2 tx-12 text-muted">Total male MSMEs in incubation.</p>
											</div>
											<div class="card-chart bg-success-transparent brround ml-auto mt-0">
												<a href="<?=site_url('bdsp/Operations/index') ?>"><i class="typcn typcn-user-add  text-success tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
			
			
		</div>
		<!-- row closed -->

		<!-- row opened -->

		<!-- row closed -->

		<!-- row opened -->

		<!-- row close -->
		
		<!-- row closed -->
	</div>
</div>
<!-- Container closed -->

<!--Sidebar-right-->

<?= $footer; ?>
<script type="text/javascript">
	$('.todo_id').click(function(){
		var id = $(this).data('id');
		//alert(id);
		$('.EditToDo #personal_todo_id').val(id);
		jQuery.ajax({
			type: "POST",
			url: "<?=base_url()?>user/smme/PersonalTodo/get_todo",
			dataType: 'text',
			data: {id:id},
			success: function(data)
			{
				//console.log(data);
				var obj = JSON.parse(data);
				//console.log(obj[0].tbl_personal_todos_subject);
				$('.EditToDo #subject').val(obj[0].tbl_personal_todos_subject);
				$('.EditToDo #due_date').val(obj[0].tbl_personal_todos_due_date);

			}
		});
	});
</script>
