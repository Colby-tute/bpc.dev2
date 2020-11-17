<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
<div class="container">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Search Result</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Search Results</li>
                </ol>
            </nav>

        </div>
		<div class="my-auto breadcrumb-right">
				
			<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
		</div>
	
	</div>
    <!-- breadcrumb -->
    <!-- row -->
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
                                            <th scope="col">Reference </th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Mobile Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($this->session->userdata('user_type') == 2){
                                                $type = "BDSP";
                                            }
                                            else{
                                                $type = "MSME";
                                            }
                                        foreach($search as $row)
                                        { ?>
                                        <tr>
                                        <td><?php echo $row->tbl_users_id;?></td> 
                                        <td><?= $type ?>-<?php echo $row->tbl_users_user_uniqueid;?></td> 
                                        <td><?php echo $row->tbl_users_firstname." ".$row->tbl_users_lastname;?></td>  
                                        <td><?php echo $row->tbl_users_email;?></td>
                                        <?php
                                        $exp = explode('-',$row->tbl_users_contrycode);
                                        ?>
                                        <td><?php echo '+'.$exp[1].'-'.$row->tbl_users_mobile;?></td>
                                       
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
</div>

<?= $footer; ?>
