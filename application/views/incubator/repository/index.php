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
					<li class="breadcrumb-item active" aria-current="page">Incubator Repository</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">

							<button data-toggle="modal" data-target="#myModal" class="btn btn-success mr-3"><span class="icon-label"><i class="fa fa-file mr-2"></i> </span><span class="btn-text">Create Repository </span></button>
							<a href="<?= site_url('incubator/Repository/assignRepository/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-users mr-2"></i> </span><span class="btn-text">Assign Repository </span></button></a>
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
						<?php }
						?>
						</p>
						<div class="table-responsive">
							<!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
							<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
								<thead>
								<tr>
									<th scope="col">PID</th>
									<th scope="col">Repository Name</th>
									<th scope="col">Actions</th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($folders as $folder) { ?>
										<tr>
											<td><?= $folder->tbl_id ?></td>
											<td><a href="<?php echo site_url('incubator/Repository/viewRepository/'. $folder->tbl_id) ?>"><i class="fa fa-folder"> </i> <?= $folder->tbl_folder_name ?></a> <span class="badge badge-pill badge-primary"><?php echo repositoryFilesCount($folder->tbl_id); ?></span></td>
											<td>
												<a onclick="updateRepository('<?php echo $folder->tbl_id;?>','<?php echo $folder->tbl_folder_name;?>');" href="javascript:void(0)"  data-toggle="modal" data-target="#editModal" ><span class="icon-label"><i class="fa fa-edit"></i></a>

												<a onclick="if(confirm('Are you sure want to delete repository?') != true){ return false; }" href="<?php echo site_url('incubator/Repository/deleteFolder/'. $folder->tbl_id) ?>"><i class="fa fa-trash"> </i></a>
											</td>
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
			<form action="<?php echo site_url('incubator/Repository/createFolder'); ?>" method="post">
				<div class="modal-header">
					<h6 class="modal-title">Create Repository</h6>
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
							aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="tbl_user_id" value="<?php echo $this->session->userdata('id_user')?>">
						<input required class="form-control" id="folderName" type="text" name="tbl_folder_name" placeholder="Enter Folder name">
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

<div class="modal fade" id="editModal">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content modal-content-demo">
			<form action="<?php echo site_url('incubator/Repository/updateFolder'); ?>" method="post">
				<div class="modal-header">
					<h6 class="modal-title">Edit Repository</h6>
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
							aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="form-group">

						<input type="hidden" name="tbl_id" id="tbl_id" value="">
						<input required class="form-control" id="editfolderName" type="text" name="tbl_folder_name" placeholder="Enter Folder name">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn ripple btn-primary" type="submit">Update</button>
					<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function updateRepository(id,name){
		$("#tbl_id").val(id);
		$("#editfolderName").val(name);
	}
</script>
<?= $footer; ?>
