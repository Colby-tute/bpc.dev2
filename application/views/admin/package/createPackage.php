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
            <a href="<?= site_url('package/entry')?>"><input type="submit" value="Cancel" class="btn btn-outline-primary mr-3"></a>
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
                        
                        <?php echo form_open('package/add')?>
                        <div class="row">
                             <div class="col-md-12">
                                <div class="col-md-4 form-group mb-3 float-lg-left">
                                    <label>Package Name*</label>
                                    <input name="packName" type="text" placeholder="name" class="form-control"/>
                                </div>
                                <div class="col-md-4 form-group mb-3 float-lg-right">
                                    <label>Package Duration*</label>
                                    <input name="packDuration" type="text" placeholder="6 months" class="form-control"/>
                                </div>
                                <div class="col-md-4 form-group mb-8 float-lg-right">
                                    <label>Package Type*</label>
                                    <select name="packType"  class="form-control">
                                        <option value="starter">Starter</option>
                                        <option value="middle">Middle</option>
                                        <option value="larger">Large</option>
                                    </select>
                                </div>
                              
                                <div class="col-md-4 form-group mb-3 float-lg-right">
                                    <label>Billing Type*</label>
                                    <input name="bill" type="text" placeholder="Once Off"class="form-control"/>
                                </div>
                                 <div class="col-md-4 form-group mb-3 float-lg-right">
                                    <label>License Cost*</label>
                                    <input placeholder="0.00" name="license" type="text" class="form-control" />
                                </div>
                                
                                <div class="col-md-4 form-group mb-3 float-lg-right">
                                    <label>Support*</label>
                                    <select name="support" class="form-control">
                                        <option value="Free">Free</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div>
                                <div></div>
                                 
                                <div class="col-md-4 form-group mb-3 float-lg-left">
                                    <input type="submit" value="Create Package" class="btn btn-primary sub"/>
                                </div>
                            
                            </div>
                        </div>
                       <?php echo form_close();?>
                        <?= $hist?>
                    </div>      
                </div>                
            </div> 
        </div>
    </div>
</div>
<?= $footer?>
