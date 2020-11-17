<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        /*$this->load->model("smme/ForgorPassword_Modal");
        $this->load->database();*/

    }

    public function index() {
        
        $this->load->view('forgot_password');
    }

    public function random_password() 
    {
      $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_';
      $password = array(); 
      $alpha_length = strlen($alphabet) - 1; 
      for ($i = 0; $i < 8; $i++) 
      {
          $n = rand(0, $alpha_length);
          $password[] = $alphabet[$n];
      }
      return implode($password); 
    }

    public function send() {

      print_r($_POST);

      $genrate_password = $this->random_password();
      $this->load->database();


      $this->db->where('tbl_users_email',$this->input->post('email'));
        $query=$this->db->get('tbl_users');
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
            $from_email = "prachikkothari@gmail.com"; 
            $to_email =  $this->input->post('email'); 
          
           $this->load->library('email', $config);
           $this->email->set_newline("\r\n");
           $this->email->from($from_email,'Bedco-Virtual Business Incubator'); 
           $this->email->to($to_email);
           $this->email->subject('New Password'); 
           $this->email->message('Your New Genrated Password is:'.$genrate_password); 

           if($this->email->send()) 
           {
            $data=array('tbl_users_password'=> md5($genrate_password));
            $this->db->where('tbl_users_email',$this->input->post('email'));
            $this->db->update('tbl_users',$data);
            $this->session->set_flashdata("success","Email sent successfully."); 
            redirect('login'); 
           }
           else 
           {

            echo $this->email->print_debugger();
            //echo "uyuyuy";exit;
            $this->session->set_flashdata("email_not_sent","Error in sending Email."); 
            redirect('forgotpassword'); 
          }
        }
        else{
          $this->session->set_flashdata("email_not_sent","Email Address does not match with our records!"); 
          redirect('forgotpassword'); 
        }
    }


}
