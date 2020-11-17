<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Business Details</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" ><a href="<?= site_url('incubator/BusinessDetails') ?>">Business Details</a></li>
						 <li class="breadcrumb-item active" aria-current="page">Business Incubator Partners</li>
                    </ol>
                </nav>

            </div>
			
			 <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/partner/add') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-plus-square mr-2"></i></span><span class="btn-text">Add Partner </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                 <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                            <?php } else if ($this->session->flashdata('success')) { ?>
                                 <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                            <?php }
                            ?>
                            </p>
                            <div class="table-responsive">
                               <!--<table id="example" class="table key-buttons text-md-nowrap"> -->
							   <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">PID</th>
                                            <th scope="col">Company Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Telephone Number</th>
                                            <th scope="col">Physical Address</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($tdata as $row)
                                        { ?>
                                        <tr>
                                        <td><?php echo $row->id;?></td> 
                                        <td><?php echo $row->name;?></td>   
                                        <td><?php echo $row->email;?></td>
                                        <td><?php echo $row->phone;?></td>
                                        <td><?php echo $row->address;?></td>
                                        <td>
											<button data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
											<div class="dropdown-menu">
												<a href="<?= site_url('incubator/partner/edit/'.$row->id) ?>" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
												<a href="#" class="dropdown-item delete-smme" data-id="<?= $row->id ?>"><i class="fa fa-trash"></i> Delete
												</a>
											</div>											
                                        </td>
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
            </div>
            <!-- row closed -->
        </div>
    </div>
<?= $footer; ?>

<script>
	$(function () {
		$(".delete-smme").on("click", function (event) {
            let conf = confirm("Are you sure?")
            if (!conf) {
                event.preventDefault()
                return false;
            }

            location.href = '<?= site_url('incubator/partner/delete/') ?>' + $(this).data('id')
        })
	});
</script>


