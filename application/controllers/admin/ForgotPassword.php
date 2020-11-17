<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {

	public function index()
	{
		$this->load->helper('form'); 
		$this->load->view('admin/forgot');
	}

	function random_password() 
	{
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_';
	    $password = array(); 
	    $alpha_length = strlen($alphabet) - 1; 
	    for ($i = 0; $i < 11; $i++) 
	    {
	        $n = rand(0, $alpha_length);
	        $password[] = $alphabet[$n];
	    }
	    return implode($password); 
	}

	public function send()
	{

		$genrate_password = $this->random_password();
		$this->load->database();


		$this->db->where('admin_email',$this->input->post('email'));
        $query=$this->db->get('admin_login');
        $result=$query->result();
        $num_rows=$query->num_rows();
        /*echo $num_rows;
        print_r($_POST);exit();*/
        if ($num_rows == 1) 
        {
        	foreach ($result as $key => $value) {	
        	}//print_r($value);exit();

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
	   		//print_r($to_email);exit;
	         //Load email library 
	         /*$this->load->library('email'); */
	    	 $this->load->library('email', $config);
	    	 $this->email->set_newline("\r\n");
	         $this->email->from($from_email,$value->admin_name); 
	         $this->email->to($to_email);
	         $this->email->subject('New Password'); 
	         $this->email->message('Your New Genrated Password is:'.$genrate_password); 

	         //print_r($this->email->send());exit;
	         //echo $this->email->print_debugger();exit;
	         if($this->email->send()) 
	         {
	         	//echo "vgvfdsgvf";exit;
	         	$data=array('admin_password'=> $genrate_password);
				$this->db->where('admin_email',$this->input->post('email'));
				$this->db->update('admin_login',$data);
	         	$this->session->set_flashdata("email_sent","Email sent successfully."); 
	         	redirect('admin/forgotpassword'); 
	         }
	         else 
	         {

	         	//echo $this->email->print_debugger();
	         	//echo "uyuyuy";exit;
	         	$this->session->set_flashdata("email_not_sent","Error in sending Email."); 
	         	redirect('admin/forgotpassword'); 
	      	}
        }
        else{
        	$this->session->set_flashdata("email_not_sent","Email Address does not match with our records!"); 
         	redirect('admin/forgotpassword'); 
        }
	}
}
