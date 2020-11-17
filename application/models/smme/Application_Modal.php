<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Application_Modal extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();

    }

    public function View_Application() {

        $this->db->join('tbl_users as user_incubator','user_incubator.tbl_users_id = tbl_application.tbl_application_incubator_id','LEFT');
        /*$this->db->join('tbl_roles as role_incubator','role_incubator.tbl_roles_id = user_incubator.tbl_users_role_id','LEFT');*/
        $this->db->join('tbl_users as user_bdsp','user_bdsp.tbl_users_id = tbl_application.tbl_application_bdsp_id','LEFT');
        /*$this->db->join('tbl_roles as role_bdsp','role_bdsp.tbl_roles_id = user_bdsp.tbl_users_role_id','LEFT');*/
        $this->db->where('tbl_application_smme_id',$this->session->userdata('id_user'));
        $this->db->select('tbl_application.*,user_incubator.tbl_users_firstname as inc_firstname,user_incubator.tbl_users_lastname as inc_lastname,user_bdsp.tbl_users_firstname as bdsp_firstname,user_bdsp.tbl_users_lastname as bdsp_lastname');
        $this->db->order_by('tbl_application_id','desc');
    	$query=$this->db->get('tbl_application');
        $result=$query->result();
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

    public function select_incubator() {

        $this->db->where('tbl_users_role_id','3');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        return $result;
    }

    public function select_bdsp() {

        $this->db->where('tbl_users_role_id','4');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        return $result;
    }
	
	public function Insert_Application($data,/*$data1,*/$data2) {

		//print_r($data1);exit();
		$this->db->insert('tbl_application', $data);
        $inserted_id = $this->db->insert_id();
         
        if($this->db->affected_rows() > 0)
        {
            /*$counted = count($data1['tbl_business_document_title']);*/
                $newdata = array('');
                $newdatas = array('');
                /*for ($i=0; $i < $counted; $i++) { 
                   $searchForValue = 'business_document_';
                   $stringValue = $data1['tbl_business_document_document'][$i];
                   if( strpos($stringValue, $searchForValue) !== false ) 
                   {

                         $business_doc_new = $stringValue ;
                    }
                    else
                    {
                        $business_doc = str_replace(" ", "_",$data1['tbl_business_document_document'][$i]);
                        $business_doc_new = "business_document_".$this->session->userdata('user_unique_id')."_".$business_doc;
                    }
                   $now = date("Y-m-d H:i:s");
                   $newdatas = array(

                    'tbl_all_documents_user_id' => $this->session->userdata('id_user'),

					'tbl_all_documents_title' => $business_doc_new,
					
                    'tbl_all_documents_document' => $business_doc_new,

                    'tbl_all_documents_type' => 'B',

                    'tbl_all_documents_insertdate' => $now,
                   );

                   $newdata = array(

                    'tbl_business_document_userid' => $this->session->userdata('id_user'),

                    'tbl_business_document_applicationid' => $inserted_id,

                    'tbl_business_document_title' => $business_doc_new,

                    'tbl_business_document_document' => $business_doc_new,

                    'tbl_business_document_insertdate' => $now,
                   );

                   $this->db->insert('tbl_business_document', $newdata);

                   $this->db->insert('tbl_all_documents', $newdatas);
                }*/

                $countedn = count($data2['tbl_business_document_document']);
                $newdatan = array('');
                for ($i=0; $i < $countedn; $i++) { 
                   $searchForValuen = 'business_document_';
                   $stringValuen = $data2['tbl_business_document_document'][$i];
                   if( strpos($stringValuen, $searchForValuen) !== false ) 
                   {

                         $business_doc_new = $stringValuen ;
                    }
                    /*else
                    {
                        $business_doc = str_replace(" ", "_",$data1['tbl_business_document_document'][$i]);
                        $business_doc_new = "business_document_".$this->session->userdata('user_unique_id')."_".$business_doc;
                    }*/
                   $now = date("Y-m-d H:i:s");
                   $newdatan = array(

                    'tbl_business_document_userid' => $this->session->userdata('id_user'),

                    'tbl_business_document_applicationid' => $id,

                    'tbl_business_document_title' => $business_doc_new,

                    'tbl_business_document_document' => $business_doc_new,

                    'tbl_business_document_insertdate' => $now,
                   );

                   //print_r($newdata);exit;
                   $this->db->insert('tbl_business_document', $newdatan);
                }

                //insert the incubator to assignment table
                $app_assignment_data = array(
                  'app_id' => $inserted_id,
                  'smme_id' => $data['tbl_application_smme_id'],
                  'incubator_id' => $data['tbl_application_incubator_id']
                );

                $this->db->insert('tbl_application_assignment', $app_assignment_data);
            
                //insert bdsp to assignment table
                 $app_assignment_data = array(
                  'app_id' => $inserted_id,
                  'smme_id' => $data['tbl_application_smme_id'],
                  'bdsp_id' => $data['tbl_application_bdsp_id']
                );
                $this->db->insert('tbl_application_assignment', $app_assignment_data);

            $error = 1; // to the controller
        }
        else
        {
            $error = 0;
        }
        return $error;
	}

	public function Edit_Application($id) {

    		$this->db->where('tbl_application_id',$id);
    		$query=$this->db->get('tbl_application');
        $result=$query->result();
        return $result;
	} 

    public function select_mul_doc_id($id) {

        $this->db->where('tbl_business_document_applicationid',$id);
        $query=$this->db->get('tbl_business_document');
        $result=$query->result();
        return $result;
    }   

	public function Update_Application($data,$id/*,$data1,$data2*/) {

		$this->db->where('tbl_application_id',$id);
        $this->db->update('tbl_application',$data);
        /*if ($this->db->trans_status() == TRUE) {
            
            if($data1['tbl_business_document_title'][0]!=''){
                
                $this->db->where("tbl_business_document_applicationid",$id);
                $this->db->delete('tbl_business_document');
                $counted = count($data1['tbl_business_document_title']);
                $newdata = array('');
                $newdatas = array('');
                for ($i=0; $i < $counted; $i++) { 
                   $searchForValue = 'business_document_';
                   $stringValue = $data1['tbl_business_document_document'][$i];
                   if( strpos($stringValue, $searchForValue) !== false ) 
                   {

                         $business_doc_new = $stringValue ;
                    }
                    else
                    {
                        $business_doc = str_replace(" ", "_",$data1['tbl_business_document_document'][$i]);
                        $business_doc_new = "business_document_".$this->session->userdata('user_unique_id')."_".$business_doc;
                    }
                   $now = date("Y-m-d H:i:s");
                   $newdatas = array(

                    'tbl_all_documents_user_id' => $this->session->userdata('id_user'),

                    'tbl_all_documents_document' => $business_doc_new,

                    'tbl_all_documents_type' => 'B',

                    'tbl_all_documents_insertdate' => $now,
                   );

                   $newdata = array(

                    'tbl_business_document_userid' => $this->session->userdata('id_user'),

                    'tbl_business_document_applicationid' => $id,

                    'tbl_business_document_title' => $business_doc_new,

                    'tbl_business_document_document' => $business_doc_new,

                    'tbl_business_document_insertdate' => $now,
                   );

                   //print_r($newdata);exit;
                   $this->db->insert('tbl_business_document', $newdata);

                   $this->db->insert('tbl_all_documents', $newdatas);
                }

                $countedn = count($data2['tbl_business_document_document']);
                $newdatan = array('');
                for ($i=0; $i < $countedn; $i++) { 
                   $searchForValuen = 'business_document_';
                   $stringValuen = $data2['tbl_business_document_document'][$i];
                   if( strpos($stringValuen, $searchForValuen) !== false ) 
                   {

                         $business_doc_new = $stringValuen ;
                    }
                    else
                    {
                        $business_doc = str_replace(" ", "_",$data1['tbl_business_document_document'][$i]);
                        $business_doc_new = "business_document_".$this->session->userdata('user_unique_id')."_".$business_doc;
                    }
                   $now = date("Y-m-d H:i:s");
                   $newdatan = array(

                    'tbl_business_document_userid' => $this->session->userdata('id_user'),

                    'tbl_business_document_applicationid' => $id,

                    'tbl_business_document_title' => $business_doc_new,

                    'tbl_business_document_document' => $business_doc_new,

                    'tbl_business_document_insertdate' => $now,
                   );

                   //print_r($newdata);exit;
                   $this->db->insert('tbl_business_document', $newdatan);
                }

            } 
           $error = 1;
        }
        else{

           $error = 0;
        }*/
        $error = 0;
        return $error;
	}

	public function Delete_Application($id) {

		$this->db->where('tbl_application_id', $id);
        $this->db->delete('tbl_application');
        
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
	
	public function select_user_personal_data($id) {
        $this->db->where('tbl_personal_details_user_id',$id);
        $query=$this->db->get('tbl_personal_details');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }
	
	public function select_user_data($id) {
        $this->db->join('tbl_stages as s','s.id = u.tbl_users_status','LEFT');
        $this->db->where('tbl_users_id',$id);
        $this->db->select('s.stage,u.*' );
        $query=$this->db->get('tbl_users as u');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }
	
	public function select_user_business_data($id) {
		$this->db->join('tbl_industry','tbl_industry.tbl_industry_id = tbl_business_details.tbl_business_details_industry','LEFT');
        $this->db->join('tbl_sub_industry','tbl_sub_industry.tbl_sub_industry_id = tbl_business_details.tbl_business_details_sub_industry','LEFT');
        $this->db->where('tbl_business_details_user_id',$id);
        $query=$this->db->get('tbl_business_details');
        $result=$query->result();
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
	
	public function bdsp_incubator_smme_name($id) {
        $this->db->join('tbl_users as user_incubator','user_incubator.tbl_users_id = tbl_application.tbl_application_incubator_id','LEFT');
        $this->db->join('tbl_users as user_bdsp','user_bdsp.tbl_users_id = tbl_application.tbl_application_bdsp_id','LEFT');
        $this->db->join('tbl_users as user_smme','user_smme.tbl_users_id = tbl_application.tbl_application_smme_id','LEFT');
        $this->db->where('tbl_application_id',$id);
        $this->db->select('tbl_application.*,user_incubator.tbl_users_firstname as inc_firstname,user_incubator.tbl_users_lastname as inc_lastname,user_bdsp.tbl_users_firstname as bdsp_firstname,user_bdsp.tbl_users_lastname as bdsp_lastname,user_smme.tbl_users_firstname as smme_firstname,user_smme.tbl_users_lastname as smme_lastname');
        $query=$this->db->get('tbl_application');
        $result=$query->result();
        return $result;
    }  
	
	public function stats_change($id,$data){
        $this->db->where('tbl_application_id',$id);
        $this->db->update('tbl_application',$data);
        if($this->db->affected_rows() > 0)
        {
            // Code here after successful insert
            $error = 1; // to the controller
        }
        else
        {
            $error = 0;
        }
        return $error;
    }

    public function getMessage($data){
      if(count($data) != 0){
        $result = $this->db->where_in('tbl_broadcaster_id',$data)->order_by('tbl_broadcast_id','desc')->get('tbl_broadcast');
        return $result->result();
      }else
      {
        return [];
      }
    }

    public function getBroadcastMessage($id){
      $result = $this->db->where('tbl_broadcast_id',$id)->get('tbl_broadcast');
      return $result->row();
    }

    function __destruct() {
        $this->db->close();
    }

}