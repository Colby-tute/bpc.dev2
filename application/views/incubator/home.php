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
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/Home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Analytics &amp; Monitoring</li>
				</ol>
			</nav>

		</div>		
		 <div class="my-auto breadcrumb-right">
							<a href="Application" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
								<h4 class="mb-1 font-weight-bold"><?php echo 'INCU-'.$this->session->userdata('user_unique_id');?></h4>
								<p class="mb-2 tx-12 text-muted">Registered: <?php echo $user_data[0]->tbl_users_insertdate;?></p>
							</div>
							<div class="card-chart bg-primary-transparent brround ml-auto mt-0">
								<i class="typcn typcn-group-outline text-primary tx-24"></i>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<div class="d-flex justify-content-between">
							<h4 class="card-title mb-3">INCUBATOR TEAM MEMBERS</h4>
							<i class="mdi mdi-dots-horizontal text-gray"></i>
						</div>
						<div class="d-flex mb-0">
							<div class="">
								<h4 class="mb-1 font-weight-bold"><?php echo $total_count_team;?></h4>
								
								<p class="mb-2 tx-12 text-muted">Staff working in the incubator</p>
							</div>
							<div class="card-chart bg-pink-transparent brround ml-auto mt-0">
								<a href="<?=site_url('incubator/team') ?>"><i class="typcn typcn-chart-line-outline text-pink tx-24"></i></a>
							</div>
						</div>

						
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
                                <div class="card">
                                    <div class="card-body iconfont text-left">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-3">BDSP | Coaches | Mentors</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                        <div class="d-flex mb-0">
                                            <div class="">
                                                <h4 class="mb-1   font-weight-bold"><?php echo $role['bdsp']?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total BDSP, coaches and mentors.</p>
                                            </div>
                                            <div class="card-chart bg-teal-transparent brround ml-auto mt-0">
                                                <a href="<?=site_url('incubator/Operations/allbdsp') ?>"><i class="typcn typcn-th-small text-teal tx-20"></i></a>
                                            </div>
                                        </div>
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
												<h4 class="mb-1 font-weight-bold"><?php echo $smmeApps ?></h4>
												 <p class="mb-2 tx-12 text-muted">Total active incubation applications</p>
											</div>
											<div class="card-chart bg-teal-transparent brround ml-auto mt-0">
												<a href="<?=site_url('incubator/Application') ?>"><i class="typcn typcn-folder-add  text-teal tx-24"></i></a>
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
                                                <a href="<?=site_url('incubator/Application') ?>"><i class="typcn typcn-cancel text-pink tx-24"></i></a>
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
												<a href="<?=site_url('incubator/Operations/indexsmme') ?>"><i class="typcn typcn-group text-purple tx-24"></i></a>
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
												<a href="<?=site_url('incubator/Operations/indexsmme') ?>"><i class="typcn typcn-user-delete  text-warning tx-24"></i></a>
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
												<a href="<?=site_url('incubator/Operations/indexsmme') ?>"><i class="typcn typcn-user-add  text-success tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">MSME Milestone Tasks</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $jobs; ?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total MSMEs' milestone tasks</p>
											</div>
											<div class="card-chart bg-purple-transparent brround ml-auto mt-0">
												<a href="<?=site_url('incubator/BusinessDetails/bbm') ?>"><i class="typcn typcn-location text-purple tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">MSME CREATED JOBS</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $jobs1; ?></h4>
                                                <p class="mb-2 tx-12 text-muted">Total casual or seasonal jobs created</p>
											</div>
											<div class="card-chart bg-primary-transparent brround ml-auto mt-0">
												<a href="<?=site_url('incubator/Analytics/registrationsReport') ?>"><i class="typcn typcn-briefcase text-primary tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>

<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
							
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">TOTAL BI RAISED FUNDS</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold">M<?php echo $inc_revenue ?></h4>
                                                <p class="mb-2 tx-12 text-muted">Business incubator's raised funds</p>
											</div>
											<div class="card-chart bg-pink-transparent brround ml-auto mt-0">
												<a href="<?=site_url('incubator/Operations/indexsmme') ?>"><i class="typcn typcn-chart-pie text-pink tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
			
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
								<div class="card">
									<div class="card-body iconfont text-left">
										<div class="d-flex justify-content-between">
											<h4 class="card-title mb-3">GRADUATED MSMES</h4>
											<i class="mdi mdi-dots-horizontal text-gray"></i>
										</div>
										<div class="d-flex mb-0">
											<div class="">
												<h4 class="mb-1 font-weight-bold"><?php echo $graduated00 ?></h4>
												 <p class="mb-2 tx-12 text-muted">Total number of graduated MSMEs.</p>
											</div>
											<div class="card-chart bg-purple-transparent brround ml-auto mt-0">
												<a href="<?=site_url('incubator/Operations/indexsmme') ?>"><i class="typcn typcn-mortar-board text-purple tx-24"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>

			
		</div>
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
