<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PackageModel
 *
 * @author Colby TUTE
 */
class PackageModel extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getPackages(){
        
        $query =$this->db->get('tbl_packages');
        
        $pack = $query->result();
        return  $pack;
    }
    public function getTotalAssign(){
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('users_incubator', 'tbl_users.tbl_users_id = users_incubator.users_id');
        $this->db->join('tbl_packages', 'tbl_packages.tbl_packages_id = users_incubator.tbl_packages_id');
        $query = $this->db->get();

        $pack = $query->result();
        return  $pack;
    } 
    public function getTotalComp(){
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('users_incubator', 'tbl_users.tbl_users_id = users_incubator.users_id');
        $this->db->join('tbl_competitions', 'tbl_users.tbl_users_id = tbl_competitions.tbl_users_id');
        $this->db->join('tbl_packages', 'tbl_packages.tbl_packages_id = users_incubator.tbl_packages_id');
        $query = $this->db->get();

        $pack = $query->result();
        return  $pack;
    } 
    public function getTotalCompetitor(){
        $this->db->select('*');
        $this->db->where("tbl_users_role_id","3");
        $this->db->from('tbl_users');
        $this->db->join('users_incubator', 'tbl_users.tbl_users_id = users_incubator.users_id');
        $this->db->join('tbl_application', 'tbl_users.tbl_users_id = tbl_application.tbl_application_incubator_id');
        $this->db->join('tbl_packages', 'tbl_packages.tbl_packages_id = users_incubator.tbl_packages_id');
        $query = $this->db->get();

        $pack = $query->result();
        return  $pack;
    } 

    public function getTotalAssignPack() {

        $this->db->select('*');    
        $this->db->from('tbl_packages');
        $this->db->join('tbl_users', 'tbl_packages.tbl_packages_id = tbl_users.tbl_users_current_package');
        $query = $this->db->get();
        $num_rows=$query->num_rows();

     
     
     }
    //adding new package
    public  function insertPackage($newPackage){
        $query = $this->db->insert("tbl_packages",$newPackage);
        if ($query){
            return "success";
        }else{
            return "fail";
        }
    }
    public function getPackageById($id){
        $this->db->where('tbl_packages_id',$id);
        $query = $this->db->get('tbl_packages');
        $pack = $query->result();
        return $pack;
    }
    public function updatePackageById($id, $updatePackage){
        $this->db->where('tbl_packages_id',$id);
        $query = $this->db->update('tbl_packages', $updatePackage);
       
         if($query){
            return "success";
        }else{
            return "fail";
        }
    }
    
    public function deletePackageById($id){
        $this->db->where('tbl_packages_id',$id);
        $query = $this->db->delete('tbl_packages');
   
        if($query){
            return "success";
        }else{
            return "fail";
        }
        
    }
    public function getPackageByUser(){
        $this->db->select('*');  
        $this->db->where('tbl_users_role_id',3);
        $this->db->from('tbl_users');
        $this->db->join('users_incubator', 'tbl_users_id = users_incubator.users_id','left');
        $this->db->join('tbl_packages', 'users_incubator.tbl_packages_id = tbl_packages.tbl_packages_id','left');
        $query = $this->db->get();
        $res = $query->result();
        return $res;

    }
    public function updateAssignPack( $id,$packId){
        $this->db->where('users_id', $id);
        $r = $this->db->get('users_incubator');
        $res = $r->result();
        
        if($res == NULL){
            $newData = array(
                'users_id' => $id,
                 'tbl_packages_id' => $packId,
             );
           $quer= $this->db->insert("users_incubator",$newData);
           return "success";
        }else{
            $newData = array(
                'tbl_packages_id' => $packId,
            );
            $this->db->where('users_id',$id);
            $query = $this->db->update('users_incubator',$newData);
            return "success";
        }
    }
   
}
