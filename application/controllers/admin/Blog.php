<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

/**

 * @name Home.php

 * @author Imron Rosdiana

 */

date_default_timezone_set('Africa/Johannesburg');

class Blog extends MY_Controller

{

 

    function __construct() {

        parent::__construct();

 

        if(empty($this->session->userdata('id_admin'))) {

            $this->session->set_flashdata('flash_data', 'You don\'t have Of Pages');

            redirect('admin/masterlogin');

        }

        $this->load->model("admin/Blog_model");

        $this->load->database();

    }

    

    public function index()

    {
        //$this->load->view ('home', $data);

        $result = $this->Blog_model->select_all_blog_view();

        $data['tdata'] = $result;

       /* $datad['d'] = $result;

        $datad['dd'] = $this->session->userdata('user_id');*/

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $this->load->view('admin/blog/index',$data);

    }



    public function update_profile_image($id) {

      

      if($_FILES['tbl_users_photo']['name'] != "")

      {



        unlink('assets/users/'.$this->input->post('old_tbl_users_photo'));



        $image_replace = str_replace(" ", "_",$_FILES['tbl_users_photo']['name']);

        $image_name = "users_photo_".$this->session->userdata('user_unique_id')."_".$image_replace;

        $images = array(

            'tbl_users_photo' => $image_name,

        ); 

        $this->Blog_model->image_insert($images,$id,'tbl_users','tbl_users_id');



        if(!empty($_FILES['tbl_users_photo']['name'])){



          $data = [

            'user_profile_image' => $image_name,

        ];

        $this->session->set_userdata($data);

     

            $_FILES['file']['name'] = $image_name;

            $_FILES['file']['type'] = $_FILES['tbl_users_photo']['type'];

            $_FILES['file']['tmp_name'] = $_FILES['tbl_users_photo']['tmp_name'];

            $_FILES['file']['error'] = $_FILES['tbl_users_photo']['error'];

            $_FILES['file']['size'] = $_FILES['tbl_users_photo']['size'];

  

            $config['upload_path'] = 'assets/users'; 

            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $config['max_size'] = '5000';

            $config['client_name'] = $image_name;

   

            $this->load->library('upload',$config); 

    

            if($this->upload->do_upload('file')){

                $uploadData = $this->upload->data();

            }

        }



        $this->session->set_flashdata('success', 'Profile Photo is Successfully Updated!!!');

        redirect($_SERVER['HTTP_REFERER']);

      }

      else{

        $this->session->set_flashdata('danger', 'Profile Photo is Not Updated!!!');

        redirect($_SERVER['HTTP_REFERER']);

      }

    }


    public function get_sub_industries() {

        $ind_id = $this->input->post('ind_id');

        $sub_industries = $this->Blog_model->sub_industries($ind_id);

        echo json_encode($sub_industries);
    }

