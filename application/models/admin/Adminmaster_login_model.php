<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

/**

 * @name: Login model

 * @author: Imron Rosdiana

 */

class Adminmaster_login_model extends CI_Model

{

 

    function __construct() {

        parent::__construct();

        $this->load->database();



    }

 

    public function validate_user($data) {

        

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_admins.tbl_admins_id','LEFT');

        $this->db->where('tbl_admins_email', $data['email']);

        //$this->db->where('tbl_admins_password', md5($data['password']));

        $query =  $this->db->get('tbl_admins')->row();

        $error = '';

        if($query != '')

        {

            foreach ($query as $key => $value) {

                # code...

            //echo $key;

            if($key == 'tbl_admins_id')

            {

            

            $this->db->where('tbl_admins_id',$value);

            $this->db->where('tbl_admins_password', md5($data['password']));

            $querys =  $this->db->get('tbl_admins')->row();

            if($querys != '')

            {

                $error = 'login';

            }

            else

            {

                $error = 'pass';

            }



            break;

            }

           }

        }

        else

        {

            $error = 'email';

        }

       // echo $error;

       /* print_r($query);

       exit();*/

        return array('logindata' => $query, 'error' => $error);

        

    }

    public function validate_login_ip($data,$error) {

        

        //print_r($data);

        $now = date("Y-m-d H:i:s");

        /*$ip=$_SERVER['REMOTE_ADDR'];

        echo "IP address= $ip";*/



    

    $uip=$_SERVER['REMOTE_ADDR']; // get the user ip

    $browser="";

    if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("MSIE")))

    {

    $browser="Internet Explorer";

    }

    else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("Presto")))

    {

    $browser="Opera";

    }

    else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("CHROME")))

    {

    $browser="Google Chrome";

    }

    else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("SAFARI")))

    {

    $browser="Safari";

    }

    else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("FIREFOX")))

    {

    $browser="FIREFOX";

    }

    else

    {

    $browser="OTHER";

    }



//header("location:http://$host$uri/$extra")

        //exit();

    if($error == 'login')

    {

        $newerror = "Login Successfully";

    }

    else

    {

        $newerror = "Wrong Password";

    }

        

        $this->db->where('tbl_roles_id', $data['admin_type']);

        $query =  $this->db->get('tbl_roles');

        $result = $query->result();

        //echo $result[0]->tbl_roles_title;

        if($result[0]->tbl_roles_title == 'admin')

        {

            $adminoruser = 'tbl_login_history_admin_id';

        }

        else

        {

            $adminoruser = 'tbl_login_history_user_id';

        }

        //exit();

        $newdata = array($adminoruser => $data['id_admin'] ,'tbl_login_history_ip' => $uip,'tbl_login_history_login_from' => $browser,'tbl_login_history_result' => $newerror,'tbl_login_history_insertdate' => $now );



        $this->db->insert('tbl_login_history', $newdata);

        //return $query;

        

    }

 

    function __destruct() {

        $this->db->close();

    }

}