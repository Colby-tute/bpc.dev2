<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');

class PersonalTodo extends MY_Controller
{
 
    function __construct() {
        parent::__construct();
 
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("smme/PersonalTodo_Modal");
        $this->load->database();
    }
    

    public function add() {

        if ($_POST) {
            //print_r($_POST);exit;

            $now = date("Y-m-d H:i:s");

            $data = array(
                'tbl_personal_todos_user_id' => $this->session->userdata('user_unique_id'),

                'tbl_personal_todos_subject' => $this->input->post('subject'),

                'tbl_personal_todos_due_date' => $this->input->post('due_date'),

                'tbl_personal_todos_insertdate' => $now,

            );

            $result = $this->PersonalTodo_Modal->add_todos($data);

            if ($result == 1) {
                $this->session->set_flashdata("success","PersonalTodo added successfully!!!"); 
                redirect('Home');
            }else {
                $this->session->set_flashdata("danger","PersonalTodo is not added successfully!!!"); 
                redirect('Home');
            }
        }

    }

    public function get_todo() {

        $id = $this->input->post('id');
        $result = $this->PersonalTodo_Modal->get_todo($id);

        echo json_encode($result);
    }

    public function update() {

        if ($_POST) {
            //print_r($_POST);exit;

            $id = $this->input->post('personal_todo_id');

            $data = array(

                'tbl_personal_todos_subject' => $this->input->post('subject'),

                'tbl_personal_todos_due_date' => $this->input->post('due_date'),

            );

            $result = $this->PersonalTodo_Modal->update_todos($data,$id);

            if ($result == 1) {
                $this->session->set_flashdata("success","PersonalTodo updated successfully!!!"); 
                redirect('Home');
            }else {
                $this->session->set_flashdata("danger","PersonalTodo is not updated successfully!!!"); 
                redirect('Home');
            }
        }
    }

    public function delete($id) {

        $result = $this->PersonalTodo_Modal->delete_todos($id);

        if ($result == 1) {
            $this->session->set_flashdata("success","PersonalTodo delete successfully!!!"); 
            redirect('Home');
        }else {
            $this->session->set_flashdata("danger","PersonalTodo is not delete successfully!!!"); 
            redirect('Home');
        }
    }
}