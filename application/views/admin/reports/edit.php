<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- RatingThemes css-->
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/ratings.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-1to10.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-movie.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-square.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-pill.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-reversed.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bars-horizontal.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/fontawesome-stars.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/css-stars.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/bootstrap-stars.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/rating/themes/fontawesome-stars-o.css">
        <style type="text/css">
            .box-example-movie .br-wrapper {
                width: 320px;
                position: absolute;
                margin: 0px 0 0 -125px;
                left: 45%;
            }
            .br-current-rating {
                width: unset!important;
            }
        </style>
        <?= $header; ?>
        <div class="container">
                    <!-- breadcrumb -->
                    <div class="breadcrumb-header justify-content-between">
                        <div>
                            <h4 class="content-title mb-2">Manage Evaluations</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/Home') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
                                </ol>
                            </nav>

                        </div>
						
						<div class="my-auto breadcrumb-right">
							<button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-envelope mr-2"></i></span><span class="btn-text">Email </span></button>
							<button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-print mr-2"></i> </span><span class="btn-text">Print </span></button>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-download mr-2"></i> </span><span class="btn-text">Export </span></button>
						</div>
						
						
						
						
						
                    </div>
                    <!-- breadcrumb -->

                    <!-- row -->
                    

                    <div class="row row-sm">
                        <!-- Col -->
                        <?php foreach ($model as $key => $value) : ?>
                            <?php if (!isset($questions[$key])) {
                                continue;
                            } else {
                                $question = $questions[$key];
                            }?>
                            <div class="col-sm-6 col-md-6">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div>
                                            <h6 class="card-title mb-1"><?= $question ?></h6>
                                        </div>
                                        <div class="box box-example-movie" style="pointer-events: none!important">
                                            <div class="box-body">
                                                <select id="<?= $key ?>" name="rating" autocomplete="off">
                                                    <option <?= $value == 1 ? 'selected' : '' ?> class="<?= $value == 1 ? 'br-selected' : '' ?>"  value="1" data-rating-text="Not at all Satisfied">Not at all Satisfied</option>
                                                    <option <?= $value == 2 ? 'selected' : '' ?> class="<?= $value == 2 ? 'br-selected' : '' ?>"  value="2" data-rating-text="Not at all Satisfied">Partly Satisfied</option>
                                                    <option <?= $value == 3 ? 'selected' : '' ?> class="<?= $value == 3 ? 'br-selected' : '' ?>"  value="3" data-rating-text="Not at all Satisfied">Satisfied</option>
                                                    <option <?= $value == 4 ? 'selected' : '' ?> value="4" class="<?= $value == 4 ? 'br-selected' : '' ?>"  data-rating-text="Not at all Satisfied">More than Satisfied</option>
                                                    <option value="5" class="<?= $value == 5 ? 'br-selected' : '' ?>" <?= $value == 5 ? 'selected' : '' ?> data-rating-text="Not at all Satisfied">Very Satisfied </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-sm-12 col-md-12">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div>
                                            <h6 class="card-title mb-1">Comment</h6>
                                        </div>
                                        <div class="box box-example-movie" style="pointer-events: none!important">
                                            <div class="box-body">
                                                <p><?= $model->comment ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- /Col -->
                    </div>
                    
                    <!-- row closed -->
                </div>
        <?= $footer; ?>

<!-- Rating js-->
        <script src="<?= base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>

        <!-- Rating js-->
        <!-- <script src="<?= base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script> -->
        <!-- <script src="<?= base_url() ?>assets/plugins/rating/jquery.barrating.js"></script> -->
        <!-- <script src="<?= base_url() ?>assets/plugins/rating/ratings.js"></script> -->

        <!-- Rating js-->
        <script src="<?= base_url() ?>assets/plugins/rating/jquery.rating-stars.js"></script>
        <script src="<?= base_url() ?>assets/plugins/rating/jquery.barrating.js"></script>

        <script type="text/javascript">
            $('document').ready(function(){

                let phases = JSON.parse('<?= $json ?>')

                $.each(phases, function(key, phase) {
                    if (phase.value == "1") {
                        $('#'+phase.id).barrating('set', '1');
                    } 
                    else if (phase.value == "2") {
                        $('#'+phase.id).barrating('set', '2');
                    }
                    else if (phase.value == "3") {
                        $('#'+phase.id).barrating('set', '3');
                    }
                    else if (phase.value == "4") {
                        $('#'+phase.id).barrating('set', '4');
                    }
                    else if (phase.value == "5") {
                        $('#'+phase.id).barrating('set', '5');
                    }
                    $('#'+phase.id).barrating('show', {
                        theme: 'bars-movie'
                    });
                })
            })

      </script>
    </body>
</html>