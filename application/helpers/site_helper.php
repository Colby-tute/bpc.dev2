<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('count_unread_message')) {
  function count_unread_message($user) {
    $CI = & get_instance();
    // $CI->db->select("incubator_id");
    // $CI->db->where($user, $CI->session->userdata("id_user"));
    // $idData = $CI->db->get("tbl_application_assignment")->result_array();

    if($user == "bdsp_id"){
      $CI->db->distinct("tbl_application_incubator_id as id");
      $CI->db->select("tbl_application_incubator_id as id, incubator_id");
      $CI->db->join("tbl_application_assignment as aa", "tbl_application.tbl_application_id=aa.app_id", "LEFT");
      $CI->db->where("tbl_application_bdsp_id='{$CI->session->userdata('id_user')}'");
      $CI->db->where("aa.incubator_id IS NOT NULL");
      $query = $CI->db->get("tbl_application");
      $incubators = $query->result();

      foreach ($incubators as $pair) {
        $CI->db->select("*");
        $CI->db->where("tbl_users_id = '{$pair->id}' OR tbl_users_id='{$pair->incubator_id}'");
        $query = $CI->db->get("tbl_users");
        $users = $query->result();
        $data['incubators'][] = $users[0];
      }

      if(count($incubators) > 0){
        $ids = array_column($data['incubators'],'tbl_users_id');
        $ids = array_merge($ids,get_admin_users());
      }else{
        $ids = get_admin_users();
      }
      
    }
    else if($user == "smme_id"){
      $sql = "SELECT aa.incubator_id,u.tbl_users_id, u.tbl_users_firstname, u.tbl_users_lastname,u.tbl_users_contrycode, u.tbl_users_mobile, u.tbl_users_user_uniqueid, u.tbl_users_email FROM tbl_application_assignment aa, tbl_users u WHERE aa.incubator_id = u.tbl_users_id and aa.incubator_id is not null and aa.smme_id=".$CI->session->userdata("id_user"); 
      $incubator = $CI->db->query($sql)->result(); 
      if(count($incubator) > 0){
        $ids = array_column($incubator,'incubator_id');
        $ids = array_merge($ids,get_admin_users());
      }else{
        $ids = get_admin_users();
      }
    }
    else if($user == "incubator_id"){
      $ids = get_admin_users();
    }else{
      $ids = [];
    }
    if(count($ids) != 0){
      $result = $CI->db->where_in('tbl_broadcaster_id',$ids)->order_by('tbl_broadcast_id','desc')->get('tbl_broadcast');
      $unreadMessage = [];
      foreach($result->result() as $item){
        if(date("Y-m-d H:i",strtotime($item->tbl_broadcast_expiry)) > date('Y-m-d H:i') || $item->tbl_broadcast_expiry == ''){
          if($CI->db->where(['tbl_broadcast_message_id'=>$item->tbl_broadcast_id,'tbl_broadcast_user_id'=>$CI->session->userdata("id_user")])->get('tbl_broadcast_read_count')->num_rows() == 0){
            $unreadMessage[] = $item;
          }
        }
      }
    }
    if($unreadMessage >0){
      return count($unreadMessage);
    }else{
      return false;
    }
  }
}

if ( ! function_exists('get_admin_users')) {
  function get_admin_users() {
    $CI = & get_instance();
    $CI->db->where("tbl_admins_roleid", 1);
    $result = $CI->db->get("tbl_admins")->result_array();
    return array_column($result,"tbl_admins_id");
  }
}

if (! function_exists('getMessage')) {
  function getMessage($process_key)
  {
      $CI = $CI =& get_instance();
      $e = $CI->db->get_where('tbl_emails', array('process_key'=>$process_key));

      if ($e->num_rows()>0) {
          $data['message'] = $e->row()->message;
          $data['subject'] = $e->row()->subject;
      } else {
          $data['message'] = "";
          $data['subject'] = "";
      }
      return $data;
  }
  
}

if (! function_exists('do_shortcodes')) {
  function do_shortcodes($message,$keys)
  {
      foreach ($keys as $key => $value) {
         $message = str_replace($key,$value,$message);
      }
      return $message;
  }
}

if (! function_exists('email_logs')) {
  function email_logs($user_id,$subject)
  {
      $CI = $CI =& get_instance();
      $CI->db->insert('tbl_email_logs', array('tbl_user_id'=>$user_id,'tbl_subject'=>$subject,'tbl_log_date'=> date('Y-m-d H:i:s')));
  }
  
}

if (! function_exists('event_log_count')) {
  function event_log_count()
  {   
    $CI = $CI =& get_instance();
    $user = $CI->session->userdata("id_user");
    $date = date("Y-m-d H:i:s", strtotime("-7 days"));
    //$date = date("Y-m-d H:i:s");
    $result = $CI->db->where('tbl_user_id',$user)->where('tbl_log_date >=',$date)->get('tbl_email_logs')->result();
    return $result;
  }
}

if (! function_exists('user_status')) {
  function user_status($id)
  {   
    $CI = $CI =& get_instance();
    $result = $CI->db->where('id',$id)->get('tbl_stages')->row('stage');
    return $result;
  }
}

if (! function_exists('is_terms_accepted')) {
  function is_terms_accepted()
  {   
    $CI = $CI =& get_instance();
    $id = $CI->session->userdata("id_user");
    $result = $CI->db->where('tbl_users_id',$id)->get('tbl_users')->row('is_terms_accepted');
    return $result;
  }
}
if (! function_exists('check_repository_assigned')) {
  function check_repository_assigned($folder)
  {   
    $CI = $CI =& get_instance();
    $id = $CI->session->userdata("id_user");
    $role = $CI->session->userdata("user_type");

    if($role == 2){
      $sql = "SELECT aa.incubator_id,u.tbl_users_id, u.tbl_users_firstname, u.tbl_users_lastname,u.tbl_users_contrycode, u.tbl_users_mobile, u.tbl_users_user_uniqueid, u.tbl_users_email FROM tbl_application_assignment aa, tbl_users u WHERE aa.incubator_id = u.tbl_users_id and aa.incubator_id is not null and aa.smme_id='".$id."' GROUP BY u.tbl_users_id"; 
      $incubator = $CI->db->query($sql)->result();
    }
    if($role == 4){
      $CI->db->distinct("tbl_application_incubator_id as id");
      $CI->db->select("tbl_application_incubator_id as id, incubator_id");
      $CI->db->join("tbl_application_assignment as aa", "tbl_application.tbl_application_id=aa.app_id", "LEFT");
      $CI->db->where("tbl_application_bdsp_id='{$CI->session->userdata('id_user')}'");
      $CI->db->where("aa.incubator_id IS NOT NULL");
      $query = $CI->db->get("tbl_application");
      $incubator = $query->result();
    }
    
    $lists = array_column($incubator,"incubator_id");

    $folders = $CI->db->select('tbl_folder_id')->where('tbl_user_id',$id)->where_in('tbl_owner_id',$lists)->get('tbl_repository_users')->result();
    if(count($folders) > 0 && in_array($folder,array_column($folders,"tbl_folder_id"))){
      return true;
    }else{
      return false;
    }
  }
}


if(!function_exists("repositoryFilesCount")){
  function repositoryFilesCount($id){
    $CI = $CI =& get_instance();
    return $CI->db->where('tbl_folder_id',$id)->get('tbl_folder_files')->num_rows();
  }
}