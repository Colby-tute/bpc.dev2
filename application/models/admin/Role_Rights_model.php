<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

/**

 * @name: Login model

 * @author: Imron Rosdiana

 */

class Role_Rights_model extends CI_Model

{

 

    function __construct() {

        parent::__construct();

        $this->load->database();



    }

 

    public function insert_master($data) {

        //echo "<pre>";

        /*print_r($data);exit;*/

        $array = [];

        foreach ($data as $key => $value) {

            if (is_null($value)) {

                 $array[$key] = 0;

            }

            else

            {

                $array[$key] =$value;

            }

        }

        //print_r($array);

        //exit;

        $active = 'active';

        /*$this->db->where('tbl_master_email', $data['tbl_master_email']);

        $this->db->where('tbl_master_username', $data['tbl_master_username']);

        $this->db->where('tbl_master_status', $active);*/

        $this->db->where("tbl_access_type='".$array['tbl_access_type']."'");

        $duplicate =  $this->db->get('access_manager')->row();



       /* $

        $query = $this->db->get('Persons');*/



        //print_r($duplicate);exit;



        if($duplicate == '')

        {

            $this->db->insert('access_manager', $array);

            

            if($this->db->affected_rows() > 0)

            {

                // Code here after successful insert

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

            $this->db->where("tbl_access_type='".$array['tbl_access_type']."'");

            $this->db->update('access_manager', $array);

            $error = 2;

        }

        return $error;

        

        

        /*$this->db->where('tbl_master_email', $data['email']);

        $this->db->where('tbl_master_password', md5($data['password']));

        $this->db->where('tbl_master_status', $active);

        return $this->db->get('master')->row();*/

        

    }



    public function insert_master_child($array) {

        //echo "<pre>";
        //print_r($array);

           

               // print_r($newdata);}exit;

        $this->db->where("tbl_role_rights_role_id='".$array[0]['tbl_role_rights_role_id']."'");

        $duplicate =  $this->db->get('tbl_role_rights')->row();

 //print_r($duplicate);exit;

       if($duplicate == '')
        { 
            /*$this->db->insert('tbl_role_rights', $array);*/
            $count = count($array);
            for ($i=0; $i < $count; $i++) { 

                $newdata  = array(

                    'tbl_role_rights_role_id' => $array[$i]['tbl_role_rights_role_id'], 

                    'tbl_role_rights_page_name' => $array[$i]['tbl_role_rights_page_name'],

                    'tbl_role_rights_view' => $array[$i]['tbl_role_rights_view'],

                    'tbl_role_rights_add' => $array[$i]['tbl_role_rights_add'],

                    'tbl_role_rights_edit' => $array[$i]['tbl_role_rights_edit'],

                    'tbl_role_rights_delete' => $array[$i]['tbl_role_rights_delete'],

                    'tbl_role_rights_insertdate' => $array[$i]['tbl_role_rights_insertdate'],

                );

                $newddt = $this->db->insert('tbl_role_rights', $newdata);
                # code...
            }
            
            
                $error = 1; // to the controller

        } 
        else
        {
            $this->db->where("tbl_role_rights_role_id='".$array[0]['tbl_role_rights_role_id']."'");

            $this->db->delete('tbl_role_rights');

            if($this->db->affected_rows() > 0)

            {
                $count = count($array);
            for ($i=0; $i < $count; $i++) { 

                $newdata  = array(

                    'tbl_role_rights_role_id' => $array[$i]['tbl_role_rights_role_id'], 

                    'tbl_role_rights_page_name' => $array[$i]['tbl_role_rights_page_name'],

                    'tbl_role_rights_view' => $array[$i]['tbl_role_rights_view'],

                    'tbl_role_rights_add' => $array[$i]['tbl_role_rights_add'],

                    'tbl_role_rights_edit' => $array[$i]['tbl_role_rights_edit'],

                    'tbl_role_rights_delete' => $array[$i]['tbl_role_rights_delete'],

                    'tbl_role_rights_insertdate' => $array[$i]['tbl_role_rights_insertdate'],

                );

                    

                    $newddt = $this->db->insert('tbl_role_rights', $newdata);
                }  
                

                    $error = 1; // to the controller
            }
        }
        return $error;

       /* $this->db->where("tbl_role_rights_page_name='".$array['tbl_role_rights_page_name']."'");

        $this->db->where("tbl_role_rights_role_id='".$array['tbl_role_rights_role_id']."'");

        $duplicate =  $this->db->get('tbl_role_rights')->row();*/



       /*

        $query = $this->db->get('Persons');*/



       // print_r($duplicate);exit;



        /*if($duplicate == '')

        {            

            $this->db->insert('tbl_role_rights', $array);

            

            if($this->db->affected_rows() > 0)

            {

                // Code here after successful insert

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

            $this->db->where("tbl_role_rights_page_name='".$array['tbl_role_rights_page_name']."'");

            $this->db->where("tbl_role_rights_role_id='".$array['tbl_role_rights_role_id']."'");

            $this->db->delete('tbl_role_rights');

            if($this->db->affected_rows() > 0)

            {

                $this->db->insert('tbl_role_rights', $array);

            

                if($this->db->affected_rows() > 0)

                {

                    // Code here after successful insert

                    $error = 1; // to the controller

                }

                else

                {

                    $error = 0;

                }

            }

            $error = 2;

        }

        return $error;*/

        

        

        /*$this->db->where('tbl_master_email', $data['email']);

        $this->db->where('tbl_master_password', md5($data['password']));

        $this->db->where('tbl_master_status', $active);

        return $this->db->get('master')->row();*/

        

    }



    public function select_data($i) {

        //$active = 'active';

        /*$this->db->where('tbl_master_status', $active);

        return $this->db->get('master')->row();*/

        $this->db->where('tbl_access_type',$i);

        $query=$this->db->get('access_manager');

        $result=$query->result();

        $num_rows=$query->num_rows();

        $last_three_record=array_slice($result,-3,3,true);

        return $result;

        

    }

    public function select_data_peruser($i,$k,$index) {

        $get_data = '';

        if($index == 'index')

        {

            $get_data = 'tbl_role_rights_view';

        }

        elseif ($index == 'delete') 

        {

            $get_data = 'tbl_role_rights_delete';

        }

        elseif ($index == 'edit') 

        {

            $get_data = 'tbl_role_rights_edit';

        }

        elseif ($index == 'add') 

        {

            $get_data = 'tbl_role_rights_add';

        }

        else

        {

            $get_data = '*';

        }

        //$active = 'active';

        /*$this->db->where('tbl_master_status', $active);

        return $this->db->get('master')->row();*/

        $this->db->select($get_data);

        $this->db->where('tbl_role_rights_role_id',$i);

        $this->db->where('tbl_role_rights_page_name',$k);

        $query=$this->db->get('tbl_role_rights');

        $result=$query->result();

        $num_rows=$query->num_rows();

        $last_three_record=array_slice($result,-3,3,true);

        if($num_rows == 0)

        {

            return 0;

        }

        else

        {

            return $result;

        }

        

    }

    public function select_data_check_peruser($i) {

        

        $this->db->where('tbl_role_rights_role_id',$i);

        $query=$this->db->get('tbl_role_rights');

        $result=$query->result();

        $num_rows=$query->num_rows();

        $last_three_record=array_slice($result,-3,3,true);

        if($num_rows == 0)

        {

            return 0;

        }

        else

        {

            return $result;

        }

        

    }



    public function select_data_user($utype) {

        //echo $utype;exit;

       /* $this->db->where('tbl_access_type','employee');

        $duplicate =  $this->db->get('user_access_manager');

        $results=$duplicate->result();

*/

       

        $active = 'active';

        $this->db->where('tbl_employee_company_id',$utype);

        $query=$this->db->get('employee');

        $result=$query->result();

        $num_rows=$query->num_rows();

        $last_three_record=array_slice($result,-3,3,true);

        if($num_rows == 0)

        {

            $newuserdt = 0;

        }

        else

        {

            $newuserdt = '<label for="message-text-1" class="col-form-label">Select Particular User Give Access</label>';

            

            $newuserdt .= '<select class="form-control" id="childuser" name="childuser" required>

                                                        <option value="">Select</option>';

            //$i=0;

            foreach ($query->result() as $row)

           {



              $newuserdt .= '<option value="'.$row->tbl_employee_id.'">'.$row->tbl_employee_name.'</option>';

             //$i++;

           }

           $newuserdt .= '</select>';

           //print_r($newuserdt);exit;

            

        }

             $data['userdata'] = $newuserdt;

            

            //$this->load->view ('home', $data);

        return json_encode($data);

        

    }

    

    public function select_data_child_user($utype) {

       // echo $utype;//exit;

        $this->db->where("tbl_role_rights_role_id='".$utype."'");

        $duplicate =  $this->db->get('tbl_role_rights');

        $results=$duplicate->result();

        $num_rows=$duplicate->num_rows();

        if($num_rows == 0)

        {

            return 0;

        }

        else

        {   

            $data['editdata'] = $results;

            return json_encode($data);

            

        }

                         

            //$this->load->view ('home', $data);

        

        

    }



    public function select_data_roles($id) {

       // echo $utype;//exit;

        

        $duplicate =  $this->db->get('tbl_roles');

        $results=$duplicate->result();

        $num_rows=$duplicate->num_rows();

        if($num_rows == 0)

        {

            return 0;

        }

        else

        {   

            return $results;

            

        }

                         

            //$this->load->view ('home', $data);

        

        

    }



 



    function __destruct() {

        $this->db->close();

    }

}