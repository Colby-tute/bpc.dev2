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
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('Login');
        }
		$this->load->model("smme/FacilityManagement_model");
		$this->load->database();
	}

	public function index()
	{
		$data['user_id'] = $this->session->userdata('id_user');
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$this->load->view('user/smme/facilities/viewBookings', $data);
	}

	public function getCategories()
	{
		$categories = $this->FacilityManagement_model->get_facility_categories();
		echo json_encode($categories);
	}

	public function getCategoryItems($category_id)
	{
		$category_items = $this->FacilityManagement_model->get_facility_category_items($category_id);
		echo json_encode($category_items);
	}

	public function getBookings() {
		$user_id = $this->input->post('user_id');
		$bookings = $this->FacilityManagement_model->get_facility_bookings($user_id);
		echo json_encode($bookings);
	}

	public function viewBookings()
	{
		$data['user_id'] = $this->session->userdata('id_user');
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$this->load->view('user/smme/facilities/viewBookings', $data);
	}

	public function createBooking()
	{
		$sql = "SELECT aa.incubator_id,u.tbl_users_id, u.tbl_users_firstname, u.tbl_users_lastname,u.tbl_users_contrycode, u.tbl_users_mobile, u.tbl_users_user_uniqueid, u.tbl_users_email FROM tbl_application_assignment aa, tbl_users u WHERE aa.incubator_id = u.tbl_users_id and aa.incubator_id is not null and aa.smme_id='".$this->session->userdata("id_user")."' GROUP BY u.tbl_users_id"; 
		$incubator = $this->db->query($sql)->result();
		$incubators = array_diff(array_column($incubator,'incubator_id'),[0]); 

		$categories = $incubators == null ? [] : $this->FacilityManagement_model->get_facility_categories($incubators);
		$data['categories'] = json_encode($categories);

		$data['user_id'] = $this->session->userdata('id_user');
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$this->load->view('user/smme/facilities/createBooking', $data);
	}

	public function submitCreateBooking()
	{
		$booking_data = array('facility_booking_user_id' => $this->input->post('user_id'),
				'facility_booking_name' => $this->input->post('title'),
				'facility_category_id' => $this->input->post('category'),
				'facility_item_id' => $this->input->post('item'),
				'facility_booking_from' => $this->input->post('start_date'),
				'facility_booking_to' => $this->input->post('end_date'));
		$booking = $this->FacilityManagement_model->add_facility_booking($booking_data);
		redirect('user/smme/FacilityManagement/viewBookings');
	}

	public function editBooking($booking_id)
	{
		$booking = $this->FacilityManagement_model->get_facility_booking($booking_id);
		$data['booking'] = $booking[0];
		$sql = "SELECT aa.incubator_id,u.tbl_users_id, u.tbl_users_firstname, u.tbl_users_lastname,u.tbl_users_contrycode, u.tbl_users_mobile, u.tbl_users_user_uniqueid, u.tbl_users_email FROM tbl_application_assignment aa, tbl_users u WHERE aa.incubator_id = u.tbl_users_id and aa.incubator_id is not null and aa.smme_id='".$this->session->userdata("id_user")."' GROUP BY u.tbl_users_id"; 
		$incubator = $this->db->query($sql)->result(); 
		$incubators = array_diff(array_column($incubator,'incubator_id'),[0]); 

		$categories = $incubators == null ? [] : $this->FacilityManagement_model->get_facility_categories($incubators);
		$data['categories'] = json_encode($categories);

		$data['user_id'] = $this->session->userdata('id_user');
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$this->load->view('user/smme/facilities/editBooking', $data);
	}

	public function submitEditBooking()
	{
		$user_id = $this->session->userdata('id_user');
		$booking_id = $this->input->post('booking_id');
		$booking_data = array('facility_booking_name' => $this->input->post('title'),
				'facility_category_id' => $this->input->post('category'),
				'facility_item_id' => $this->input->post('item'),
				'facility_booking_from' => $this->input->post('start_date'),
				'facility_booking_to' => $this->input->post('end_date'));
		$booking = $this->FacilityManagement_model->update_facility_booking($user_id, $booking_id, $booking_data);
		redirect('user/smme/FacilityManagement/viewBookings');
	}

	public function deleteBooking($booking_id)
	{
		$user_id = $this->session->userdata('id_user');
		$this->FacilityManagement_model->delete_facility_booking($booking_id, $user_id);
	}

	public function checkItemAvailability()
	{
		$item_id = $this->input->post('item_id');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');
		$overlappingBookings = $this->FacilityManagement_model->check_item_availability($item_id, $start_time, $end_time);
		echo json_encode($overlappingBookings);
	}
}
