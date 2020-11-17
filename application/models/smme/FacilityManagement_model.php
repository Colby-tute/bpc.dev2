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
    public function get_facility_categories($ids = null) {
        $this->db->select('*');
        $this->db->where('facility_category_is_deleted', false);
        $this->db->where_in('tbl_facility_user_id', $ids);
        $result = $this->db->get('tbl_facility_categories')->result_array();
        return $result;
    }

    //Get all active facility items
    public function get_facility_category_items($category_id) {
        //SELECT * FROM tbl_facility_items WHERE facility_item_is_deleted = 0
        $this->db->select('*');
        $this->db->where('facility_item_is_deleted = 0 AND facility_category_id = ' . $category_id);
        $result = $this->db->get('tbl_facility_items')->result_array();
        return $result;
    }

    //Get all active facility bookings
    public function get_facility_bookings($user_id) {
        //SELECT * FROM tbl_facility_bookings WHERE facility_booking_is_deleted = 0
        $query = $this->db->query("SELECT
            concat(u.tbl_users_firstname,' ',u.tbl_users_lastname) as user_name,
            fc.facility_category_name,
            fi.facility_item_name,
            fb.*
        FROM
            tbl_facility_bookings fb,
            tbl_users u,
            tbl_facility_items fi,
            tbl_facility_categories fc
        WHERE
            fb.facility_booking_user_id = u.tbl_users_id 
            AND fi.facility_category_id = fc.facility_category_id 
            AND fb.facility_item_id = fi.facility_item_id 
            AND fb.facility_category_id = fc.facility_category_id
            AND fb.facility_booking_is_deleted = 0
            AND u.tbl_users_id = " . $user_id);
        $result = $query->result();
        //$this->db->select('*');
        //$this->db->where('facility_booking_user_id = ' . $user_id . ' AND facility_booking_is_deleted = 0');
        //$result = $this->db->get('tbl_facility_bookings')->result_array();

        return $result;
    }

    //Get info of a facility bookings
    public function get_facility_booking($booking_id) {
        //SELECT * FROM tbl_facility_bookings WHERE facility_booking_id = 1
        $this->db->select('*');
        $this->db->where('facility_booking_id = ' . $booking_id . ' AND facility_booking_is_deleted = 0');
        $result = $this->db->get('tbl_facility_bookings')->result_array();

        return $result;
    }

    //Insert facility booking
    public function add_facility_booking($booking_data) {
        //INSERT INTO tbl_facility_bookings(facility_booking_id, facility_item_id, facility_category_id, facility_booking_user_id, facility_booking_name, facility_booking_from, facility_booking_to) VALUES (1, 1, 1, 'Test', '2020-02-02 00:00:00', '2020-02-02 02:00:00')
        $this->db->insert('tbl_facility_bookings', $booking_data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //Update facility booking
    public function update_facility_booking($user_id, $booking_id, $booking_data) {
        $this->db->where('facility_booking_id = ' . $booking_id . ' AND facility_booking_user_id = ' . $user_id);
        $this->db->update('tbl_facility_bookings', $booking_data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //Delete facility booking
    public function delete_facility_booking($booking_id, $user_id) {
        $this->db->where('facility_booking_id = ' . $booking_id . ' AND facility_booking_user_id = ' . $user_id);
        $this->db->update('tbl_facility_bookings', array('facility_booking_is_deleted' => true));
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    //Check availability of facility items
    public function check_item_availability($item_id, $start_time, $end_time) {
        $query = $this->db->query("SELECT fb.*
                                FROM
                                    tbl_facility_bookings fb
                                 WHERE
                                 fb.facility_booking_from <= '" . $end_time ."'
                                 AND fb.facility_booking_to >= '" . $start_time ."'
                                 and fb.facility_item_id = " . $item_id ."
                                 and fb.facility_booking_is_deleted = 0");
        $result = $query->result();
        return $result;
    }

    function __destruct() {
        $this->db->close();
    }

}