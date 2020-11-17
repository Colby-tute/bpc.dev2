
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Feedback_Modal extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function select_all_feedbacks($id) {
        
        $this->db->join('tbl_users','tbl_users.tbl_users_user_uniqueid = tbl_feedback.tbl_feedback_user_unique_id','LEFT');
        $this->db->join('tbl_roles','tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_feedback_smme_unique_id',$id);
        $this->db->where('is_feedback_active',1);
        $query=$this->db->get('tbl_feedback');
        $result=$query->result();
        return $result;
    }

    public function get_feedback($id) {
        $this->db->where('tbl_feedback_id',$id);
        $query=$this->db->get('tbl_feedback');
        $result=$query->result();
        return $result;
    }

    function __destruct() {
        $this->db->close();
    }
}