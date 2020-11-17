<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Broadcast model
 * @author: Imron Rosdiana
 */
class Broadcast_model extends CI_Model
{

 
    function __construct() {
        parent::__construct();
        $this->load->database();

    }

    public function getMessage($id){
        $result = $this->db->where('tbl_broadcaster_id',$id)->get('tbl_broadcast');
        return $result->result();
    }   

    public function insertBroadcastMessage($data)
    {
        if($data['tbl_broadcast_expiry'] == ''){
            $data['tbl_broadcast_expiry'] = null;
        }
        $this->db->insert('tbl_broadcast',$data);
        if($this->db->affected_rows() > 0)
        {
            return 1; 
        }
        else
        {
            return 0;
        }
    }
    public function updateBroadcastMessage($id,$message){
        $result = $this->db->where('tbl_broadcast_id',$id)->update('tbl_broadcast',['tbl_broadcast_message'=>$message]);
        if($result == 1)
        {
            return 1; 
        }
        else
        {
            return 0;
        }
    }
    public function deleteBroadcastMessage($data)
    {
        if($this->db->delete('tbl_broadcast',$data) == 1)
        {
            return 1; 
        }
        else
        {
            return 0;
        }
    }

}