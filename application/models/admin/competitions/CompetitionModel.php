<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompetitionModel
 *
 * @author Colby TUTE
 */
class CompetitionModel extends CI_Model {
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getCompetition(){
        $this->db->select('*');  
        $this->db->from('tbl_competitions');
        //$this->db->join('tbl_competitions', 'tbl_users.tbl_users_id = tbl_competitions.tbl_users_id','left');
       
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    public function createCompetition($incId, $data){
        $this->db->select('*');  
        $this->db->where('tbl_users_id',$incId);
        $this->db->from('tbl_users');
        $this->db->join('users_incubator', 'tbl_users_id = users_incubator.users_id','left');
        $this->db->join('tbl_packages', 'users_incubator.tbl_packages_id = tbl_packages.tbl_packages_id','left');
        $query = $this->db->get();
        $res = $query->result();
        
       if($res->tbl_packages_type == "free"){
           $result = countRows($incId);
           
           if($result > 1){
               return "error";
           }else{
               
           }
       }
    }
    public function countRows($inId) {
        $this->db->where('tbl_users_id',$incId );
        $q= $this->db->get('tbl_competitions');
        $result = $q->num_rows();
        
        return $result;
    }
    public function loadData($id,$newData){
        
        $userPackType = $this->getUserPackById($id);
        if(strcasecmp($userPackType,"free")){
            $compNum = $this->countCompNumberByUser($id);
            
            if($compNum > 1){
                return "A";
            }else{
                return $this->insertComp($newData);
            }
        }
        elseif(strcasecmp($userPackType,"starter")){
            $compNum = $this->countCompNumberByUser($id);
            
            if($compNum > 2){
                return "B";
            }else{
                return $this->insertComp($newData);
            }
        }elseif (strcasecmp($userPackType,"middle")) {
            $compNum = $this->countCompNumberByUser($id);
            
            if($compNum > 10){
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
        $result = $q->result();
        
        return count($result);
    }
    public function insertComp($newData){
        $query = $this->db->insert("tbl_competitions",$newData );
        if ($query){
            return "success";
        }else{
            return "fail";
        }
    }
    public function deleteCompetitionById($id){
        
         $this->db->where('tbl_competitions_id ',$id);
        $query = $this->db->delete('tbl_competitions');
         
        if($query){
            return "success";
        }else{
            return "fail";
        }
        
    }
    public function getCompetitionById($id){
        $this->db->where('tbl_competitions_id', $id);
        $res = $this->db->get('tbl_competitions');
        $result = $res->result();
        return $result;
    }
    public function updateCompById($id,$newData){
        $this->db->where('tbl_competitions_id',$id);
        $query = $this->db->update('tbl_competitions', $newData);
       
         if($query){
            return "success";
        }else{
            return "fail";
        }
    }
   
}
