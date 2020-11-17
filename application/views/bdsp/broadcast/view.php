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
                    <li class="breadcrumb-item"><a href="<?= site_url('bdsp/Home') ?>">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('bdsp/BroadcastMessage/getMessage') ?>">Broadcast Messages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Broadcast Messages</li>
                </ol>
            </nav>
        </div>
		
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('bdsp/BroadcastMessage/getMessage') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('bdsp/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="min-height: 300px;">
	                                <div class="t4 main-message-list chat-scroll ps broadcast-box">
	                                    <h2><?= date("Y-m-d H:i:s",strtotime($message->tbl_broadcast_insertdate)) ?>   
                                        </h2>
                                        <p>
                                            <?= $message->tbl_broadcast_message ?>
                                        </p>
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