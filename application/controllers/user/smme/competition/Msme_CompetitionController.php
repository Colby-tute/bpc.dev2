<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Msme_CompetitionController
 *
 * @author Colby TUTE
 */
class Msme_CompetitionController extends CI_Controller {
    //put your code here
     private $id;
     
    function __construct() {   
        parent::__construct();

        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("smme/competition/Msme_CompetitionModel");
        $this->id = $this->session->userdata('id_user');
        $this->load->database();
    }
    public function  index(){
        
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $data['incData'] = $this->Msme_CompetitionModel->getIncCompetition($this->id);
        $data['hist']= $this->load->view('admin/includes/loginHistory', NULL, TRUE);
        $this->load->view('user/smme/competition/msme_competitionEntries',$data);
    }
    //Create Competition
    public function createCompetition(){
        $data['header']= $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer']= $this->load->view('admin/includes/footer', NULL, TRUE);
        $data['hist']= $this->load->view('admin/includes/loginHistory', NULL, TRUE);
        $this->load->view('user/smme/competition/msme_createComp',$data);
    }
     //Add Competition
    public function addCompetition(){
        $randNum = mt_rand(100000, 999999);
   
        $currdate = date('y-m-d');
        $userId = $this->id;
        $inc= $this->input->post('incRef');
        $val_inc = $this->Msme_CompetitionModel->getIncById($inc);
        
        if($val_inc == "exist"){
            $newData = array(
                'tbl_users_id' => $inc,
                'tbl_competitions_unique_id' => $randNum,
                'tbl_competitions_name' => $this->input->post('compName'),
                'tbl_competitions_description' => $this->input->post('description'),
                'tbl_competitions_starting_date'=> $this->input->post('ssd'),
                'tbl_competitions_end_date'=> $this->input->post('sed'),
                'tbl_competitions_entry_num'=> $this->input->post('nEnty'),
                'pre_screeningenddate'=> $this->input->post('psed'),
                'finalselectionenddate'=> $this->input->post('fsed'),
            );

            $result = $this->Msme_CompetitionModel->loadData($userId,$newData);
            switch ($result){
                case"A":
                    $this->session->set_flashdata('danger','You have reach your limit number of competition please upgrate your package!');
                    redirect('msme/competition');
                    break;

                case "B":
                    $this->session->set_flashdata('danger','You have reach your limit number of competition please upgrate your package!');
                    redirect('msme/competition');
                    break;
                case "C":
                    $this->session->set_flashdata('danger','You have reach your limit number of competition please upgrate your package!');
                    redirect('msme/competition');
                default :
                    $this->session->set_flashdata('success','You have successfully create a competition!');
                    redirect('msme/competition');
                    break;

            }
        }else{
            $this->session->set_flashdata('danger','Your incubator do not Exit!');
            redirect('msme/comp/create');
        }
        
        
    }

}
