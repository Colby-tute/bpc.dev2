<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class Management extends MY_Controller
{

	function __construct() {
		parent::__construct();

		if(empty($this->session->userdata('id_user'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('Login');
		}
		$this->load->database();
	}

	public function index()
	{
		$this->db->select('tbl_board_title as title, tbl_board_title as id, tbl_board_id as brd_id');
		$this->db->where('tbl_board_smme_unique_id', $this->session->userdata('id_user'));
		$query = $this->db->get("tbl_board");
		$data['boards'] = $query->result();

		for ($i = 0; $i < count($data['boards']); $i++) {

			$this->db->select('tbl_boardlist_title as title, tbl_boardlist_title as id');
			$this->db->where('tbl_boardlist_board_id', $data['boards'][$i]->brd_id);
			$this->db->order_by("tbl_boardlist_index ASC");
			$query = $this->db->get("tbl_boardlist");
			$items = $query->result();

			$boardItems = [];
			foreach ($items as $item) {
				$boardItems[] = [
					"id" => $item->id,
					"title" => $item->title
				];
			}

			$data['boards'][$i]->item = $boardItems;
		}

		$data['boards'] = json_encode($data['boards']);
		$data['smme_id'] = $this->session->userdata('id_user');

		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$this->load->view('user/smme/management/index',$data);
	}

	public function orderElements()
	{
		$this->db->select('tbl_board_id as id');
		$this->db->where('tbl_board_title', $_POST['boardId']);
		$query = $this->db->get("tbl_board");
		$board = $query->result();

		foreach ($_POST['order'] as $key => $item) {
			$this->db->where("tbl_boardlist_title='{$item}'");
			$this->db->update("tbl_boardlist", [
				"tbl_boardlist_board_id" => $board[0]->id,
				"tbl_boardlist_index" => $key + 1
			]);
		}
	}
}
