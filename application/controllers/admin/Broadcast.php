<?php defined('BASEPATH') or exit('No direct script access allowed');


date_default_timezone_set('Africa/Johannesburg');

class Broadcast extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata('id_admin'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('admin/masterlogin');
        }		
		$this->load->database();
		$this->load->model("admin/Broadcast_model");

	}


	public function index()
	{
		$data['messages'] = $this->Broadcast_model->getMessage($this->session->userdata('id_admin'));
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		$this->load->view('admin/broadcast/index', $data);
	}

	public function getMessage(){
		$data['result'] = $this->Broadcast_model->getMessage($this->input->post('tbl_broadcaster_id'));
		echo $this->load->view("admin/broadcast/message_view",$data,true);
	}

	public function sendMessage(){
		$result = $this->Broadcast_model->insertBroadcastMessage($this->input->post());
		if($result == 1){
			echo true;
		}else{
			echo false;
		}
	}

	public function updateMessage(){
		$id = $this->input->post('tbl_broadcast_id');
		$message = $this->input->post('tbl_broadcast_message');
		$result = $this->Broadcast_model->updateBroadcastMessage($id,$message);
		if($result == 1){
			echo true;
		}else{
			echo false;
		}
	}

	public function deleteMessage(){
		$result = $this->Broadcast_model->deleteBroadcastMessage($this->input->post());
		if($result == 1){
			echo true;
		}else{
			echo false;
		}
	}

}