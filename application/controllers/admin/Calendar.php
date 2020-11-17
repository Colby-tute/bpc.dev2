<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

/**

 * @name Home.php

 * @author Imron Rosdiana

 */

date_default_timezone_set('Africa/Johannesburg');

class Calendar extends MY_Controller

{

 

    function __construct() {

        parent::__construct();

       
        $this->load->database();
        $this->load->model("smme/Calender_Modal");
        $this->load->helper('email_service');
    }

    public function index()
    {

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
        $data['events'] = json_encode($this->get_events());
		//echo '<pre>'; print_r($data['events']); exit;

        $this->load->view('admin/calendar/index',$data);

    }

    public function get_events()
    {
         $this->db->select("*");
         $this->db->where("user_id", $this->session->userdata("id_admin"));
         $events = $this->db->get("tbl_admin_event");

         $colors = [
                "Meeting" => 
                [
                    "backgroundColor" => '#bff2f2',
                    "borderColor" => '#00cccc',
                    "textColor" => '#00cccc'
                ],
                "Training" => 
                [
                    "backgroundColor" => '#e0e4f4',
                    "borderColor" => '#0a2ba5',
                    "textColor" => '#0a2ba5',
                ],
                "Feedback" =>
                [
                    "backgroundColor" => '#ffd5cc',
                    "borderColor" => '#ff5733',
                    "textColor" => '#ff5733',
                ],
                "Workshop" => 
                [
                    "backgroundColor" => '#d2e0ff',
                    "borderColor" => '#0373f3',
                    "textColor" => '#0373f3',
                ],
                "One on One" =>
                [
                    "backgroundColor" => '#bfdeff',
                    "borderColor" => '#007bff',
                    "textColor" => '#007bff',
                ],
                "Evaluation" =>
                [
                    "backgroundColor" => '#d5c2f3',
                    "borderColor" => '#560bd0',
                    "textColor" => '#560bd0',
                ],
                "Assessment" => 
                [
                    "backgroundColor" => '#bff2f2',
                    "borderColor" => '#00cccc',
                    "textColor" => '#00cccc'
                ],
        ];  

        $meetings = ["id" => 1];
        $training = ["id" => 2];
        $feedback = ["id" => 3];
        $workshop = ["id" => 4];
        $one_on_one = ["id" => 5];
        $evaluation = ["id" => 6];
        $assessment = ["id" => 7];

         foreach($events->result() as $key => $r) {

            $this->db->select("*");
            $this->db->where("tbl_users_id", $r->incubator_id);
            $query = $this->db->get("tbl_users");
            $inc = $query->result();

            $this->db->select("*");
            $this->db->where("tbl_users_id", $r->smme_id);
            $query = $this->db->get("tbl_users");
            $smme = $query->result();

            $this->db->select("*");
            $this->db->where("tbl_users_id", $r->bdsp_id);
            $query = $this->db->get("tbl_users");
            $bdsp = $query->result();

            $event = array(
                 "id" => $r->id,
                 "title" => str_replace("'", "***", $r->title),
                 "description" => str_replace("'", "***", $r->description),
                 "end" => $r->end_date,
                 "start" => $r->start_date,
                 "address" => $r->address,
                 "inc" => isset($inc[0]) ? $inc[0]->tbl_users_firstname . " " . $inc[0]->tbl_users_lastname : "",
                 "smme" => isset($smme[0]) ? $smme[0]->tbl_users_firstname . " " . $smme[0]->tbl_users_lastname : "",
                 "bdsp" => isset($bdsp[0]) ? $bdsp[0]->tbl_users_firstname . " " . $bdsp[0]->tbl_users_lastname : "",
                 
             );

            foreach ($colors[$r->type] as $key => $value) {
                $event[$key] = $value;
            }
			
			//echo $r->type.",";

            if ($r->type == "Meeting") {
               $meetings['events'][] = (object)$event;
            } elseif ($r->type == "Training") {
               $training['events'][] = (object)$event;
            } elseif ($r->type == "Feedback") {
               $feedback['events'][] = (object)$event;
            } elseif ($r->type == "Workshop") {
               $workshop['events'][] = (object)$event;
            } elseif ($r->type == "One on One") {
               $one_on_one['events'][] = (object)$event;
            } elseif ($r->type == "Evaluation") {
               $evaluation['events'][] = (object)$event;
            } elseif ($r->type == "Assessment") {
               $assessment['events'][] = (object)$event;
            }
         }
		 
		 //exit;
		 
         return [$meetings, $training, $feedback, $workshop, $one_on_one, $evaluation, $assessment];
    }

