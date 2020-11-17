<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Calendar extends MY_Controller
{
	function __construct() {

        parent::__construct();

        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->database();
        $this->load->helper("email_service");
    }

    public function index()
    {

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);
        $data['events'] = json_encode($this->get_events());
		//echo '<pre>'; print_r($data['events']); exit;

        $this->load->view('incubator/calendar/index',$data);

    }

    public function get_events()
    {
         /*$this->db->select("*");
         $this->db->where("incubator_id", $this->session->userdata("id_user"));
         $events = $this->db->get("tbl_admin_event");
		 //print_r($events); exit;
		 
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
		 
         return [$meetings, $training, $feedback, $workshop, $one_on_one, $evaluation, $assessment];*/


         $this->db->select("*");
         $this->db->where("incubator_id", $this->session->userdata("id_user"));
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
    }

    public function delete($id) 
    {
        $this->db->where("id", $id);
        $this->db->delete("tbl_incubator_event");
        redirect("incubator/Calendar");
    }

    public function edit($event_id) 
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->db->where("id", $event_id);
            $this->db->update("tbl_incubator_event", $_POST);
            redirect("incubator/Calendar");
        }        
        $data['event_id'] = $event_id;
        $this->db->select("bdsp_id, smme_id");
        $this->db->where("aa.incubator_id", $this->session->userdata("id_user"));
        $query = $this->db->get("tbl_application_assignment as aa");
        $res = $query->result();

        $data['smmes'] = [];
        
        if ($res) {
            foreach ($res as $r) {

                $id = $r->bdsp_id == null ? $r->smme_id : $r->bdsp_id;

                $this->db->select("tbl_users_id as id, tbl_users_role_id as role_id, tbl_users_firstname as name, tbl_users_lastname as last_name");
                $this->db->where("tbl_users_id={$id}");
                $user = $this->db->get("tbl_users")->result()[0];

                if ($user->role_id == 2) {
                    $data['smmes'][] = $user;
                }
            }
        }


        $data['bdsp'] = [];
        $this->db->select("incubation_id");
        $this->db->where("user_id", $this->session->userdata("id_user"));
        $incubation_ids = $this->db->get("tbl_incubation_users")->result();
        
        if ($incubation_ids) {
        	foreach ($incubation_ids as $id) {
        		$this->db->select("user_id");
        		$this->db->where("incubation_id", $id->incubation_id);
        		$users = $this->db->get("tbl_incubation_users")->result();

        		if ($users) {
        			foreach ($users as $user_id) {
        				$this->db->select("*");
        				$this->db->where("tbl_users_id", $user_id->user_id);
        				$user = $this->db->get("tbl_users")->result()[0];

        				if ($user->tbl_users_role_id == 4) {
    						$data['bdsp'][] = $user;
        				}
        			}
        		}
        	}
        }

        $this->db->select("*");
        $this->db->where("id", $event_id);
        $data['model'] = $this->db->get("tbl_incubator_event")->result()[0];
        $data['incubator_id'] = $this->session->userdata("id_user");

        $data['user_id'] = $this->session->userdata("id_user");
        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

         $this->load->view('incubator/calendar/edit',$data);       
    }

    public function create() 
    {

        /*if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->db->insert("tbl_incubator_event", $_POST);
            redirect("incubator/Calendar");
        }

        $this->db->select("bdsp_id, smme_id");
        $this->db->where("aa.incubator_id", $this->session->userdata("id_user"));
        $query = $this->db->get("tbl_application_assignment as aa");
        $res = $query->result();

        $data['smmes'] = [];
    
        if ($res) {
            foreach ($res as $r) {

                $id = $r->bdsp_id == null ? $r->smme_id : $r->bdsp_id;

                $this->db->select("tbl_users_id as id, tbl_users_role_id as role_id, tbl_users_firstname as name, tbl_users_lastname as last_name");
                $this->db->where("tbl_users_id={$id}");
                $user = $this->db->get("tbl_users")->result();
                if($user) {
                    $user = $user[0];

                    if ($user->role_id == 2) {
                        $data['smmes'][] = $user;
                    } 
                }
            }
        }

        $data['bdsp'] = [];
        $this->db->select("incubation_id");
        $this->db->where("user_id", $this->session->userdata("id_user"));
        $incubation_ids = $this->db->get("tbl_incubation_users")->result();
        
        if ($incubation_ids) {
        	foreach ($incubation_ids as $id) {
        		$this->db->select("user_id");
        		$this->db->where("incubation_id", $id->incubation_id);
        		$users = $this->db->get("tbl_incubation_users")->result();

        		if ($users) {
        			foreach ($users as $user_id) {
        				$this->db->select("*");
        				$this->db->where("tbl_users_id", $user_id->user_id);
        				$user = $this->db->get("tbl_users")->result()[0];

        				if ($user->tbl_users_role_id == 4) {
    						$data['bdsp'][] = $user;
        				}
        			}
        		}
        	}
        }

        $data['user_id'] = $this->session->userdata("id_user");
        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $this->load->view('incubator/calendar/create',$data);*/

         if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if($this->input->post('title') == '' || $this->input->post('address') == '' || $this->input->post('description') == ''){
                $this->session->set_flashdata('danger','Please fill all fields.');
                return redirect(site_url("incubator/Calendar/create"));
            }
            $_POST['incubator_id'] = $_POST['user_id'];
            $users = [$_POST['smme_id'],$_POST['bdsp_id']];
            
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
            redirect("incubator/Calendar");
        }

        $this->db->select("bdsp_id, smme_id");
        $this->db->where("aa.incubator_id", $this->session->userdata("id_user"));
        $query = $this->db->get("tbl_application_assignment as aa");
        $res = $query->result();
        $data['smmes'] = [];
    
        if ($res) {
            foreach ($res as $r) {

                $id = $r->smme_id != null ? $r->smme_id : $r->bdsp_id;
                $this->db->select("tbl_users_id as id, tbl_users_role_id as role_id, tbl_users_firstname as name, tbl_users_lastname as last_name");
                $this->db->where("tbl_users_id={$id}");

                $user = $this->db->get("tbl_users")->result();
                if($user) {
                    $user = $user[0];

                    if ($user->role_id == 2) {
                        $data['smmes'][] = $user;
                    } 
                }
            }
        }
        $data['bdsp'] = [];
        $this->db->select("incubation_id");
        $this->db->where("user_id", $this->session->userdata("id_user"));
        $incubation_ids = $this->db->get("tbl_incubation_users")->result();
        
        if ($incubation_ids) {
            foreach ($incubation_ids as $id) {
                $this->db->select("user_id");
                $this->db->where("incubation_id", $id->incubation_id);
                $users = $this->db->get("tbl_incubation_users")->result();

                if ($users) {
                    foreach ($users as $user_id) {
                        $this->db->select("*");
                        $this->db->where("tbl_users_id", $user_id->user_id);
                        $user = $this->db->get("tbl_users")->result();
                        if($user){
                            $user = $user[0];
                            if ($user->tbl_users_role_id == 4) {
                            $data['bdsp'][] = $user;
                        }    
                        }

                        
                    }
                }
            }
        }
        

        $data['user_id'] = $this->session->userdata("id_user");
        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $this->load->view('incubator/calendar/create',$data);        
    }

}
