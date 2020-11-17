<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<?= $header; ?>

<div class="container">
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Operations</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('bdsp/home') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Incubation Progress</li>
                </ol>
            </nav>

        </div>
         <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('bdsp/application') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-bell mr-2"></i></span><span class="btn-text">Status </span></button></a>
							<a href="<?= site_url('bdsp/Profile/view_profile/'.$this->session->userdata('id_user')) ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-user mr-2"></i> </span><span class="btn-text">Personal Details </span></button></a>
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
                        <div class="bg-gray-300 nav-bg">
                            <nav class="nav nav-tabs">
                                <a class="nav-link tabCont1 active" data-toggle="tab" href="#tabCont1">Investigation Phase</a>
                                <a class="nav-link tabCont2" data-toggle="tab" href="#tabCont2">Development Phase</a>
                                <a class="nav-link tabCont3" data-toggle="tab" href="#tabCont3">Commercial Phase</a>
                            </nav>
                        </div>
                        <div class="card-body tab-content">
                        <div class="tab-pane active show"  id="tabCont1">
                            <div class="row">
                                <div class="table-responsive">
                                    <!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
									
									<nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li>Investigation</li>
                </ol>
            </nav>
                                     <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                        <thead>
                                        <tr>
                                            <th scope="col">PID</th>
                                            <th scope="col">Reference</th>
                                            <!-- <th scope="col">Photo</th> -->
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Mobile Number</th>
                                            <!--  <th scope="col">Gender</th>
                                             <th scope="col">Role</th> -->
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($Investigation['smmes'])) {
                                            foreach ($Investigation['smmes'][0] as $k => $row) {
                                                if (empty($row)) {
                                                    continue;
                                                }
                                                if (gettype($row) == "array" && isset($row[0]) && !empty($row[0])) {
                                                    $row = $row[0];
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $row->tbl_users_id; ?></td>
                                                    <td>MSME-<?php echo $row->tbl_users_user_uniqueid; ?></td>
                                                    <td><?php echo $row->tbl_users_firstname . " " . $row->tbl_users_lastname; ?></td>
                                                    <td><?php echo $row->tbl_users_email; ?></td>
                                                    <td><?php echo $row->tbl_users_mobile; ?></td>
                                                    <td>
                                                        <button data-toggle="dropdown"
                                                                class="btn btn-primary btn-block button_width"><i
                                                                class="la la-cog setting"></i></button>
                                                        <div class="dropdown-menu">
                                                            <!-- <a href="<?= site_url('bdsp/Smme/createTask/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-edit"></i> Manage Notice Board
                                                            </a> -->
                                                            <!-- <a href="<?= site_url('bdsp/Smme/createMilestone/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item">Create Milestone
                                                            </a> 
                                                            <a href="<?= site_url('bdsp/BusinessDetails/handlebbm/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-eye"></i>View BBM Assessment
                                                            </a> -->
                                                            <a href="<?= site_url('bdsp/Operations/incprogress/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-eye"></i> View
                                                            </a>                                                            
                                                            <!--<a href="<?= site_url('bdsp/Smme/evaluate/' . $row->tbl_users_id) ?>"
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

                        <div class="tab-pane" id="tabCont2">
                            <div class="row">
                                <div class="table-responsive">
                                    <!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
									<nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li>Feasibility &nbsp;&nbsp;/&nbsp; Planning &nbsp;&nbsp;/&nbsp; Introduction </li>
					
                </ol>
            </nav>
                                     <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                        <thead>
                                        <tr>
                                            <th scope="col">pid</th>
                                            <th scope="col">Reference</th>
                                            <!-- <th scope="col">Photo</th> -->
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Mobile Number</th>
                                            <!--  <th scope="col">Gender</th>
                                             <th scope="col">Role</th> -->
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($Development['smmes'])) {
                                            foreach ($Development['smmes'][0] as $k => $row) {
                                                if (empty($row)) {
                                                    continue;
                                                }
                                                if (gettype($row) == "array" && isset($row[0]) && !empty($row[0])) {
                                                    $row = $row[0];
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $row->tbl_users_id; ?></td>
                                                    <td>MSME-<?php echo $row->tbl_users_user_uniqueid; ?></td>
                                                    <td><?php echo $row->tbl_users_firstname . " " . $row->tbl_users_lastname; ?></td>
                                                    <td><?php echo $row->tbl_users_email; ?></td>
                                                    <td><?php echo $row->tbl_users_mobile; ?></td>
                                                    <td>
                                                        <button data-toggle="dropdown"
                                                                class="btn btn-primary btn-block button_width"><i
                                                                class="la la-cog setting"></i></button>
                                                        <div class="dropdown-menu">
                                                            <!-- <a href="<?= site_url('bdsp/Smme/createTask/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-edit"></i> Manage Notice Board
                                                            </a> -->
                                                            <!-- <a href="<?= site_url('bdsp/Smme/createMilestone/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item">Create Milestone
                                                            </a> 
                                                            <a href="<?= site_url('bdsp/Smme/createMilestoneTask/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-eye"></i> View Milestones
                                                            </a>-->
                                                            <a href="<?= site_url('bdsp/Operations/incprogress/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-eye"></i> View                                                            </a>
                                                            <!--<a href="<?= site_url('bdsp/Smme/evaluate/' . $row->tbl_users_id) ?>"
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

                        <div class="tab-pane" id="tabCont3">
                            <div class="row">
                                <div class="table-responsive">
                                    <!-- <table id="example" class="table key-buttons text-md-nowrap"> -->
									<nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li>Full Scale Production &nbsp;&nbsp;/&nbsp; Maturity </li>
										
                </ol>
            </nav>
                                     <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                        <thead>
                                        <tr>
                                            <th scope="col">pid</th>
                                            <th scope="col">Reference</th>
                                            <!-- <th scope="col">Photo</th> -->
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Mobile Number</th>
                                            <!--  <th scope="col">Gender</th>
                                             <th scope="col">Role</th> -->
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($Commercial['smmes'])) {
                                            foreach ($Commercial['smmes'][0] as $k => $row) {
                                                if (empty($row)) {
                                                    continue;
                                                }
                                                if (gettype($row) == "array" && isset($row[0]) && !empty($row[0])) {
                                                    $row = $row[0];
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $row->tbl_users_id; ?></td>
                                                    <td>MSME-<?php echo $row->tbl_users_user_uniqueid; ?></td>
                                                    <td><?php echo $row->tbl_users_firstname . " " . $row->tbl_users_lastname; ?></td>
                                                    <td><?php echo $row->tbl_users_email; ?></td>
                                                    <td><?php echo $row->tbl_users_mobile; ?></td>
                                                    <td>
                                                        <button data-toggle="dropdown"
                                                                class="btn btn-primary btn-block button_width"><i
                                                                class="la la-cog setting"></i></button>
                                                        <div class="dropdown-menu">
                                                           <!-- <a href="<?= site_url('bdsp/Smme/createTask/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-edit"></i> Manage Notice Board
                                                            </a> -->
                                                            <!-- <a href="<?= site_url('bdsp/Smme/createMilestone/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item">Create Milestone
                                                            </a>
                                                            <a href="<?= site_url('bdsp/Smme/createMilestoneTask/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-eye"></i> View Milestones
                                                            </a> -->
                                                            <a href="<?= site_url('bdsp/Operations/incprogress/' . $row->tbl_users_id) ?>"
                                                               class="dropdown-item"><i class="fa fa-eye"></i> View
                                                            </a>
                                                            <!--<a href="<?= site_url('bdsp/Smme/evaluate/' . $row->tbl_users_id) ?>"
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
