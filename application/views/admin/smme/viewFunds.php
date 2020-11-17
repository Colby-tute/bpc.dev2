<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?= $header; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
<div class="container">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Business Incubator Funding</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $smme[0]->firstname?> <?= $smme[0]->lastname ?></li>
                </ol>
            </nav>

        </div>

            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('admin/Home/Profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
    </div>
    <!-- breadcrumb -->

    <!-- row -->


    <div class="row row-sm">
        <!-- Col -->

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="border">
                        <div class="card-body tab-content">
                                <div class="form-group">
                                       <div class="row">
                                            <div class="col text-right">
                                                <a href="javascript:void(0)" class="btn btn-outline-primary mr-3 edit_biz"><span class="icon-label"><i class="fa fa-credit-card"></i></span> <span class="btn-text"> Allocate Funds</span></a>
                                                <a href="javascript:void(0)" class="btn btn-outline-danger mr-3 close_biz" style="display: none;"><span class="icon-label"></span> <span class="btn-text">Close</span></a>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label label_font">MSME Investment Required</label>
                                        <b class="b_font">M
                                            <?php
                                            $investment_need = '[Unspecified]';
                                            if (!empty($funds)) {
                                                if($funds[0]->tbl_business_details_investmant_need != "") {
                                                    $investment_need = $funds[0]->tbl_business_details_investmant_need;
                                                }
                                            }
                                            echo $investment_need;
                                            ?></b>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label label_font">MSME Personal Raised Funds</label>
                                        <b class="b_font">M
                                            <?php
                                            $personal_funds = '[Unspecified]';
                                            if (!empty($funds)) {
                                                if($funds[0]->tbl_business_details_personal_funds != "") {
                                                    $personal_funds = $funds[0]->tbl_business_details_personal_funds;
                                                }
                                            }
                                            echo $personal_funds;
                                            ?></b>
                                    </div>
									
									
									<div class="col-md-3">
                                                <label class="form-label label_font">Business Incubator Raised Revenue</label>
                                                <b class="b_font">M
                                                    <?php
                                                    $evenue_raised = '[Unspecified]';
                                                    if (!empty($funds)) {
                                                        if($funds[0]->tbl_business_details_revenue_raised != "") {
                                                            $evenue_raised = $funds[0]->tbl_business_details_revenue_raised;
                                                        }
                                                    }
                                                    echo $evenue_raised;
                                                    ?></b>
                                            </div>
                                </div> 
                               							
								
								
                                <div class="business_details_show">
                                    <div class="form-group">
                                        <div class="row">
										
										 <input type="hidden" name="tbl_business_details_id"
                                                   id="tbl_business_details_id" value="<?php if (!empty($funds)) {
                                                echo $funds[0]->tbl_business_details_id;
                                            } ?>">
                                            <input type="hidden" name="smme_id"
                                                   id="smme_id" value="<?php if (!empty($smme_id)) {
                                                echo $smme_id;
                                            } ?>">
                                            
                                        </div>
                                    </div>
                                </div>

<div class="alert alert-success" role="alert">
		<button aria-label="Close" class="close" data-dismiss="alert" type="button">
		   <span aria-hidden="true">&times;</span>
	  </button>
		<strong>Business Funding!</strong> <br /> Business Incubators or Accelerators grant, loan or help entrepreneurs access funding from different sources.
	</div>











                                <div class="business_details_edit">
                                    <?php echo form_open_multipart("admin/smme/Smme/submitEditFunds"); ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <input type="hidden" id="tbl_business_details_id" name="tbl_business_details_id"
                                                   value="<?php if (!empty($funds)) {
                                                       echo $funds[0]->tbl_business_details_id;
                                                   } ?>">
                                            <input type="hidden" name="smme_id"
                                                   id="smme_id" value="<?php if (!empty($smme_id)) {
                                                echo $smme_id;
                                            } ?>">
                                            <div class="col-md-3">
                                                <label class="form-label">Allocate or update funding raised by the business incubator for the MSME</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="tbl_business_details_revenue_raised" class="form-control"
                                                       id="tbl_business_details_revenue_raised" placeholder="BI Revenue Raised"
                                                       value="<?php if (!empty($funds)) {
                                                           echo $funds[0]->tbl_business_details_revenue_raised;
                                                       } ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-primary sub5">Submit</button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $footer; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $('document').ready(function () {

        if ($('#tbl_business_details_id').val() == '') {
            $('.business_details_edit').show();
            $('.business_details_show').hide();
        } else {
            $('.business_details_edit').hide();
            $('.business_details_show').show();
        }
        $('.edit_biz').click(function () {
            $(".sub5").show();
            $('.business_details_edit').show();
            $('.business_details_show').hide();
            $('.close_biz').show();
            $('.edit_biz').hide();
        });
        $('.close_biz').click(function () {
            $('.business_details_edit').hide();
            $('.business_details_show').show();
            $('.edit_biz').show();
            $('.close_biz').hide();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $("body").on("click", ".remove", function () {

            $(this).closest("tr").remove();

        });
    });

</script>
</body>
</html>
