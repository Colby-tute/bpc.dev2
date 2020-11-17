<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?= $header; ?>
    
    <div class="container">
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Resources</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('bdsp/home') ?>">Dashboard</a></li>
						 <li class="breadcrumb-item"><a href="<?= site_url('bdsp/SearchBlogs') ?>">Knowledge Centre</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Knowledge Centre</li>
                    </ol>
                </nav>

            </div>
            <div class="my-auto breadcrumb-right">
							<a href="<?= site_url('bdsp/SearchBlogs') ?>" class=""><button class="btn btn-outline-primary mr-3"><span class="icon-label"><i class="fa fa-arrow-circle-left mr-2"></i></span><span class="btn-text">Go Back </span></button></a>
							<a href="<?= site_url('bdsp/blog/add') ?>" class=""><button class="btn btn-outline-danger mr-3"><span class="icon-label"><i class="fa fa-folder mr-2"></i> </span><span class="btn-text">Add Article </span></button></a>
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
                            <div class="table-responsive">
                               <table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">Pid</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Article Title</th>
                                            <th scope="col">Short Description</th>
                                            <th scope="col">Video Link</th>
                                            <th scope="col">Tags</th>
                                            <th scope="col">Gallery?</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($tdata as $row)
                                        { ?>
                                        <tr>
                                        <td><?php echo $row->tbl_blog_id;?></td> 
                                        <td><img src="<?php echo base_url(); ?>assets/blogs/<?php echo $row->tbl_blog_image;?>" style="width: 50px; height: auto;"></td>
                                        <td><?php echo $row->tbl_blog_title;?></td> 
                                        
                                        <td><?php echo $row->tbl_blog_short_desc;?></td>  
                                        <td><?php echo $row->tbl_blog_video_link;?></td>
                                        <td><?php echo $row->tbl_blog_tags;?></td>
                                        <td><?php if($row->tbl_blog_have_gallery ==1){echo "Yes";}else{ echo "No";}?></td>
                                        <td>
                                            <button data-toggle="dropdown" class="btn btn-primary btn-block button_width"><i class="la la-cog setting"></i></button>
                                            <div class="dropdown-menu">
                                                <a href="<?= site_url('bdsp/Blogs/view/'.$row->tbl_blog_id) ?>" class="dropdown-item"><i class="fa fa-eye"></i> View
                                                </a>
                                                <a href="<?= site_url('bdsp/Blog/edit/'.$row->tbl_blog_id) ?>" class="dropdown-item"><i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="<?= site_url('bdsp/Blog/delete/'.$row->tbl_blog_id) ?>" class="dropdown-item"><i class="fa fa-trash"></i> Delete
                                                </a>
                                            </div>      
                                        </td>
                                        </tr>
                                        <?php
                                        } 
                                        ?>
                                    </tbody>
                               </table>
                            </div>
                         </div>
                        <div class="modal history" id="scrollmodal">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Login History</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
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
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
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



