<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Add admin_form_open
if ( ! function_exists('email_send')) {
	function email_send($to_email,$title,$subject,$content) {

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
        $CI = &get_instance();

        $CI->load->library('email', $config);

        $CI->email->set_mailtype("html");
        $CI->email->set_newline("\r\n");
        $CI->email->from($from_email,'BEDCO :: VBI');
        $CI->email->to($to_email);
        $CI->email->subject($subject);
        $CI->email->message($content);
        return $CI->email->send();
	}
}