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

		$this->load->model("bdsp/Application_Modal");

		$this->load->database();
	}

	public function getMessage(){
		// $this->db->select("incubator_id");
  //       $this->db->where("bdsp_id", $this->session->userdata("id_user"));
  //       $incubation_ids = $this->db->get("tbl_application_assignment")->result_array();
        
        $this->db->distinct("tbl_application_incubator_id as id");
		$this->db->select("tbl_application_incubator_id as id, incubator_id");
		$this->db->join("tbl_application_assignment as aa", "tbl_application.tbl_application_id=aa.app_id", "LEFT");
		$this->db->where("tbl_application_bdsp_id='{$this->session->userdata('id_user')}'");
		$this->db->where("aa.incubator_id IS NOT NULL");
		$query = $this->db->get("tbl_application");
		$incubators = $query->result();

		foreach ($incubators as $pair) {
			$this->db->select("*");
			$this->db->where("tbl_users_id = '{$pair->id}' OR tbl_users_id='{$pair->incubator_id}'");
			$query = $this->db->get("tbl_users");
			$users = $query->result();
			$data['incubators'][] = $users[0];
		}
		if(count($incubators) > 0){
            $ids = array_column($data['incubators'],'tbl_users_id');
            $ids = array_merge($ids,get_admin_users());
          }else{
            $ids = get_admin_users();
          }
		$data['messages'] = $this->Application_Modal->getMessage($ids);
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

		$this->load->view("bdsp/broadcast/message_view",$data);
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
			$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
	        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);
			$this->load->view("bdsp/broadcast/view",$data);
		}


	}

}