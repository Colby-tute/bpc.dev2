<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class Approve extends MY_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('email_service');
	}

	public function approve($id, $role)
	{
		$this->db->where("tbl_users_id", $id);
		$this->db->update("tbl_users", [
			"login_approve" => "1"
		]);

		$user = $this->db->where('tbl_users_id',$id)->get('tbl_users')->row();
        $owner = $this->db->where('tbl_admins_id',$this->session->userdata('id_admin'))->get('tbl_admins')->row();
        $process_key = "user_approved";
        $emailData = $this->db->where('process_key',$process_key)->get('tbl_emails')->row();
        $keys = [
                '[name_to]' => $user->tbl_users_firstname .' ' . $user->tbl_users_lastname,
                '[name_from]' => $owner->tbl_admins_firstname .' ' . $owner->tbl_admins_lastname,
            ];
        $content = do_shortcodes($emailData->message,$keys);
        email_send($user->tbl_users_email,$emailData->subject,$emailData->subject,$content);
        email_logs($user->tbl_users_id,$emailData->subject);

		if ($role == 4) {
			redirect('admin/bdsps', 'refresh');
		} else {
			redirect('admin/incubators', 'refresh');
		}

	}

}
