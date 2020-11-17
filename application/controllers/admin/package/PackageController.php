<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*define('BASEPATH') OR exit('No direct script access allowed')
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PackageController
 *
 * @author Colby TUTE
 */
class PackageController extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        
        if(empty($this->session->userdata('id_admin'))){
            $this->session->set_flashdata('flash_data', 'You don\'t have access to this page');
            redirect('admin/masterlogin');
        }
        $this->load->model("admin/package/PackageModel");
        $this->load->database();
    }
    //view entries
    public function index(){
        $data['pack'] = $this->PackageModel->getPackages();
        $data['assign'] = $this->PackageModel->getTotalAssign();
        $data['totalC'] = $this->PackageModel->getTotalComp();
        $data['competitor'] = $this->PackageModel->getTotalCompetitor();
        $data['header']= $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer']= $this->load->view('admin/includes/footer', NULL, TRUE);
        $data['hist']= $this->load->view('admin/includes/loginHistory', NULL, TRUE);
        $this->load->view('admin/package/packageEntries',$data);
    }
    //....................................
    
    //create package
    public function createPackage(){
        $data['header']= $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer']= $this->load->view('admin/includes/footer', NULL, TRUE);
        $data['hist']= $this->load->view('admin/includes/loginHistory', NULL, TRUE);
        $this->load->view('admin/package/createPackage',$data);
    }
    /*......................................................................*/
    
    //Add Package
    public function addPackage(){
        
        $randNum = mt_rand(10000, 999999);
        $newData = array(
            'tbl_packages_unique_code' => $randNum,
            'tbl_packages_name' => $this->input->post('packName'),
            'tbl_packages_duration' => $this->input->post('packDuration'),
            'tbl_packages_type'=> $this->input->post('packType'),
            'billing'=> $this->input->post('bill'),
            'licence_cost'=> $this->input->post('license'),
            'support'=> $this->input->post('support'),
        );
        
        $result = $this->PackageModel->insertPackage($newData);
        if($result == "success"){
            echo '<script>alert("You Have Successfully updated this Record!");</script>';
               redirect('package/entry', 'refresh');
        }else{
             redirect('package/add', 'refresh');
        }
    }
    /*.....................................................................*/
    
    //Edit Package 
    public function editPackage() {
        $packId = $this->uri->segment(3);
        $result = $this->PackageModel->getPackageById($packId);
        $data['package'] = $result;
        $data['header']= $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer']= $this->load->view('admin/includes/footer', NULL, TRUE);
        $data['hist']= $this->load->view('admin/includes/loginHistory', NULL, TRUE);
        $this->load->view('admin/package/editPackage',$data);
    }
    /*......................................................................*/
    
    public function  updatePackage(){
        
        $packId = $this->input->post('packId');
        $newData = array(
        
            'tbl_packages_name' => $this->input->post('packName'),
            'tbl_packages_duration' => $this->input->post('packDuration'),
            'tbl_packages_type'=> $this->input->post('packType'),
            'billing'=> $this->input->post('bill'),
            'licence_cost'=> $this->input->post('license'),
            'support'=> $this->input->post('support'),
        );
        
        $result = $this->PackageModel->updatePackageById($packId,$newData);
        if($result == "success"){
            $this->session->set_flashdata('success','package is successfully updated');
            redirect('package/entry','refresh');
        }else{
           $this->session->set_flashdata('danger','Something wrong happenned!!');
           redirect('package/add', 'refresh');
        }
    }
    
    public function  deletePackage(){
        $packId = $this->uri->segment(3);
        $res = $this->PackageModel->deletePackageById($packId);
        if ($res == 'success'){
            $this->session->set_flashdata('success','Package is successfully deleted');
            redirect('package/entry','refresh');
        }else{
            $this->session->set_flashdata('danger','Something Wrong Happenned!!');
            redirect('package/entry','refresh');
        }
    }
    
    public function assignPackage(){
        $res = $this->PackageModel->getPackageByUser();
        $data['pack']= $res;
        $data['packList']=$this->PackageModel->getPackages();
        $data['header']= $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer']= $this->load->view('admin/includes/footer', NULL, TRUE);
        $data['hist']= $this->load->view('admin/includes/loginHistory', NULL, TRUE);
        $this->load->view('admin/package/assignPackage',$data);
    }
    public function assignPackToInc(){
       $userId = $this->uri->segment(4);
       $packId = $this->input->post('packageType');
       
             
       $res = $this->PackageModel->updateAssignPack($userId, $packId); 
       switch ($res){
           case "success":
              $this->session->set_flashdata('success','Package is successfully Asssigned');
              redirect('package/assign','refresh');
              break;
          default :
              $this->session->set_flashdata('danger','Something Wrong Happenned!!');
              redirect('package/assign','refresh');
       }
    }
    
}
    
    