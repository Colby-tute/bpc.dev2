<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model("Registration_Modal");
        $this->load->model("Login_Modal");
        $this->load->database();

    }

    public function index() {
        $type = $this->Registration_Modal->Select_Type();
        $data['type'] = $type;
        $this->load->view('registration',$data);
    }

    public function add() {


      $now = date("Y-m-d H:i:s");
      $randomid = mt_rand(100000,999999);

      if ($this->input->post('type') == 2 || $this->input->post('type') == 1) {
        $login_approve = 1;
      } else {
        $login_approve = 2;
      }

      $data = array(
        'tbl_users_role_id' => $this->input->post('type'),

        'tbl_users_user_uniqueid' => $randomid,

        'tbl_users_conf_id' => md5($randomid),

        'tbl_users_firstname' => $this->input->post('firstname'),

        'tbl_users_lastname' => $this->input->post('lastname'),

        'tbl_users_email' => $this->input->post('email'),

        'tbl_users_password' => md5($this->input->post('password')),

        'tbl_users_contrycode' => $this->input->post('contrycode'),

        'tbl_users_mobile' => $this->input->post('mobile_no'),

        'tbl_users_status' => '2',

        'tbl_users_insertdate' => $now,

        'login_approve' => $login_approve,
      );

      $result = $this->Registration_Modal->registration($data);

      $user_id = explode('^', $result);

      if($result[0] == 1)
      {

        $data = [
          'email' => $this->input->post('email'),
          'user_id' => $user_id[1]
        ];
        $this->session->set_userdata($data);

        $r = "";
        if ($this->input->post('type') == 2) {
      $r = 'MSME';
    } elseif($this->input->post('type') == 4) {
      $r = "BDSP";
    } elseif($this->input->post('type') == 3) {
          $r = "INCU";
    }

    $psw = substr($this->input->post('password'), 0, -4)."****";

        $message = '
          <html>
          <body>
          <p>Dear '.$this->input->post('firstname').' '.$this->input->post('lastname').',</p>
          <p style="text-align:justify;">Thank you for registering on BEDCO Virtual Incubator platform.</p>
          <p>Your unique reference ID is <strong> '.$r.'-'.$randomid.'</strong>, please mention it in any communication with the incubation and support teams. In order to access your profile, you will need to confirm your registration by clicking on the below link:</p>
		  
		  <p><a href="'.base_url("Registration/confirm_email/".$user_id[1]).'" target="_blank">ACTIVATE ACCOUNT</a></p>
          <p>Once activated, you will be able to access your profile. Below are the login details you supplied when registerirng your profile:</p>
          <p>
          Username: '.$this->input->post('email').'
          <br/>
          Password: '.$psw.'
          </p>
          <p>
          <strong>Support Department</strong><br />
			Email: admin@bedco.org.ls &nbsp;&nbsp; | &nbsp;  Tel: +266 22216100 <br /> 
			Postal: P.O. Box 1216. Sebaboleng, Maseru/Maseru West 100. Lesotho 
          </p>
          </body>
          </html>
        ';

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
         $to_email =  $this->input->post('email');

         $this->load->library('email', $config);
         $this->email->set_mailtype("html");
         $this->email->set_newline("\r\n");
         $this->email->from($from_email,'BEDCO :: VBI');
         $this->email->to($to_email);
         $this->email->subject($r.'-'.$randomid);
         $this->email->message($message);
        if($this->email->send())
        {
          $this->session->set_flashdata('success', 'Please check your email and activate your account!');
          redirect('registration/thankyou');
        }
        else{
          echo $this->email->print_debugger();
          echo "uyuyuy";exit;
          $this->session->set_flashdata("danger","Error, sending email failed. Please Sign-up again!");
          redirect('registration');
        }

      }
      else if($result[0] == 2) {
        $this->session->set_flashdata('danger', 'Phone or Email Address is a duplicate!');
        redirect('registration');
      }
      else {
          $this->session->set_flashdata('danger', 'Error, data could not be saved!');
          redirect('registration');
      }

    }

    public function confirm_email($id) {

      $result = $this->Registration_Modal->confirm_email($id);

      if (!empty($result)) {

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
         $to_email =  $result->tbl_users_email;

         $this->load->library('email', $config);
         $this->email->set_newline("\r\n");
         $this->email->from($from_email,'BEDCO :: VBI');
         $this->email->to($to_email);
         $this->email->subject('Confirm Email Address');
         $this->email->message('Thank you for your confirmation!!!');

        $data = [
            'id_user' => $result->tbl_users_id,
            'username' => $result->tbl_users_firstname.' '.$result->tbl_users_lastname,
            'user_type' => $result->tbl_users_role_id,
            'user_type_name' => $result->tbl_roles_title,
            'user_unique_id' => $result->tbl_users_user_uniqueid,
            'user_profile_image' => $result->tbl_users_photo,
            'user_email' => $result->tbl_users_email,
        ];
        $result1 = $this->Login_Modal->validate_login_ip($data,$error ="Login Successfully");
        //$this->session->set_userdata($data);
        redirect('Login');
      }
      else{
        $this->session->set_flashdata('danger', 'Your email address has not yet been confirmed!!!');
        redirect('Login');
      }
    }

    public function thankyou() {
      //print_r($this->session->userdata('email'));exit();
      $this->load->view('thankyou');
    }

     public function resendemail() {
      //print_r($this->session->userdata('email'));exit();
      $this->load->view('resendemail');
    }

	public function sendmailagain(){
		$email=$this->input->post('email');
		$this->db->where('tbl_users_email',$email);
        $query=$this->db->get('tbl_users');
        $result=$query->result();
		if(empty($result)){
			
		}else{
			foreach($result as $row){
				$firstname=$row->tbl_users_firstname;
				$lastname=$row->tbl_users_lastname;
				$randomid=$row->tbl_users_user_uniqueid;
				$tbl_users_conf_id=$row->tbl_users_conf_id;
			}
			 $message = '
			  <html>
			  <body>
			  <p>Dear '.$firstname.' '.$lastname.',</p>
			  <p style="text-align:justify;">Thank you for registering on BEDCO Virtual Incubator platform.</p>
			  <p>Your unique reference ID is <strong> '.$randomid.'</strong>, please mention it in any communication with the incubation and support teams. In order to access your profile, you will need to confirm your registration by clicking on the below link:</p>
			  
			  <p><a href="'.base_url("Registration/confirm_email/".$tbl_users_conf_id).'" target="_blank">ACTIVATE ACCOUNT</a></p>
			  <p>Once activated, you will be able to access your profile. Below are the login details you supplied when registerirng your profile:</p>
			  <p>
			  Username: '.$email.'
			  <br/>			 
			  </p>
			  <p>
          <strong>Support Department</strong><br />
			Email: admin@bedco.org.ls &nbsp;&nbsp; | &nbsp;  Tel: +266 22216100 <br /> 
			Postal: P.O. Box 1216. Sebaboleng, Maseru/Maseru West 100. Lesotho 
          </p>
			  </body>
			  </html>
			';

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
			 $to_email =  $email;

			 $this->load->library('email', $config);
			 $this->email->set_mailtype("html");
			 $this->email->set_newline("\r\n");
			 $this->email->from($from_email,'BEDCO :: VBI');
			 $this->email->to($to_email);
			 $this->email->subject($randomid);
			 $this->email->message($message);
			if($this->email->send())
			{
			  $this->session->set_flashdata('email_sent', 'Please check your email and activate your account!');
			  redirect('registration/resendemail');
			}
			else{
			  echo $this->email->print_debugger();
			  echo "uyuyuy";exit;
			  $this->session->set_flashdata("email_not_sent","Error, sending email failed. Please Sign-up again!");
			  redirect('registration');
			}
		}
	}
	
    public function resend_mail() {

      /*print_r($this->session->userdata('email'));
      print_r($this->session->userdata('user_id'));exit;*/
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
         $to_email =  $this->session->userdata('email');

         $this->load->library('email', $config);
         $this->email->set_newline("\r\n");
         $this->email->from($from_email,'BEDCO :: VBI');
         $this->email->to($to_email);
         $this->email->subject('Confirm Email Address');
         $this->email->message('Please confirm your email address by clicking below link!!!');
         $this->email->set_newline("\r\n");
         $this->email->message(base_url("Registration/confirm_email/".$this->session->userdata('user_id')));
        //$this->email->message(base_url("smme/Registration/confirm_email/37"));
        if($this->email->send())
        {
          $this->session->set_flashdata('success', 'Message has been resent successfully!');
          redirect('registration/thankyou');
        }
        else{
          echo $this->email->print_debugger();
          //echo "uyuyuy";exit;
          $this->session->set_flashdata("danger","Error, sending email failed. Please Sign-up again!");
          redirect('registration');
        }
    }

