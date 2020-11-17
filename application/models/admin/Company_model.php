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
 
    public function insert_master($data,$data2) {
        /*echo "<pre>";
        print_r($data);exit;*/
        $this->db->where("tbl_user_username='".$data['tbl_user_username']."' OR tbl_user_email='".$data['tbl_user_email']."'");
        $this->db->where("tbl_user_type","company");
        $duplicate =  $this->db->get('user')->row();

        if($duplicate == '')
        {
            $this->db->insert('user', $data);
            $insertId = $this->db->insert_id();
            /*$data3 = array( 
            
                'tbl_bank_user_id' => $insertId,
            );
            $data4 = array_merge($data2, $data3);
            print_r($data4); echo $insertId;*/
            if($this->db->affected_rows() > 0)
            {
               //echo "Prachi".$last_id = $this->db->insert_id(); exit;
                $counted = count($data2['tbl_bank_name']);
                //print_r($data4['tbl_bank_name'][0]);
                //exit;
                $newdata = array('');
                for ($i=0; $i < $counted; $i++) { 
                    # code...
                    $now = date("Y-m-d H:i:s");
                    $newdata = array(

                         
                         'tbl_bank_user_id' => $insertId,

                         'tbl_bank_name' => $data2['tbl_bank_name'][$i],

                         'tbl_bank_branch' => $data2['tbl_bank_branch'][$i],

                         'tbl_bank_acno'=> $data2['tbl_bank_acno'][$i],

                         'tbl_bank_ifsc'=> $data2['tbl_bank_ifsc'][$i],

                         'tbl_bank_ac_type'=> $data2['tbl_bank_ac_type'][$i],

                         'tbl_bank_user_type' => 'company',

                         'tbl_bank_inserted' => $now,

                    ); 
                    $this->db->insert('bank_details', $newdata);
                    //$insertId = 0;

                }

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

    public function select_all_company_data($id) {
        //$active = 'active';
        /*$this->db->where('tbl_master_status', $active);
        return $this->db->get('master')->row();*/
        /*$this->db->where('tbl_master_status','active');*/
        
        $this->db->where('tbl_user_master_id',$id);
        $this->db->where('tbl_user_type', 'company');
        $query=$this->db->get('user');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_all_company_data_view($id) {
        $this->db->select('user.tbl_user_name,user.tbl_user_username,user.tbl_user_aliasname,user.tbl_user_email,user.tbl_user_phone,user.tbl_user_billing_address,user.tbl_user_shipping_address,tbl_zone_name,tbl_state_name,tbl_city_name,tbl_zip_code,user.tbl_user_pan,user.tbl_user_gst,user.tbl_user_support_no,user.tbl_user_status,user.tbl_user_id,us.tbl_user_name as usname');
        $this->db->join('state', 'user.tbl_user_state = state.tbl_state_id','LEFT');
        $this->db->join('city', 'user.tbl_user_city = city.tbl_city_id','LEFT');
        $this->db->join('zone', 'user.tbl_user_zone = zone.tbl_zone_id','LEFT');
        $this->db->join('zip', 'user.tbl_user_zip = zip.tbl_zip_id','LEFT');
        $this->db->join('user us', 'user.tbl_user_company_id = us.tbl_user_id','LEFT');
        $this->db->where('user.tbl_user_master_id',$id);
        $this->db->where('user.tbl_user_type', 'company');
        $this->db->order_by('user.tbl_user_id', 'DESC');
        $query=$this->db->get('user');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_company_data($i) {
       $this->db->join('images', 'user.tbl_user_id = images.tbl_images_parent_id','LEFT');
        $this->db->where('tbl_images_type', 'company');
        $this->db->where('tbl_user_id',$i);
        $query=$this->db->get('user');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
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

    public function image_insert($images){
        $this->db->insert('images', $images);
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