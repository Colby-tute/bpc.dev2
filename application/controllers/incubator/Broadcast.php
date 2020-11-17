<?php defined('BASEPATH') or exit('No direct script access allowed');


date_default_timezone_set('Africa/Johannesburg');

class Broadcast extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('Login');
        }

		$this->load->model("incubator/Application_Modal");

		$this->load->database();

		$this->load->helper('email_service');

	}


	public function index()
	{
		$data['messages'] = $this->Application_Modal->getMessage($this->session->userdata('id_user'));
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('incubator/broadcast/index', $data);
	}

	public function getMessage(){
		$data['result'] = $this->Application_Modal->getMessage($this->input->post('tbl_broadcaster_id'));
		echo $this->load->view("incubator/broadcast/message_view",$data,true);
	}

	public function sendMessage(){
		$result = $this->Application_Modal->insertBroadcastMessage($this->input->post());
		if($result == 1){
			echo true;
		}else{
			echo false;
		}
	}

	public function updateMessage(){
		$id = $this->input->post('tbl_broadcast_id');
		$message = $this->input->post('tbl_broadcast_message');
		$result = $this->Application_Modal->updateBroadcastMessage($id,$message);
		if($result == 1){
			echo true;
		}else{
			echo false;
		}
	}

	public function deleteMessage(){
		$result = $this->Application_Modal->deleteBroadcastMessage($this->input->post());
		if($result == 1){
			echo true;
		}else{
			echo false;
		}
	}

	public function messageList(){
		
		$data['messages'] = $this->Application_Modal->getMessageList();
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view("incubator/broadcast/message_list",$data);
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
			return redirect('incubator/Broadcast/messageList');
		}else{
			$data['message'] = $message;
			$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
	        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);
			$this->load->view("incubator/broadcast/view",$data);
		}

	}
	

}