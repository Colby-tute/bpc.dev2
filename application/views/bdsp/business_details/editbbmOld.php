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
                    <li class="breadcrumb-item active" aria-current="page">BBM - Assessment</li>
                </ol>
            </nav>

        </div>

 <div class="my-auto breadcrumb-right">
                <button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
                <button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button>
                
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

                        <div class="row">
                            <div class="col-sm-12">
                                <h3 style="margin-bottom: 20px">Assessment about <?= $user->tbl_users_firstname ?> <?= $user->tbl_users_lastname ?> - <?= $user->tbl_users_user_uniqueid ?></h3>
                            </div>
                        </div>

                        <ul class="nav nav-tabs">
                        <?php $k = 1; foreach($phases as $phase) : ?>
                            
                                <li class="<?= $k == 1 ? 'active' : '' ?>"><a data-toggle="tab" href="#<?= str_replace(" ", "", $phase->phase) ?>"><?= $phase->phase ?></a></li>
                            
                            <?php $k = 2; ?>
                        <?php endforeach; ?>
                        </ul>

                        <div class="tab-content">
                        <?php $k = 1; ?>
                        <?php foreach($phases as $phase) : ?>
                            <div id="<?= str_replace(" ", "", $phase->phase) ?>" class="tab-pane fade <?= $k == 1 ? 'in active' : '' ?>">
                                <?php $k = 2; ?>
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
                            </div>    
                    	<?php endforeach; ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="<?= site_url('bdsp/BusinessDetails/bbm') ?>" class="btn btn-primary">
                                    Submit
                                </a>
                            </div>
                        </div>
                        </div>
                     </div>
                 	</form>
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
	function saveAnswer(elem, q_id)
	{
		let a = 2
		if ($(elem).is(":checked"))
			a = 1

		$.ajax({
			method: "post",
			url: '<?= base_url() ?>bdsp/BusinessDetails/saveAnswer',
			data: {
				user_id: '<?= $user_id ?>',
				question: q_id,
				answer: a
			}
		})
	}
</script>
