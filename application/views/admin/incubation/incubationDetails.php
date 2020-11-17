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
					<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">Incubator Programme Details</li>
				</ol>
			</nav>

		</div>
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/incubation/Incubation/incubationList') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('admin/incubation/Incubation/create') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Create Programme </span></button></a>
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
                        <div class="bg-gray-300 nav-bg">
                            <nav class="nav nav-tabs">
                            	<a class="nav-link active show" data-toggle="tab" href="#tabCont1">Programme Summary</a>
                                <a class="nav-link tabCont2" data-toggle="tab" href="#tabCont2">Incubator Manager
                                <a class="nav-link tabCont3" data-toggle="tab" href="#tabCont3">BDSP | Coaches | Mentors</a>
                                <a class="nav-link tabCont4" data-toggle="tab" href="#tabCont4">MSMES</a>
								<a class="nav-link tabCont5" data-toggle="tab" href="#tabCont5">Facility Management</a>
                            </nav>
                        </div>

                        <div class="card-body tab-content">
	                        <div class="tab-pane active show" id="tabCont1">
	                            <div class="row">                        						
											<div class="row">
												<div class="col-sm-6" style="padding-top:5px;">
                                                    <label class="form-label label_font">Incubator Programme Name</label>
                                                    <b class="b_font">
                                                    <?php 
                                                        if(!empty($incubation)){ 
                                                            echo $incubation->title; 
                                                        }else{
                                                            echo "[Unspecified]";
                                                        } ?>
                                                    </b>
												</div>
												<div class="col-sm-6" style="padding-top:5px;">
                                                    <label class="form-label label_font">Programme Description</label>
                                                    <b class="b_font">
                                                    <?php 
                                                        if(!empty($incubation)){ 
                                                            echo $incubation->description; 
                                                        }else{
                                                            echo "[Unspecified]";
                                                        } ?>
                                                    </b>
												</div>
												<div class="col-sm-6" style="padding-top:5px;">
                                                    <label class="form-label label_font">Physical Address</label>
                                                    <b class="b_font">
                                                    <?php 
                                                        if(!empty($incubation)){ 
                                                            echo $incubation->address; 
                                                        }else{
                                                            echo "[Unspecified]";
                                                        } ?>
                                                    </b>
												</div>
												<div class="col-sm-6" style="padding-top:5px;">
                                                    <label class="form-label label_font">Telephone Number</label>
                                                    <b class="b_font">
                                                    <?php 
                                                        if(!empty($incubation)){ 
                                                            echo $incubation->phone; 
                                                        }else{
                                                            echo "[Unspecified]";
                                                        } ?>
                                                    </b>
												</div>
											</div>
								</div>
							</div>

	                        <div class="tab-pane"  id="tabCont2">
	                            <div class="row">                        						
									<div class="table-responsive">
										<table class="table key-buttons text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
											<thead>
		                                        <tr>
		                                            <th scope="col">pid</th>
		                                            <th scope="col">Reference</th>
		                                            <th scope="col">Full Name</th>
		                                            <th scope="col">Email Address</th>
		                                            <th scope="col">Mobile Number</th>
		                                        </tr>
											</thead>
											<tbody>
		                                        <?php
		                                        if(!empty($incubators)) {
		                                         foreach($incubators as $row)
		                                        { ?>
		                                        <tr>
		                                        <td><?php echo $row->tbl_users_id;?></td> 
		                                        <td>INCU-<?php echo $row->tbl_users_user_uniqueid;?></td> 
		                                        <td><?php echo $row->tbl_users_firstname." ".$row->tbl_users_lastname;?></td>  
		                                        <td><?php echo $row->tbl_users_email;?></td>
		                                         <?php
		                                        if ($row->tbl_users_mobile != '') {
		                                            if ($row->tbl_users_contrycode != '') {
		                                                $exp = explode('-',$row->tbl_users_contrycode);
		                                                $code = $exp[1];
		                                            }
		                                            else{
		                                                $code = '';
		                                            }
		                                            
		                                            $mobile = '+'.$code.''.$row->tbl_users_mobile;
		                                        }else{
		                                            $mobile = '';
		                                        }
		                                        ?>
		                                        <td><?php echo $mobile;?></td>
		                                        </tr>
		                                        <?php 
		                                    		}
		                                        }  else {
		                                        	echo "No data to display!";
		                                        } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>

	                        <div class="tab-pane"  id="tabCont3">
	                            <div class="row">                        						
									<div class="table-responsive">
										<table class="table key-buttons text-md-nowrap dataTable no-footer" style="width: 100%" id="example2" role="grid" aria-describedby="example2_info">
											<thead>
		                                        <tr>
		                                            <th scope="col">pid</th>
		                                            <th scope="col">Reference</th>
		                                            <th scope="col">Full Name</th>
		                                            <th scope="col">Email Address</th>
		                                            <th scope="col">Mobile Number</th>
		                                        </tr>
											</thead>
											<tbody>
		                                        <?php
		                                        if(!empty($bdsps)) {
		                                         foreach($bdsps as $row)
		                                        { ?>
		                                        <tr>
		                                        <td><?php echo $row->tbl_users_id;?></td> 
		                                        <td>BDSP-<?php echo $row->tbl_users_user_uniqueid;?></td> 
		                                        <td><?php echo $row->tbl_users_firstname." ".$row->tbl_users_lastname;?></td>  
		                                        <td><?php echo $row->tbl_users_email;?></td>
		                                         <?php
		                                        if ($row->tbl_users_mobile != '') {
		                                            if ($row->tbl_users_contrycode != '') {
		                                                $exp = explode('-',$row->tbl_users_contrycode);
		                                                $code = $exp[1];
		                                            }
		                                            else{
		                                                $code = '';
		                                            }
		                                            
		                                            $mobile = '+'.$code.''.$row->tbl_users_mobile;
		                                        }else{
		                                            $mobile = '';
		                                        }
		                                        ?>
		                                        <td><?php echo $mobile;?></td>
		                                        </tr>
		                                        <?php 
		                                    		}
		                                        }  else {
		                                        	echo "No data to display!";
		                                        } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
	                        <div class="tab-pane"  id="tabCont4">
	                            <div class="row">                        						
									<div class="table-responsive">
										<table class="table key-buttons text-md-nowrap dataTable no-footer" id="example3" role="grid" aria-describedby="example3_info">
											<thead>
		                                        <tr>
		                                            <th scope="col">pid</th>
		                                            <th scope="col">Reference</th>
		                                            <th scope="col">Full Name</th>
		                                            <th scope="col">Email Address</th>
		                                            <th scope="col">Mobile Number</th>
		                                            <th scope="col">Actions</th>
		                                        </tr>
											</thead>
											<tbody>
		                                        <?php
		                                        if(!empty($smmes)) {
		                                         foreach($smmes as $row)
		                                        { ?>
		                                        <tr>
		                                        <td><?php echo $row->tbl_users_id;?></td> 
		                                        <td>MSME-<?php echo $row->tbl_users_user_uniqueid;?></td> 
		                                        <td><?php echo $row->tbl_users_firstname." ".$row->tbl_users_lastname;?></td>  
		                                        <td><?php echo $row->tbl_users_email;?></td>
		                                         <?php
		                                        if ($row->tbl_users_mobile != '') {
		                                            if ($row->tbl_users_contrycode != '') {
		                                                $exp = explode('-',$row->tbl_users_contrycode);
		                                                $code = $exp[1];
		                                            }
		                                            else{
		                                                $code = '';
		                                            }
		                                            
		                                            $mobile = '+'.$code.''.$row->tbl_users_mobile;
		                                        }else{
		                                            $mobile = '';
		                                        }
		                                        ?>
		                                        <td><?php echo $mobile;?></td>
		                                        <td>
		                                            <button data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
		                                            <div class="dropdown-menu">
		                                                <a href="<?= site_url('admin/smme/Smme/edit/'.$row->tbl_users_id) ?>" class="dropdown-item"> <i class="fa fa-edit"></i> Edit
		                                                </a>
		                                                <a href="<?= site_url('admin/smme/Smme/createTask/' . $row->tbl_users_id) ?>"
		                                                   class="dropdown-item"><i class="fa fa-plus-square"></i> Create Task
		                                                </a>
		                                                <a href="<?= site_url('admin/smme/Smme/' . $row->tbl_users_id) ?>"
		                                                   class="dropdown-item"><i class="fa fa-calendar-plus"></i> Create Milestone
		                                                </a>

		                                                <a href="<?= site_url('admin/smme/Smme/createMilestoneTask/' . $row->tbl_users_id) ?>"
		                                                   class="dropdown-item"><i class="fa fa-calendar-plus"></i> Create Milestone Task
		                                                </a>

		                                                <a href="#" class="dropdown-item delete-smme" data-id="<?= $row->tbl_users_id ?>"><i class="fa fa-trash"></i> Delete
		                                                </a>
		                                                <a class="dropdown-item login_view" data-target="#scrollmodal" data-toggle="modal" href="" data-id="<?php echo $row->tbl_users_id;?>"><i class="fa fa-unlock-alt"></i> Login Activities</a>
		                                            </div>      
		                                        </td>
		                                        </tr>
		                                        <?php 
		                                    		}
		                                        } else {
		                                        	//echo "No data to display!";
		                                        }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							    <div class="tab-pane"  id="tabCont5">
	                            <div class="row">                        						
									<div class="table-responsive">
										<table class="table key-buttons text-md-nowrap dataTable no-footer" style="width: 100%" id="example2" role="grid" aria-describedby="example2_info">
											<thead>
		                                        <tr>
		                                            <th scope="col">pid</th>
		                                            <th scope="col">Category</th>
		                                            <th scope="col">Item Full Name</th>
		                                            <th scope="col">Status</th>
		                                        </tr>
											</thead>
											<tbody>
		                                        <?php foreach($facility as $item) {?>
			                                    <tr>
			                                        <td><?php echo $item->facility_item_id ;?></td> 
			                                        <td><?php echo $item->facility_category_name ;?></td> 
			                                        <td><?php echo $item->facility_item_name ;?></td>  
			                                        <td><?php if($item->facility_category_is_deleted == 0){
			                                        	echo "Active";
			                                        	}else{
			                                        		echo "Deleted";
			                                        	} ?>
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
				</div>
			</div>
		</div>
		<!-- row closed -->
	</div>
</div>
<?= $footer; ?>
