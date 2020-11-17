<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Board extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function save($data)
	{
		$this->db->insert('tbl_board', $data);
	}

	function __destruct()
	{
		$this->db->close();
	}
}
