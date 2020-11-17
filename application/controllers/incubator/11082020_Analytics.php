<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class Analytics extends MY_Controller
{

	function __construct() {
		parent::__construct();
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('Login');
        }		
		$this->load->database();
		$this->load->model("incubator/Analytics_model");
	}

	private function array_count_exists($search_key, $array) {
		foreach ($array as $key => $value) {
			if(array_key_exists($search_key, $value)) {
				return $key;
			}
		}
		return -1;
	}

	public function registrationsReport()
	{
		//$registrations_counts = $this->Analytics_model->get_registrations_count();
		$registrations_by_year = array();
		$registrations_by_month = array();
		$registrations_by_week = array();
		$registrations_by_year = $this->Analytics_model->get_registrations_year_count();
		$registrations_by_month = $this->Analytics_model->get_registrations_month_count();
		$registrations_by_week = $this->Analytics_model->get_registrations_week_count();

		/*
		foreach ($registrations_counts as $key => $count_row) {
			$role_id = $count_row->role_id;
			$year = $count_row->registration_year;
			$month = $year . "-" . str_pad($count_row->registration_month, 2, 0, STR_PAD_LEFT);
			$week = $year . "-" . str_pad($count_row->registration_week, 2, 0, STR_PAD_LEFT);
			$count = $count_row->registration_count;


			$role_key = $this->array_count_exists($role_id, $registrations_by_year);
			if($role_key >= 0) {
				$year_key = $this->array_count_exists($year, $registrations_by_year[$role_key]);
				if($year_key >= 0) {
					$new_count = $registrations_by_year[$role_key][$role_id][$year_key][$year] + $count;
					echo "<br>+++replace" . "<br>";
					echo "role_key " . $role_key . "<br>";
					echo "role_id " . $role_id . "<br>";
					echo "year_key " . $year_key . "<br>";
					echo "year " . $year . "<br>";
					echo "count " . $count . "<br>";
					echo "new_count " . $new_count . "<br>";
					echo "---replace" . "<br>";
					array_replace($registrations_by_year[$role_key][$role_id][$year_key], array($year => $new_count));
				} else {
					echo "<br>+++year_push" . "<br>";
					echo "role_key " . $role_key . "<br>";
					echo "role_id " . $role_id . "<br>";
					echo "year_key " . $year_key . "<br>";
					echo "year " . $year . "<br>";
					echo "count " . $count . "<br>";
					echo "---year_push" . "<br>";
					array_push($registrations_by_year[$role_key][$role_id], array($year => $count));
				}
			} else {
					echo "<br>+++role_push" . "<br>";
					echo "role_key " . $role_key . "<br>";
					echo "role_id " . $role_id . "<br>";
					echo "year " . $year . "<br>";
					echo "count " . $count . "<br>";
					echo "---role_push" . "<br>";
					array_push($registrations_by_year, array($role_id => array($year => $count)));
			}

			
			$role_key = $this->array_count_exists($role_id, $registrations_by_month);
			if($role_key >= 0) {
				$month_key = $this->array_count_exists($month, $registrations_by_month[$role_key]);
				if($month_key >= 0) {
					$new_count = $registrations_by_month[$role_key][$month_key][$month] + $count;
					array_replace($registrations_by_month[$role_key][$month_key], array($month => $new_count));
				} else {
					array_push($registrations_by_month[$role_key], array($month => $count));
				}
			} else {
					array_push($registrations_by_month, array($role_id => array($month => $count)));
			}

			$role_key = $this->array_count_exists($role_id, $registrations_by_week);
			if($role_key >= 0) {
				$week_key = $this->array_count_exists($week, $registrations_by_week[$role_key]);
				if($week_key >= 0) {
					$new_count = $registrations_by_week[$role_key][$week_key][$week] + $count;
					array_replace($registrations_by_week[$role_key][$week_key], array($week => $new_count));
				} else {
					array_push($registrations_by_week[$role_key], array($week => $count));
				}
			} else {
					array_push($registrations_by_week, array($role_id => array($week => $count)));
			}
			
			$count_row->registration_year
			$count_row->registration_month
			$count_row->registration_week
			$count_row->registration_count
			$count_row['registration_year']
			$count_row['registration_month']
			$count_row['registration_week']
			$count_row['registration_count']
		}
		*/

		$data['registrations_by_year'] = json_encode($registrations_by_year);
		$data['registrations_by_month'] = json_encode($registrations_by_month);
		$data['registrations_by_week'] = json_encode($registrations_by_week);
 		
		$registerUser=$this->Analytics_model->getRegistrationsReport($this->session->userdata('role_id'));
		$data['reportTabledata'] = json_encode($registerUser);
        
        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('incubator/analytics/registration',$data);
	}

	public function incubationStatusReport() {
		$roleId = ['2'];
		$statusId = ['2'];
		$incubation_application_status = $this->Analytics_model->get_smme_by_incubation_application_status($roleId ,$statusId);

		$totalCount = 0;
		foreach ($incubation_application_status as $key => $status) {
			$totalCount += $status['count'];
		}
		$data['totalSmmeCount'] = $totalCount;
		$data['smmeStatus'] = json_encode($incubation_application_status);

		$gender_count = $this->Analytics_model->get_smme_status_by_gender($roleId ,$statusId );
		$girlsCount = 0;
		foreach ($gender_count as $key => $gender) {
			if($gender['gender'] == 'F') {
				$girlsCount = $gender['count'];
				break;
			}
		}
		$data['totalSmmeGirlsCount'] = $girlsCount;
		$data['smmeStatusByGender'] = json_encode($gender_count);

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $getIncubationStatusReport=$this->Analytics_model->getIncubationStatusReport($roleId ,$statusId );
		$data['reportTabledata'] = json_encode($getIncubationStatusReport);

		$this->load->view('incubator/analytics/incubationstatus',$data);
	}

	public function demographicsReport() {
		$roleId = ['2'];
		$statusId = ['2'];

		$data['gender'] = json_encode($this->Analytics_model->get_users_by_gender($roleId ,$statusId ));
		$data['age'] = json_encode($this->Analytics_model->get_users_by_age($roleId ,$statusId ));
		$data['district'] = json_encode($this->Analytics_model->get_users_by_district($roleId ,$statusId ));
		$data['town_village'] = json_encode($this->Analytics_model->get_users_by_town_village($roleId ,$statusId ));
		//$data['smme_teams'] = json_encode($this->Analytics_model->get_smmes_team_members()
		//echo json_encode($data);
		$getDemographicsReports=$this->Analytics_model->getDemographicsReports($this->session->userdata('role_id'));
        $data['reportTabledata'] = json_encode($getDemographicsReports);

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('incubator/analytics/demographics',$data);
	}

	public function evaluationReport() {

		$data['smmes'] = json_encode($this->Analytics_model->get_all_smmes());
		$data['incubators'] = json_encode($this->Analytics_model->get_all_users_by_role(3));
		$data['bdsps'] = json_encode($this->Analytics_model->get_all_users_by_role(4));

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('incubator/analytics/evaluation',$data);
	}

	public function getUserEvaluationReport() {
		$evaluatee_type = $_POST['userType'];
		$evaluatee_id = $_POST['userId'];
		$data = [];
		if($evaluatee_type == "MSME") {
			$data = json_encode($this->Analytics_model->get_smme_ratings($evaluatee_id));
		} else if($evaluatee_type == "INCUBATOR") {
			$data = json_encode($this->Analytics_model->get_incubator_ratings($evaluatee_id));
		} else if($evaluatee_type == "BDSP") {
			$data = json_encode($this->Analytics_model->get_bdsp_ratings($evaluatee_id));
		}
		echo $data;
	}

	public function investmentReport() {

		$data['smmes'] = json_encode($this->Analytics_model->get_all_smmes());

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('incubator/analytics/investment',$data);
	}

	public function getUserInvestmentReport() {
		$smme_id = $_POST['userId'];
		$data = json_encode($this->Analytics_model->get_smme_funding($smme_id));
		echo $data;
	}
	
	public function incubationProgressReport() {
		$incubationProgress = array(
								'Investigation' => 0,
								'Development' => 0,
								'Commercial' => 0 );
		$statuses = $this->Analytics_model->get_smme_incubation_progress();
		for($idx = 0; $idx < sizeof($statuses); $idx +=3) {
			if($statuses[$idx]['percentage'] != "100") {
				$incubationProgress['Investigation'] += 1;
			} else if($statuses[$idx+1]['percentage'] != "100") {
				$incubationProgress['Development'] += 1;
			} else if($statuses[$idx+2]['percentage'] != "100") {
				$incubationProgress['Commercial'] += 1;
			}
		}
		$data['incubationProgress'] = json_encode($incubationProgress);
		
        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('incubator/analytics/incubationprogress',$data);
	}

	public function channelsReport()
	{
		$roleId    =['2'];
		$statusId  =['2'];

		$data['channels'] = json_encode($this->Analytics_model->get_users_by_channels($roleId ,$statusId));

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $getChannelsReport=$this->Analytics_model->getChannelsReport($roleId ,$statusId);
		$data['reportTabledata'] = json_encode($getChannelsReport);

		$this->load->view('incubator/analytics/channels',$data);
	}

	public function get_ip_details($IPaddress) 
	{
	    //$json       = file_get_contents("http://ipinfo.io/{$IPaddress}");
	    $json       = file_get_contents("http://www.geoplugin.net/json.gp?ip={$IPaddress}");
	    $details    = json_decode($json);
	    return $details->geoplugin_countryName;
	}

	public function findCountry($countries, $country)
	{
	    foreach ($countries as $key => $value) {
	        if ($value['country'] == $country) {
	        	return $key;
	        }
	    }
	    return -1;
	}

	public function updateCountry() {
		//SELECT `tbl_login_history_ip`, COUNT(*) FROM `tbl_login_history` GROUP BY `tbl_login_history_ip` 
		$this->db->select("tbl_login_history_ip, COUNT(*)");
		$this->db->where("tbl_login_history_country", "");
		$this->db->group_by("tbl_login_history_ip");
		$this->db->limit(10);
		$res = $this->db->get('tbl_login_history')->result();
		foreach ($res as $key => $result) {
			$country = $this->get_ip_details($result->tbl_login_history_ip);
			$this->db->set(array('tbl_login_history_country' => $country));
			$this->db->where('tbl_login_history_ip', $result->tbl_login_history_ip);
			$this->db->update('tbl_login_history');
			echo $country . ' => ' . $result->tbl_login_history_ip . '<br>';
		}
	}

	public function securityReport() {
		$roleId    =['2','3','4'];
		$statusId  =['2']; 
		$data['results'] = json_encode($this->Analytics_model->get_users_by_login_result($roleId ,$statusId));
		$data['browsers'] = json_encode($this->Analytics_model->get_users_by_browsers($roleId ,$statusId));
		
		/*$uniqueIPsResult = $this->Analytics_model->get_users_by_location();
		$countries = array();
		foreach ($uniqueIPsResult as $key => $uniqueIP) {
			//$countryCode = $this->get_ip_details($uniqueIP['ipaddress'])['country'];
			$countryCode = explode('.', $uniqueIP['ipaddress']);
			if(sizeof($countryCode) == 4) {
				$countryCode = $countryCode[0] . '.' . $countryCode[1] . '.*.*';
			} else {
				$countryCode = '*.*.*.*';
			}
			$count = $uniqueIP['count'];
			$countryKey = $this->findCountry($countries, $countryCode);
			if($countryKey >= 0) {
				$newCountry = array(
					'country' => $countryCode,
					'count' => $count + $countries[$countryKey]['count']);
				array_replace($countries[$countryKey], $newCountry);
			} else {
				array_push($countries, array(
					'country' => $countryCode,
					'count' => $count));
			}
		}*/
		$data['countries'] = json_encode($this->Analytics_model->get_users_by_country($roleId ,$statusId));


        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $getsecurityReport=$this->Analytics_model->getsecurityReport($roleId ,$statusId);
		$data['reportTabledata'] = json_encode($getsecurityReport);
		

		$this->load->view('incubator/analytics/security',$data);
	}

}