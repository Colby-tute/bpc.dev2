<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class User_model extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function login_history($id)
    {
       /* $this->db->join('tbl_roles','tbl_roles.tbl_roles_id = tbl_login_history.tbl_login_history_user_id','left');*/
        $this->db->join('tbl_users','tbl_users.tbl_users_id = `tbl_login_history`.`tbl_login_history_user_id`','left');
        
        $this->db->join('tbl_roles','tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','left');
        $this->db->where('tbl_login_history_user_id',$id);
        $query=$this->db->get('tbl_login_history');
        $result=$query->result();
        //print_r($result);exit();
        return $result;
    }
    public function validate_user($data) {
        //print_r($data);exit;
        $active = 'active';
        $this->db->where('tbl_user_email', $data['email']);
        $this->db->where('tbl_user_password', md5($data['password']));
        $this->db->where('tbl_user_status', $active);
        $query = $this->db->get('user');
        $result = $query->result();
       // print_r($results);exit;
        if(!empty($result))
        {
            $this->db->select('tbl_images_path,tbl_images_name');
            $this->db->where('tbl_images_parent_id', $result[0]->tbl_user_id);
            $this->db->where('tbl_images_type', $result[0]->tbl_user_type);
            $querys = $this->db->get('images');
            $results = $querys->result();
             $data = [
                    'id_user' => $result[0]->tbl_user_master_id,
                    'user_id' => $result[0]->tbl_user_id,
                    'username' => $result[0]->tbl_user_username,
                    'user_type' => $result[0]->tbl_user_type,
                    'user_image' => $result[0]->tbl_images_path."/".$result[0]->tbl_images_name,
                    'parent_company_id' => $result[0]->tbl_user_company_id,
                ];

                //print_r($data);

        }
        else
        { 
            $active = 'active';
            $this->db->where('tbl_employee_email', $data['email']);
            $this->db->where('tbl_employee_password', md5($data['password']));
            $this->db->where('tbl_employee_status', $active);
            $query = $this->db->get('employee');
            $result = $query->result();
          
             
            // Test if string contains the word 
            
            if(!empty($result))
            {
                $this->db->select('tbl_images_path,tbl_images_name');
                $this->db->where('tbl_images_parent_id', $result[0]->tbl_employee_id);
                $this->db->where('tbl_images_type', 'employee');
                $querys = $this->db->get('images');
                $results = $querys->result();
                /*print_r($results);*/
                //echo $result[0]->tbl_employee_id;
                if(!empty($results))
                {
                    foreach ($results as $key => $value) {
                        $word = "emp_photo_";
                        $mystring = $value->tbl_images_name;
                       
                        if(strpos($mystring, $word) !== false){
                             
                            $data = [
                                'id_user' => $result[0]->tbl_employee_master_id,
                                'user_id' => $result[0]->tbl_employee_id,
                                'username' => $result[0]->tbl_employee_username,
                                'user_type' => 'employee',
                                'user_image' => $value->tbl_images_path."/".$value->tbl_images_name,
                                'parent_company_id' => $result[0]->tbl_employee_company_id,
                            ];
                            break;
                        } 
                        else{

                            $data = [
                            'id_user' => $result[0]->tbl_employee_master_id,
                            'user_id' => $result[0]->tbl_employee_id,
                            'username' => $result[0]->tbl_employee_username,
                            'user_type' => 'employee',
                            'user_image' => '',
                            'parent_company_id' => $result[0]->tbl_employee_company_id,
                            ];
                        }
                    }
                }
                else{

                        $data = [
                        'id_user' => $result[0]->tbl_employee_master_id,
                        'user_id' => $result[0]->tbl_employee_id,
                        'username' => $result[0]->tbl_employee_username,
                        'user_type' => 'employee',
                        'user_image' => '',
                        'parent_company_id' => $result[0]->tbl_employee_company_id,
                        ];
                    }

                //exit;
            }
            else
            { 
                $data = [];
            }
            

               // print_r($data);exit;
        }
        return json_encode($data);
        
        //print_r($query->result());exit();
        /*return $this->db->get('user')->row();*/
        //$noros = $this->db->get('user')->num_rows();   
    }

    public function select_all_role()
    { 
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
     public function insert_master($user,$personal,$business,$smme_teams) {
        //echo "<pre>";
        //print_r($user);exit;
        $this->db->where("tbl_users_user_uniqueid='".$user['tbl_users_user_uniqueid']."'");
        $duplicate =  $this->db->get('tbl_users')->row();

        if($duplicate == '')
        {
            $this->db->insert('tbl_users', $user);
            $insertId = $this->db->insert_id();

            if($this->db->affected_rows() > 0)
            {

                $personal['tbl_personal_details_user_id'] = $insertId;
                $business['tbl_business_details_user_id'] = $insertId;
                
                $this->db->insert('tbl_personal_details', $personal);
                $this->db->insert('tbl_business_details', $business);
                $businessId = $this->db->insert_id();
               //echo "Prachi".$last_id = $this->db->insert_id(); exit;
                

                if(!empty($smme_teams))
                {
                    $counted = count($smme_teams['tbl_smme_teams_first_name']);
                    //echo $counted;
                    //exit;
                    //print_r($data4['tbl_bank_name'][0]);
                    //exit;
                    $newdata = array('');
                    for ($i=0; $i < $counted; $i++) { 
                        # code...
                        $now = date("Y-m-d H:i:s");
                        $newdata = array(

                             
                             'tbl_smme_teams_user_id' => $insertId,

                             'tbl_smme_teams_bussiness_id' => $businessId,

                             'tbl_smme_teams_first_name' => $smme_teams['tbl_smme_teams_first_name'][$i],

                             'tbl_smme_teams_last_name'=> $smme_teams['tbl_smme_teams_last_name'][$i],

                             'tbl_smme_teams_email'=> $smme_teams['tbl_smme_teams_email'][$i],

                             'tbl_smme_teams_mobile'=> $smme_teams['tbl_smme_teams_mobile'][$i],

                             'tbl_smme_teams_insertdate' => $now,

                        ); 
                        //print_r($businessId);exit;
                        $this->db->insert('tbl_smme_teams', $newdata);
                        //$insertId = 0;

                    }
                }
               // echo "dhdjh";exit;
                $error = 1; // to the controller
            }
            else
            {
                $error = 0;
                
            }
           //print_r($error);

        }
        else
        { 
            $error = 2;
            $insertId=0;
        }
        return $error."^".$insertId;     
    }

    public function select_all_user_data($id) {
        
        
        $this->db->where('tbl_users_id',$id);
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_all_user_data_view($id) {

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->order_by('tbl_users_id', 'DESC');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_all_smme_data_view() {

        $this->db->where('tbl_roles_title', 'MSME');
        $querys=$this->db->get('tbl_roles');
        $results=$querys->result();

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_role_id', $results[0]->tbl_roles_id);
        $this->db->group_by('tbl_users_id');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        //print_r($result);exit;
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_all_bdsps_data_view() {

        $this->db->where('tbl_roles_title', 'BDSP');
        $querys=$this->db->get('tbl_roles');
        $results=$querys->result();

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_role_id', $results[0]->tbl_roles_id);
        $this->db->group_by('tbl_users_id');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        //print_r($result);exit;
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_all_incubators_data_view() {

        $this->db->where('tbl_roles_title', 'INCUBATOR');
        $querys=$this->db->get('tbl_roles');
        $results=$querys->result();

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_role_id', $results[0]->tbl_roles_id);
        $this->db->group_by('tbl_users_id');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        //print_r($result);exit;
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_user_data($i) {
        $this->db->where('tbl_users_id',$i);
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
    }
    public function select_user_personal_data($i) {
        $this->db->where('tbl_personal_details_user_id',$i);
        $query=$this->db->get('tbl_personal_details');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
    }
    public function select_user_business_data($i) {
        $this->db->where('tbl_business_details_user_id',$i);
        $query=$this->db->get('tbl_business_details');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
    }
    public function select_smme_teams_data($i) {
        $this->db->where('tbl_smme_teams_user_id',$i);
        $query=$this->db->get('tbl_smme_teams');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
    }

    public function update_master($user,$personal,$business,$smme_teams,$upd_id,$persona_id,$business_id) {

        /*$this->db->where("tbl_users_user_uniqueid='".$user['tbl_users_user_uniqueid']."'");
        $this->db->where("tbl_users_id!='".$upd_id."'");
        $duplicate =  $this->db->get('tbl_users')->row();*/

            $this->db->where("tbl_users_id ='".$upd_id."'");
            $this->db->update('tbl_users', $user);

            if($this->db->affected_rows() > 0)
            {
                if($persona_id!= '')
                {   $now = date("Y-m-d H:i:s");
                    $personal['tbl_personal_details_user_id'] = $upd_id;
                    $business['tbl_business_details_user_id'] = $upd_id;
                    $personal['tbl_personal_details_insertdate'] = $now;
                    $business['tbl_business_details_insertdate'] = $now;
                    
                    $this->db->insert('tbl_personal_details', $personal);
                    $this->db->insert('tbl_business_details', $business);
                    $businessId = $this->db->insert_id();
                }
                else
                {
                    $this->db->where("tbl_personal_details_id='".$persona_id."'");
                    $this->db->update('tbl_personal_details', $personal);
                    $this->db->where("tbl_business_details_id='".$business_id."'");
                    $this->db->insert('tbl_business_details', $business);
                    $businessId = $business_id;

                }
               //echo "Prachi".$last_id = $this->db->insert_id(); exit;
                $this->db->where("tbl_smme_teams_user_id='".$upd_id."'");
                $this->db->where("tbl_smme_teams_bussiness_id='".$business_id."'");
                $duplicate =  $this->db->get('tbl_smme_teams')->row();
                if($duplicate != '')
                {
                    $this->db->where("tbl_smme_teams_user_id='".$upd_id."'");
                    $this->db->where("tbl_smme_teams_bussiness_id='".$business_id."'");
                    $this->db->delete('tbl_smme_teams');
                    if($this->db->affected_rows() > 0)
                    {
                        if(!empty($smme_teams))
                        {
                            $counted = count($smme_teams['tbl_smme_teams_first_name']);
                            //echo $counted;
                            //exit;
                            //print_r($data4['tbl_bank_name'][0]);
                            //exit;
                            $newdata = array('');
                            for ($i=0; $i < $counted; $i++) { 
                                # code...
                                $now = date("Y-m-d H:i:s");
                                $newdata = array(

                                     
                                     'tbl_smme_teams_user_id' => $upd_id,

                                     'tbl_smme_teams_bussiness_id' => $business_id,

                                     'tbl_smme_teams_first_name' => $smme_teams['tbl_smme_teams_first_name'][$i],

                                     'tbl_smme_teams_last_name'=> $smme_teams['tbl_smme_teams_last_name'][$i],

                                     'tbl_smme_teams_email'=> $smme_teams['tbl_smme_teams_email'][$i],

                                     'tbl_smme_teams_mobile'=> $smme_teams['tbl_smme_teams_mobile'][$i],

                                     'tbl_smme_teams_insertdate' => $now,

                                ); 
                                //print_r($businessId);exit;
                                $this->db->insert('tbl_smme_teams', $newdata);
                                //$insertId = 0;

                            }
                        }
                    }
                }
                
               // echo "dhdjh";exit;
                $error = 1; // to the controller
            }
            else
            {
                $error = 0;
                
            }
        return $error."^".$upd_id; 
    }

    public function update_company_user($data,$data2) {
     //print_r($data);print_r($data2);exit;
        $this->db->where("(tbl_user_username='".$data['tbl_user_username']."' OR tbl_user_email='".$data['tbl_user_email']."') AND tbl_user_id !='".$data['tbl_user_id']."'");
        $this->db->where("tbl_user_type","company");
        $duplicate =  $this->db->get('user')->row();
        //print_r($duplicate);exit;
        if($duplicate == '')
        {
            $this->db->where('tbl_user_id', $data['tbl_user_id']);
            $this->db->update('user', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() == TRUE)
            {
                //print_r($data2);exit;
                $this->db->where('tbl_bank_user_id', $data['tbl_user_id']);
                $this->db->delete('bank_details');

                $counted = count($data2['tbl_bank_name']);

                
                
                $newdata = array('');
                for ($i=0; $i < $counted; $i++) { 
                    # code...
                    $now = date("Y-m-d H:i:s");
                    $newdata = array(

                         
                         'tbl_bank_user_id' => $data['tbl_user_id'],

                         'tbl_bank_name' => $data2['tbl_bank_name'][$i],

                         'tbl_bank_branch' => $data2['tbl_bank_branch'][$i],

                         'tbl_bank_acno'=> $data2['tbl_bank_acno'][$i],

                         'tbl_bank_ifsc'=> $data2['tbl_bank_ifsc'][$i],
                         
                         'tbl_bank_user_type' => 'company',

                         'tbl_bank_ac_type'=> $data2['tbl_bank_ac_type'][$i]

                    ); 
                    //print_r($newdata);exit;
                    $this->db->insert('bank_details', $newdata);
                }
                
                // Code here after successful insert
                $error = 1; // to the controller
            }
            else
            {
                $error = 0;
            }

        }
        else
        { 
            $error = 2;
        }
        return $error;
        
    }

    public function did_delete_company_row($i,$data)
    {
        /*print_r($i);
        print_r($data);exit;*/
        $this->db->where('tbl_user_id', $i);
            $this->db->update('user', $data);
        if($this->db->affected_rows() > 0)
            {
                // Code here after successful insert
                $error = 1; // to the controller
            }
            else
            {
                $error = 0;
            }
        return $error;
    }

    public function select_all_admin_data() {
        
        $this->db->where('tbl_user_type', 'admin');
        $query=$this->db->get('user');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_user_bank_data($i) {

        $this->db->where('tbl_bank_user_id',$i);
        $this->db->where('tbl_bank_user_type','company');
        $query=$this->db->get('bank_details');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }

    public function image_insert($images,$id,$table,$field_name){
        //print_r($table);exit();
        $this->db->where($field_name,$id);
        $this->db->update($table, $images);
    }

    public function select_all_image($i){
        //$this->db->where('tbl_images_parent_id',$i);
         $this->db->where("tbl_images_parent_id='".$i."' AND tbl_images_type ='company'");
        $query=$this->db->get('images');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }

    public function display_image(){
        $query=$this->db->get('images');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
    }

    public function update_image($images,$upd_id){
        //print_r($images);
        $this->db->where('tbl_images_parent_id', $upd_id);
        $this->db->where('tbl_images_type', 'company');
        $this->db->update('images',$images);
        if($this->db->affected_rows() > 0)
            {
                // Code here after successful insert
                $error = 1; // to the controller
            }
            else
            {
                $error = 0;
            }
        return $error;
    }

    public function select_all_zone()
    {
        
        $query=$this->db->get('zone');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
    }

    public function get_state_by_zone($zone_id){
        $query = $this->db->get_where('state', array('tbl_state_zone_id' => $zone_id));
        return $query;
    }

    public function get_city_by_state($state_id){
        $query = $this->db->get_where('city', array('tbl_city_state_id' => $state_id));
        return $query;
    }

    public function get_zip_by_city($city_id){
        $query = $this->db->get_where('zip', array('tbl_zip_city_id' => $city_id));
        return $query;
    }

    public function check_username($username,$id){
        if($id != 0)
        {
            //echo "sdhjfdsh";
            $this->db->where("tbl_user_username='".$username."'");
            $this->db->where("tbl_user_id !='".$id."'");
            $this->db->where("tbl_user_type","company");
            $query =  $this->db->get('user');
        }
        else
        {
            $this->db->where("tbl_user_username='".$username."'");
            $this->db->where("tbl_user_type","company");
            $query =  $this->db->get('user');
        }
        //exit();
        
        $num_rows=$query->num_rows();
        if($num_rows > 0)
        {
            return "taken";  
        }
        else
        {
            return "not_taken";  
        }
    }

    public function check_email($email,$id){
        if($id != 0)
        {
           // echo "sdhjfdsh";
            $this->db->where("tbl_user_email='".$email."'");
            $this->db->where("tbl_user_id !='".$id."'");
            $this->db->where("tbl_user_type","company");
            $query =  $this->db->get('user');
        }
        else
        {
            $this->db->where("tbl_user_email='".$email."'");
            $this->db->where("tbl_user_type","company");
            $query =  $this->db->get('user');
        }
        //exit();
        
        $num_rows=$query->num_rows();
        if($num_rows > 0)
        {
            return "taken";  
        }
        else
        {
            return "not_taken";  
        }
        
    }

    function __destruct() {
        $this->db->close();
    }
}