/*    public function edit_profile($id) {

        $editdt = $this->Registration_Modal->select_user_data($id);
        $personal = $this->Registration_Modal->select_user_personal_data($id);

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $data['userdt'] = $editdt;
        $data['personal'] = $personal;


      $this->load->view('edit_profile',$data);
    }

    public function update($upd_id) {

            if($_POST)
            {
                $now = date("Y-m-d H:i:s");
                $randomid = mt_rand(100000,999999);
                //echo $randomid;
                $user = array(


                         'tbl_users_firstname' => $this->input->post('tbl_users_firstname'),

                         'tbl_users_lastname'=> $this->input->post('tbl_users_lastname'),

                         'tbl_users_contrycode'=> $this->input->post('country_code'),

                         'tbl_users_mobile'=> $this->input->post('tbl_users_mobile'),

                         'tbl_users_gender'=> $this->input->post('tbl_users_gender'),

                    );
                $personal = array(

                         'tbl_personal_details_occupation' => $this->input->post('tbl_personal_details_occupation'),

                         'tbl_personal_details_optional_telephone' => $this->input->post('tbl_personal_details_optional_telephone'),

                         'tbl_personal_details_howdidyouknow'=> $this->input->post('tbl_personal_details_howdidyouknow'),

                         'tbl_personal_details_education'=> $this->input->post('tbl_personal_details_education'),

                         'tbl_personal_details_district'=> $this->input->post('tbl_personal_details_district'),

                         'tbl_personal_details_town_village'=> $this->input->post('tbl_personal_details_town_village'),

                         'tbl_personal_details_postcode'=> $this->input->post('tbl_personal_details_postcode'),

                         'tbl_personal_details_dob' => $this->input->post('tbl_personal_details_dob'),

                    );

                $result = $this->Registration_Modal->update_master($user,$personal,$upd_id,$this->input->post('tbl_personal_details_id'));
                $user_id = explode('^', $result);
                if($result[0] == 1) {
                        if($_FILES['tbl_personal_details_educational_doc']['name'] != "")
                        {
                            $image_replace = str_replace(" ", "_",$_FILES['tbl_personal_details_educational_doc']['name']);
                            $image_name = "edu_doc_photo_".$randomid."_".$image_replace;
                            $images = array(
                                'tbl_personal_details_educational_doc' => $image_name,
                            );
                            $this->Registration_Modal->image_insert($images,$upd_id,'tbl_personal_details','tbl_personal_details_user_id');

                            if(!empty($_FILES['tbl_personal_details_educational_doc']['name'])){

                                $_FILES['file']['name'] = $image_name;
                                $_FILES['file']['type'] = $_FILES['tbl_personal_details_educational_doc']['type'];
                                $_FILES['file']['tmp_name'] = $_FILES['tbl_personal_details_educational_doc']['tmp_name'];
                                $_FILES['file']['error'] = $_FILES['tbl_personal_details_educational_doc']['error'];
                                $_FILES['file']['size'] = $_FILES['tbl_personal_details_educational_doc']['size'];

                                $config['upload_path'] = 'assets/users';
                                $config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
                                $config['max_size'] = '5000';
                                $config['client_name'] = $image_name;

                                $this->load->library('upload',$config);

                                if($this->upload->do_upload('file')){
                                    $uploadData = $this->upload->data();
                                    $filename = $uploadData['client_name'];
                                    $data1['totalFiles'][] = $filename;
                                }
                            }
                        }
                        $this->session->set_flashdata('success', 'Data Inserted Successfully!');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                if($result == 2) {
                    $this->session->set_flashdata('danger', 'Username or Email id is Duplicate!');
                    redirect($_SERVER['HTTP_REFERER']);
                }
                elseif($result == 0) {
                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
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
        $this->Registration_Modal->image_insert($images,$id,'tbl_users','tbl_users_id');

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
    }*/

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

                        'tbl_users_password' => md5($this->input->post('password')),

                    );
                $result = $this->Registration_Modal->insert_master($data,$this->session->userdata('id_user'),$this->input->post('oldpass'));
                if($result == 2) {
                    $this->session->set_flashdata('danger', 'Error, your current password is incorrect. Please supply the correct one and try again!');
                    redirect('user/smme/change_password');
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
                     $to_email =  $this->session->userdata('user_email');

                     $this->load->library('email', $config);
                     $this->email->set_newline("\r\n");
                     $this->email->from($from_email,'BEDCO :: VBI');
                     $this->email->to($to_email);
                     $this->email->subject('New Password');
                     $this->email->message('Your password has been changed at '.$now.'<br> Your New Password Ihas been set to : '.$this->input->post('password'));

                     if($this->email->send())
                     {
                      $this->session->set_flashdata('success', 'Password has been updated successfully. Please check your email!');
                      // redirect('user/smme/change_password');
                      redirect('/Login');
                    }
                    else
                    {

                      $this->session->set_flashdata("danger","Error, sending email failed. Please check the email address supplied!");
                      redirect('user/smme/change_password');
                    }

                }
                elseif($result == 0) {
                    $this->session->set_flashdata('danger', 'Error, data could not be saved!');
                    redirect('user/smme/change_password');
                }
            }

            $HEADER="";
            $FOOTER="";
            $user_role = $this->session->userdata('user_type');

            if ($user_role == 1) {
                $HEADER="admin/includes/header";
                $FOOTER="admin/includes/footer";
            } elseif ($user_role == 4) {
                $HEADER="bdsp/includes/header";
                $FOOTER="bdsp/includes/footer";
            } elseif ($user_role == 2) {
                $HEADER="includes/header";
                $FOOTER="includes/footer";
            } elseif ($user_role == 3) {
                $HEADER="incubator/includes/header";
                $FOOTER="incubator/includes/footer";
            }

            $data['header'] = $this->load->view($HEADER, NULL, TRUE);
            $data['footer'] = $this->load->view($FOOTER, NULL, TRUE);

            // $this->load->view ('home', $data);
            $this->load->view('change_password',$data);
        }
        else {
            $this->session->set_flashdata('danger', 'Password and Confirm Password does not match');
            redirect('user/smme/change_password');
        }

    }

}
