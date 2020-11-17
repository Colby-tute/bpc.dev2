<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

/**

 * @name Home.php

 * @author Imron Rosdiana

 */

date_default_timezone_set('Africa/Johannesburg');

class Calender extends MY_Controller

{

    function __construct() {

        parent::__construct();

        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->database();
        $this->load->model("smme/Calender_Modal");
        $this->load->helper("email_service");
    }

    

    public function index()
    {

          // Our Start and End Dates
         /*$start = $this->input->get("start");
         $end = $this->input->get("end");

         $startdt = new DateTime('now'); // setup a local datetime
         $startdt->setTimestamp($start); // Set the date based on timestamp
         $start_format = $startdt->format('Y-m-d H:i:s');

         $enddt = new DateTime('now'); // setup a local datetime
         $enddt->setTimestamp($end); // Set the date based on timestamp
         $end_format = $enddt->format('Y-m-d H:i:s');

         $events = $this->Calender_Modal->get_events($start_format = '', $end_format='');


         $data_events = array();

         foreach($events->result() as $r) {

             $data_events[] = array(
                 "id" => $r->tbl_calender_id,
                 "title" => $r->tbl_calender_title,
                 "end" => $r->tbl_calender_end_datetime,
                 "start" => $r->tbl_calender_start_datetime
             );
         }
        //print_r($data_events);exit();
         //echo json_encode(array("events" => $data_events));
         //exit();
         $data['newdata'] = $data_events;

        

        //$this->load->view ('home', $data);

        /*$smme = $this->Calender_Modal->select_all_smme_data_view();

        $data['smme'] = $smme;

        $bdsp = $this->Calender_Modal->select_all_bdsps_data_view();

        $data['bdsp'] = $bdsp;

        $inc = $this->Calender_Modal->select_all_incubators_data_view();

        $data['inc'] = $inc;*/

       /* $datad['d'] = $result;

        $datad['dd'] = $this->session->userdata('user_id');*/

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $data['events'] = json_encode($this->get_events());

        $this->load->view('user/smme/calender/index',$data);

    }

    public function get_events()
    {
         //$this->db->select("*");
         //$this->db->where("user_id", $this->session->userdata("id_user"));
         //$events = $this->db->get("tbl_smme_event");
     
    $this->db->select("*");
         $this->db->where("smme_id", $this->session->userdata("id_user"));
         //$events = $this->db->get("tbl_admin_event");
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
    
    //print_r($events->result()); exit;

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
         //echo "<pre>"; print_r($event); exit();
         return [$meetings, $training, $feedback, $workshop, $one_on_one, $evaluation, $assessment];

        /*$smme_id = $this->session->userdata("id_user");
        $query = $this->db->query("(
                SELECT
                    id,
                    smme_id,
                    bdsp_id,
                    incubator_id,
                    title,
                    description,
                    address,
                    start_date,
                    end_date,
                    type,
                    FALSE AS is_owner
                FROM
                    tbl_admin_event
                WHERE
                    smme_id = " . $smme_id . "
            )
            UNION
                (
                SELECT
                    id,
                    smme_id,
                    user_id AS bdsp_id,
                    incubator_id,
                    title,
                    description,
                    address,
                    start_date,
                    end_date,
                    type,
                    FALSE AS is_owner
                FROM
                    tbl_bdsp_event
                WHERE
                    smme_id = " . $smme_id . "
            )
            UNION
                (
                SELECT
                    id,
                    smme_id,
                    bdsp_id,
                    user_id AS incubator_id,
                    title,
                    description,
                    address,
                    start_date,
                    end_date,
                    type,
                    FALSE AS is_owner
                FROM
                    tbl_incubator_event
                WHERE
                    smme_id = " . $smme_id . "
            )
            UNION
                (
                SELECT
                    id,
                    user_id AS smme_id,
                    bdsp_id,
                    incubator_id,
                    title,
                    description,
                    address,
                    start_date,
                    end_date,
                    type,
                    TRUE AS is_owner
                FROM
                    tbl_smme_event
                WHERE
                    user_id = " . $smme_id . "
            )");
        $events = $query->result();

         $meetings = array();
         $training = array();
         $feedback = array();
         $workshop = array();
         $one_on_one = array();
         $assessment = array();
         $evaluation = array();

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
         foreach($events as $key => $r) {

            $this->db->select("*");
            $this->db->where("tbl_users_id", $r->incubator_id);
            $query = $this->db->get("tbl_users");
            $inc = $query->result();

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
                 "inc" => isset($inc[0]) ? str_replace("'", "***", $inc[0]->tbl_users_firstname . " " . $inc[0]->tbl_users_lastname) : "",
                 "bdsp" => isset($bdsp[0]) ? str_replace("'", "***", $bdsp[0]->tbl_users_firstname . " " . $bdsp[0]->tbl_users_lastname) : "",
                 "is_owner" => $r->is_owner
             );

            foreach ($colors[$r->type] as $key => $value) {
                $event[$key] = $value;
            }



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
        
         return [$meetings, $training, $feedback, $workshop, $one_on_one, $evaluation, $assessment];*/
    }

