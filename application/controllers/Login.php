<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        /*if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('admin/user');
        }*/
        $this->load->model("Login_Modal");
        $this->load->model("admin/Adminmaster_login_model");
        $this->load->database();

    }

    public function index()
    {
        /*$type = $this->Login_Modal->Select_Type();
        $data['type'] = $type;*/
        $this->load->view('login');
    }

    public function validate_user()
    {

        if ($_POST) {

            $this->db->select("tbl_users_role_id as role");
            $this->db->where("tbl_users_email", $_POST['email']);
			
            $query = $this->db->get("tbl_users");
            $user = $query->result();

            if (!isset($user[0])) {
                $this->db->select("*");
                $this->db->where("tbl_admins_email", $_POST['email']);
                $query = $this->db->get("tbl_admins");
                $user = $query->result();
                if (!$user) {
                    $this->session->set_flashdata('danger', 'Incorrect Password or Email Address');
                    redirect('Login');
                }
                $user[0]->role = 1;

                if ($_POST) {
                    $result = $this->Adminmaster_login_model->validate_user($_POST);
                    //print_r($result['logindata']->tbl_admins_id);exit;
                    if (!empty($result['logindata'])) {
                        $data = [
                            'id_admin' => $result['logindata']->tbl_admins_id,
                            'admin_uniqueid' => $result['logindata']->tbl_admins_uniqueid,
                            'adminfname' => $result['logindata']->tbl_admins_firstname,
                            'adminlname' => $result['logindata']->tbl_admins_lastname,
                            'admin_type' => $result['logindata']->tbl_admins_roleid,
                            'admin_type_name' => $result['logindata']->tbl_roles_title,
                            'role_id' => $result['logindata']->tbl_roles_id,
                            'admin_email' => $result['logindata']->tbl_admins_email,
                            'admin_profile_image' => $result['logindata']->tbl_admins_image
                           
                        ];

                        $result1 = $this->Adminmaster_login_model->validate_login_ip($data, $result['error']);

                        $this->session->set_userdata($data);
                        //print_r($this->session->set_userdata($data));exit();
                        if ($result['error'] == 'login') {
                            redirect('admin/home');
                        } else if ($result['error'] == 'pass') {
                            $this->session->set_flashdata('flash_data', 'Wrong Password!');
                            redirect('Login');
                        }
                    } else if ($result['error'] == 'email') {
                        $this->session->set_flashdata('flash_data', 'Wrong Email ID supplied!');
                        redirect('Login');
                    } else {
                        $this->session->set_flashdata('flash_data', 'Wrong Email ID or Password!');
                        redirect('Login');
                    }
                }
            } else {
                $result = $this->Login_Modal->validate_user($_POST);

                if (!empty($result['logindata'])) {
                    $data = [
                        'id_user' => $result['logindata']->tbl_users_id,
                        'username' => $result['logindata']->tbl_users_firstname . ' ' . $result['logindata']->tbl_users_lastname,
                        'user_type' => $result['logindata']->tbl_users_role_id,
                        'user_type_name' => $result['logindata']->tbl_roles_title,
                        'user_unique_id' => $result['logindata']->tbl_users_user_uniqueid,
                        'user_email' => $result['logindata']->tbl_users_email,
                        'role_id' => $result['logindata']->tbl_roles_id,
                        'user_profile_image' => $result['logindata']->tbl_users_photo,
						'email_validation' => $result['logindata']->email_validation,
						
                    ];
                    $result1 = $this->Login_Modal->validate_login_ip($data, $result['error']);
                    $this->session->set_userdata($data);
					
					if ($result['logindata']->email_validation == 0) {
						//$link = site_url('/registration/thankyou');
						$link = anchor('/registration/resendemail', 'Resend Email');
                        $this->session->set_flashdata('danger', 'You have not yet activated your profile. If you did not get the activation email, please click '.$link);
					    redirect("Login");
                    }
                    
                    if ($result['logindata']->login_approve == 2) {
                        $this->session->set_flashdata('danger', 'Your profile has not yet been approved by the system administrator!');
                        redirect("Login");
                    }
					
					 if ($result['logindata']->login_approve == 0) {
                        $this->session->set_flashdata('danger', 'Your profile is DISABLED by the system administrator!');
                        redirect("Login");
                    }


                    if ($result['error'] == 'Login Successfully') {
                        $this->session->set_flashdata('success', 'Login Successful!!!');
                        
                        
                        if ($user[0]->role == 1) {
                            redirect('admin/home');
                        } elseif ($user[0]->role == 4) {
                            redirect('bdsp/Home');
                        } elseif ($user[0]->role == 2) {
                            redirect('Home');
                        } elseif ($user[0]->role == 3) {
                            redirect('incubator/Home');
                        }
                    } else if ($result['error'] == 'Password Wrong') {
                        $this->session->set_flashdata('danger', 'Incorrect Password or Email Address');
                        redirect('Login');
                    } 

                } else {
                    $this->session->set_flashdata('danger', 'Your profile has not yet been approved by the system administrator!');
                    redirect('Login');
                }
            } 
        }
    }

}
