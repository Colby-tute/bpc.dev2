<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class EmailTemplate_model extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getTemplates(){
        $result = $this->db->get('tbl_emails');
        return $result->result();
    }

    public function getTemplate($id){
        $result = $this->db->where('id',$id)->get('tbl_emails')->row();
        return $result;
    }
    
    public function updateTemplate($id,$data){
        $result = $this->db->where('id',$id)->update('tbl_emails',$data);
        return $result;
    }

}
