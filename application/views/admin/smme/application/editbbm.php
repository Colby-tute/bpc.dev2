<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
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
                    <li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">BBM Assessment</li>
                </ol>
            </nav>

        </div>
		
		<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('admin/smme/Application/add') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-check-square mr-2"></i></span><span class="btn-text">Add New Application </span></button></a>
							<a href="<?= site_url('admin/Home/Profile') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
		
		
		
		
		
		
		
    </div>

    <div class="">
        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                	<form action="#" method="post">
                    <div class="card-body iconfont text-left">
                        <p><?php if ($this->session->flashdata('danger')) { ?>
                            <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                              <?php } else if ($this->session->flashdata('success')) { ?>
                            <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                              <?php }?>
                        </p>

                        <?php foreach($phases as $phase) : ?>

                        	<div class="row" style="margin-bottom:30px;">
                        		<div class="col-sm-12">
                        			<h3><?= $phase->phase ?></h3>
                        		</div>

                        		<?php foreach ($phase->sub_phase as $sub_phase => $questions) : ?>
                        			
                    				<div class="col-sm-12" style="margin-top: 10px; margin-bottom: 10px">
                    					<h5 style="padding-left: 10px; text-decoration: underline;"><?= $sub_phase ?></h4>
                    				</div>		

	                        		<div class="col-sm-12">
	                        			<div class="table-responsive">
				                            <table class="table table-striped">
				                                <thead>
				                                    <tr>
				                                        <th scope="col">Question</th>
				                                        <th width="150" scope="col">Answered</th>
				                                    </tr>
				                                </thead>
				                                <tbody>
				                                	<?php foreach ($questions as $k => $question) : ?>

			                                			<tr>
			                                				<td><label for="<?= $question->id ?>"><?= $question->question ?></label></td>
			                                				<td>
			                                					<div>
			                                						<input type="checkbox" id="<?= $question->id ?>" <?= $question->answer == 1 ? "checked" : "" ?> onclick="saveAnswer(this, <?= $question->id ?>)" />
			                                					</div>
			                                				</td>
			                                			</tr>
				                                	<?php endforeach; ?>
				                                </tbody>
				                        	</table>
			                        	</div>
	                        		</div>

                    			<?php endforeach; ?>

                        	</div>	

                    	<?php endforeach; ?>
                     </div>
                 	</form>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
</div>
<?= $footer; ?>

<script type="text/javascript">
	function saveAnswer(elem, q_id)
	{
		let a = 2
		if ($(elem).is(":checked"))
			a = 1

		$.ajax({
			method: "post",
			url: '<?= base_url() ?>admin/smme/Application/saveAnswer',
			data: {
				user_id: '<?= $user_id ?>',
				question: q_id,
				answer: a
			}
		})
	}
</script>