    public function add() {

       

            if($_POST)

            {
                //print_r($_POST);exit();

                $now = date("Y-m-d H:i:s");

                $user = array(


                         'tbl_blog_admin_id' => $this->session->userdata('admin_uniqueid'),



                         'tbl_blog_title' => $this->input->post('tbl_blog_title'),



                         'tbl_blog_short_desc' => $this->input->post('tbl_blog_short_desc'),



                         'tbl_blog_long_desc'=> $this->input->post('tbl_blog_long_desc'),



                         'tbl_blog_have_gallery'=> $this->input->post('tbl_blog_have_gallery'),



                         'tbl_blog_video_link'=> $this->input->post('tbl_blog_video_link'),

                         'tbl_blog_tags'=> $this->input->post('tbl_blog_tags'),


                         'tbl_blog_category_id'=> $this->input->post('tbl_business_details_industry'),

                         'tbl_blog_subcategory_id'=> $this->input->post('tbl_business_details_subindustry'),


                         'tbl_blog_insertdate' => $now,



                ); 


                $result = $this->Blog_model->insert_master($user);

                $user_id = explode('^', $result);

                if($result[0] == 1) {

                    $count = count($_FILES['tbl_blog_gallery_image']['name']);

                    if($count > 0 && $_FILES['tbl_blog_gallery_image']['name'][0] != '')
                    {
                        for ($i=0; $i < $count; $i++) { 

                    $business_doc = str_replace(" ", "_",$_FILES['tbl_blog_gallery_image']['name'][$i]);
                    $business_doc_new = "tbl_blog_gallery_image_".$user_id[1]."_".$business_doc;

                    $images = array(

                        'tbl_blog_gallery_admin_id' => $this->session->userdata('admin_uniqueid'),

                        'tbl_blog_gallery_blog_id' => $user_id[1],

                        'tbl_blog_gallery_image' => $business_doc_new,

                        'tbl_blog_gallery_insertdate' => $now

                    ); 

                    $this->Blog_model->image_insert($images,'tbl_blog_gallery');

                    if(!empty($_FILES['tbl_blog_gallery_image']['name'][$i])){

                        $_FILES['file']['name'] = $business_doc_new;
                        $_FILES['file']['type'] = $_FILES['tbl_blog_gallery_image']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['tbl_blog_gallery_image']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['tbl_blog_gallery_image']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['tbl_blog_gallery_image']['size'][$i];
              
                        $config['upload_path'] = 'assets/blogs'; 
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        //$config['max_size'] = '5000';
                        $config['client_name'] = $business_doc_new;
               
                        $this->load->library('upload',$config);
                
                        if($this->upload->do_upload('file')){
                            $uploadData = $this->upload->data();
                        }
                    }
                }
                    }

                
                        

                if(!empty($_FILES['tbl_blog_image']['name'])){

                    $image_replace = str_replace(" ", "_",$_FILES['tbl_blog_image']['name']);

                    $image_name = "tbl_blog_image".$user_id[1]."_".$image_replace;

                    $images = array(

                        'tbl_blog_image' => $image_name,

                    ); 

                    $this->Blog_model->image_update($images,$user_id[1],'tbl_blog','tbl_blog_id');


                    $_FILES['file']['name'] = $image_name;
                    $_FILES['file']['type'] = $_FILES['tbl_blog_image']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['tbl_blog_image']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['tbl_blog_image']['error'];
                    $_FILES['file']['size'] = $_FILES['tbl_blog_image']['size'];
          
                    $config1['upload_path'] = 'assets/blogs'; 

                    $config1['allowed_types'] = 'jpg|jpeg|png|gif';
                    //$config['max_size'] = '5000';
                    $config1['client_name'] = $image_name;
           
                    $this->load->library('upload',$config1); 
                    $this->upload->initialize($config1);
                    if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();                       
                    }
                }


                        $this->session->set_flashdata('success', 'Data Inserted Successfully!');

                        //redirect($_SERVER['HTTP_REFERER']);

                        redirect('admin/blog');

                    }

                if($result == 2) {

                    $this->session->set_flashdata('danger', 'Username or Email id is Duplicate!');

                    //redirect($_SERVER['HTTP_REFERER']);

                    redirect('admin/blog');

                }

                elseif($result == 0) {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

                    //redirect($_SERVER['HTTP_REFERER']);

                    redirect('admin/blog');

                }

            }

            $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

            $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

            $industrys = $this->Blog_model->select_industry();

            $data['industrys'] = $industrys;

