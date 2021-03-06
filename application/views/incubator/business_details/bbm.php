<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Business Building Model</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Business Building Model</li>
                    </ol>
                </nav>

            </div>
                        
            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/Application'); ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
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
                                  <?php }?>
                            </p>
                            <div class="table-responsive">
                              <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">PID</th>
											<th scope="col">Reference</th>
											<th scope="col">Full Name</th>
                                            <th scope="col">Email Address</th>
											<th scope="col">Telephone Number</th>
											<th scope="col">BBM Progress</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
										$j=1;
										if(!empty($bbmprodetails)){
											foreach ($bbmprodetails as $row) {
												$bbmpro[$j]=$row->bbmprog;
												$j=$j+1;
											}
										}else{
											$bbmpro[$j]="";
										}
                                        $i = 1;
                                    		foreach ($view_data as $key => $value) { ?>
                                    			<tr>
                                    				<td><?php echo $i;?></td>
													
													<td>MSME-<?= $value->uniqueid; ?></td>
													
													
													<td><?php echo $value->name.' '.$value->last_name;?></td>
                                                    <td><?php echo $value->email;?></td>
													<td><?php echo $value->mobile;?></td>
													<td><?php echo sprintf("%.2f",$bbmpro[$i]);?>%</td>
                                    				<td>
                                                  <!--      <button onclick="window.location.href='<?= site_url('incubator/BusinessDetails/editbbm/'.$value->id) ?>'" class="btn btn-primary button_width" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip"><i class="la la-edit iconsetting"></i></button>
                                                        <button onclick="window.location.href='<?= site_url('incubator/BusinessDetails/add_question/'.$value->id) ?>'" class="btn btn-primary button_width" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip"><i class="la la-add iconsetting"></i></button>
                                                 -->
                                                        <button onclick="window.location.href='<?= site_url('incubator/BusinessDetails/handlebbm/'.$value->id) ?>'" class="btn btn-primary button_width" style="padding: 3px 6px 0px 6px;" data-toggle="tooltip"><i class="la la-edit iconsetting"></i></button>
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
<?= $footer; ?>