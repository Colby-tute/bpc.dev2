<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Login_Modal extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();

    }
    
    public function validate_user($data) {

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_email', $data['email']);
        //$this->db->where('tbl_users_password', md5($data['password']));
        $query =  $this->db->get('tbl_users')->row();

        $error = '';
        if($query != '')
        {
            foreach ($query as $key => $value) {
                # code...
            //echo $key;
            if($key == 'tbl_users_id')
            {
            
            $this->db->where('tbl_users_id',$value);
            $this->db->where('tbl_users_password', md5($data['password']));
            $querys =  $this->db->get('tbl_users')->row();
            if($querys != '')
            {
                $_SESSION['user_id']= $value;
                $error = 'Login Successfully';
            }
            else
            {
                $error = 'Password Wrong';
            }

            break;
            }
           }
        }
        else
        {
            $error = 'Email Wrong';
        }

        return array('logindata' => $query, 'error' => $error);
    }

    public function validate_login_ip($data,$error) {

        $now = date("Y-m-d H:i:s");
    
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

        $this->db->where('tbl_roles_id', $data['user_type']);
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
        $newdata = array($adminoruser => $data['id_user'] ,'tbl_login_history_ip' => $uip,'tbl_login_history_login_from' => $browser,'tbl_login_history_result' => $error,'tbl_login_history_insertdate' => $now );

        $this->db->insert('tbl_login_history', $newdata);
    }

    function __destruct() {
        $this->db->close();
    }

}