	<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class FacilityManagement extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
        if(empty($this->session->userdata('id_admin'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('admin/masterlogin');
        }
		$this->load->model("admin/FacilityManagement_model");
		$this->load->database();
	}

	public function index()
	{
		//$categories = $this->FacilityManagement_model->get_facility_categories();
		//$data['categories'] = $categories;
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
		$this->load->view('admin/facilities/viewCategories', $data);
	}

	public function getCategories()
	{
		$categories = $this->FacilityManagement_model->get_facility_categories();
		echo json_encode($categories);
	}

	public function createCategory()
	{
		$category_name =  $this->input->post('category_name');
		$this->FacilityManagement_model->add_facility_category($category_name);
	}

	public function updateCategory()
	{
		$category_id =  $this->input->post('category_id');
		$category_new_name  =  $this->input->post('category_new_name');
		$this->FacilityManagement_model->update_facility_category($category_id, $category_new_name);
	}

	public function deleteCategory($category_id)
	{
		$this->FacilityManagement_model->delete_facility_category($category_id);
	}

	public function viewCategoryItems($category_id)
	{
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
		$data['category_id'] = $category_id;
		$this->load->view('admin/facilities/viewCategoryItems', $data);
	}

	public function getCategoryItems($category_id)
	{
		$category_items = $this->FacilityManagement_model->get_facility_category_items($category_id);
		echo json_encode($category_items);
	}

	public function createCategoryItem()
	{
		$item_name =  $this->input->post('item_name');
		$category_id =  $this->input->post('category_id');
		$this->FacilityManagement_model->add_facility_item($category_id, $item_name);
	}

	public function updateCategoryItem()
	{
		$item_id =  $this->input->post('item_id');
		$item_new_name  =  $this->input->post('item_new_name');
		$this->FacilityManagement_model->update_facility_item($item_id, $item_new_name);
	}

	public function deleteCategoryItem($item_id)
	{
		$this->FacilityManagement_model->delete_facility_item($item_id);
	}
}
