<?php 
    defined('BASEPATH') OR exit('No direct script access allowed')
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?= $header?>
<div class="container">
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto breadcrumb-right">
            <a href="<?= site_url('admin/competition')?>"><input type="submit" value="Cancel" class="btn btn-outline-primary mr-3"></a>
        </div>      
    </div> 
    <div class="">
        <!--body of the page-->
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <div class="card-category">
                    <div class="card-body iconfont text-left">
                        <p><?php if ($this->session->flashdata('danger')){?>
                                <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('danger');?></div>
                            <?php }else if($this->session->flashdata('success')){?>
                                <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                            <?php }?>
                        </p> 
                        
                        <?php echo form_open('admin/comp/up')?>
                         <?php foreach ($comp as $rows){?>
                        <div class="row">
                             <div class="col-md-12">
                                 <input type="hidden" name="id" value="<?= $rows->tbl_competitions_id ?>"/> 
                                <div class="col-md-4 form-group mb-3 float-lg-left">
                                    <label>Competition Name*</label>
                                    <input name="compName" type="text" value="<?= $rows->tbl_competitions_name ?>" class="form-control"/>
                                </div>
                                <div class="col-md-4 form-group mb-3 float-lg-right">
                                    <label>Number of qualifying entries*</label>
                                    <input name="nEnty" type="number" value="<?= $rows->tbl_competitions_entry_num?>" class="form-control"/>
                                </div>
                                <div class="col-md-4 form-group mb-8 float-lg-right">
                                    <label>Submission Start Date:*</label>
                                    <input type="date" value="<?= $rows->tbl_competitions_starting_date ?>" name="ssd" class="form-control"/>
                                </div>
                              
                                <div class="col-md-4 form-group mb-3 float-lg-left">
                                    <label>Submission End Date*</label>
                                    <input name="sed" value="<?= $rows->tbl_competitions_end_date ?>" type="date" class="form-control"/>
                                </div>
                                 <div class="col-md-4 form-group mb-3 float-lg-left">
                                    <label>Pre-screening End Date*</label>
                                    <input  name="psed" type="date" value="<?= $rows->pre_screeningenddate ?>"  class="form-control" />
                                </div>
                                 <div class="col-md-4 form-group mb-3 float-lg-left">
                                    <label>Final Selection End Date*</label>
                                    <input  name="fsed" type="date" value="<?= $rows->finalselectionenddate ?>"  class="form-control" />
                                </div>
                                <div class="col-md-4 form-group mb-3 float-lg-left">
                                    <label>Selection Criteria*</label>
                                    <textarea  name = "selectCr" class="form-control" >
                                       <?= $rows->tbl_competitions_criteria?>
                                    </textarea><br>
                                </div>
                                 <div class="col-md-4 form-group mb-3 float-lg-left">
                                    <label>Prizes to be Won*</label>
                                    <textarea  name = "prize" class="form-control" >
                                       <?= $rows->tbl_competitions_prize?>
                                    </textarea><br>
                                </div>
                                <div class="col-md-4 form-group mb-3 float-lg-right">
                                    <label>Competion Description*</label>
                                    <textarea  name = "description" class="form-control" >
                                       <?= $rows->tbl_competitions_description?>
                                    </textarea><br>
                                </div>
                                <div></div>
                                 
                                <div class="col-md-4 form-group mb-3">
                                    <input type="submit" value="Update Competitions" class="btn btn-primary sub"/>
                                </div>
                            
                            </div>
                        </div>
                         <?php } echo form_close();?>
                        <?= $hist?>
                    </div>      
                </div>                
            </div> 
        </div>
    </div>
</div>
<?= $footer?>

