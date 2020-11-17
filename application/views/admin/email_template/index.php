<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    
<div class="container">
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Email & Notifications</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item">Email Templates</li>
                </ol>
            </nav>
        </div>
        
        <div class="my-auto breadcrumb-right">
		<button data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-info"><span class="icon-label"><i class="fa fa-code mr-2"></i> </span>Shortcodes Reference</button>
		<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
        </div>
    </div>

    <div class="">
        <!-- row opened -->
        <div class="row row-sm">
          <!--  <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="card">
                    <div class="card-body iconfont text-left">
                        <h3 class="panel-title">Email Messages <button data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-info">Shortcodes Reference</button>
                        </h3>
                        <em class="text-danger">These are the predefined email messages template on each process. All you need to do is to edit the content of the email if necessary</em>
                    </div>
                </div>

            </div> -->
            <div class="col-md-12 col-sm-12 col-xs-12">
            
                <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success" style="margin-top: 25px;"><?php echo $this->session->flashdata('success');?></div>
                <?php } ?>
                <?php if ($this->session->flashdata('danger')) { ?>
                        <div class="alert alert-danger" style="margin-top: 25px;"><?php echo $this->session->flashdata('danger');?></div>
                <?php } ?>
                <div class="card">
                    <div class="card-body iconfont text-left">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>PID</th>
                                        <th>Process Key</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($templates as $key => $value) :                                    ?>
                                        <tr>
                                            <td><?php echo $value->id; ?></td>
                                            <td><?php echo $value->process_key; ?></td>
                                            <td><strong><?php echo $value->subject; ?></strong></td>
                                            <td><?php echo getMessage($value->process_key)['message']; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('admin/EmailTemplate/edit/'.$value->id); ?>" class="btn btn-xs btn-outline-primary xwb-edit-email">Edit</a>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach; ?>

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
    
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Shortcodes Reference</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="bootbox-body">
                <div class="row">  
                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                        <em class="text-danger">Info</em>
                        <ul>
                            <li><label>[name_from] </label> - <span>The name of the sender</span></li>
                            <li><label>[email_from] </label> - <span>The email of the sender</span></li>
                            <li><label>[name_to] </label> - <span>The Name of the recipient</span></li>
                            <li><label>[email_to] </label> - <span>The Email of the recipient</span></li>
                            <li><label>[message] </label> - <span>Message of the sender</span></li>
                        </ul>
                    </div>  
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<?= $footer; ?>
