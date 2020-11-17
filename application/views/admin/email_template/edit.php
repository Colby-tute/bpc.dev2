<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Edit Email Template</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Edit Email Template</li>
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
                
            <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if (validation_errors()) { ?>
                            <div id="infoMessage" class="alert alert-danger" style="margin-top: 25px;"><?php echo validation_errors();?></div>
                    <?php } ?>
                <form method="post" action="<?php echo site_url('admin/EmailTemplate/updateTemplate/'.$template->id) ?>">
                    <div class="card mg-b-20">
                        <div class="card-body">

                            <div class="pl-0">
                                <div class="main-profile-overview">
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="emailKey">Access Key</label>
                                                <input disabled type="text" id="emailKey" name="emailKey" class="form-control" placeholder="Enter Subject" required value="<?= $template->process_key ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="emailSubject">Subject</label>
                                                <input type="text" id="emailSubject" name="emailSubject" class="form-control" placeholder="Enter Subject" value="<?= $template->subject ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="emailMessage">Message</label>
                                                <textarea required class="form-control ckeditor" name="emailMessage" id="emailMessage" rows="5"  placeholder="Email Message"><?php echo getMessage($template->process_key)['message']; ?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- main-profile-overview -->
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- row closed -->
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<?= $footer; ?>