    public function delete($id) 
    {
        $this->db->where("id", $id);
        $this->db->delete("tbl_admin_event");
        redirect("admin/Calendar");
    }

    public function edit($event_id) 
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->db->where("id", $event_id);
            $this->db->update("tbl_admin_event", $_POST);
            redirect("admin/Calendar");
        }        
        $data['event_id'] = $event_id;
        $this->db->select("tbl_users_id, tbl_users_role_id, tbl_users_firstname, tbl_users_lastname");
        $query = $this->db->get("tbl_users");
        $res = $query->result();

        $data['smmes'] = [];
        $data['bdsp'] = [];
        $data['inc'] = [];

        if ($res) {
            foreach ($res as $r) {
                $this->db->select("tbl_users_id as id, tbl_users_role_id as role_id, tbl_users_firstname as name, tbl_users_lastname as last_name");
                $this->db->where("tbl_users_id={$r->tbl_users_id}");
                $user = $this->db->get("tbl_users")->result()[0];

                if ($r->tbl_users_role_id == 2) {
                    $data['smmes'][] = $r;
                }
                if ($r->tbl_users_role_id == 3) {
                    $data['inc'][] = $r;
                }
                if ($r->tbl_users_role_id == 4) {
                    $data['bdsp'][] = $r;
                }
            }
        }

        $this->db->select("*");
        $this->db->where("id", $event_id);
        $data['model'] = $this->db->get("tbl_admin_event")->result()[0];

        $data['user_id'] = $this->session->userdata("id_admin");
        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

         $this->load->view('admin/calendar/edit',$data);       
    }

    public function create() 
    {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if($this->input->post('title') == '' || $this->input->post('address') == '' || $this->input->post('description') == ''){
                $this->session->set_flashdata('danger','Please fill all fields.');
                return redirect(site_url("admin/Calendar/create"));
            }
            $users = [$_POST['smme_id'],$_POST['bdsp_id'],$_POST['incubator_id']];
            $this->db->insert("tbl_admin_event", $_POST);
            foreach($users as $user){
                $user = $this->db->where('tbl_users_id',$user)->get('tbl_users')->row();
                $owner = $this->db->where('tbl_admins_id',$this->session->userdata('id_admin'))->get('tbl_admins')->row();
                $process_key = "admin_create_calender_event";
                $emailData = $this->db->where('process_key',$process_key)->get('tbl_emails')->row();
                $data['title'] = $emailData->subject;
                $keys = [
                        '[name_to]' => $user->tbl_users_firstname .' ' . $user->tbl_users_lastname,
                        '[name_from]' => $owner->tbl_admins_firstname .' ' . $owner->tbl_admins_lastname,
                    ];
                $content = do_shortcodes($emailData->message,$keys);
                email_send($user->tbl_users_email,$emailData->subject,$emailData->subject,$content);
                email_logs($user->tbl_users_id,$emailData->subject);
            }
            redirect("admin/Calendar");
        }
        
        $this->db->select("*");
        $query = $this->db->get("tbl_users");
        $res = $query->result();

        $data['smmes'] = [];
        $data['bdsp'] = [];
        $data['inc'] = [];

        if ($res) {
            foreach ($res as $r) {
               /* $this->db->select("tbl_users_id as id, tbl_users_role_id as role_id, tbl_users_firstname as name, tbl_users_lastname as last_name");
                $this->db->where("tbl_users_id={$r->tbl_users_id}");
                $user = $this->db->get("tbl_users")->result()[0];*/

                if ($r->tbl_users_role_id == 2) {
                    $data['smmes'][] = $r;
                }
                if ($r->tbl_users_role_id == 3) {
                    $data['inc'][] = $r;
                }
                if ($r->tbl_users_role_id == 4) {
                    $data['bdsp'][] = $r;
                }
            }
        }

        $data['user_id'] = $this->session->userdata("id_admin");
        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $this->load->view('admin/calendar/create',$data);       
    }

}