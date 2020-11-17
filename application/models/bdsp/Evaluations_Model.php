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

    public function get_smme_applications($id)
    { 
        $this->db->distinct();
        $this->db->select('app_id,smme_id,u.tbl_users_firstname, u.tbl_users_lastname');
        $this->db->where('`app_id` IN (SELECT `app_id` FROM `tbl_application_assignment` WHERE `bdsp_id` = '.$id.')', NULL, FALSE);
        $this->db->join('tbl_users as u','aa.smme_id = u.tbl_users_id');
        $result = $this->db->get("tbl_application_assignment as aa")->result();
        return $result;
    }

    public function get_smme_application($id)
    { 
        $this->db->select('*');
        $this->db->where("app_id",$id);
        $result = $this->db->get("tbl_application_assignment")->result();
        return $result;
    }

    public function get_user_details($userid) {
        $this->db->select('*');
        $this->db->where("tbl_users_id",$userid);
        $result = $this->db->get("tbl_users")->result();
        return $result;
    }

    public function get_evaluations($evaluator_id)
    { 
        $this->db->select("*, u.tbl_users_firstname as evaluatee_firstname, u.tbl_users_lastname as evaluatee_lastname");
        $this->db->where("evaluator_id", $evaluator_id);
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

    public function get_evaluation_questions($evaluatee_id)
    { 
        $this->db->select("tbl_users_role_id");
        $this->db->where("tbl_users_id", $evaluatee_id);
        $result = $this->db->get("tbl_users")->result()[0];
        $evaluatee_role_id = $result->tbl_users_role_id;

        $this->db->select("*");
        $this->db->where("evaluatee_role_id", $evaluatee_role_id);
        $result = $this->db->get("tbl_evaluation_questions")->result();

        return $result;
    }

    public function create_evaluation($evaluation)
    { 
        $this->db->insert("tbl_evaluations", [
            "smme_application_id" => $evaluation['smme_application_id'],
            "smme_id" =>  $evaluation['smme_id'],
            "evaluator_id" => $evaluation['evaluator_id'],
            "evaluatee_id" => $evaluation['evaluatee_id'],
            "evaluation_title" => $evaluation['title'],
            "evaluation_desc" => $evaluation['description'],
            "evaluation_comments" => $evaluation['comments']
        ]);
        $evaluation_id = $this->db->insert_id();
        return  $evaluation_id;
    }

    public function submit_evaluation_answers($evaluation, $evaluation_id)
    {
        $submit_answers = array();
        foreach ($evaluation['answers'] as $evaluation_question_id => $evaluation_answer) {
            array_push($submit_answers, array(
                "evaluation_id" => $evaluation_id,
                "evaluation_question_id" =>  $evaluation_question_id,
                "evaluation_answer" => $evaluation_answer
            ));
        }
        $this->db->insert_batch('tbl_evaluation_answers', $submit_answers);
        return $this->db->insert_id();
    }

    function __destruct() {
        $this->db->close();
    }

}