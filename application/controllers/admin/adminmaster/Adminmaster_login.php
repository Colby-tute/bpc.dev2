<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Adminmaster_login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Adminmaster_login_model");
        $this->load->database();
    }

    function index()
    {
        //echo "hbdff";exit;

        $this->load->view('admin/admin_master/login');
    }
    function login($m = NULL)
    {

        //print_r($_POST);exit;
    	if($_POST) {
            $result = $this->Adminmaster_login_model->validate_user($_POST);
            //print_r($result['logindata']->tbl_admins_id);exit;
            if(!empty($result['logindata'])) {
                $data = [
                    'id_admin' => $result['logindata']->tbl_admins_id,
                    'admin_uniqueid' => $result['logindata']->tbl_admins_uniqueid,
                    'adminfname' => $result['logindata']->tbl_admins_firstname,
                    'adminlname' => $result['logindata']->tbl_admins_lastname,
                    'admin_type' => $result['logindata']->tbl_admins_roleid,
                    'admin_type_name' => $result['logindata']->tbl_roles_title,
                    'admin_email' => $result['logindata']->tbl_admins_email,
                    'admin_profile_image' => $result['logindata']->tbl_admins_image
                    /*
                    'user_id' => 0,
                    'parent_company_id'=> 0,
                    'user_image' => '',*/
                ];
              
                $result1 = $this->Adminmaster_login_model->validate_login_ip($data,$result['error']);
                
                $this->session->set_userdata($data);
                //print_r($this->session->set_userdata($data));exit();
                if($result['error'] =='login')
                {
                   redirect('admin/home');
                }
                else if($result['error'] =='pass')
                {
                    $this->session->set_flashdata('flash_data', 'Password is wrong!');
                    redirect('admin/masterlogin');
                }
            } 
            else if($result['error'] =='email')
            {
                $this->session->set_flashdata('flash_data', 'Email Id is wrong!');
                redirect('admin/masterlogin');
            }
            else 
            {
                $this->session->set_flashdata('flash_data', 'Email Id or Password is wrong!');
                redirect('admin/masterlogin');
            }
        }
 
       // $this->load->view("suadmin/login");
       // echo "redirected";exit;
    }

}
