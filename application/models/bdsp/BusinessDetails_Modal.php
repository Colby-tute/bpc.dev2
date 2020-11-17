<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class BusinessDetails_Modal extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();

    }

    public function select_all_role()
    { 
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }

    public function select_industry() {
        $query=$this->db->get('tbl_industry');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
    }

    public function sub_industries($id) {

        $this->db->where('tbl_sub_industry_industry_id',$id);
        $query=$this->db->get('tbl_sub_industry');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;   
    }

    public function select_user_business_data($id) {
        $this->db->join('tbl_industry','tbl_industry.tbl_industry_id = tbl_business_details.tbl_business_details_industry','LEFT');

        $this->db->join('tbl_sub_industry','tbl_sub_industry.tbl_sub_industry_id = tbl_business_details.tbl_business_details_sub_industry','LEFT');
        
        $this->db->where('tbl_business_details_user_id',$id);
        $query=$this->db->get('tbl_business_details');
        $result=$query->result();
        //echo "<pre>";print_r($result);exit();
        $num_rows=$query->num_rows();
        return $result;
        
    }

    public function select_smme_teams_data($id) {
        $this->db->where('tbl_smme_teams_user_id',$id);
        $query=$this->db->get('tbl_smme_teams');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
    }

    public function select_business_docs($id) {
        $this->db->where('tbl_all_documents_type','B');
        $this->db->where('tbl_all_documents_user_id',$id);
        $query=$this->db->get('tbl_all_documents');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }

    public function update_master($business,$upd_id,$business_id) {
                
                if($business_id == '')
                {  
                    $now = date("Y-m-d H:i:s");
                    $business['tbl_business_details_user_id'] = $upd_id;
                    $business['tbl_business_details_insertdate'] = $now;
                    
                    $this->db->insert('tbl_business_details', $business);
                    $businessId = $this->db->insert_id();
                    if($this->db->affected_rows())
                    {
                        $status = 1;
                    }else{
                        $status = 0;
                    }
                }
                else
                {
                    $this->db->where("tbl_business_details_id='".$business_id."'");
                    $this->db->update('tbl_business_details', $business);
                    $businessId = $business_id;
                    if($this->db->affected_rows())
                    {
                        $status = 1;
                    }else{
                        $status = 0;
                    }
                }

                // $this->db->where("tbl_smme_teams_user_id",$upd_id);
                // $duplicate =  $this->db->get('tbl_smme_teams')->row();

                // if($duplicate != '')
                // {
                //     $this->db->where("tbl_smme_teams_user_id",$upd_id);
                //     //$this->db->where("tbl_smme_teams_bussiness_id='".$businessId."'");
                //     $this->db->delete('tbl_smme_teams');
                //     if($this->db->affected_rows() > 0)
                //     {
                //         if ($business['tbl_business_details_areyouteam'] == 0) {
                //             $this->db->where("tbl_smme_teams_user_id='".$upd_id."'");
                //             //$this->db->where("tbl_smme_teams_bussiness_id='".$$businessId."'");
                //             $this->db->delete('tbl_smme_teams');
                //         }
                //         if(!empty($smme_teams))
                //         {
                //             $counted = count($smme_teams['tbl_smme_teams_first_name']);
                //             //echo $counted;
                //             //exit;
                //             //print_r($data4['tbl_bank_name'][0]);
                //             //exit;
                //             $newdata = array('');
                //             for ($i=0; $i < $counted; $i++) { 
                //                 # code...
                //                 $now = date("Y-m-d H:i:s");
                //                 $newdata = array(

                                     
                //                      'tbl_smme_teams_user_id' => $upd_id,

                //                      'tbl_smme_teams_bussiness_id' => $business_id,

                //                      'tbl_smme_teams_first_name' => $smme_teams['tbl_smme_teams_first_name'][$i],

                //                      'tbl_smme_teams_last_name'=> $smme_teams['tbl_smme_teams_last_name'][$i],

                //                      'tbl_smme_teams_email'=> $smme_teams['tbl_smme_teams_email'][$i],

                //                      'tbl_smme_teams_gender'=> $smme_teams['tbl_smme_teams_gender'][$i],

                //                      'tbl_smme_teams_date_hired'=> $smme_teams['tbl_smme_teams_date_hired'][$i],

                //                      'tbl_smme_teams_mobile'=> $smme_teams['tbl_smme_teams_mobile'][$i],

                //                      'tbl_smme_teams_insertdate' => $now,

                //                 ); 
                //                 //print_r($businessId);exit;
                //                 $this->db->insert('tbl_smme_teams', $newdata);
                //                 //$insertId = 0;

                //             }
                //         }
                //     }
                //     $status = 2;
                // }
                // else
                // {
                //     if(!empty($smme_teams))
                //     {
                //             $counted = count($smme_teams['tbl_smme_teams_first_name']);
                //             $newdata = array('');
                //             for ($i=0; $i < $counted; $i++) { 
                //                 # code...
                //                 $now = date("Y-m-d H:i:s");
                //                 $newdata = array(

                                     
                //                      'tbl_smme_teams_user_id' => $upd_id,

                //                      'tbl_smme_teams_bussiness_id' => $businessId,

                //                      'tbl_smme_teams_first_name' => $smme_teams['tbl_smme_teams_first_name'][$i],

                //                      'tbl_smme_teams_last_name'=> $smme_teams['tbl_smme_teams_last_name'][$i],

                //                      'tbl_smme_teams_email'=> $smme_teams['tbl_smme_teams_email'][$i],

                //                      'tbl_smme_teams_gender'=> $smme_teams['tbl_smme_teams_gender'][$i],

                //                      'tbl_smme_teams_date_hired'=> $smme_teams['tbl_smme_teams_date_hired'][$i],

                //                      'tbl_smme_teams_mobile'=> $smme_teams['tbl_smme_teams_mobile'][$i],

                //                      'tbl_smme_teams_insertdate' => $now,

                //                 ); 
                //                 $this->db->insert('tbl_smme_teams', $newdata);

                //             }
                //     }
                //     $error = 1;
                // }
               
        return $status; 
    }

    public function insert_business_doc($data) {

        $this->db->insert('tbl_all_documents', $data);
            
        if($this->db->affected_rows() > 0)
        {
            $error = 1; 
        }
        else
        {
            $error = 0;
        }
        return $error;
    }

    public function select_doc($id) {
        $this->db->where('tbl_all_documents_id',$id);
        $query=$this->db->get('tbl_all_documents');
        $result=$query->result();
        return $result;
    }
    
    public function delete($id) {

        $this->db->where('tbl_all_documents_id', $id);
        $this->db->delete('tbl_all_documents');
        
        if($this->db->affected_rows() > 0)
        {
            $error = 1; 
        }
        else
        {
            $error = 0;
        }
    return $error;
    }

    function __destruct() {
        $this->db->close();
    }

}