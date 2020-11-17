<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Analytics model
 * @author: Imron Rosdiana
 */
class FacilityManagement_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();

    }
     
    //Get all active facilities
    public function get_facility_categories() {
        //SELECT * FROM tbl_facility_categories WHERE facility_category_is_deleted = 0
        $this->db->select('*');
        $this->db->where('tbl_facility_user_id', $this->session->userdata('id_user'));
        $this->db->where('facility_category_is_deleted', false);
        $result = $this->db->get('tbl_facility_categories')->result_array();
        return $result;
    }

    //Insert facility categories
    public function add_facility_category($category_name) {
        //INSERT INTO tbl_facility_categories(facility_category_name) VALUES ('Meeting Room')
        $this->db->insert('tbl_facility_categories',array('facility_category_name' => $category_name,'tbl_facility_user_id'=> $this->session->userdata('id_user')));
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //Update facility categories
    public function update_facility_category($category_id, $category_new_name) {
        //UPDATE tbl_facility_categories SET facility_category_name = "New" WHERE facility_category_id = 1
        $this->db->where('facility_category_id', $category_id);
        $this->db->update('tbl_facility_categories',array('facility_category_name' => $category_new_name));
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //Delete facility categories
    public function delete_facility_category($category_id) {
        //UPDATE tbl_facility_categories SET facility_category_is_deleted = 1 WHERE facility_category_id = 1
        $this->db->where('facility_category_id', $category_id);
        $this->db->update('tbl_facility_categories',array('facility_category_is_deleted' => true));
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //Get all active facility items
    public function get_facility_category_items($category_id) {
        //SELECT * FROM tbl_facility_items WHERE facility_item_is_deleted = 0
        $this->db->select('*');
        $this->db->where('facility_item_is_deleted = 0 AND facility_category_id = ' . $category_id);
        $result = $this->db->get('tbl_facility_items')->result_array();
        return $result;
    }

    //Insert facility items
    public function add_facility_item($category_id, $item_name) {
        //INSERT INTO tbl_facility_items(facility_category_id, facility_item_name) VALUES (1, 'MR 01')
        $this->db->insert('tbl_facility_items',array(
            'facility_item_name' => $item_name,
            'facility_category_id' => $category_id));
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //Update facility items
    public function update_facility_item($item_id, $item_new_name) {
        //UPDATE tbl_facility_items SET facility_item_name = "New" WHERE facility_item_id = 1
        $this->db->where('facility_item_id', $item_id);
        $this->db->update('tbl_facility_items',array('facility_item_name' => $item_new_name));
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //Delete facility items
    public function delete_facility_item($item_id) {
        //UPDATE tbl_facility_items SET facility_item_is_deleted = 1 WHERE facility_item_id = 1
        $this->db->where('facility_item_id', $item_id);
        $this->db->update('tbl_facility_items',array('facility_item_is_deleted' => true));
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //Get all active facility bookings
    public function get_facility_bookings() {
        //SELECT * FROM tbl_facility_bookings WHERE facility_booking_is_deleted = 0
        $this->db->select('*');
        $this->db->where('facility_booking_is_deleted', false);
        $result = $this->db->get('tbl_facility_bookings')->result_array();
        return $result;
    }


    function __destruct() {
        $this->db->close();
    }

}