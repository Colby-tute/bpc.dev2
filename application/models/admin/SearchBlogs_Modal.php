
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class SearchBlogs_Modal extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function select_category() {

        $query=$this->db->get('tbl_basecenter_category');
        $result=$query->result();
       
        foreach ($result as $key => $value) {
            $this->db->where('tbl_basecenter_category_id',$value->tbl_basecenter_category_id);
            $querys = $this->db->get('tbl_basecenter_sub_category');
            $results[$value->tbl_basecenter_category_id] = $querys->result();
        }

        //print_r($results);exit();
        return array('category' => $result,'sub_category' => $results);
    }

    public function select_subcategory() {

        $query=$this->db->get('tbl_basecenter_sub_category');
        $result=$query->result();
        return $result;
    }

    function __destruct() {
        $this->db->close();
    }
}