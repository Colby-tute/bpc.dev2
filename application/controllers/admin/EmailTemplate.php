	<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class EmailTemplate extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
        if(empty($this->session->userdata('id_admin'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('admin/masterlogin');
        }
		$this->load->database();
		$this->load->helper('directory');
		$this->load->model('admin/EmailTemplate_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['templates'] = $this->EmailTemplate_model->getTemplates();
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
		$this->load->view('admin/email_template/index', $data);
	}

	public function edit($id)
	{
		$data['template'] = $this->EmailTemplate_model->getTemplate($id);
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
		$this->load->view('admin/email_template/edit', $data);
	}

	public function updateTemplate($id){
		//$this->form_validation->set_rules('emailKey','Key', 'required');
		$this->form_validation->set_rules('emailSubject','Subject', 'required');
		$this->form_validation->set_rules('emailMessage','Message','required');

		if($this->form_validation->run() == false){
			$data['template'] = $this->EmailTemplate_model->getTemplate($id);
			$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
			$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
			$this->load->view('admin/email_template/edit', $data);
		}else{
			$data = [
					//'process_key' =>$this->input->post('emailKey'),
					'subject' =>$this->input->post('emailSubject'),
					'message' => $this->input->post('emailMessage')
				];
			if($this->EmailTemplate_model->updateTemplate($id,$data)){
				$this->session->set_flashData('success','Template Updated Successfully.');
				return redirect('admin/EmailTemplate/index');
			}else{
				$this->session->set_flashData('danger','Template Update Failed.');
				return redirect('admin/EmailTemplate/index');
			}
		}
	}
}
