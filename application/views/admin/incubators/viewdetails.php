<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?= $header; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
<div class="container">

	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div>
			<h4 class="content-title mb-2">Business Details</h4>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
					 <li class="breadcrumb-item" ><a href="<?= site_url('admin/incubators') ?>">Business Incubators</a></li>
					<li class="breadcrumb-item active" aria-current="page">Business Details</li>
				</ol>
			</nav>

		</div>

		<?php

		foreach ($business as $key => $buss) {
			# code...
		}

		?>
	        
			<div class="my-auto breadcrumb-right">
			<a href="<?= site_url('admin/incubators') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('admin/incubators/Incubators/add') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i> </span><span class="btn-text">Create New Profile </span></button></a>
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
						<div class="bg-gray-300 nav-bg">
							<nav class="nav nav-tabs">
								<a class="nav-link active" data-toggle="tab" href="#tabCont1">Business Summary</a>
								<a class="nav-link tabCont2" data-toggle="tab" href="#tabCont2">Business Quick Description</a>
								<a class="nav-link tabCont3" data-toggle="tab" href="#tabCont3">Business Product & Services</a>
								<a class="nav-link tabCont4" data-toggle="tab" href="#tabCont4">Business Documents</a>	
                                <a class="nav-link tabCont5" data-toggle="tab" href="#tabCont5">Business Team Members</a>
								<a class="nav-link tabCont6" data-toggle="tab" href="#tabCont6">Business Logo</a>
							
							</nav>
						</div>
						<div class="card-body tab-content">
										<div class="tab-pane active show" id="tabCont1">

								

								<div class="business_details_show">
									<div class="form-group">
										<div class="row">
											<input type="hidden" name="tbl_business_details_id"
												   id="tbl_business_details_id" value="<?php if (!empty($business)) {
												echo $business[0]->tbl_business_details_id;
											} ?>">
											<div class="col-md-3">
												<label class="form-label label_font">Business Name</label>
												<b class="b_font">
													<?php
													if (!empty($business)) {
														echo $business[0]->tbl_business_details_name;
													} else {
														echo '[Unspecified]';
													}
													?></b>
											</div>
											<div class="col-md-3">
    <label class="form-label label_font">Business Start Date</label>
    <b class="b_font">
  <?php if(!empty($business))
    { 

        echo $business[0]->tbl_business_details_date_hired;
    }else{
        echo "[Unspecified]";
    } ?> 
