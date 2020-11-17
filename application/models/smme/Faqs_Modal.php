
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Faqs_Modal extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function select_faqs() {
        
        $this->db->where('tbl_faqs_role_type','SMME');
        $query=$this->db->get('tbl_faqs');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
    }

    function __destruct() {
        $this->db->close();
    }
}