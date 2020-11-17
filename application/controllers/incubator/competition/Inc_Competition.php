<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inc_Competition
 *
 * @author Colby TUTE
 */
class Inc_Competition extends CI_Controller{
    //put your code here
    private  $user_id = null; 
            function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('Login');
        }
        $this->user_id = $this->session->userdata('id_user');
	$this->load->database();
	$this->load->model("incubator/competition/Inc_CompetitionModel");
	
    }
    
    public function  index(){
        $data['comp'] = $this->Inc_CompetitionModel->getCompetitionByInc($this->session->userdata('id_user'));
        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);
        $data['hist']= $this->load->view('admin/includes/loginHistory', NULL, TRUE);
        $this->load->view('incubator/competition/incubatorSettings', $data);
    
    }
    //Create Competition
    public function createCompetition(){
        $data['header']= $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer']= $this->load->view('incubator/includes/footer', NULL, TRUE);
        $data['hist']= $this->load->view('admin/includes/loginHistory', NULL, TRUE);
        $this->load->view('incubator/competition/inc_createComp',$data);
    }

    //Add Competition
    public function addCompetition(){
        $randNum = mt_rand(100000, 999999);
   
        $userId = $this->user_id;
        echo  $userId;
        $newData = array(
            'tbl_users_id' => $userId,
            'tbl_competitions_unique_id' => $randNum,
            'tbl_competitions_name' => $this->input->post('compName'),
            'tbl_competitions_description' => $this->input->post('description'),
            'tbl_competitions_starting_date'=> $this->input->post('ssd'),
            'tbl_competitions_end_date'=> $this->input->post('sed'),
            'tbl_competitions_entry_num'=> $this->input->post('nEnty'),
            'pre_screeningenddate'=> $this->input->post('psed'),
            'finalselectionenddate'=> $this->input->post('fsed'),
        );
        
        $result = $this->Inc_CompetitionModel->loadData($userId,$newData);
        switch ($result){
            case"A":
                $this->session->set_flashdata('danger','You have reach your limit number of competition please upgrate your package!');
                redirect('inc/competition');
                break;
            
            case "B":
                $this->session->set_flashdata('danger','You have reach your limit number of competition please upgrate your package!');
                redirect('inc/competition');
                break;
            case "C":
                $this->session->set_flashdata('danger','You have reach your limit number of competition please upgrate your package!');
                redirect('inc/competition');
            default :
                $this->session->set_flashdata('success','You have successfully create a competition!');
                redirect('inc/competition');
                break;
            
        }
    }
     public function deleteCompetition(){
        $id = $this->uri->segment(4);
        $res = $this->Inc_CompetitionModel->deleteCompetitionById($id);
        if ($res == 'success'){
            $this->session->set_flashdata('success','Competition is successfully deleted');
            
            redirect('inc/competition','refresh');
            return "Record removed successfully";
        }else{
            $this->session->set_flashdata('danger','Something Wrong Happenned!!');
            redirect('inc/competition','refresh');
        }
    }
    public function editCompetition(){
        $id = $this->uri->segment(4);
        $res = $this->Inc_CompetitionModel->getCompetitionById($id);
        $data['comp'] = $res;
        $data['header']= $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer']= $this->load->view('admin/includes/footer', NULL, TRUE);
        $data['hist']= $this->load->view('admin/includes/loginHistory', NULL, TRUE);
        $this->load->view('incubator/competition/inc_editComp',$data);
    }
     public function updateCompetition(){
        $id = $this->input->post('id');
        $newData = array(
        
            'tbl_competitions_name' => $this->input->post('compName'),
            'tbl_competitions_description' => $this->input->post('description'),
            'tbl_competitions_starting_date'=> $this->input->post('ssd'),
            'tbl_competitions_end_date'=> $this->input->post('sed'),
            'tbl_competitions_entry_num'=> $this->input->post('nEnty'),
            'pre_screeningenddate'=> $this->input->post('psed'),
            'finalselectionenddate'=> $this->input->post('fsed'),
            'tbl_competitions_criteria'=> $this->input->post('selectCr'),
            'tbl_competitions_prize'=> $this->input->post('prize'),
        );
        
        $result = $this->Inc_CompetitionModel->updateCompById($id,$newData);
        
        switch ($result){
            case $result == "success":
                $this->session->set_flashdata('success','Competition is successfully updated');
                redirect('inc/competition','refrech');
                break;
            default :
                $this->session->set_flashdata('danger','Something wrong happened!!');
                redirect('inc/competition');
                break;
        }
        
    }
}