</b>
</div>

											<div class="col-md-3">
												<label class="form-label label_font">Business Industry</label>
												<b class="b_font">
													<?php
													if (!empty($business)) {
														echo $business[0]->tbl_industry_name;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											<div class="col-md-3">
												<label class="form-label label_font">
													Sub Industry </label>
												<b class="b_font">
													<?php
													if (!empty($business)) {
														echo $business[0]->tbl_sub_industry_name;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											

										</div>
									</div>

									<div class="form-group ">
										<div class="row">
										<div class="col-md-3">
												<label class="form-label label_font">Business Email Address</label>
												<b class="b_font">
													<?php if (!empty($business)) {
														echo $business[0]->tbl_business_details_email;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											<div class="col-md-3">
												<label class="form-label label_font">Business Phone Number</label>
												<b class="b_font">
													<?php
													if (!empty($business)) {
														if ($business[0]->tbl_business_details_countrycode != '') {
															$exp = explode('-', $business[0]->tbl_business_details_countrycode);
															$code = '+' . $exp[1];
														} else {
															$code = '';
														}
													}
													?>
													<?php if (!empty($business)) {
														echo $code . '' . $business[0]->tbl_business_details_phone;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											<div class="col-md-3">
												<label class="form-label label_font">Business District</label>
												<b class="b_font">
													<?php if (!empty($business)) {
														echo $business[0]->tbl_business_details_district;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div>

											<div class="col-md-3">
												<label class="form-label label_font">Business Town/Village</label>
												<b class="b_font">
													<?php if (!empty($business)) {
														echo $business[0]->tbl_business_details_town_village;
													} else {
														echo "[Unspecified]";
													} ?>
												</b>
											</div> 

											
													
											
										</div>
									</div>

									

									
								</div>
</div>

								
							<div class="tab-pane" id="tabCont2">
								
								<div class="col-md-12">
												<!--<label class="form-label label_font">Business Description</label> -->
												<p style="text-align:justify;">
													<?= !empty($business) ? $business[0]->tbl_business_details_desc : ""?>
												</p>
											</div>
								
								
								</div>


							<div class="tab-pane" id="tabCont3">
                                
                                <div class="row row-sm product_services_edit">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                       
                                        <div class="col-sm-12">
                                      
                                       <p style="text-align:justify;"> <?= !empty($business) ? trim($business[0]->product_service) : "" ?> </p>
                                         </div>
                                        

                                       
                                    </div>
                                </div>

                                
                            </div>

<div class="tab-pane" id="tabCont4">
								<div class="row row-sm">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									
										<div class="card-body iconfont text-left">
											
											<div class="table-responsive">
												<table class="table table-bordered mg-b-0 text-md-nowrap"
													   style="width: 100%;">
													<thead>
													<tr>
														<th scope="col">PID</th>
														<th scope="col" class="table_title_width">Docuement Name / Description</th>
														<th scope="col">Action</th>
													</tr>
													</thead>
													<tbody>
													<?php
													$i = 1;
													foreach ($business_doc as $key => $value) { ?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo $value->tbl_all_documents_title; ?></td>
															<td>

																<a href="<?php echo base_url(); ?>assets/Application/Business_Document/<?php echo $value->tbl_all_documents_document; ?>"
																   target="_blank"
																   class="btn btn-success btn-block btn_width"><i
																			class="far fa-eye"></i></a>


																<a href="<?= site_url('bdsp/BusinessDetails/delete/' . $value->tbl_all_documents_id) ?>"
																   class="btn btn-danger btn-block btn_width"><i
																			class="far fa-times-circle"></i></a>
															</td>
														</tr>

														<?php $i++;
													}
													?>
													</tbody>
												</table>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							  <div class="tab-pane" id="tabCont5">
                   <div class="col-md-12 team">
										<div class="row ">
											<section class="container col-xs-12">
												<div class="table table-responsive">
													<h4><!-- Select Team Details --></h4>
													<table class="table text-md-nowrap" id="example2"
															   style="width: 100%;">
														<thead>
														<tr>
															<td style="background: none;">First Name</td>
															<td style="background: none;">Last Name</td>
															<td style="background: none;">Email Address</td>
															<td style="background: none;">Mobile Number</td>
															<td style="background: none;">Gender</td>
														</tr>
														</thead>
														<tbody>
														<?php
														if (!empty($smme_teams)) {
															foreach ($smme_teams as $key => $value) {
																# code...
																?>
																<tr>
																	<td>
																		<?php echo $value->tbl_smme_teams_first_name; ?>
																	</td>
																	<td>
																		<?php echo $value->tbl_smme_teams_last_name; ?>
																	</td>
																	<td>
																		<?php echo $value->tbl_smme_teams_email; ?>
																	</td>
															<td>
														<?php echo $value->tbl_smme_teams_mobile; ?>
																	</td>

																	<td>
														<?php echo $value->tbl_smme_teams_gender; ?>
																	</td>
																</tr>
																<?php
															}
														} else {
															?>
															<td>
																
															</td>
															<td>
																
															</td>
															<td>

															</td>
															<td>
																
															</td>
															</tr>
															<?php
														}
														?>
														</tbody>
													</table>
												</div>
											</section>
										</div>
									</div>
                              
                            </div>
							  <div class="tab-pane" id="tabCont6">
							  
							  <div class="col-md-3">
    <!-- <label class="form-label label_font">Business Logo</label> -->
    <b class="b_font">
  <?php if(!empty($business))
   { 

        echo "<img src='".base_url().'assets/users/'.$business[0]->tbl_business_details_business_logo."' width='100' />";
    }else{
        echo "[Unspecified]";
    } ?> 
</b>
</div>	
							  </div>
						</div>
					</div>
					
				</div>

				<!-- <div class="card-footer">

				</div> -->
			</div>
		</div>

		<!-- /Col -->
	</div>

	<!-- row closed -->
</div>
<?= $footer; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$('document').ready(function () {

		// $('.iti__selected-flag .iti__flag').removeClass('iti__us').addClass('iti__ls');

		$('.iti__selected-flag .iti__flag').removeClass('iti__us').addClass('iti__ls');
		var cc = $('#country_code').val();
		var ccf = cc.split('-');
		var input = document.querySelector("#phone");
		intlTelInput(input, {
			initialCountry: ccf[0]
		});
		//$('.iti__selected-flag .iti__flag').addClass('iti__'+ccf[0]);


		/* $('#country-listbox li').click(function() {
			 var country_code = $(this).data("dial-code");
			 $('#country_code').val(country_code);
			 //alert($(".iti__selected-flag").attr('title'));
			 //var tdTitleAttr = $(your-td-element).attr('title');
		 });*/

		$("#country-listbox li")
				.focusout(function () {
					var country_code = $(this).data("dial-code");
					var country_code_flag = $(this).data("country-code");
					//alert(country_code_flag+'-'+country_code);
					$('#country_code').val(country_code_flag + '-' + country_code);
				});
		if ($('#tbl_business_details_id').val() == '') {
			$('.business_details_edit').show();
			$('.business_details_show').hide();
		} else {
			$(".tabCont2").show();
			$('.business_details_edit').hide();
			$('.business_details_show').show();
		}
		$('.product_services_edit').hide();
		$('.tabCont2').click(function () {
			$('.nav-tabs a[href="#tabCont2"]').tab('show');
		});

		$(".teams").hide();
		$(".teamdt").hide();
		$(".sub").show();
		$(".addnewpartner").show();
		$(".sub1").hide();
		$(".sub5").hide();
		$(".partner_edit_table_row").hide();
        $(".partner_update").hide();	

		$('.edit_biz').click(function () {
			//$("input").removeClass("textbox-border-hide");
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


        $('.edit_product_services').click(function() {
            //$("input").removeClass("textbox-border-hide");
            $(".sub5").show();
            $('.product_services_show').hide();
            $('.product_services_edit').show();
            $('.close_product_services').show();
            $('.edit_product_services').hide();

        });

        $('.close_product_services').click(function() {
            $('.product_services_show').show();
            $('.product_services_edit').hide();
            $('.edit_product_services').show();
            $('.close_product_services').hide();
            $('.sub5').hide();
        });

        $('.edit_business_partners').click(function() {
            //$("input").removeClass("textbox-border-hide");
            $(".sub5").show();
            $('.edit_business_partners').hide();
            $('.close_business_partners').show();
            $('.partner_edit_table_row').show();
            $('.partner_show_table_row').hide();
            $(".addnewpartner").hide();

        });

        $('.close_business_partners').click(function() {
            $(".sub5").hide();
            $('.edit_business_partners').show();
            $('.close_business_partners').hide();
            $('.partner_edit_table_row').hide();
            $('.partner_show_table_row').show();
            $(".addnewpartner").show();
        });

		$('#tbl_business_details_employees').keyup(function () {
			//alert($(this).val());
			if ($(this).val() != 0) {
				//alert('if');
				$(".one").prop('checked', true);
				$(".teamdt").show();
				$(".teams").show();
				/*$(".sub").hide();
				$(".sub1").show();*/

			} else {
				$(".zero").prop('checked', true);
				$(".teamdt").hide();
				$(".teams").hide();
				/* $(".sub").show();
				 $(".sub1").hide();*/
			}
		});

		var radioValue = $("input[name='tbl_business_details_areyouteam']:checked").val();
		if (radioValue == 1) {

			$(".teamdt").show();
			$(".teams").show();
			/*$(".sub").hide();
			$(".sub1").show(); */
		} else {

			$(".teamdt").hide();
			$(".teams").hide();
			/*$(".sub").show();
			$(".sub1").hide();*/

		}
		$("input[name='tbl_business_details_areyouteam']").click(function () {
			var radioValue = $(this).val();

			if (radioValue == 1) {
				$(".teamdt").show();
				$(".teams").show();
				/*$(".sub").hide();
				$(".sub1").show();*/

			} else {
				$(".teamdt").hide();
				$(".teams").hide();
				/* $(".sub").show();
				 $(".sub1").hide();*/
			}
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {

		$("#btnAdd").bind("click", function () {
			//alert('click');
			var div = $("<tr />");
			div.html(GetDynamicTextBox(""));
			$("#TextBoxContainer").append(div);

		});
		$("body").on("click", ".remove", function () {

			$(this).closest("tr").remove();

		});
	});

	function GetDynamicTextBox(value) {
		return '<td><input name="tbl_smme_teams_first_name[]" class="sku form-control" id="tbl_smme_teams_first_name" type="text"  placeholder="Enter First Name"></td><td><input  name="tbl_smme_teams_last_name[]" class="form-control" id="tbl_smme_teams_last_name" type="text" placeholder="Enter Last Name"></td><td><input name="tbl_smme_teams_email[]" class="gst form-control" id="tbl_smme_teams_email"  type="email" placeholder="Enter Emailid" required></td><td><input name="tbl_smme_teams_mobile[]" class="qty form-control" id="tbl_smme_teams_mobile"  type="tel" placeholder="Enter Mobile No." required></td><td><button type="button" class="btn btn-danger remove" data-toggle="tooltip" data-original-title="Remove" style="float: right;padding: 4px 10px;"><i class="typcn typcn-archive icon_margin_remove font_size"></i></button></td>';
	}
</script>
<script type="text/javascript">
	$('#tbl_business_details_industry').change(function () {
		//alert($(this).val());
		var ind_id = $(this).val();
		jQuery.ajax({
			type: "POST",
			url: "<?=base_url()?>bdsp/BusinessDetails/get_sub_industries",
			dataType: 'text',
			data: {ind_id: ind_id},
			success: function (data) {
				var obj = JSON.parse(data);
				//console.log(obj);
				var html = '';
				$.each(obj, function (index, value) {
					html += '<option value="' + value.tbl_sub_industry_id + '">' + value.tbl_sub_industry_name + '</option>';
				});
				$('#tbl_business_details_subindustry').html(html);
			}
		});
	});
</script>
<script type="text/javascript">
	var ind_id = $('#ind').val();
	var sub_ind = $('#sub_ind').val();
	//alert(sub_ind);
	jQuery.ajax({
		type: "POST",
		url: "<?=base_url()?>bdsp/BusinessDetails/get_sub_industries",
		dataType: 'text',
		data: {ind_id: ind_id},
		success: function (data) {
			var obj = JSON.parse(data);
			//console.log(obj);
			var html = '';
			$.each(obj, function (index, value) {
				if (value.tbl_sub_industry_id == sub_ind) {
					html += '<option value="' + value.tbl_sub_industry_id + '" selected>' + value.tbl_sub_industry_name + '</option>';
				} else {
					html += '<option value="' + value.tbl_sub_industry_id + '">' + value.tbl_sub_industry_name + '</option>';
				}
			});
			$('#tbl_business_details_subindustry').html(html);
		}
	});
</script>
</body>
</html>
