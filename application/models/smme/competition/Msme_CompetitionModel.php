<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Msme_CompetitionModel
 *
 * @author Colby TUTE
 */
class Msme_CompetitionModel extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();

    }
    
    public function getIncCompetition($id){
        $this->db->select('*');  
       // $this->db->where('tbl_application_smme_id', $id);
        $this->db->from('tbl_application');
        $this->db->join('tbl_competitions', 'tbl_application_incubator_id = tbl_competitions.tbl_users_id','left');
        
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }
    
    public function getIncById($id){
        $this->db->where('tbl_users_id',$id);
        $this->db->where('tbl_users_role_id',"3");
        $q = $this->db->get('tbl_users');
        $result = $q->row_array();
        $count = $result['COUNT(*)'];
         
        if ($count > 0){
           return "exist"; 
        } else {
            return "na";
        }
        
    }

    public function loadData($id,$newData){
        
        $userPackType = $this->getUserPackById($id);
        if(strcasecmp($userPackType->tbl_packages_type,"free")){
            $compNum = $this->countCompNumberByUser($id);
            
            if($compNum <= 1){
                return "A";
            }else{
                return $this->insertComp($newData);
            }
        }
        elseif($userPackType->tbl_packages_type == "starter"){
            $compNum = $this->countCompNumberByUser($id);
            
            if($compNum <= 5){
                return "B";
            }else{
                return $this->insertComp($newData);
            }
        }elseif (strcasecmp($userPackType->tbl_packages_type,"middle")) {
            $compNum = $this->countCompNumberByUser($id);
            
            if($compNum <= 10){
                return "C";
            }else{
                return $this->insertComp($newData);
            }
        }else{
            return $this->insertComp($newData);
        }
      
    }
    public function getUserPackById($id){
        $this->db->select('tbl_packages.tbl_packages_type');  
        $this->db->where('tbl_users_id',$id);
        $this->db->from('tbl_users');
        $this->db->join('users_incubator', 'tbl_users_id = users_incubator.users_id','left');
        $this->db->join('tbl_packages', 'users_incubator.tbl_packages_id = tbl_packages.tbl_packages_id','left');
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }
    public function countCompNumberByUser($id){
        $this->db->where('tbl_users_id',$id);
        $q = $this->db->get('tbl_competitions');
        $result = $q->row_array();
        $count = $result['COUNT(*)'];
             
        return $count;
    }
    public function insertComp($newData){
        $query = $this->db->insert("tbl_competitions",$newData );
        if ($query){
            return "success";
        }else{
            return "fail";
        }
    }
}
