<?php defined('BASEPATH') or exit('No direct script access allowed');


date_default_timezone_set('Africa/Johannesburg');

class BroadcastMessage extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('Login');
        }

		$this->load->model("smme/Application_Modal");

		$this->load->database();
	}

	public function getMessage(){
		// $this->db->select("incubator_id");
  //       $this->db->where("smme_id", $this->session->userdata("id_user"));
  //       $incubation_ids = $this->db->get("tbl_application_assignment")->result_array();

		$sql = "SELECT aa.incubator_id,u.tbl_users_id, u.tbl_users_firstname, u.tbl_users_lastname,u.tbl_users_contrycode, u.tbl_users_mobile, u.tbl_users_user_uniqueid, u.tbl_users_email FROM tbl_application_assignment aa, tbl_users u WHERE aa.incubator_id = u.tbl_users_id and aa.incubator_id is not null and aa.smme_id=".$this->session->userdata("id_user"); 
		$incubator = $this->db->query($sql)->result();
		if(count($incubator) > 0){
	        $ids = array_column($incubator,'incubator_id');
	        $ids = array_merge($ids,get_admin_users());
	      }else{
	        $ids = get_admin_users();
	      }
		$data['messages'] = $this->Application_Modal->getMessage($ids);
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$this->load->view("user/smme/broadcast/message_view",$data);
	}

	public function viewMessage($id){
		$user_id = $this->session->userdata("id_user");
		$check = $this->db->where(["tbl_broadcast_message_id"=>$id,"tbl_broadcast_user_id"=>$user_id])->get("tbl_broadcast_read_count")->num_rows();
		if($check == 0){
			$this->db->insert("tbl_broadcast_read_count",["tbl_broadcast_message_id"=>$id,"tbl_broadcast_user_id"=>$user_id]);
		}
		$message = $this->Application_Modal->getBroadcastMessage($id);

		if(date("Y-m-d H:i",strtotime($message->tbl_broadcast_expiry)) < date('Y-m-d H:i') && $message->tbl_broadcast_expiry != ''){
			$this->session->set_flashdata("danger","Message has been expired.");
			return redirect('bdsp/BroadcastMessage/getMessage');
		}else{
			$data['message'] = $message;
			$data['header'] = $this->load->view('includes/header', NULL, TRUE);
	        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
			$this->load->view("user/smme/broadcast/view",$data);
		}

	}

}