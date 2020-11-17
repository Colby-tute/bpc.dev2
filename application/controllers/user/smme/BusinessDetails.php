<?php defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Africa/Johannesburg');
class BusinessDetails extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
       if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("smme/BusinessDetails_Modal");
        $this->load->database();

    }

    public function index() {

        $id = $this->session->userdata('id_user');
        $data['user_id'] = $id;

        $business = $this->BusinessDetails_Modal->select_user_business_data($id);
        $smme_teams = $this->BusinessDetails_Modal->select_smme_teams_data($id);
        $business_doc = $this->BusinessDetails_Modal->select_business_docs($id);
        $role = $this->BusinessDetails_Modal->select_all_role();

        $industrys = $this->BusinessDetails_Modal->select_industry();
        $data['industrys'] = $industrys;
        
        $data['role'] = $role;
        $data['business'] = $business;
        //echo '<pre>';print_r($business);exit();
        $data['smme_teams'] = $smme_teams;
		
        $data['business_doc'] = $business_doc;
		
		$this->db->select("*");
		$this->db->where('upload_for',$id);
		$this->db->where('tbl_all_documents_type',"B");
        $querys=$this->db->get('tbl_all_documents');
        $incu_doc=$querys->result();	
		$data['incu_doc'] = $incu_doc;

        $this->db->select("*");
        $phases = $this->db->get("tbl_phase")->result();
        $data['phases'] = $phases;

        $this->db->select("*");
        $phases = $this->db->get("tbl_sub_phase")->result();
        $data['subphases'] = [];

        /*foreach ($phases as $phase) {
            $this->db->select("COUNT(uqa.id) as count");
            $this->db->join("tbl_phase_question as pq", "uqa.question_id=pq.id", "LEFT");
            $this->db->where("phase_id", $phase->id);
            $this->db->where("uqa.user_id", $this->session->userdata("id_user"));
            $yesCount = $this->db->get("tbl_user_question_answer as uqa")->result()[0]->count;

            $this->db->select("COUNT(id) as count");
            $this->db->where("phase_id", $phase->id);
            $totalCount = $this->db->get("tbl_phase_question")->result()[0]->count;
            
            $percentage = number_format(($yesCount / $totalCount) * 100, 2);
            $data['phases'][$phase->phase] = $percentage;
        }

        $json = [];
        foreach ($data['phases'] as $phase => $percentage) {
            $json[] = [
                'phase' => str_replace(" ", "", $phase),
                'percent' => $percentage
            ];
        }
        */
        $phasePercentage = [];
        foreach ($data['phases'] as $phase) {
            $phasePercentage[] = [
                'phase' => $phase->phase,
                'phaseName' => str_replace(" ", "", $phase->phase),
                'phaseId' => $phase->id,
                'percent' => 0
            ];
        }

        $user_id = $this->session->userdata("id_user");
        $this->db->select("question_text");
        $this->db->where("user_id", $user_id);
        $this->db->where("is_answered", true);
        $answered = $this->db->get("tbl_smme_question_answer")->result();
        $data['answered'] = $answered;

        $this->db->select("phase_id, subphase_id,COUNT(id) as answered_count");
        $this->db->where("user_id", $user_id);
        $this->db->where("is_answered", true);
        $this->db->where("is_deleted", false);
        $this->db->group_by('phase_id');
        $this->db->group_by('subphase_id');
        $answered = $this->db->get("tbl_smme_question_answer")->result();

        $this->db->select("phase_id, subphase_id,COUNT(id) as total_count");
        $this->db->where("user_id", $user_id);
        $this->db->where("is_deleted", false);
        $this->db->group_by('phase_id');
        $this->db->group_by('subphase_id');
        $questions = $this->db->get("tbl_smme_question_answer")->result();

        foreach ($questions as $question) {
            foreach ($answered as $answer) {
                if($question->phase_id == $answer->phase_id && $question->subphase_id == $answer->subphase_id) {
                    if($question->total_count == $answer->answered_count) {
                        $phasePercentage[$question->phase_id-1]['percent'] += 25;
                    }
                    break;
                }
            }
        }

        $this->db->select("*");
        $this->db->where("user_id", $id);
        $data['fin_details'] = $this->db->get("tbl_financial_details")->result();

        $data['bar'] = json_encode($phasePercentage);

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $this->load->view('user/smme/business_details/edit',$data);
    }

    public function get_sub_industries() {

        $ind_id = $this->input->post('ind_id');

        $sub_industries = $this->BusinessDetails_Modal->sub_industries($ind_id);

        echo json_encode($sub_industries);
    }

    public function update_fin()
    {
        $query = $this->db->query("SELECT id FROM tbl_financial_details
                    WHERE user_id = ".$_POST['fin_details']['user_id']." limit 1");
        if ($query->num_rows() == 0) {
            $this->db->insert("tbl_financial_details", $_POST['fin_details']);
        } else {
            $this->db->where("user_id", $_POST['fin_details']['user_id']);
            $this->db->update("tbl_financial_details", $_POST['fin_details']);
        }

        
        if (!empty($_POST['business'])){
            // print_r($_POST['business']);exit();
            $business = $_POST['business'];
            $business['tbl_business_details_updatedate'] = date('Y-m-d H:i:s',strtotime('now'));
            $this->db->where("tbl_business_details_user_id", $_POST['fin_details']['user_id']);
            $this->db->update("tbl_business_details", $business);
        }

        redirect("user/smme/BusinessDetails");
    }
	
	public function team($upd_id) 
    {
		if($_POST)
		{

			$now = date("Y-m-d H:i:s");
			$randomid = mt_rand(100000,999999); 
			//echo $randomid;

			$smme_teams = array(

				'tbl_business_details_areyouteam' => $this->input->post('tbl_business_details_areyouteam'),
				
				'tbl_smme_teams_first_name' => $this->input->post('tbl_smme_teams_first_name'),

				'tbl_smme_teams_last_name' => $this->input->post('tbl_smme_teams_last_name'),

				'tbl_smme_teams_email' => $this->input->post('tbl_smme_teams_email'),

				'tbl_smme_teams_mobile'=> $this->input->post('tbl_smme_teams_mobile'),

				'tbl_smme_teams_gender'=> $this->input->post('tbl_smme_teams_gender'),

				'tbl_smme_teams_date_hired'=> $this->input->post('tbl_smme_teams_date_hired'),

				'tbl_smme_teams_insertdate'=> $now,

			); 
			//print_r($_POST);exit;
			$result = $this->BusinessDetails_Modal->update_master_team($smme_teams,$upd_id,$this->input->post('tbl_business_details_id'));
			
			$this->session->set_flashdata('success', 'Team Inserted Successfully!');
			redirect($_SERVER['HTTP_REFERER']);
		}
    }

    public function update($upd_id) 
    {
        //print_r($_POST); print_r($_FILES); exit;
		
		if($_POST)
		{

            $now = date("Y-m-d H:i:s");
            $randomid = mt_rand(100000,999999);
			
			if($_FILES['tbl_business_details_business_logo']['name'] != "")
			{
				$image_replace = str_replace(" ", "_",$_FILES['tbl_business_details_business_logo']['name']);
				//$image_replace = str_replace(".", "_", $image_replace);
				$image_name = "business_logo_photo_".$randomid."_".$image_replace;
				
				if(!empty($_FILES['tbl_business_details_business_logo']['name'])){
		   
					$_FILES['file']['name'] = $image_name;
					$_FILES['file']['type'] = $_FILES['tbl_business_details_business_logo']['type'];
					$_FILES['file']['tmp_name'] = $_FILES['tbl_business_details_business_logo']['tmp_name'];
					$_FILES['file']['error'] = $_FILES['tbl_business_details_business_logo']['error'];
					$_FILES['file']['size'] = $_FILES['tbl_business_details_business_logo']['size'];
		  
					$config['upload_path'] = 'assets/users'; 
					$config['allowed_types'] = 'jpg|jpeg|png|tiff';
					//$config['max_size'] = '5000';
					$config['client_name'] = $image_name;
		   
					$this->load->library('upload',$config); 
			
					if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    }
                    else{
                        $this->session->set_flashdata('danger',$this->upload->display_errors());
                        return redirect(site_url('user/smme/BusinessDetails'));
                    }
				}
			}
			else
			{
				$image_name = $this->input->post('tbl_business_details_business_logo_old');
			}

            $business = array(
                'tbl_business_details_name' => $this->input->post('tbl_business_details_name'),
                'tbl_business_details_industry' => $this->input->post('tbl_business_details_industry'),
                'tbl_business_details_sub_industry' => $this->input->post('tbl_business_details_subindustry'),
                'tbl_business_details_email' => $this->input->post('tbl_business_details_email'),
                'tbl_business_details_countrycode'=> $this->input->post('country_code'),
                'tbl_business_details_phone'=> $this->input->post('tbl_business_details_phone'),
                'tbl_business_details_district'=> $this->input->post('tbl_business_details_district'),
                'tbl_business_details_town_village'=> $this->input->post('tbl_business_details_town_village'),
                'tbl_business_details_employees'=> $this->input->post('tbl_business_details_employees'),
                'tbl_business_details_date_hired'=> $this->input->post('tbl_business_details_date_hired'),
                'tbl_business_details_investmant_need'=> $this->input->post('tbl_business_details_investmant_need'),
                'tbl_business_details_areyouteam'=> $this->input->post('tbl_business_details_areyouteam'),
                'tbl_business_details_business_logo'=> $image_name,
                //'ttbl_business_details_insertdate'=> $now,
            ); 
            $result = $this->BusinessDetails_Modal->update_master_data($business,$upd_id,$this->input->post('tbl_business_details_id'));

            if($result == 1) {
                if($_FILES['tbl_business_details_business_doc']['name'] != "")
                {
                    $image_replace = str_replace(" ", "_",$_FILES['tbl_business_details_business_doc']['name']);
                    $image_name = "business_doc_photo_".$randomid."_".$image_replace;
                    $images = array(
                        'tbl_business_details_business_doc' => $image_name,
                    ); 
                    $this->BusinessDetails_Modal->image_insert($images,$upd_id,'tbl_business_details','tbl_business_details_user_id');

                    if(!empty($_FILES['tbl_business_details_business_doc']['name'])){
               
                        $_FILES['file']['name'] = $image_name;
                        $_FILES['file']['type'] = $_FILES['tbl_business_details_business_doc']['type'];
                        $_FILES['file']['tmp_name'] = $_FILES['tbl_business_details_business_doc']['tmp_name'];
                        $_FILES['file']['error'] = $_FILES['tbl_business_details_business_doc']['error'];
                        $_FILES['file']['size'] = $_FILES['tbl_business_details_business_doc']['size'];
              
                        $config['upload_path'] = 'assets/users'; 
                        $config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
                        //$config['max_size'] = '5000';
                        $config['client_name'] = $image_name;
               
                        $this->load->library('upload',$config); 
                
                        if($this->upload->do_upload('file')){
                            $uploadData = $this->upload->data();
                        }
                    }
                }
                $this->session->set_flashdata('success', 'Data inserted successfully!');
                redirect($_SERVER['HTTP_REFERER']);
            }
            elseif($result == 0) {
                $this->session->set_flashdata('danger', 'Failed! Please make changes to update.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function insert_business_doc() {

    	/*print_r($_POST);
    	print_r($_FILES);exit;*/

    	$now = date("Y-m-d H:i:s");
       /* $count = count($_FILES['business_doc_files']['name']);
        for ($i=0; $i < $count; $i++) { 
*/

    	$business_doc = str_replace(" ", "_",$_FILES['business_doc_files']['name']);
        $business_doc_new = "business_document_".$this->session->userdata('user_unique_id')."_".$business_doc;

    	$data = array(
    		'tbl_all_documents_user_id' => $this->session->userdata('id_user'),

    		//'tbl_business_document_businessid' => $this->input->post('tbl_business_details_id'),

    		'tbl_all_documents_title' => $this->input->post('business_doc_title'),

    		'tbl_all_documents_document' => $business_doc_new,

            'tbl_all_documents_type' => 'B',

            'doc_type' => $this->input->post('doc_type'),

    		'tbl_all_documents_insertdate' => $now,
    	);

    	$result = $this->BusinessDetails_Modal->insert_business_doc($data);
       /*}*/
    	if ($result == 1) {

            if(!empty($_FILES['business_doc_files']['name'])){

                $_FILES['file']['name'] = $business_doc_new;
                $_FILES['file']['type'] = $_FILES['business_doc_files']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['business_doc_files']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['business_doc_files']['error'];
                $_FILES['file']['size'] = $_FILES['business_doc_files']['size'];
      
                $config['upload_path'] = 'assets/Application/Business_Document'; 
                 $config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
                //$config['max_size'] = '5000';
                $config['file_name'] = $business_doc_new;
       
                $this->load->library('upload',$config); 
        
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                }
            }
                    
                $this->session->set_flashdata("success","Document uploaded successfully!!!"); 
                redirect($_SERVER['HTTP_REFERER']); 
            }
            else{
                $this->session->set_flashdata("danger","An error has occured while uploading the document!!!"); 
                redirect($_SERVER['HTTP_REFERER']); 
            }
    }

    public function delete($id) {

        $select_doc = $this->BusinessDetails_Modal->select_doc($id);
    
        unlink('assets/Application/Business_Document/'.$select_doc[0]->tbl_business_document_document);

        $result = $this->BusinessDetails_Modal->delete($id);

        if ($result == 1) {

            $this->session->set_flashdata("success","Document has been deleted successfully!!!"); 
            redirect($_SERVER['HTTP_REFERER']);
        }
        else{

            $this->session->set_flashdata("danger","An error has occured while deleting the document!!!"); 
            redirect($_SERVER['HTTP_REFERER']);
        }

    } 

}
