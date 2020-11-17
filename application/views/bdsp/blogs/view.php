<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Knowledge Center Details</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('bdsp/Home') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('bdsp/SearchBlogs') ?>">Knowledge Center</a></li>
                        <li class="breadcrumb-item"><?php echo $blog['result'][0]->tbl_blog_title;?></li>
                    </ol>
                </nav>

            </div>
			
			<div class="my-auto breadcrumb-right">
							<a href="<?= site_url('bdsp/blog') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('bdsp/blog/') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-folder mr-2"></i> </span><span class="btn-text">Manage Knowledge Centre </span></button></a>
							<button class="btn btn-success mr-0"><span class="icon-label"><i class="fa fa-question-circle mr-2"></i> </span><span class="btn-text">Help </span></button>
						</div>
        </div>

        <div class="">
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div>
                        <div class="iconfont text-left">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card" style="padding: 10px;">
                                    <?php
                                    foreach ($blog['result'] as $key => $value) { ?>
                                        <div class="col-md-12 blog_space">
                                            <h1><?php echo $value->tbl_blog_title;?></h1>
                                        </div>
                                        <div class="row tags_sizs col-md-12">
                                            <div class="col-md-10 row">
                                                <div class="col-md-1">
                                                    <h6>Tags:</h6>
                                                </div>
                                                <div class="tags col-md-11">
                                                    <?php
                                                    $exp = explode(',',$value->tbl_blog_tags);
                                                    //print_r($exp);
                                                    foreach ($exp as $key => $expval) { ?>
                                                        <span class="tag tag-gray-dark"><?php echo $expval;?></span>
                                                    <?php }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="pull-right">
                                                    <?php $date = Date('F j, Y',strtotime($value->tbl_blog_insertdate));
                                                        echo $date;
                                                    ?>
                                                </p>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-12 blog_space">
                                        <?php
                                            if ($value->tbl_blog_video_link != '') { ?>
                                                <iframe class="bogs_content_size" src="<?php echo $value->tbl_blog_video_link;?>"></iframe>
                                        <?php } elseif ($value->tbl_blog_image != '') { ?>
                                                <img class="bogs_content_size" src="<?php echo base_url(); ?>assets/blogs/<?php echo $value->tbl_blog_image;?>" alt="">
                                            <?php } elseif ($value->tbl_blog_have_gallery == 1) { ?>
                                                <div class="carousel slide" data-ride="carousel" id="carouselExample2">
                                                    <div class="carousel-inner">
                                                        <?php
                                                        $i = 0;
                                                        foreach ($blog['blog_gallery'] as $keys => $gallery) { 
                                                            if ($i == 0) { ?>
                                                                <div class="carousel-item active">
                                                                <img class="d-block bogs_content_size" src="<?php echo base_url(); ?>assets/blogs/<?php echo $gallery->tbl_blog_gallery_image;?>" alt="">
                                                            </div>
                                                            <?php }else{ ?>
                                                                <div class="carousel-item">
                                                                <img class="d-block bogs_content_size" src="<?php echo base_url(); ?>assets/blogs/<?php echo $gallery->tbl_blog_gallery_image;?>" alt="">
                                                            </div>
                                                            <?php }
                                                            ?>
                                                            
                                                        <?php 
                                                        $i++; } 
                                                        ?>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExample2" role="button" data-slide="prev">
                                                        <i class="fa fa-angle-left fs-30" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExample2" role="button" data-slide="next">
                                                        <i class="fa fa-angle-right fs-30" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-12" style="text-align: justify;">
                                            <p><?php echo $value->tbl_blog_long_desc;?></p>
                                        </div>
                                    <?php }
                                    ?>
                                    </div>
                                </div>

                                <?php

                                foreach ($random_blogs['result'] as $key => $value) { ?>
                                    <div class="col-md-4">
                                        <div class="card" style="padding: 10px;">
                                            <div class="card custom-card card_size">
                                                <?php
                                                if ($value->tbl_blog_video_link != '') { ?>
                                                    <!-- <video controls="" class="w-100 height_size"><source src="<?php echo $value->tbl_blog_video_link;?>" type="video/mp4" ></video> -->
                                                        <iframe class="w-100 height_size" src="<?php echo $value->tbl_blog_video_link;?>"></iframe>
                                                <?php }elseif ($value->tbl_blog_image != '') { ?>
                                                    <img class="card-img-top w-100 height_size" src="<?php echo base_url(); ?>assets/blogs/<?php echo $value->tbl_blog_image;?>" alt="">
                                                <?php } elseif ($value->tbl_blog_have_gallery == 1) { ?>
                                                    <div class="carousel slide" data-ride="carousel" id="carouselExample2">
                                                        <div class="carousel-inner">
                                                            <?php
                                                            $i = 0;
                                                            foreach ($random_blogs['blog_gallery'][$value->tbl_blog_id] as $keys => $gallery) { 
                                                                if ($i == 0) { ?>
                                                                    <div class="carousel-item active">
                                                                    <img class="d-block w-100 height_size" src="<?php echo base_url(); ?>assets/blogs/<?php echo $gallery->tbl_blog_gallery_image;?>" alt="">
                                                                </div>
                                                                <?php }else{ ?>
                                                                    <div class="carousel-item">
                                                                    <img class="d-block w-100 height_size" src="<?php echo base_url(); ?>assets/blogs/<?php echo $gallery->tbl_blog_gallery_image;?>" alt="">
                                                                </div>
                                                                <?php }
                                                                ?>
                                                                
                                                            <?php 
                                                            $i++; } 
                                                            ?>
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExample2" role="button" data-slide="prev">
                                                            <i class="fa fa-angle-left fs-30" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExample2" role="button" data-slide="next">
                                                            <i class="fa fa-angle-right fs-30" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                <?php }else{ ?>
                                                    <img class="card-img-top w-100 height_size" src="<?php echo base_url(); ?>assets/blogs/g4.jpg" alt="">
                                                <?php }
                                                ?>
                                                <div class="card-body">
                                                    <h4 class="card-title"><?php echo $value->tbl_blog_title;?></h4>
                                                    <div class="row tags_sizs">
                                                        <div class="col-md-2">
                                                            <h6 class="card-text">Tags:</h6>
                                                        </div>
                                                        <div class="tags col-md-10">
                                                            <?php
                                                            $exp = explode(',',$value->tbl_blog_tags);
                                                            //print_r($exp);
                                                            foreach ($exp as $key => $expval) { ?>
                                                                <span class="tag tag-gray-dark"><?php echo $expval;?></span>
                                                            <?php }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <p class="card-text"><?php echo $value->tbl_blog_short_desc;?></p>
                                                    <?php
                                                    $date = date('F j, Y',strtotime($value->tbl_blog_insertdate));
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <p class="card-text"><?php echo $date;?></p>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <a href="<?= site_url('bdsp/Blogs/view/'.$value->tbl_blog_id) ?>" class="pull-right">Read More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            
                               
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
    </div>
<?= $footer; ?>
