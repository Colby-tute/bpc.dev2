<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style type="text/css">
    .nav.nav-tabs li a {
        color: #555;
        border-radius: 0;
    }
</style>
<div class="container">
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Business Building Model</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('bdsp/Home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item">BBM - Assessment</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit BBM Question</li>
                </ol>
            </nav>

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

                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 style="margin-bottom: 20px">Edit Question</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">

                                    <label>Question</label>
                                    <textarea class="form-control ckeditor" name="question" id="question_textarea" rows="4"><?php echo $question->question?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 mg-t-15">
                                    <button class="btn btn-primary" id="update" onclick="updateQuestion(<?= $question->id ?>)">Update</button>
                                    <button class="btn btn-primary" id="cancel" onclick="goBack()">Cancel</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
</div>
<?= $footer; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function updateQuestion(q_id)
	{
		let text = $("#question_textarea").val();
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>bdsp/BusinessDetails/updateQuestion',
			data: {
				questionId: q_id,
				questionText: text
			},
            success:function(data) {
              goBack(); 
            }
		})
	}
    function goBack() {
        window.history.back();
    }
</script>
    