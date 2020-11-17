<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Calender_Modal extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
   
    public function get_events()
    {
        return $this->db->where('tbl_calender_smme_unique_id', $this->session->userdata('user_unique_id'))->get("tbl_calender");
    }

    public function add_event($data)
    {
        $this->db->insert("tbl_calender", $data);
    }

    public function get_event($id)
    {
        return $this->db->where("tbl_calender_id", $id)->get("tbl_calender");
    }

    public function update_event($id, $data)
    {
        $this->db->where("tbl_calender_id", $id)->update("tbl_calender", $data);
    }

    public function delete_event($id)
    {
        $this->db->where("tbl_calender_id", $id)->delete("tbl_calender");
    }

    function __destruct() {
        $this->db->close();
    }
}