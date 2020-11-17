<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2"><?= $folder->tbl_folder_name ?></h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/Repository/index') ?>">Incubator Repository</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?= $folder->tbl_folder_name ?></li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">

							<button data-toggle="modal" data-target="#myModal" class="btn btn-success mr-3"><span class="icon-label"><i class="fa fa-file mr-2"></i> </span><span class="btn-text">Upload File</span></button>

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
									<th scope="col">PID</th>
									<th scope="col">File Name</th>
									<th scope="col">Actions</th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($files as $file) { ?>
										<tr>
											<th scope="col"><?php echo $file->tbl_id ?></th>
											<th scope="col"><a href="<?php echo site_url('incubator/Repository/download/'.$file->tbl_id) ?>"> <i class="fa fa-file"> </i> <?php echo $file->tbl_filename ?></a></th>
											
											<th scope="col">
												<a href="<?php echo site_url('incubator/Repository/download/'.$file->tbl_id) ?>"> <i class="fa fa-download"> </i></a>
												<a onclick="if(confirm('Are you sure want to delete file?') != true){ return false; }" href="<?php echo site_url('incubator/Repository/deleteFile/'. $file->tbl_id.'/'.$folder->tbl_id) ?>"><i class="fa fa-trash"> </i></a>
											</th>
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

<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content modal-content-demo">
			<form action="<?php echo site_url('incubator/Repository/uploadFile'); ?>" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h6 class="modal-title">Upload File</h6>
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
							aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="tbl_folder_id" value="<?php echo $folder->tbl_id; ?>">
						<input required class="form-control" id="tbl_filename" type="file" name="tbl_filename" placeholder="Enter Folder name" required>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn ripple btn-primary" type="submit">Create</button>
					<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?= $footer; ?>
