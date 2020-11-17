<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Evaluations_Model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_evaluations()
    { 
        $this->db->select("*, u.tbl_users_firstname as evaluatee_firstname, u.tbl_users_lastname as evaluatee_lastname");
        $this->db->join('tbl_users as u','ev.evaluatee_id = u.tbl_users_id AND ev.evaluation_status = 1');
        $result = $this->db->get("tbl_evaluations as ev")->result();
        return $result;
    }

    public function get_evaluation($evaluation_id) {
        $this->db->select("*, u.tbl_users_firstname as evaluatee_firstname, u.tbl_users_lastname as evaluatee_lastname, u.tbl_users_user_uniqueid as uniqueid");
        $this->db->where("evaluation_id", $evaluation_id);
        $this->db->join('tbl_users as u','ev.evaluatee_id = u.tbl_users_id');   
        $result = $this->db->get("tbl_evaluations as ev")->result();
        return $result;        
    }

    public function get_evaluation_answers($evaluation_id)
    { 
        //SELECT tbl_evaluation_answers.*,tbl_evaluation_questions.question_text FROM `tbl_evaluation_answers`
                //JOIN tbl_evaluation_questions ON
                //tbl_evaluation_answers.evaluation_question_id = tbl_evaluation_questions.evaluation_question_id AND //tbl_evaluation_answers.evaluation_id = 1;
        $this->db->select('tbl_evaluation_answers.*, tbl_evaluation_questions.question_text')
                 ->from('tbl_evaluation_answers')
                 ->join('tbl_evaluation_questions', 'tbl_evaluation_answers.evaluation_question_id = tbl_evaluation_questions.evaluation_question_id AND tbl_evaluation_answers.evaluation_id = '.$evaluation_id);
        $result = $this->db->get()->result();
        return $result;
    }

    public function delete_evaluation($id) {
        $this->db->where('evaluation_id',$id);
        $this->db->update('tbl_evaluations',array("evaluation_status" => false));
        return $this->db->affected_rows();
    }

    function __destruct() {
        $this->db->close();
    }

}