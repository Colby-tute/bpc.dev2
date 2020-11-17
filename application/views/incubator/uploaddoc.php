<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Operations</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('incubator/Operations/indexsmme') ?>">MSME Management</a></li>
					<li class="breadcrumb-item active" aria-current="page">MSME Contracts & Agreements</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/Operations/indexsmme') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
	</div>

	<div class="">
	
	            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                       <div class="card-body">
					   <div class="form-group">
                                    <div class="row">
									 <div class="col-md-12">
									
									<p><?php if ($this->session->flashdata('danger')) { ?>
						<div id="infoMessage"
							 class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger'); ?></div>
						<?php } else if ($this->session->flashdata('success')) { ?>
							<div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success'); ?></div>
						<?php }
						?></p></div>
						</div>
						</div>
						
						     <div class="border">
							 
                            
                                    <div class="bg-gray-300 nav-bg">
                                        <nav class="nav nav-tabs">
                                            <a class="nav-link active" data-toggle="tab" href="#tabCont1">Contracts & Agreements</a>
                                            <a class="nav-link tabCont2" data-toggle="tab" href="#tabCont2">Manage Contracts & Agreements</a>
                                        </nav>
                                    </div>
                                    <div class="card-body tab-content">
                                        <div class="tab-pane active show" id="tabCont1">
						
						  <?php echo form_open_multipart("incubator/BusinessDetails/Uplaoddocformsme/", 'class="login" data-toggle="validator"'); ?>	
									
									 <div class="form-group ">
                                    <div class="row">
									 <div class="col-md-3">
									 <label class="form-label">									 
									Provide document title or decription.
									</label>
									</div>
									 <div class="col-md-5">
									<input name="title" class="qty form-control" id="title"  type="text"  placeholder="" >
									</div>
											</div>
								</div>
									 
									 
									 <div class="form-group ">
                                    <div class="row">
									
                                        <div class="col-md-3">
                                            <label class="form-label">
											Select the MSME profile you would like to upload this document to</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="msmeid" id="msmeid" class="form-control" >
							<option value="">---</option>
								<?php
								if (isset($tdata)) {
									foreach ($tdata as $row) {										
										$fullname=$row->tbl_users_firstname . " " . $row->tbl_users_lastname." | MSME-".$row->tbl_users_user_uniqueid; 	
										echo "<option  value='{$row->tbl_users_id}'>{$fullname}</option>";
									};	
								}
								?>
						</select>
                                        </div>
                                    </div>
                                </div>
								     <div class="form-group ">
                                    <div class="row">									
                                        <div class="col-md-3">
									 <label class="form-label">
									Select the document you would like to upload to selected MSME.
									</label>
									</div>
									 <div class="col-md-5">
									<input name="upload_msme_doc" class="qty form-control" id="upload_msme_doc"  type="file"  placeholder="" />
											</div>
											</div>
								</div>
                         
                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Upload</button>
                          </div>
                        <?php echo form_close(); ?>
						</div>
						  <div class="tab-pane" id="tabCont2">
						  <div class="table-responsive">
                                                                    <table class="table table-bordered mg-b-0 text-md-nowrap" style="width: 100%;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">PID</th>
                                                                                <th scope="col" style="width:40%">Document Name / Description</th>
																				<th scope="col" style="width:20%">MSME Full Name</th>
																				<th scope="col" style="width:20%"> USER UNIQUE ID</th>
                                                                                <th scope="col">Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $i = 1;
                                                                            foreach ($incu_doc as $key => $value) { ?>
                                                                                <tr>
                                                                                    <td><?php echo $i;?></td>
                                                                                    <td><?php echo $value->title;?></td>    
																					<td><?php echo $value->fname.' '.$value->lname;?></td>
<td><?php echo 'MSME-'.$value->uniqueid;?></td>  																					
																				   <td>                                                                                   
                                                                                    <a href="<?php echo base_url(); ?>assets/Application/Business_Document/<?php echo $value->document;?>" target="_blank" class="btn btn-success btn-block btn_width"><i class="far fa-eye"></i></a>
                                                                                    <a href="<?= site_url('incubator/BusinessDetails/delete/'.$value->docid) ?>" class="btn btn-danger btn-block btn_width"><i class="fa fa-trash"></i></a>		
																																		
																				</td>
                                                                                </tr>
                                                                                
                                                                            <?php $i++; }
                                                                            ?>
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
</div>
</div>
</div>
<?= $footer; ?>
