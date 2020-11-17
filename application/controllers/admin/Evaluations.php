	<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Evaluations extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
        if(empty($this->session->userdata('id_admin'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('admin/masterlogin');
        }
		$this->load->model("admin/Evaluations_Model");
		$this->load->database();
	}

	public function index()
	{
		$evaluations = $this->Evaluations_Model->get_evaluations();
		$data['evaluations'] = $evaluations;
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
		$this->load->view('admin/evaluations/viewEvaluations', $data);
	}

	public function deleteEvaluation($evaluation_id)
	{
		$this->Evaluations_Model->delete_evaluation($evaluation_id);
		redirect('/admin/Evaluations/index', 'location');
	}

	public function viewEvaluation()
	{
		$evaluation_id =  $this->uri->segment(4);
		$evaluatee_id =  $this->uri->segment(5);
		$evaluation_details = $this->Evaluations_Model->get_evaluation($evaluation_id);
		$data['evaluation_details'] = $evaluation_details[0];

		$evaluation = $this->Evaluations_Model->get_evaluation_answers($evaluation_id);
		$data['evaluator_id'] = $this->session->userdata("id_user");
		$data['evaluatee_id'] = $evaluatee_id;
		$data['evaluation'] = $evaluation;
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		$this->load->view('admin/evaluations/viewEvaluation', $data);
	}
}
