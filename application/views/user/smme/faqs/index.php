<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Frequently Asked Questions</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Frequently Asked Questions</li>
                    </ol>
                </nav>

            </div>
           <div class="my-auto breadcrumb-right">
							<a href="mailto:admin@bedco.org.ls" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-folder mr-2"></i></span><span class="btn-text">Submit a Question </span></button></a>
							<a href="<?= site_url('user/smme/SearchBlogs') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-folder-open mr-2"></i> </span><span class="btn-text">Knowledge Centre </span></button></a>
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
                            <div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
                                <?php
                                $i = 1;
                                foreach ($faqs as $key => $value) { 
                                    if ($i == 1) { ?>
                                        <div class="card">
                                        <div class="card-header" id="heading<?php echo $i;?>" role="tab">
                                            <a aria-controls="collapse<?php echo $i;?>" aria-expanded="true" data-toggle="collapse" href="#collapse<?php echo $i;?>"><?php echo $i.'. '.$value->tbl_faqs_title;?></a>
                                        </div>
                                        <div aria-labelledby="heading<?php echo $i;?>" class="collapse show" data-parent="#accordion" id="collapse<?php echo $i;?>" role="tabpanel">
                                            <div class="card-body">
                                                <?php echo $value->tbl_faqs_desc;?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                        <div class="card">
                                        <div class="card-header" id="heading<?php echo $i;?>" role="tab">
                                            <a aria-controls="collapse<?php echo $i;?>" aria-expanded="false" data-toggle="collapse" href="#collapse<?php echo $i;?>"><?php echo $i.'. '.$value->tbl_faqs_title;?></a>
                                        </div>
                                        <div aria-labelledby="heading<?php echo $i;?>" class="collapse hide" data-parent="#accordion" id="collapse<?php echo $i;?>" role="tabpanel">
                                            <div class="card-body">
                                                <?php echo $value->tbl_faqs_desc;?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } $i++; }
                                ?>
                            </div>

                         </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
    </div>
<?= $footer; ?>


