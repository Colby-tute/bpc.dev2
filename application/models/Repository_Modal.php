<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name: Repository model
 * @author: Manoj Kumawat
 */

date_default_timezone_set('Africa/Johannesburg');

class Repository_Modal extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getFolders($ids = null,$user = null,$type = null){
		if($ids == null ){
			return $this->db->get('tbl_repository')->result();
		}
		if($type == true){
			$lists = array_column($ids,"incubator_id");

			$folders = $this->db->select('tbl_folder_id')->where('tbl_user_id',$user)->where_in('tbl_owner_id',$lists)->get('tbl_repository_users')->result();
			if(count($folders) > 0){
				return $this->db->where_in('tbl_id',array_column($folders,"tbl_folder_id"))->get('tbl_repository')->result();
			}
			return [];
		}

		return $this->db->where('tbl_user_id',$ids)->get('tbl_repository')->result();
	}

	public function getFolder($id){
		return $this->db->where('tbl_id',$id)->get('tbl_repository')->row();
	}

	public function getFile($id){
		return $this->db->where('tbl_id',$id)->get('tbl_folder_files')->row();
	}

	public function getFiles($id){
		return $this->db->where('tbl_folder_id',$id)->get('tbl_folder_files')->result();
	}

	public function insert($data,$table){
		$this->db->insert($table, $data);
		return $this->db->affected_rows();
	}

	public function update($where,$value,$data,$table){
		$this->db->where($where, $value);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function delete($data,$table){
		$this->db->where($data)->delete($table);
		return $this->db->affected_rows();
	}

	public function getAssignedUser($id)
	{
		return $this->db->where('tbl_owner_id',$id)->get('tbl_repository_users')->result();
	}

}
