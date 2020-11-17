<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class PersonalTodo_Modal extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    
    public function add_todos($data) {
        
        $this->db->insert('tbl_personal_todos', $data);
            
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

    public function get_todo($id) {
        $this->db->where('tbl_personal_todos_id',$id);
        $query=$this->db->get('tbl_personal_todos');
        $result=$query->result();
        return $result;
    }

    public function update_todos($data,$id) {

        $this->db->where('tbl_personal_todos_id',$id);
        $this->db->update('tbl_personal_todos',$data);
        if ($this->db->trans_status() == TRUE) 
        {
            $error = 1;
        }
        else
        {
            $error = 0;
        }
        return $error;
    }

    public function delete_todos($id) {

        $this->db->where("tbl_personal_todos_id",$id);
        $this->db->delete('tbl_personal_todos');
            
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