<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

/**

 * @name Home.php

 * @author Imron Rosdiana

 */



date_default_timezone_set('Africa/Johannesburg');

class Home extends MY_Controller

{

 

    function __construct() {

        parent::__construct();

        $this->load->database();

        

        if(empty($this->session->userdata('id_admin'))) {

            $this->session->set_flashdata('flash_data', 'You don\'t have Of Pages');

            redirect('admin/masterlogin');

        }

        

        $this->load->model("admin/Home_modal");

        

    }

 

    public function index() {


        $role = $this->Home_modal->select_all_no_row();

        $data['role'] = $role;



        $this->db->select("COUNT(*) as count");
        $data['smmeApps'] = $this->db->get("tbl_application")->result()[0]->count;

        $this->db->select("COUNT(*) as count");
        $this->db->join("tbl_incubation_users as ic", "u.tbl_users_id=ic.user_id", "LEFT");
        $this->db->where("u.tbl_users_role_id=2");
        $query = $this->db->get("tbl_users as u");
		$data['incSmmes'] = $query->result()[0]->count;

		$data['msAchieved'] = 0;
		$data['revenues'] = 0;

		$this->db->select("COUNT(*) as count");
		$this->db->where("u.tbl_users_role_id=2 AND u.tbl_users_status=7");
		$query = $this->db->get("tbl_users as u");
		$data['graduated'] = $query->result()[0]->count;

		$data['jobs'] = $data['smmeApps'];
		$data['inc_revenue'] = 0;

		$this->db->select("
		(
			(
				(
				SUM(prob_solv) + 
				SUM(prob_solve_timely) + 
				SUM(advice) + 
				SUM(recommend)
				) 
				/ COUNT(id)
			) 
		/ 4) as total");
		$data['bdsp_rating'] = $this->db->get("tbl_evaluate_smme_bdsp")->result()[0]->total;

		$this->db->select("
		(
			(
				(
				SUM(shared_s) + 
				SUM(rel_train) + 
				SUM(networking) +
				SUM(inc_resp) + 
				SUM(rel_info) +  
				SUM(prof) + 
				SUM(prof_staff)
				) 
				/ COUNT(id)
			) 
		/ 7) as total");
		$data['inc_rating'] = $this->db->get("tbl_evaluate_smme_inc")->result()[0]->total;
		
		
		/* Added by Munjal */
		$this->db->select("COUNT(*) as count");
		$data['smmeApps'] = $this->db->get("tbl_application")->result()[0]->count;
		
		$this->db->select("COUNT(*) as count");
		$this->db->join("tbl_incubation_users as ic", "u.tbl_users_id=ic.user_id", "LEFT");
		$this->db->where("u.tbl_users_role_id=2");
		$query = $this->db->get("tbl_users as u");
		$data['incSmmes'] = $query->result()[0]->count;
		
		/* Munjal Code */
		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_status", "Declined");
		$data['declinedApps'] = $this->db->get("tbl_application")->result()[0]->count;
		
		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_status", "Incubation");
		$data['incSmmes'] = $this->db->get("tbl_application")->result()[0]->count;
		
		
		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_status", "Graduated");
		$data['graduated00'] = $this->db->get("tbl_application")->result()[0]->count;
		
		$this->db->join("tbl_users u",'u.tbl_users_id = `tbl_application`.`tbl_application_smme_id`','LEFT');
		$this->db->select("COUNT(u.tbl_users_id) as count");
		$this->db->where("u.tbl_users_gender='F'");
		$this->db->where("tbl_application_status", "Incubation");
		$data['graduated'] = $this->db->get("tbl_application")->result()[0]->count;
		
		
		$this->db->join("tbl_users u",'u.tbl_users_id = `tbl_application`.`tbl_application_smme_id`','LEFT');
		$this->db->select("COUNT(u.tbl_users_id) as count");
		$this->db->where("u.tbl_users_gender='M'");
		$this->db->where("tbl_application_status", "Incubation");
		$data['msAchieved'] = $this->db->get("tbl_application")->result()[0]->count;
		
		$this->db->select("COUNT(*) as count");
		$tbl_phase_question = $this->db->get("tbl_phase_question")->result()[0]->count;
		//echo $tbl_phase_question; exit;
		
		$data['jobs'] = $tbl_phase_question * $data['incSmmes'];
		
		$this->db->join("tbl_smme_teams u",'`tbl_application`.`tbl_application_smme_id` = u.tbl_smme_teams_user_id','LEFT');
		$this->db->select("tbl_application_smme_id, COUNT(u.tbl_smme_teams_id) as count_row, COUNT(tbl_application_id) as count_apps");
		$this->db->group_by("tbl_application_smme_id");
		$rresult = $this->db->get("tbl_application")->result();
		
		$jobs1 = 0;
		
		foreach($rresult as $row1)
		{
			$jobs1+= ($row1->count_row + 1);
		}
		
		$data['jobs1'] = $jobs1;
		
		
		$this->db->join("tbl_business_details u",'`tbl_application`.`tbl_application_smme_id` = u.tbl_business_details_user_id','LEFT');
		$this->db->select("tbl_business_details_user_id, tbl_business_details_revenue_raised");
		$this->db->where("tbl_business_details_revenue_raised is NOT NULL", NULL, FALSE);
		$rresult1 = $this->db->get("tbl_application")->result();
		//echo '<pre>'; print_r($rresult1); exit;
		
		$inc_revenue = 0;
		
		foreach($rresult1 as $row1)
		{
			$inc_revenue+= $row1->tbl_business_details_revenue_raised;
		}
		
		$data['inc_revenue'] = $inc_revenue;

        //print_r($role);exit;
        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
        $this->load->view('admin/home',$data);

    }



    public function profile() {

        $role = $this->Home_modal->select_all_role();

            $data['role'] = $role;

        $id = $this->session->userdata('id_admin');

        $editdt = $this->Home_modal->select_admin_data($id);

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $data['userdt'] = $editdt;



      $this->load->view('admin/profile',$data);

    }



    public function update_profile_image($id) {

		//print_r($_FILES);exit;

		if($_FILES['tbl_users_photo']['name'] != "")

		{



			@unlink('assets/admin/'.$this->input->post('old_tbl_users_photo'));



			$image_replace = str_replace(" ", "_",$_FILES['tbl_users_photo']['name']);

			$image_name = "admin_photo_".$this->session->userdata('id_admin')."_".$image_replace;

			$images = array(

				'tbl_admins_image' => $image_name,

			); 

			$this->Home_modal->image_insert($images,$id,'tbl_admins','tbl_admins_id');



			$data = [

				'admin_profile_image' => $image_name,

			];

			$this->session->set_userdata($data);



			$_FILES['file']['name'] = $image_name;

			$_FILES['file']['type'] = $_FILES['tbl_users_photo']['type'];

			$_FILES['file']['tmp_name'] = $_FILES['tbl_users_photo']['tmp_name'];

			$_FILES['file']['error'] = $_FILES['tbl_users_photo']['error'];

			$_FILES['file']['size'] = $_FILES['tbl_users_photo']['size'];



			$config['upload_path'] = 'assets/admin'; 

			$config['allowed_types'] = 'jpg|jpeg|png|gif';

			$config['max_size'] = '5000';

			$config['client_name'] = $image_name;



			$this->load->library('upload',$config); 



			if($this->upload->do_upload('file')){

				$uploadData = $this->upload->data();

			}




			$this->session->set_flashdata('success', 'Profile Photo is Successfully Updated!!!');

			redirect($_SERVER['HTTP_REFERER']);

		}

		else{

			$this->session->set_flashdata('danger', 'Profile Photo is Not Updated!!!');

			redirect($_SERVER['HTTP_REFERER']);

			}

    }



    public function change_password() {

        //print_r($_POST);exit();

        $password = $this->input->post('password');

        $confirm_password = $this->input->post('confirm_password');

        if ($password == $confirm_password) 

        {

           if($_POST)

            {

                $now = date("Y-m-d H:i:s");

                $data = array(



                        'tbl_admins_password' => md5($this->input->post('password')),



                    ); 

                $result = $this->Home_modal->insert_master($data,$this->session->userdata('id_admin'),$this->input->post('oldpass'));

                if($result == 2) {

                    $this->session->set_flashdata('danger', 'Your Current Password Is Incorrect Please Try Again!');

                    redirect('admin/change_password');

                } else if($result == 1) {



                    $config = Array(

                      'protocol' => 'smtp',

                      'smtp_host' => 'ssl://smtp.gmail.com',

                      'smtp_port' => 465,

                      'smtp_user' => 'bedco.vbi@gmail.com', // change it to yours

                      'smtp_pass' => 'yqitwwcttlbrfbnc', // change it to yours

                      'mailtype' => 'html',

                      'charset' => 'iso-8859-1',

                      'wordwrap' => TRUE

                    );

                     $from_email = "bedco.vbi@gmail.com"; 

                     $to_email =  $this->session->userdata('admin_email'); 

                    //print_r($to_email);exit;

                     //Load email library 

                     /*$this->load->library('email'); */

                     $this->load->library('email', $config);

                     $this->email->set_newline("\r\n");

                     $this->email->from($from_email,$value->admin_name); 

                     $this->email->to($to_email);

                     $this->email->subject('New Password'); 

                     $this->email->message('Your Password Has been changed at '.$now.'<br> Your New Password Is : '.$this->input->post('password'));

                     //print_r($this->email->send());exit;

                     //echo $this->email->print_debugger();exit;

                     if($this->email->send()) 

                     {

                      $this->session->set_flashdata('success', 'Your Password Is Updated Successully Please Check Your Email!');

                      redirect('admin/change_password');

                    }

                    else 

                    {



                      //  echo $this->email->print_debugger();

                      //echo "uyuyuy";exit;

                      $this->session->set_flashdata("danger","Error in sending Email.Please Check Your Email id Again!"); 

                      redirect('admin/change_password'); 

                    }

                    

                }

                elseif($result == 0) {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

                    redirect('admin/change_password');

                }

            }

            $role = $this->Home_modal->select_all_role();

            $data['role'] = $role;

            $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

            $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

            

            //$this->load->view ('home', $data);

            $this->load->view('admin/change_password',$data);

        }

        else {

            $this->session->set_flashdata('danger', 'Password and Confirm Password does not match');

            redirect('admin/change_password');

        }

       

    }





    public function edit_profile() {

        //print_r($i);

        $editdt = $this->Home_modal->select_data($this->session->userdata('id_admin'));

        $role = $this->Home_modal->select_all_role();

        $data['role'] = $role;

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $data['userdt'] = $editdt;

        

        //$this->load->view ('home', $data);

        $this->load->view('admin/edit_profile',$data);



    }



    public function login_history() {

        //print_r($i);

        $editdt = $this->Home_modal->login_history($this->session->userdata('id_admin'));

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $data['tdata'] = $editdt;

        

        //$this->load->view ('home', $data);

        $this->load->view('admin/activity_log',$data);



    }

 

    public function logout() {

        

            $data = ['id_admin', 'adminfname','adminlname','admin_type','admin_type_name','admin_email','admin_profile_image'];

            $this->session->unset_userdata($data);

            redirect('login');

    }

}
