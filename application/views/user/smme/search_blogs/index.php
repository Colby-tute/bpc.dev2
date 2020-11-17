<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    <style type="text/css">
        .t4 {
    -webkit-column-count: 3;
    -moz-column-count: 3;
    column-count: 3;
}
.lipadding
{
    padding: 10px 0;
}
    </style>
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Resources</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Knowledge Centre</li>
                    </ol>
                </nav>

            </div>
              <div class="my-auto breadcrumb-right">
							<a href="mailto:admin@bedco.org.ls" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-folder mr-2"></i></span><span class="btn-text">Submit an Article </span></button></a>
							<a href="<?= site_url('user/smme/Faqs') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-folder-open mr-2"></i> </span><span class="btn-text">Frequently Asked Questions </span></button></a>
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
                                 <div id="infoMessage" class="alert alert-danger mt25"><?php echo $this->session->flashdata('danger');?></div>
                            <?php } else if ($this->session->flashdata('success')) { ?>
                                 <div id="infoMessage" class="alert alert-success mt25"><?php echo $this->session->flashdata('success');?></div>
                            <?php }
                            ?>
                            </p>
                            <div class="input-group mb-0">
                                <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search">
                                <!-- <span class="input-group-append">
                                    <button class="btn ripple btn-primary" type="button">Search</button>
                                </span> -->
                            </div>
                            <div class="row"> 
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <ul class="t4 myUL" id="myUL">
                                <?php
                                foreach ($select_category['category'] as $key => $value) { ?>
                                    <div class="col-xl-12">
                                        <li class="lipadding">
                                            <a href="<?= site_url('user/smme/Blogs/index/'.$value->tbl_basecenter_category_id.'/0') ?>"><?php echo $value->tbl_basecenter_category_name;?></a>
                                            <ul id="myUL">
                                                <?php foreach ($select_category['sub_category'][$value->tbl_basecenter_category_id] as $keys => $subcat) { ?>
                                                <li class="subli" style="margin-bottom: 5px;">
                                                    <a href="<?= site_url('user/smme/Blogs/index/'.$value->tbl_basecenter_category_id.'/'.$subcat->tbl_basecenter_sub_category_id) ?>"><?php echo $subcat->tbl_basecenter_sub_category_name;?></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </div>
                                <?php }
                                ?>
                                </ul>
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
<script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    //ul = document.getElementsByClassName("myUL");
    ul = document.getElementById("myUL");
    li = ul.getElementsByClassName("subli");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }

        //ul = document.getElementById("myUL");
        
    }
}
</script>
