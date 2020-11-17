<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2"><?= $folder->tbl_folder_name ?> </h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url($type.'/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url($path.'/index') ?>">Incubator Repository</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?= $folder->tbl_folder_name ?></li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">

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

						<?php if($this->session->flashdata('file_errors')) { 
							foreach($this->session->flashdata('file_errors') as $error){ ?>
								<div id="infoMessage"
							 class="alert alert-danger mt25"><?php echo $error ?></div>
						<?php } } ?>						
						</p>
						<div class="table-responsive">
							<!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
							<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
								<thead>
								<tr>
									<th scope="col" width="10%">PID</th>
									<th scope="col">File Name</th>
									<th scope="col">Download</th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($files as $file) { ?>
										<tr>
											<th scope="col"><?php echo $file->tbl_id ?></th>
											<th scope="col"><a href="<?php echo site_url($path.'/download/'.$file->tbl_id) ?>"> <i class="fa fa-file"> </i></a> <?= $file->tbl_filename ?></th>
											<th scope="col"><a href="<?php echo site_url($path.'/download/'.$file->tbl_id) ?>"> <i class="fa fa-download"> </i> </a></th>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>

<?= $footer; ?>
