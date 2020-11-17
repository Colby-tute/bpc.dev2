<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Incubation Progress Dashboard</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('incubator/home') ?>">Dashboard</a></li>
					 <li class="breadcrumb-item"><a href="<?= site_url('incubator/Operations/incubationstatus') ?>">Incubation Status</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $smme[0]->tbl_users_firstname.' '.$smme[0]->tbl_users_lastname.' / MSME-'.$smme[0]->tbl_users_user_uniqueid ?></li>
                </ol>
            </nav>

        </div>
        <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('incubator/Operations/incubationstatus') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('incubator/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                        <div id="infoMessage"
                             class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger'); ?></div>
                        <?php } else if ($this->session->flashdata('success')) { ?>
                            <div id="infoMessage"
                                 class="alert alert-success mt25"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php }
                        ?>
                        </p>
                        <div class="card-body tab-content">
                        <div class="tab-pane active show"  id="tabCont1">
                            <div class="row">
                                <div class="table-responsive">
                                     <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                        <thead>
                                        <tr>
                                            <th scope="col">PID</th>
                                            <th scope="col">Milestones</th>
                                            <!-- <th scope="col">Photo</th> -->
                                            <th scope="col">Technical/Product</th>
                                            <th scope="col">Market</th>
                                            <th scope="col">Business</th>
                                             <th scope="col">Operations</th>
                                             <!-- <th scope="col">Role</th> -->
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php  

                                        // print_r($PhaseSubPhasePercentage);exit();
                                        if (isset($phases)) {
                                            foreach ($phases as $k => $phase) {
                                                if (empty($phase)) {
                                                    continue;
                                                }
                                                $phaseid = $phase['id'];
                                                $subPhasePercentage=$PhaseSubPhasePercentage[$phaseid-1];
                                                ?>
                                                <tr>
                                                    <td><?php echo $phaseid; ?></td>
                                                    <td><?php echo $phase['phase']; ?></td>
                                                    <td>
                                                        <h2>
                                                            <span class="badge badge-primary" style="background-color: <?= $subPhasePercentage[0]['color'] ?>;font-size: 13px; line-height: 2;">
                                                                <span style="color: <?= $subPhasePercentage[0]['textColor'] ?>;">
                                                                    <?php echo $subPhasePercentage[0]['statusText'] ?>
                                                                </span>
                                                                <span class="badge badge-light">
                                                                    <?php echo $subPhasePercentage[0]['percent'] ?> %
                                                                </span>
                                                            </span>
                                                        </h2>
                                                    </td> <!-- Technical/Product -->
                                                    <td>
                                                        <h2>
                                                            <span class="badge badge-primary" style="background-color: <?= $subPhasePercentage[1]['color'] ?>;font-size: 13px; line-height: 2;">
                                                                <span style="color: <?= $subPhasePercentage[1]['textColor'] ?>;">
                                                                    <?php echo $subPhasePercentage[1]['statusText'] ?>
                                                                </span>
                                                                <span class="badge badge-light">
                                                                    <?php echo $subPhasePercentage[1]['percent'] ?> %
                                                                </span>
                                                            </span>
                                                        </h2>
                                                    </td>  <!-- Market -->
                                                    <td>
                                                        <h2>
                                                            <span class="badge badge-primary" style="background-color: <?= $subPhasePercentage[2]['color'] ?>;font-size: 13px; line-height: 2;">
                                                                <span style="color: <?= $subPhasePercentage[2]['textColor'] ?>;">
                                                                    <?php echo $subPhasePercentage[2]['statusText'] ?>
                                                                </span>
                                                                <span class="badge badge-light">
                                                                    <?php echo $subPhasePercentage[2]['percent'] ?> %
                                                                </span>
                                                            </span>
                                                        </h2>
                                                    </td>  <!-- Business -->
                                                    <td>
                                                        <h2>
                                                            <span class="badge badge-primary" style="background-color: <?= $subPhasePercentage[3]['color'] ?>;font-size: 13px; line-height: 2;">
                                                                <span style="color: <?= $subPhasePercentage[3]['textColor'] ?>;">
                                                                    <?php echo $subPhasePercentage[3]['statusText'] ?>
                                                                </span>
                                                                <span class="badge badge-light">
                                                                    <?php echo $subPhasePercentage[3]['percent'] ?> %
                                                                </span>
                                                            </span>
                                                        </h2>
                                                    </td>  <!-- Operations -->
                                                    <td>
                                                        <button data-toggle="dropdown"
                                                                class="btn btn-primary btn-block button_width"><i
                                                                class="la la-cog setting"></i></button>
                                                        <div class="dropdown-menu">
                                                            <!-- <a href="<?= site_url('incubator/Smme/createTask/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-edit"></i> Manage Notice Board
                                                            </a> -->
                                                            <!-- <a href="<?= site_url('incubator/Smme/createMilestone/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item">Create Milestone
                                                            </a> 
                                                            <a href="<?= site_url('incubator/BusinessDetails/handlebbm/' . $smmeid) ?>"
                                                               class="dropdown-item"><i class="fa fa-eye"></i> View BBM Assessment
                                                            </a>-->
                                                            <a href="<?= site_url('incubator/Smme/handleMilestoneQuestions/' . $smmeid) ?>"
                                                               class="dropdown-item"><i class="fa fa-eye"></i> Milestone Tasks
                                                            </a>
                                                            <!--<a href="<?= site_url('incubator/Smme/evaluate/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-check-square"></i> MSME Evaluation
                                                            </a> -->
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                       

                      
                        </div> <!--card-body tab-content-->
                        </div>
                    </div>
                    <div class="modal history" id="scrollmodal">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Login History</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <table id="example" class="table key-buttons text-md-nowrap view_history_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">IP</th>
                                            <th scope="col">Login From</th>
                                            <th scope="col">Result</th>
                                            <th scope="col">Date & Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button class="btn ripple btn-primary" type="button">Save changes</button> -->
                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close
                                    </button>
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
