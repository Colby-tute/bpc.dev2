<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?= $header; ?>

<div class="container">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Broadcast Messages</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('incubator/Home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Broadcast Messages</li>
                </ol>
            </nav>
        </div>
		
		<div class="my-auto breadcrumb-right">
							<a href="<?=site_url('incubator/Application')?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
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

                    <div class="row"> 
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                             <th scope="col" width="5%">PID</th>
                                            <th scope="col" width="50%">Broadcast Messages List</th>
											<th scope="col" width="10%">Status</th>
                                            <th scope="col" width="15%">Created Date</th>
                                            <th scope="col" width="15%">Expiry Date</th>
                                            <th scope="col" width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="t4 main-message-list chat-scroll ps broadcast-box" id="broadcast-box">
                                    <?php foreach($messages as $message) { 
                                    if(date("Y-m-d H:i ",strtotime($message->tbl_broadcast_expiry)) > date('Y-m-d H:i') || $message->tbl_broadcast_expiry == ''){
                                            ?>
                                        <tr>
                                            <td><?php echo $message->tbl_broadcast_id; ?></td>
                                            <td><?php echo $message->tbl_broadcast_message; ?></td>
                                            <td>
                                                <?php 
                                                $status = $this->db->where(['tbl_broadcast_message_id'=>$message->tbl_broadcast_id,'tbl_broadcast_user_id'=>$this->session->userdata('id_user')])->get('tbl_broadcast_read_count')->num_rows();

                                                if($status){ 
                                                    echo 'Read';
                                                }else{
                                                    echo 'Unread';
                                                }?>
                                            </td>
                                            <td>
                                                <?= $message->tbl_broadcast_insertdate ?>
                                            </td>
                                            <td>
                                                <?php if($message->tbl_broadcast_expiry != '') { ?>
                                                    <?= $message->tbl_broadcast_expiry ?>
                                                <?php }else{
                                                    echo "N/A";
                                                }
                                                ?>
                                            </td>
                                            <td><a href="<?php echo site_url('incubator/Broadcast/viewMessage/'.$message->tbl_broadcast_id); ?>"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
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