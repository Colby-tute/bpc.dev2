<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Resources</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/Repository/index') ?>">Incubator Repository</a></li>
					<li class="breadcrumb-item active" aria-current="page">Assign Repository</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
		<a href="<?= site_url('incubator/Repository/index') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
			<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
		</div>
	</div>

	<div class="">
		<!-- row opened -->
		<div class="row row-sm">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body iconfont text-left">
						<p><?php if ($this->session->flashdata('danger')) { ?>
						<div id="infoMessage"
							 class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger'); ?></div>
						<?php } else if ($this->session->flashdata('success')) { ?>
							<div id="infoMessage"
								 class="alert alert-success mt25"><?php echo $this->session->flashdata('success'); ?></div>
						<?php } ?>						
						</p>
						<?php 
						// echo "<pre>";
						// 	print_r($smmes);
						// 	print_r($bdsps);
						?>
						<form action="<?php echo site_url('incubator/Repository/assignRepositorySave'); ?>" method="POST">
							<div class="row">
								<div class="col-md-12">

								<h3>MSME</h3>
									<?php
										foreach($smmes as $user){ ?>
											<div class="row mb-5">
												<table class="table table-bordered table-striped">
													<thead class="thead-dark">
														<tr>
															<th scope="col" width="30%">User Full Name</th>
															<th scope="col">Folder Rights</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?= $user->name ?></td>
															<td>
																<?php 
																	foreach($folders as $folder){
																		$key = $folder->tbl_id."|".$user->id."|".$this->session->userdata('id_user');
																	?>
																		<input type='checkbox' name="folders[]" value="<?= $key ?>" <?php if(in_array($key,$asssigned)) { echo 'checked'; } ?> > <?= $folder->tbl_folder_name ?>	
																	<?php }
																?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
									<?php	}
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">

								<h3>BDSP</h3>
									<?php
										foreach($bdsps as $user){ ?>
											<div class="row mb-5">
												<table class="table table-bordered table-striped">
													<thead class="thead-dark">
														<tr>
															<th scope="col" width="30%">User Full Name</th>
															<th scope="col">Folder Rights</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?= $user->name ?></td>
															<td>
																<?php 
																	foreach($folders as $folder){ 
																		$key = $folder->tbl_id."|".$user->id."|".$this->session->userdata('id_user');
																																			?>
																		<input type='checkbox' name="folders[]" value="<?= $key ?>" <?php if(in_array($key,$asssigned)) { echo 'checked'; } ?> > <?= $folder->tbl_folder_name ?>	
																	<?php }
																?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
									<?php	}
									?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12"><button class="btn btn-success mr-3">Assign</button></div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>

<?= $footer; ?>
