<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Analytics model
 * @author: Imron Rosdiana
 */
class Analytics_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();

    }

    //Gets all smmes
    public function get_all_smmes() {
        //SELECT tbl_users_id, tbl_users_firstname, tbl_users_lastname FROM tbl_users WHERE tbl_users_role_id = 2 AND tbl_users_status IN (4, 6, 7);
        $this->db->select('tbl_users_id as user_id, tbl_users_firstname as user_fname, tbl_users_lastname as user_lname');
        $this->db->where('tbl_users_role_id = 2 AND tbl_users_status IN (4, 6, 7)');
        $result = $this->db->get('tbl_users')->result_array();
        return $result;
    }

    //Gets all users by role
    public function get_all_users_by_role($role_id) {
        //SELECT tbl_users_id, tbl_users_firstname, tbl_users_lastname FROM tbl_users WHERE tbl_users_role_id = 2;
        $this->db->select('tbl_users_id as user_id, tbl_users_firstname as user_fname, tbl_users_lastname as user_lname');
        $this->db->where('tbl_users_role_id', $role_id);
        $result = $this->db->get('tbl_users')->result_array();
        return $result;
    }

    //Gets smme ratings
    public function get_smme_ratings($evaluatee_id) {
        $query = $this->db->query('SELECT IFNULL(AVG(avg.average), 0) as average_rating FROM 
            (SELECT evaluation_id, SUM(evaluation_answer),COUNT(*), SUM(evaluation_answer)/(COUNT(*)*5) as average 
             FROM tbl_evaluation_answers 
             WHERE evaluation_id in 
             (SELECT evaluation_id FROM tbl_evaluations 
              JOIN tbl_users
              ON evaluatee_id = ' . $evaluatee_id . ' AND evaluator_id = tbl_users_id AND tbl_users_role_id = 3) 
             GROUP BY evaluation_id) as avg');
        $rating_from_incubator =  $query->result_array()[0]['average_rating'];
        $query = $this->db->query('SELECT IFNULL(AVG(avg.average), 0) as average_rating FROM 
            (SELECT evaluation_id, SUM(evaluation_answer),COUNT(*), SUM(evaluation_answer)/(COUNT(*)*5) as average 
             FROM tbl_evaluation_answers 
             WHERE evaluation_id in 
             (SELECT evaluation_id FROM tbl_evaluations 
              JOIN tbl_users
              ON evaluatee_id = ' . $evaluatee_id . ' AND evaluator_id = tbl_users_id AND tbl_users_role_id = 4) 
             GROUP BY evaluation_id) as avg');
        $rating_from_bdsp =  $query->result_array()[0]['average_rating'];
        return array(
            "Incubator" => $rating_from_incubator,
            "BDSP" => $rating_from_bdsp);
    }

    //Gets bdsp ratings
    public function get_bdsp_ratings($evaluatee_id) {
        $query = $this->db->query('SELECT IFNULL(AVG(avg.average), 0) as average_rating FROM 
            (SELECT evaluation_id, SUM(evaluation_answer),COUNT(*), SUM(evaluation_answer)/(COUNT(*)*5) as average 
             FROM tbl_evaluation_answers 
             WHERE evaluation_id in 
             (SELECT evaluation_id FROM tbl_evaluations 
              JOIN tbl_users
              ON evaluatee_id = ' . $evaluatee_id . ' AND evaluator_id = tbl_users_id AND tbl_users_role_id = 2) 
             GROUP BY evaluation_id) as avg');
        $rating_from_smme =  $query->result_array()[0]['average_rating'];
        $query = $this->db->query('SELECT IFNULL(AVG(avg.average), 0) as average_rating FROM 
            (SELECT evaluation_id, SUM(evaluation_answer),COUNT(*), SUM(evaluation_answer)/(COUNT(*)*5) as average 
             FROM tbl_evaluation_answers 
             WHERE evaluation_id in 
             (SELECT evaluation_id FROM tbl_evaluations 
              JOIN tbl_users
              ON evaluatee_id = ' . $evaluatee_id . ' AND evaluator_id = tbl_users_id AND tbl_users_role_id = 3) 
             GROUP BY evaluation_id) as avg');
        $rating_from_incubator =  $query->result_array()[0]['average_rating'];
        return array(
            "Incubator" => $rating_from_incubator,
            "MSME" => $rating_from_smme);
    }

    //Gets incubator ratings
    public function get_incubator_ratings($evaluatee_id) {
        $query = $this->db->query('SELECT IFNULL(AVG(avg.average), 0) as average_rating FROM 
            (SELECT evaluation_id, SUM(evaluation_answer),COUNT(*), SUM(evaluation_answer)/(COUNT(*)*5) as average 
             FROM tbl_evaluation_answers 
             WHERE evaluation_id in 
             (SELECT evaluation_id FROM tbl_evaluations 
              JOIN tbl_users
              ON evaluatee_id = ' . $evaluatee_id . ' AND evaluator_id = tbl_users_id AND tbl_users_role_id = 2) 
             GROUP BY evaluation_id) as avg');
        $rating_from_smme =  $query->result_array()[0]['average_rating'];
        $query = $this->db->query('SELECT IFNULL(AVG(avg.average), 0) as average_rating FROM 
            (SELECT evaluation_id, SUM(evaluation_answer),COUNT(*), SUM(evaluation_answer)/(COUNT(*)*5) as average 
             FROM tbl_evaluation_answers 
             WHERE evaluation_id in 
             (SELECT evaluation_id FROM tbl_evaluations 
              JOIN tbl_users
              ON evaluatee_id = ' . $evaluatee_id . ' AND evaluator_id = tbl_users_id AND tbl_users_role_id = 4) 
             GROUP BY evaluation_id) as avg');
        $rating_from_bdsp =  $query->result_array()[0]['average_rating'];
        return array(
            "BDSP" => $rating_from_bdsp,
            "MSME" => $rating_from_smme);
    }

    //Gets count of users by browser used for login
    public function get_users_by_browsers() {
        //SELECT tbl_login_history_login_fromas browser, COUNT(*) as count FROM tbl_login_history GROUP BY tbl_login_history_login_from;
        $this->db->select('tbl_login_history_login_from as browser, COUNT(*) as count');
        $this->db->group_by('tbl_login_history_login_from');
        $result = $this->db->get('tbl_login_history')->result_array();
        return $result;
    }

    //Gets count of users by location using IP
    public function get_users_by_location() {
        //SELECT tbl_login_history_ip as ipaddress, COUNT(*) as count FROM tbl_login_history GROUP BY tbl_login_history_ip;
        $this->db->select('tbl_login_history_ip as ipaddress, COUNT(*) as count');
        $this->db->group_by('tbl_login_history_ip');
        $result = $this->db->get('tbl_login_history')->result_array();
        return $result;
    }

    //Gets count of users by location using country
    public function get_users_by_country() {
        //SELECT tbl_login_history_country as country, COUNT(*) as count FROM tbl_login_history GROUP BY tbl_login_history_country;
        $this->db->select('tbl_login_history_country as country, COUNT(*) as count');
        $this->db->group_by('tbl_login_history_country');
        $result = $this->db->get('tbl_login_history')->result_array();
        return $result;
    }

    //Gets count of users by login result
    public function get_users_by_login_result() {
        //SELECT tbl_login_history_result as login_result, COUNT(*) as count FROM tbl_login_history GROUP BY tbl_login_history_result;
        $this->db->select('tbl_login_history_result as login_result, COUNT(*) as count');
        $this->db->group_by('tbl_login_history_result');
        $result = $this->db->get('tbl_login_history')->result_array();
        return $result;
    }    

    public function get_smme_incubation_progress() {

        $query = $this->db->query("SELECT tbl_users_id, 
            CASE WHEN t.phase_id in(1) THEN 'Investigation '
                 WHEN t.phase_id in (2,3,4) then 'Development'
                 when t.phase_id in (5,6) then 'Commercial'
            END AS period,
            CASE WHEN t.phase_id in(1) THEN sum(answered_count)
                 WHEN t.phase_id in (2,3,4) then sum(answered_count)
                 when t.phase_id in (5,6) then sum(answered_count)
            END AS period_ans_count,
            CASE WHEN t.phase_id in(1) THEN sum(total_qcount)
                 WHEN t.phase_id in (2,3,4) then sum(total_qcount)
                 when t.phase_id in (5,6) then sum(total_qcount)
            END AS period_qcount,
            CASE WHEN t.phase_id in(1) THEN round(sum(answered_count)*100/sum(total_qcount))
                 WHEN t.phase_id in (2,3,4) then round(sum(answered_count)*100/sum(total_qcount))
                 when t.phase_id in (5,6) then round(sum(answered_count)*100/sum(total_qcount))
            END AS percentage
            from 
            (SELECT
                total_count.tbl_users_id, total_count.phase_id, IFNULL(answered.answered_count,0) as answered_count, total_qcount, IFNULL(answered.answered_count*100 / total_count.total_qcount, 0) as complete_percent
            FROM
                (
                SELECT
                    tbl_users_id,
                    phase_id,
                    COUNT(*) AS answered_count
                FROM
                    tbl_users u,
                    tbl_smme_question_answer q
                WHERE
                    tbl_users_role_id = 2 AND tbl_users_status = 6 AND is_answered = 1 AND is_deleted = 0
                    and u.tbl_users_id = q.user_id
                GROUP BY
                    tbl_users_id,
                    phase_id
               ) AS answered
            RIGHT JOIN(
                    (
            SELECT
                        tbl_users_id,
                        phase_id,
                        COUNT(*) AS total_qcount
                    FROM
                        tbl_users u,
                        tbl_smme_question_answer a
                    WHERE
                        tbl_users_role_id = 2 AND tbl_users_status = 6 AND is_deleted = 0
                        and u.tbl_users_id = a.user_id
                    GROUP BY
                        tbl_users_id,
                        phase_id
             ) AS total_count
                )
            ON
                answered.tbl_users_id = total_count.tbl_users_id AND answered.phase_id = total_count.phase_id
                ORDER BY total_count.tbl_users_id, total_count.phase_id
            ) as t
            group by t.tbl_users_id, period");
        return $query->result_array();
    }


##################kamlesh############

public function getRegistrationsReport($roleid=''){
   $result=[];  
   $query = $this->db->select('u.*,r.tbl_roles_id,r.tbl_roles_title')
     ->from('tbl_users as u')
     ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
    if($roleid !=1){
      $query->where('u.tbl_users_role_id', $roleid);
    }
    $result =  $query->get()->result_array();
     return $result;  
}

public function getDemographicsReports($roleid=''){
   $result= [];

   $query = $this->db->select(
    'distinct(u.tbl_users_user_uniqueid)
    ,u.tbl_users_firstname,u.tbl_users_lastname
    ,u.tbl_users_insertdate
    ,u.tbl_users_gender
    ,u.tbl_users_mobile
    ,pd.tbl_personal_details_district
    ,pd.tbl_personal_details_town_village
    ,pd.tbl_personal_details_howdidyouknow as channel
    ,r.tbl_roles_title
    ,s.stage as status
    ,IFNULL(ROUND(DATEDIFF(CURRENT_DATE, STR_TO_DATE(pd.tbl_personal_details_dob, "%Y-%m-%D"))/365),0) AS age
    ')
     ->from('tbl_users as u') 
     ->join('tbl_personal_details as pd', 'pd.tbl_personal_details_user_id = u.tbl_users_role_id', 'LEFT')
     ->join('tbl_all_documents as du', 'u.tbl_users_role_id = du.tbl_all_documents_user_id', 'LEFT')
     ->join('tbl_stages as s', 's.id = u.tbl_users_status')
     ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
     if($roleid !=1){
     // $query->where('u.tbl_users_role_id', $roleid);
     } 
    $result =  $query->get()->result_array(); 
    return $result; 
}




    public function getIncubationStatusReport($roleid=''){
       $result= [];
       $query = $this->db->select(
        'distinct(u.tbl_users_user_uniqueid)
        ,u.tbl_users_firstname,u.tbl_users_lastname
        ,u.tbl_users_insertdate
        ,u.tbl_users_gender
        ,u.tbl_users_mobile
        ,pd.tbl_personal_details_district
        ,pd.tbl_personal_details_town_village
        ,pd.tbl_personal_details_howdidyouknow as channel
        ,r.tbl_roles_title
        ,s.stage as status
        ,IFNULL(ROUND(DATEDIFF(CURRENT_DATE, STR_TO_DATE(pd.tbl_personal_details_dob, "%Y-%m-%D"))/365),0) AS age
        ')
         ->from('tbl_users as u') 
         ->join('tbl_personal_details as pd', 'pd.tbl_personal_details_user_id = u.tbl_users_role_id', 'LEFT')
         ->join('tbl_all_documents as du', 'u.tbl_users_role_id = du.tbl_all_documents_user_id', 'LEFT')
         ->join('tbl_stages as s', 's.id = u.tbl_users_status')
         ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
         if($roleid !=1){
          $query->where('u.tbl_users_role_id', $roleid);
        } 
        $result =  $query->get()->result_array();
        return $result;
    }

    public function getChannelsReport($roleid=''){
           $result= [];
           $query = $this->db->select(
            'distinct(u.tbl_users_user_uniqueid)
            ,u.tbl_users_firstname,u.tbl_users_lastname
            ,u.tbl_users_insertdate
            ,u.tbl_users_gender
            ,u.tbl_users_mobile
            ,pd.tbl_personal_details_district
            ,pd.tbl_personal_details_town_village
            ,pd.tbl_personal_details_howdidyouknow as channel
            ,r.tbl_roles_title
            ,s.stage as status
            ,IFNULL(ROUND(DATEDIFF(CURRENT_DATE, STR_TO_DATE(pd.tbl_personal_details_dob, "%Y-%m-%D"))/365),0) AS age
            ')
             ->from('tbl_users as u') 
             ->join('tbl_personal_details as pd', 'pd.tbl_personal_details_user_id = u.tbl_users_role_id', 'LEFT')
             ->join('tbl_all_documents as du', 'u.tbl_users_role_id = du.tbl_all_documents_user_id', 'LEFT')
             ->join('tbl_stages as s', 's.id = u.tbl_users_status')
             ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
             if($roleid !=1){
              $query->where('u.tbl_users_role_id', $roleid);
            } 
            $result =  $query->get()->result_array(); 
            return $result;
    }


     public function getsecurityReport($roleid=''){
           $result= [];
           $query = $this->db->select(
            'u.tbl_users_user_uniqueid
            ,u.tbl_users_firstname,u.tbl_users_lastname
            ,u.tbl_users_insertdate
            ,u.tbl_users_gender
            ,u.tbl_users_mobile
            ,lh.tbl_login_history_ip
            ,lh.tbl_login_history_country
            ,lh.tbl_login_history_login_from as browser
            ,lh.tbl_login_history_insertdate as lastLoginTime
            ,lh.tbl_login_history_result as loginStatus
            ,r.tbl_roles_title
            ')
             ->from('tbl_login_history as lh') 
             ->join('tbl_users as u', 'lh.tbl_login_history_user_id = u.tbl_users_role_id', 'LEFT')
            ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
             
            $result =  $query->get()->result_array(); 
            return $result;
    }


    public function getevaluationReport($roleid=[],$status=[]){
           $result= [];
            
           $query = $this->db->select(
            'distinct(u.tbl_users_user_uniqueid)
            ,u.tbl_users_firstname,u.tbl_users_lastname
            ,u.tbl_users_insertdate
            ,u.tbl_users_gender
            ,u.tbl_users_mobile          
            ,r.tbl_roles_title             
            ')
             ->from('tbl_users as u') 
             ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
             //->where_in('u.tbl_users_status',$status);

             if($roleid){
                $query->where_in('u.tbl_users_role_id', $roleid);
             } 
            $result =  $query->get()->result_array();
            return $result;
    }
    public function getIncubationProgressReport($roleid=[],$status=[]){
           $result= [];
            
           $query = $this->db->select(
            'distinct(u.tbl_users_user_uniqueid)
            ,u.tbl_users_firstname,u.tbl_users_lastname
            ,u.tbl_users_insertdate
            ,u.tbl_users_gender
            ,u.tbl_users_mobile
            ,sqa.phase_id 
            ,r.tbl_roles_title             
            ')
             ->from('tbl_users as u') 
             ->join('tbl_smme_question_answer sqa','u.tbl_users_id=sqa.user_id')
             ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT')
             ->where_in('u.tbl_users_status',$status);

             if($roleid){
                $query->where_in('u.tbl_users_role_id', $roleid);
             } 
            $result =  $query->get()->result_array();
            return $result;
    }

    public function getInvestmentReport($roleid=[],$status=[]){
           $result= [];
            
           $query = $this->db->select(
            'distinct(u.tbl_users_user_uniqueid)
            ,u.tbl_users_firstname,u.tbl_users_lastname
            ,u.tbl_users_insertdate
            ,u.tbl_users_gender
            ,u.tbl_users_mobile
            ,bd.tbl_business_details_investmant_need as investment_need
            ,bd.tbl_business_details_revenue_raised as revenue_raised
            ,bd.tbl_business_details_personal_funds as personal_funds
            ,bd.tbl_business_details_revenue_raised  as funding_gap
            ,r.tbl_roles_title             
            ')
             ->from('tbl_users as u') 
             ->join('tbl_business_details bd','u.tbl_users_id=bd.tbl_business_details_user_id')
             ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT')
             ->where_in('u.tbl_users_status',$status);

             if($roleid){
                $query->where_in('u.tbl_users_role_id', $roleid);
             } 
            $result =  $query->get()->result_array();
            return $result;
    }

    function __destruct() {
        $this->db->close();
    }

}