            $this->load->view('admin/blog/add',$data);



    }

    public function edit($i) {

        //print_r($i);

        $editdt = $this->Blog_model->select_blog_data($i);

        $images = $this->Blog_model->select_blog_images_data($i);

        $industrys = $this->Blog_model->select_industry();
            
        $data['industrys'] = $industrys;

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $data['userdt'] = $editdt;

        $data['images'] = $images;

    
        $this->load->view('admin/blog/edit',$data);



    }



    public function update($upd_id) {

        //echo $upd_id;exit;

        //print_r($_POST);exit();

            if($_POST)

            {

                $now = date("Y-m-d H:i:s");


                $user = array(


                         'tbl_blog_admin_id' => $this->session->userdata('admin_uniqueid'),



                         'tbl_blog_title' => $this->input->post('tbl_blog_title'),



                         'tbl_blog_short_desc' => $this->input->post('tbl_blog_short_desc'),



                         'tbl_blog_long_desc'=> $this->input->post('tbl_blog_long_desc'),



                         'tbl_blog_have_gallery'=> $this->input->post('tbl_blog_have_gallery'),



                         'tbl_blog_video_link'=> $this->input->post('tbl_blog_video_link'),

                         'tbl_blog_tags'=> $this->input->post('tbl_blog_tags'),

                          'tbl_blog_category_id'=> $this->input->post('tbl_business_details_industry'),

                         'tbl_blog_subcategory_id'=> $this->input->post('tbl_business_details_subindustry'),


                         'tbl_blog_insertdate' => $now,



                );

                //print_r($data);exit;
            

                $result = $this->Blog_model->update_master($user,$upd_id);

                $user_id = explode('^', $result);

                $images = $this->Blog_model->select_blog_images_data($upd_id);

                if($result[0] == 1) {

                        $count = count($_FILES['tbl_blog_gallery_image']['name']);

                        /*if(!empty($images) && $count > 0)
                        {
                            $this->Blog_model->image_delete($upd_id);
                        }*/
                        if($count > 0 && $_FILES['tbl_blog_gallery_image']['name'][0] != '')
                        {
                        /*print_r($_FILES['tbl_blog_gallery_image']['name'][0]);
                        echo $count;exit();*/


                        for ($i=0; $i < $count; $i++) { 

                            $business_doc = str_replace(" ", "_",$_FILES['tbl_blog_gallery_image']['name'][$i]);
                            $business_doc_new = "tbl_blog_gallery_image_".$user_id[1]."_".$business_doc;

                            $images = array(

                                'tbl_blog_gallery_admin_id' => $this->session->userdata('admin_uniqueid'),

                                'tbl_blog_gallery_blog_id' => $user_id[1],

                                'tbl_blog_gallery_image' => $business_doc_new,

                                'tbl_blog_gallery_insertdate' => $now

                            ); 

                            $this->Blog_model->image_insert($images,'tbl_blog_gallery');

                            if(!empty($_FILES['tbl_blog_gallery_image']['name'][$i])){

                                $_FILES['file']['name'] = $business_doc_new;
                                $_FILES['file']['type'] = $_FILES['tbl_blog_gallery_image']['type'][$i];
                                $_FILES['file']['tmp_name'] = $_FILES['tbl_blog_gallery_image']['tmp_name'][$i];
                                $_FILES['file']['error'] = $_FILES['tbl_blog_gallery_image']['error'][$i];
                                $_FILES['file']['size'] = $_FILES['tbl_blog_gallery_image']['size'][$i];
                      
                                $config['upload_path'] = 'assets/blogs'; 
                                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                                //$config['max_size'] = '5000';
                                $config['client_name'] = $business_doc_new;
                       
                                $this->load->library('upload',$config);
                        
                                if($this->upload->do_upload('file')){
                                    $uploadData = $this->upload->data();
                                }
                            }
                        }
                        }    

                        if(!empty($_FILES['tbl_blog_image']['name'])){

                            $image_replace = str_replace(" ", "_",$_FILES['tbl_blog_image']['name']);

                            $image_name = "tbl_blog_image".$user_id[1]."_".$image_replace;

                            $images = array(

                                'tbl_blog_image' => $image_name,

                            ); 

                            $this->Blog_model->image_update($images,$user_id[1],'tbl_blog','tbl_blog_id');


                            $_FILES['file']['name'] = $image_name;
                            $_FILES['file']['type'] = $_FILES['tbl_blog_image']['type'];
                            $_FILES['file']['tmp_name'] = $_FILES['tbl_blog_image']['tmp_name'];
                            $_FILES['file']['error'] = $_FILES['tbl_blog_image']['error'];
                            $_FILES['file']['size'] = $_FILES['tbl_blog_image']['size'];
                  
                            $config1['upload_path'] = 'assets/blogs'; 

                            $config1['allowed_types'] = 'jpg|jpeg|png|gif';
                            //$config['max_size'] = '5000';
                            $config1['client_name'] = $image_name;
                   
                            $this->load->library('upload',$config1); 
                            $this->upload->initialize($config1);
                            if($this->upload->do_upload('file')){
                                $uploadData = $this->upload->data();                       
                            }
                        }


                                $this->session->set_flashdata('success', 'Data Updated Successfully!');

                                //redirect($_SERVER['HTTP_REFERER']);

                                redirect('admin/blog');

                    }

                if($result == 2) {

                    $this->session->set_flashdata('danger', 'Username or Email id is Duplicate!');

                    //redirect($_SERVER['HTTP_REFERER']);

                    redirect('admin/blog');

                }

                elseif($result == 0) {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Update!');

                    //redirect($_SERVER['HTTP_REFERER']);

                    redirect('admin/blog');

                }

            }

            $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

            $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

            

            //$this->load->view ('home', $data);

            $this->load->view('admin/blog/index',$data);

            //print_r($_POST);exit;



    }



    public function delete($i) {

        //print_r($i);exit;

         

            $result = $this->Blog_model->did_delete_company_row($i);

            if($result == 1) {

                $this->session->set_flashdata('success', 'Data Delete Successfully!');

                redirect('admin/blog');

            }

            elseif($result == 0) {

                $this->session->set_flashdata('danger', 'We are in truble Data Could not Delete!');

                redirect('admin/blog');

            }

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        

        //$this->load->view ('home', $data);

        $this->load->view('admin/blog/index',$data);



    }



    public function get_state_by_zone(){



        $zone_id = $this->input->post('zone_id');

        $data = $this->Blog_model->get_state_by_zone($zone_id)->result();

        echo json_encode($data);

    }



    public function get_city_by_state(){



        $state_id = $this->input->post('state_id');

        $data = $this->Blog_model->get_city_by_state($state_id)->result();

        echo json_encode($data);

    }

    

    public function get_zip_by_city(){



        $city_id = $this->input->post('city_id');

        $data = $this->Blog_model->get_zip_by_city($city_id)->result();

        echo json_encode($data);

    }



    public function check_username(){





        $username = $this->input->post('username');

        $id = $this->input->post('id');

        $data = $this->Blog_model->check_username($username,$id);

        echo json_encode($data);

    }



    public function check_email(){



        $email = $this->input->post('email');

        $id = $this->input->post('id');

        $data = $this->Blog_model->check_email($email,$id);

        echo json_encode($data);

    }


    public function logout() {

        $data = ['id_user', 'username'];

        $this->session->unset_userdata($data);

 

        redirect('admin/masterlogin');

    }

}