<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');

class Feedback extends MY_Controller
{
 
    function __construct() {
        parent::__construct();
 
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("smme/Feedback_Modal");
        $this->load->database();
    }
    
    public function index()
    {
        $result = $this->Feedback_Modal->select_all_feedbacks($this->session->userdata('user_unique_id'));
        $data['feedback'] = $result;

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $this->load->view('user/smme/feedback/index',$data);
    }

    public function get_all_feedback() {
        $result = $this->Feedback_Modal->select_all_feedbacks($this->session->userdata('user_unique_id'));
        $data['feedback'] = $result;
        echo json_encode($data);
    }

    public function delete_feedback() {
        $feedb_id = $_POST['feedb_id'];
        $this->db->where("tbl_feedback_id", $feedb_id);
        $this->db->update("tbl_feedback", [
                "is_feedback_active" => "N"
            ]);
    }

    public function get_feedback() {

        $id = $this->input->post('id');

     $result = $this->Feedback_Modal->get_feedback($id);

     echo json_encode($result);

    }
}