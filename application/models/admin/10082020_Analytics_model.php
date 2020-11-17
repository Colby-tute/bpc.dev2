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
     
    //REGISTRATION CHARTS
    //Gets count of registrations of all kind of users by year, month, week
    public function get_registrations_count() {
        /*
        SELECT  YEAR(tbl_users_insertdate), MONTH(tbl_users_insertdate), WEEK(tbl_users_insertdate), tbl_users_role_id, COUNT(*) FROM `tbl_users` GROUP BY YEAR(tbl_users_insertdate), MONTH(tbl_users_insertdate), WEEK(tbl_users_insertdate), tbl_users_role_id;       
        */
        $this->db->select('YEAR(tbl_users_insertdate) as registration_year, 
                        MONTH(tbl_users_insertdate) as registration_month,
                        WEEK(tbl_users_insertdate) as registration_week, 
                        tbl_users_role_id as role_id,
                        COUNT(*) as registration_count');
        $this->db->group_by('YEAR(tbl_users_insertdate), MONTH(tbl_users_insertdate), 
                            WEEK(tbl_users_insertdate), tbl_users_role_id');
        $result = $this->db->get('tbl_users')->result_array();
        
        return $result;
    }

    //Gets count of registrations of all kind of users by year
    public function get_registrations_year_count() {
        $this->db->select('YEAR(tbl_users_insertdate) as registration_year, 
                        tbl_users_role_id as role_id,
                        COUNT(*) as registration_count');
        $this->db->group_by('YEAR(tbl_users_insertdate), tbl_users_role_id');
        $result = $this->db->get('tbl_users')->result_array();
        return $result;
    }

    //Gets count of registrations of all kind of users by month
    public function get_registrations_month_count() {
        $this->db->select('YEAR(tbl_users_insertdate) as registration_year, 
                        MONTH(tbl_users_insertdate) as registration_month,
                        tbl_users_role_id as role_id,
                        COUNT(*) as registration_count');
        $this->db->group_by('YEAR(tbl_users_insertdate), MONTH(tbl_users_insertdate), 
                            tbl_users_role_id');
        $result = $this->db->get('tbl_users')->result_array();
        return $result;
    }

    //Gets count of registrations of all kind of users by week
    public function get_registrations_week_count() {
        $this->db->select('YEAR(tbl_users_insertdate) as registration_year, 
                        WEEK(tbl_users_insertdate) as registration_week, 
                        tbl_users_role_id as role_id,
                        COUNT(*) as registration_count');
        $this->db->group_by('YEAR(tbl_users_insertdate), 
                            WEEK(tbl_users_insertdate), tbl_users_role_id');
        $result = $this->db->get('tbl_users')->result_array();
        return $result;
    }    

    //Gets count of registrations of all incubations by year, month, week
    public function get_incubations_count() {
        $this->db->select('*');
        $result = $this->db->get('tbl_incubation')->result();
        return $result;
    }

    //DEMOGRAPHICS CHARTS
    //Gets count of users by gender
    public function get_users_by_gender($roleId =[],$statusId =[]) {
        //SELECT tbl_users_gender, COUNT(*) FROM `tbl_users` GROUP BY `tbl_users_gender`
        $this->db->select('IFNULL(tbl_users_gender,"UNKNOWN") as gender,
                        COUNT(*) as count');
        if($roleId){
            $this->db->where_in('tbl_users_role_id',$roleId);
        }
        
        $this->db->group_by('tbl_users_gender');
        $result = $this->db->get('tbl_users')->result_array();
        return $result;
    }

    //Gets count of users by age
    public function get_users_by_age($roleId =[],$statusId =[]) {
        //SELECT tbl_personal_details_dob, IFNULL(ROUND(DATEDIFF(CURRENT_DATE, STR_TO_DATE(tbl_personal_details_dob, '%Y-%m-%D'))/365),0) AS age, COUNT(*) FROM tbl_personal_details GROUP BY age
        $this->db->select("pd.tbl_personal_details_dob, IFNULL(ROUND(DATEDIFF(CURRENT_DATE, STR_TO_DATE(pd.tbl_personal_details_dob, '%Y-%m-%D'))/365),0) AS age, COUNT(*) as count");

        $this->db->join('tbl_users as u', 'pd.tbl_personal_details_user_id = u.tbl_users_role_id', 'LEFT');

         if($roleId){
            $this->db->where_in('u.tbl_users_role_id',$roleId);
        }
       /* if($statusId){
             $this->db->where_in('u.tbl_users_status',$statusId);
        } */ 

        $this->db->group_by('age');
        $result = $this->db->get('tbl_personal_details as pd')->result();

        return $result;
    }

    //Gets count of users by district
    public function get_users_by_district($roleId =[],$statusId =[]) {
        ////SELECT `tbl_personal_details_district` as district,COUNT(*) as count FROM `tbl_personal_details` GROUP BY `tbl_personal_details_district`;
        $this->db->select('pd.tbl_personal_details_district as district,COUNT(*) as count');
         $this->db->join('tbl_users as u', 'pd.tbl_personal_details_user_id = u.tbl_users_role_id', 'LEFT');

         if($roleId){
            $this->db->where_in('u.tbl_users_role_id',$roleId);
        }
        /* if($statusId){
            $this->db->where_in('tbl_users_status',$statusId);
        } */

        $this->db->group_by('pd.tbl_personal_details_district');
        $result = $this->db->get('tbl_personal_details as pd')->result_array();
         
        return $result;
    }

    //Gets count of users by town_village
    public function get_users_by_town_village($roleId =[],$statusId =[]) {
        ////SELECT `tbl_personal_details_town_village`,COUNT(*) FROM `tbl_personal_details` GROUP BY `tbl_personal_details_town_village`;
        $this->db->select('pd.tbl_personal_details_town_village as town_village,COUNT(*) as count');
        $this->db->join('tbl_users as u', 'pd.tbl_personal_details_user_id = u.tbl_users_role_id', 'LEFT');

         if($roleId){
            $this->db->where_in('u.tbl_users_role_id',$roleId);
        }
        /* if($statusId){
            $this->db->where_in('tbl_users_status',$statusId);
        } */

        $this->db->group_by('pd.tbl_personal_details_town_village');
        $result = $this->db->get('tbl_personal_details as pd')->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    //Gets count of team members of smmes //TODO
    public function get_smmes_team_members() {
        //SELECT users.tbl_users_id, users.tbl_users_firstname, users.tbl_users_lastname, teams.tbl_smme_teams_id, teams.tbl_smme_teams_user_id FROM `tbl_users` users, tbl_smme_teams teams WHERE users.tbl_users_role_id = 2 GROUP BY teams.tbl_smme_teams_id;
        $this->db->select('users.tbl_users_id, users.tbl_users_firstname, users.tbl_users_lastname, teams.tbl_smme_teams_id, teams.tbl_smme_teams_user_id');
        $this->db->group_by('tbl_smme_teams_id');
        $result = $this->db->get('tbl_users')->result_array();
        return $result;
    }

    //Gets all smmes
    public function get_all_smmes($roleId =[],$statusId =[]) {
        //SELECT tbl_users_id, tbl_users_firstname, tbl_users_lastname FROM tbl_users WHERE tbl_users_role_id = 2 AND tbl_users_status IN (4, 6, 7);
        $this->db->select('tbl_users_id as user_id, tbl_users_firstname as user_fname, tbl_users_lastname as user_lname');
        if($roleId){
            $this->db->where_in('tbl_users_role_id',$roleId);
        }
       // if($statusId){
       //     $this->db->where_in('tbl_users_status',$statusId);
       // } 
       // $this->db->where('tbl_users_role_id = 2 AND tbl_users_status IN (4, 6, 7)');
        $result = $this->db->get('tbl_users')->result_array();
        return $result;
    }

    //Gets all users by role
    public function get_all_users_by_role($roleId =[],$statusId =[]) {
        //SELECT tbl_users_id, tbl_users_firstname, tbl_users_lastname FROM tbl_users WHERE tbl_users_role_id = 2;
        $this->db->select('tbl_users_id as user_id, tbl_users_firstname as user_fname, tbl_users_lastname as user_lname');
        if($roleId){
            $this->db->where_in('tbl_users_role_id',$roleId);
        }
        //$this->db->where('tbl_users_role_id', $role_id);
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
            "INCUBATORS" => $rating_from_incubator,
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
            "INCUBATORS" => $rating_from_incubator,
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

    //Gets count of users by channels tbl_personal_details_howdidyouknow
    public function get_users_by_channels($roleId =[],$statusId =[]) {
        //SELECT tbl_personal_details_howdidyouknow as channel,  COUNT(*) as count FROM tbl_personal_details GROUP BY tbl_personal_details_howdidyouknow;
        $this->db->select('
                            CONCAT(UCASE(LEFT(pd.tbl_personal_details_howdidyouknow, 1)), SUBSTRING(lower(pd.tbl_personal_details_howdidyouknow), 2))  as channel,  COUNT(*) as count');
       $this->db->join('tbl_users as u', 'pd.tbl_personal_details_user_id = u.tbl_users_role_id', 'LEFT');

        if($roleId){
            $this->db->where_in('u.tbl_users_role_id',$roleId);
        }
        /* if($statusId){
            $this->db->where_in('tbl_users_status',$statusId);
        } */

        $this->db->group_by('pd.tbl_personal_details_howdidyouknow');
        $result = $this->db->get('tbl_personal_details as pd')->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    //Gets count of users by browser used for login
    public function get_users_by_browsers($roleId =[],$statusId =[]) {
        //SELECT tbl_login_history_login_fromas browser, COUNT(*) as count FROM tbl_login_history GROUP BY tbl_login_history_login_from;
        $this->db->select('
            CONCAT(UCASE(LEFT(lh.tbl_login_history_login_from, 1)), SUBSTRING(lower(lh.tbl_login_history_login_from), 2))
             as browser, COUNT(*) as count');
        $this->db->join('tbl_users as u', 'lh.tbl_login_history_user_id = u.tbl_users_role_id', 'LEFT'); 

        if($roleId){
            $this->db->where_in('u.tbl_users_role_id',$roleId);
        } 

        $this->db->group_by('lh.tbl_login_history_login_from');
        $result = $this->db->get('tbl_login_history lh')->result_array();
        //echo $this->db->last_query();
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
    public function get_users_by_country($roleId =[],$statusId =[]) {
        //SELECT tbl_login_history_country as country, COUNT(*) as count FROM tbl_login_history GROUP BY tbl_login_history_country;
        $this->db->select('lh.tbl_login_history_country as country, COUNT(*) as count');
        $this->db->group_by('lh.tbl_login_history_country');
        $this->db->join('tbl_users as u', 'lh.tbl_login_history_user_id = u.tbl_users_role_id', 'LEFT'); 

        if($roleId){
            $this->db->where_in('u.tbl_users_role_id',$roleId);
        } 
        $result = $this->db->get('tbl_login_history lh')->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    //Gets count of users by login result
    public function get_users_by_login_result($roleId =[],$statusId =[]) {
        //SELECT tbl_login_history_result as login_result, COUNT(*) as count FROM tbl_login_history GROUP BY tbl_login_history_result;
        $this->db->select('lh.tbl_login_history_result as login_result, COUNT(*) as count');
        $this->db->group_by('lh.tbl_login_history_result');
        $this->db->join('tbl_users as u', 'lh.tbl_login_history_user_id = u.tbl_users_role_id', 'LEFT'); 

        if($roleId){
            $this->db->where_in('u.tbl_users_role_id',$roleId);
        } 
       
        $result = $this->db->get('tbl_login_history as lh')->result_array();
        //echo $this->db->last_query();
        return $result;
    }    

    //Gets SMMEs by incubation application status
    public function get_smme_by_incubation_application_status($roleId =[],$statusId =[]) {
        //SELECT stage as status, COUNT(*) as count FROM tbl_users JOIN tbl_stages ON tbl_users_role_id=2 AND id = tbl_users_status GROUP BY tbl_users_status;
        $this->db->select('tbl_stages.stage as status, COUNT(*) as count');
        $this->db->from('tbl_users');
        $this->db->join('tbl_stages ', 'tbl_stages.id = tbl_users.tbl_users_status', 'LEFT');


        if($roleId){
            $this->db->where_in('tbl_users.tbl_users_role_id',$roleId);
        } 
        /* if($statusId){
            $this->db->where_in('tbl_users_status',$statusId);
        } */

        //$this->db->join('tbl_stages', 'tbl_users.tbl_users_role_id != 1 AND tbl_stages.id = tbl_users.tbl_users_status');
        $this->db->group_by('tbl_users.tbl_users_status');
        $result = $this->db->get()->result_array();
        return $result;
    }

    //Gets SMMEs by incubation application status by gender
    public function get_smme_status_by_gender($roleId =[],$statusId =[]) {
        //SELECT tbl_users_gender as gender, COUNT(*) as count FROM tbl_users WHERE tbl_users_role_id=2  AND tbl_users_status IN (4,6) GROUP BY tbl_users_gender;
        $this->db->select('tbl_users_gender as gender, COUNT(*) as count');
        if($roleId){
            $this->db->where_in('tbl_users_role_id',$roleId);
        }
        //$this->db->where('tbl_users_role_id !=1 ');
        $this->db->group_by('tbl_users_gender');
        $result = $this->db->get('tbl_users')->result_array();
        return $result;
    }

    //SELECT * FROM `tbl_business_details` WHERE CAST(`tbl_business_details_investmant_need` AS DECIMAL) < CAST(`tbl_business_details_revenue_raised` AS DECIMAL) + CAST(`tbl_business_details_personal_funds` AS DECIMAL)
    //UPDATE `tbl_business_details` SET `tbl_business_details_revenue_raised` = CAST(`tbl_business_details_revenue_raised` AS DECIMAL)/2  WHERE CAST(`tbl_business_details_investmant_need` AS DECIMAL) < CAST(`tbl_business_details_revenue_raised` AS DECIMAL) + CAST(`tbl_business_details_personal_funds` AS DECIMAL)
    public function get_smme_funding($smme_id) {
        $query = $this->db->query("SELECT 
            IFNULL(ROUND(tbl_business_details_investmant_need), 0) AS investment_need,
            IFNULL(ROUND(tbl_business_details_revenue_raised), 0) AS revenue_raised,
            IFNULL(ROUND(tbl_business_details_personal_funds), 0) as personal_funds,
            IFNULL(ROUND((CAST(tbl_business_details_investmant_need AS DECIMAL) - CAST(tbl_business_details_revenue_raised AS DECIMAL))), 0) AS funding_gap FROM tbl_business_details 
            WHERE tbl_business_details_user_id = " . $smme_id);
        return $query->result_array();
    }

    public function get_smme_incubation_progress__old() {

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


    public function get_smme_incubation_progress($roleId =[],$statusId =[]) {

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
                    tbl_users_role_id = 2 AND is_answered = 1 AND is_deleted = 0
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
                        tbl_users_role_id = 2 AND is_deleted = 0
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
        
       $resultData = $query->result_array();
      // echo $this->db->last_query();
       return $resultData;
    }





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

public function getDemographicsReports($roleId =[],$statusId =[]){
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
     if($roleId){
       $query->where_in('u.tbl_users_role_id', $roleId);
     } 
    $result =  $query->get()->result_array(); 
    return $result; 
}




    public function getIncubationStatusReport($roleId =[],$statusId =[]){
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
         if($roleId){
            $query->where_in('u.tbl_users_role_id', $roleId);
         } 
        $result =  $query->get()->result_array(); 
        return $result;
    }

    public function getChannelsReport($roleId =[],$statusId =[]){
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
             if($roleId){
              $query->where_in('u.tbl_users_role_id', $roleId);
             } 
            $result =  $query->get()->result_array();
            return $result;
    }


     public function getsecurityReport($roleId =[],$statusId =[]){
           $result= [];
           $query = $this->db->select(
            'u.tbl_users_user_uniqueid
            ,u.tbl_users_firstname,u.tbl_users_lastname
            ,u.tbl_users_insertdate
            ,u.tbl_users_gender
            ,u.tbl_users_mobile
            ,lh.tbl_login_history_ip
            ,lh.tbl_login_history_country
            ,CONCAT(UCASE(LEFT(lh.tbl_login_history_login_from, 1)), SUBSTRING(lower(lh.tbl_login_history_login_from), 2))
             as browser
            ,lh.tbl_login_history_insertdate as lastLoginTime
            ,lh.tbl_login_history_result as loginStatus
            ,r.tbl_roles_title
            ')
             ->from('tbl_login_history as lh') 
             ->join('tbl_users as u', 'lh.tbl_login_history_user_id = u.tbl_users_role_id', 'LEFT')
            ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
            if($roleId){
              $query->where_in('u.tbl_users_role_id', $roleId);
             } 
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
            ,(select phase_id from tbl_smme_question_answer where user_id=tbl_users_id order by id desc limit 1) as phase_id 
            ,r.tbl_roles_title             
            ')
             ->from('tbl_users as u') 
             //->join('tbl_smme_question_answer sqa','u.tbl_users_id=sqa.user_id')
             ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
             //->where_in('u.tbl_users_status',$status);

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
             ->join('tbl_business_details bd','u.tbl_users_id=bd.tbl_business_details_user_id','LEFT')
             ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
            // ->where_in('u.tbl_users_status',$status);

             if($roleid){
                $query->where_in('u.tbl_users_role_id', $roleid);
             } 
            $result =  $query->get()->result_array();
            return $result;
    }

    public function getactivityLogReport($roleId =[],$statusId =[]){
           $result= [];
           $query = $this->db->select(
            'u.tbl_users_user_uniqueid
            ,u.tbl_users_firstname,u.tbl_users_lastname
            ,u.tbl_users_insertdate
            ,u.tbl_users_gender
            ,u.tbl_users_mobile
            ,lh.tbl_login_history_ip
            ,lh.tbl_login_history_country
             ,CONCAT(UCASE(LEFT(lh.tbl_login_history_login_from, 1)), SUBSTRING(lower(lh.tbl_login_history_login_from), 2))
             as browser
            ,lh.tbl_login_history_insertdate as lastLoginTime
            ,lh.tbl_login_history_result as loginStatus
            ,r.tbl_roles_title
            ')
             ->from('tbl_login_history as lh') 
             ->join('tbl_users as u', 'lh.tbl_login_history_user_id = u.tbl_users_role_id', 'LEFT')
            ->join('tbl_roles as r', 'u.tbl_users_role_id = r.tbl_roles_id', 'LEFT');
            if($roleId){
              $query->where_in('u.tbl_users_role_id', $roleId);
             } 
            $result =  $query->get()->result_array();
            return $result;
    }


    function __destruct() {
        $this->db->close();
    }

}
