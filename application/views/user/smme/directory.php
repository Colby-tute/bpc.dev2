<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Directory</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('user/smme/home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search</li>
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
                                 <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                            <?php } else if ($this->session->flashdata('success')) { ?>
                                 <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                            <?php }
                            ?>
                            </p>
                            <div class="table-responsive">
                               <!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
                                   <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">PID</th>
                                            <th scope="col">Reference</th>
                                            <!-- <th scope="col">Photo</th> -->
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Mobile Number</th>
                                            <th scope="col">Industry</th>
                                            <th scope="col">Incubation Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($search as $row)
                                        { ?>
                                        <tr>
                                        <td><?php echo $row->tbl_users_id;?></td> 
                                        <td>BDSP-<?php echo $row->tbl_users_user_uniqueid;?></td> 
                                        <!-- <td><img onerror="this.src='<?php echo base_url(); ?>assets/users/avtar.png?>'" src="<?php echo base_url(); ?>assets/users/<?php echo $row->tbl_users_photo;?>" style="width: 50px; height: auto;"></td> -->
                                        <td><?php echo $row->tbl_users_firstname." ".$row->tbl_users_lastname;?></td>  
                                        <td><?php echo $row->tbl_users_email;?></td>
                                         <?php
                                        //print_r($row->tbl_users_contrycode);
                                        if ($row->tbl_users_mobile != '') {
                                            if ($row->tbl_users_contrycode != '') {
                                                $exp = explode('-',$row->tbl_users_contrycode);
                                                /*print_r($exp);*/
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
                                        <?php
                                            $industry = $this->db->where('tbl_business_details_user_id',$row->tbl_users_id)->limit(1)->order_by('tbl_business_details_id','desc')->get('tbl_business_details')->row();

                                        ?>
                                        <td>
                                            <?php
                                                if($industry == null){
                                                    echo "N/A";
                                                }
                                                else{
                                                    echo $this->db->where('tbl_industry_id',$industry->tbl_business_details_industry)->get('tbl_industry')->row('tbl_industry_name');
                                                }
                                            ?>
                                        </td>
                                        <!-- <td><?php if($row->tbl_users_gender == 'M')
                                        {
                                            echo "Male";

                                        }else if($row->tbl_users_gender == 'F')
                                        {
                                            echo "Female";

                                        }
                                        else
                                        {
                                            echo "Other";

                                        }?></td>
                                        <td><?php echo $row->tbl_roles_title;?></td>  -->
										<td>
											<?php 
                                            if(in_array($row->tbl_users_status,array(4,6,7))){
                                                echo "In Incubation";
                                            }else{
                                                echo "Out of Programme";
                                            } ?>
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