    public function delete($id) 
    {
        $this->db->where("id", $id);
        $this->db->delete("tbl_admin_event");
        redirect("user/smme/Calender");
    }

    public function edit($event_id) 
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->db->where("id", $event_id);
            $this->db->update("tbl_admin_event", $_POST);
            redirect("user/smme/Calender");
        }        

        $this->db->select("incubator_id, bdsp_id");
        $this->db->where("aa.smme_id", $this->session->userdata("id_user"));
        $query = $this->db->get("tbl_application_assignment as aa");
        $res = $query->result();

        $data['inc'] = [];
        $data['bdsp'] = [];
        if ($res) {
            foreach ($res as $r) {

                $id = $r->incubator_id == null ? $r->bdsp_id : $r->incubator_id;

                $this->db->select("tbl_users_id as id, tbl_users_role_id as role_id, tbl_users_firstname as name, tbl_users_lastname as last_name");
                $this->db->where("tbl_users_id={$id}");
                $user = $this->db->get("tbl_users")->result()[0];

                if ($user->role_id == 3) {
                    $data['inc'][] = $user;
                } elseif($user->role_id == 4) {
                    $data['bdsp'][] = $user;
                }
            }
        }

        $this->db->select("*");
        $this->db->where("id", $event_id);
        $data['model'] = $this->db->get("tbl_admin_event")->result()[0];
        
        $data['event_id'] = $event_id;
        $data['user_id'] = $this->session->userdata("id_user");
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

         $this->load->view('user/smme/calender/edit',$data);       
    }

    public function create() 
    {

      $underIncubation = $this->db->where(['smme_id'=>$this->session->userdata('id_user'),'app_id !='=>null])->get('tbl_application_assignment')->result();
      if(count($underIncubation) > 0){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
          if($this->input->post('title') == '' || $this->input->post('address') == '' || $this->input->post('description') == ''){
                $this->session->set_flashdata('danger','Please fill all fields.');
                return redirect(site_url("user/smme/Calendar/create"));
            }
          $_POST['smme_id'] = $_POST['user_id'];
          $users = [$_POST['incubator_id'],$_POST['bdsp_id']];
          
          foreach($users as $user){
              $user = $this->db->where('tbl_users_id',$user)->get('tbl_users')->row();
              $owner = $this->db->where('tbl_users_id',$this->session->userdata('id_user'))->get('tbl_users')->row();
              $process_key = "create_calender_event";
              $emailData = $this->db->where('process_key',$process_key)->get('tbl_emails')->row();
              $data['title'] = $emailData->subject;
              $keys = [
                      '[name_to]' => $user->tbl_users_firstname .' ' . $user->tbl_users_lastname,
                      '[name_from]' => $owner->tbl_users_firstname .' ' . $owner->tbl_users_lastname,
                  ];
              $content = do_shortcodes($emailData->message,$keys);
              email_send($user->tbl_users_email,$emailData->subject,$emailData->subject,$content);  
              email_logs($user->tbl_users_id,$emailData->subject);
          }
          $this->db->insert("tbl_admin_event", $_POST);
          redirect("user/smme/Calender");
        }
       }
       else{
        $this->session->set_flashdata('danger','You are not in Incubation.');
       } 

        $this->db->select("incubator_id, bdsp_id");
        $this->db->where("aa.smme_id", $this->session->userdata("id_user"));
        $query = $this->db->get("tbl_application_assignment as aa");
        $res = $query->result();

        $data['inc'] = [];
        //$data['bdsp'] = [];
        if ($res) {
            foreach ($res as $r) {
                $id = $r->incubator_id == null ? $r->bdsp_id : $r->incubator_id;

                $this->db->select("tbl_users_id as id, tbl_users_role_id as role_id, tbl_users_firstname as name, tbl_users_lastname as last_name");
                $this->db->where("tbl_users_id={$id}");
                $user = $this->db->get("tbl_users")->row();
                if($user != null){
                  if ($user->role_id == 3) {
                      $data['inc'][] = $user;
                  } elseif($user->role_id == 4) {
                      //$data['bdsp'][] = $user;
                  }
                }
            }
        }

        $sql = "SELECT u.tbl_users_id as id, u.tbl_users_role_id as role_id, u.tbl_users_firstname as name, u.tbl_users_lastname as last_name FROM tbl_application_assignment aa, tbl_users u WHERE aa.bdsp_id = u.tbl_users_id and aa.bdsp_id is not null and aa.smme_id=".$this->session->userdata("id_user")." GROUP BY u.tbl_users_id"; 
        $data['bdsp'] = $this->db->query($sql)->result(); 
        $data['underIncubation'] = count($underIncubation);
        $data['user_id'] = $this->session->userdata("id_user");
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $this->load->view('user/smme/calender/create',$data);       
    }

}