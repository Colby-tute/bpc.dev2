<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
  function __construct()
  { 
      
    parent::__construct();
    //
    if($this->session->userdata('user_type') != '')
    {
      //echo $this->session->userdata('user_type');exit;

       $this->session->userdata('user_type');
       $this->session->userdata('id_user');
      $tui = $this->load->model("admin/Role_Rights_model");

      $this->calledClasss = strtolower($this->router->fetch_class());
      $this->calledMethods = strtolower($this->router->fetch_method());
      $editdts = $this->Role_Rights_model->select_data_peruser($this->session->userdata('user_type'),$this->calledClasss,$this->calledMethods);
      
      $this->load->model("Home_modal");
      
      
      if($this->calledMethods == 'index')
        {
            $views = 'view';
        }else if($this->calledMethods == 'add')
        {
            $views = 'add';
        }
        else if($this->calledMethods == 'edit')
        {
            $views = 'edit';
        }
        else if($this->calledMethods == 'delete')
        {
            $views = 'delete';
        }       
        
        $this->load->library('user_agent');
        
        if(!empty($editdts))
        {
          foreach ($editdts[0] as $key => $value) 
          {
            # code...
           // echo  $key;
            $string = $key;
            $pieces = explode('_', $string);
            $last_word = array_pop($pieces);

           // echo $last_word."<br>";

              if($last_word == $views)
              {
                  if($value == 0)
                  {
                      $this->session->set_flashdata('danger', 'You are not allowed to access of '.$this->calledClasss.' '.$this->calledMethods.' page!');
                      if($this->calledClasss."-".'index'== $keys)
                      {
                        redirect('home');
                      }
                      else
                      {
                        redirect($_SERVER['HTTP_REFERER']);
                        //echo $this->calledClasss;
                        //redirect($this->calledClasss);
                      }
                  }
              }

            }
        }
        else
        {
        //echo "string";
        }
    }
    else if($this->session->userdata('admin_type') != '')
    {
      //echo 'hhdfhf';exit;

        $this->session->userdata('admin_type');
        $this->session->userdata('id_admin');
        $tui = $this->load->model("admin/Role_Rights_model");

        $this->calledClasss = strtolower($this->router->fetch_class());
        $this->calledMethods = strtolower($this->router->fetch_method());
        $editdts = $this->Role_Rights_model->select_data_peruser($this->session->userdata('admin_type'),$this->calledClasss,$this->calledMethods);
        $this->load->model("admin/Home_modal");

        if($this->calledMethods == 'index')
        {
            $views = 'view';
        }else if($this->calledMethods == 'add')
        {
            $views = 'add';
        }
        else if($this->calledMethods == 'edit')
        {
            $views = 'edit';
        }
        else if($this->calledMethods == 'delete')
        {
            $views = 'delete';
        }
        else
        {
        	$views = '';
        }      
        
        $this->load->library('user_agent');
        
        if(!empty($editdts))
        {
          foreach ($editdts[0] as $key => $value) 
          {
            # code...
           // echo  $key;
            $string = $key;
            $pieces = explode('_', $string);
            $last_word = array_pop($pieces);

           // echo $last_word."<br>";

              if($last_word == $views)
              {
                  if($value == 0)
                  {
                      $this->session->set_flashdata('danger', 'You are not allowed to access of '.$this->calledClasss.' '.$this->calledMethods.' page!');
                      if($this->calledClasss."-".'index'== $keys)
                      {
                        redirect('home');
                      }
                      else
                      {
                        redirect($_SERVER['HTTP_REFERER']);
                        //echo $this->calledClasss;
                        //redirect($this->calledClasss);
                      }
                  }
              }

            }
        }
        else
        {
        //echo "string";
        }
        //exit;
    }
     // exit;
  }

  //end page restriction

  function page_construct($page, $meta = array(), $data = array()) {
    $this->theme = base_url().'views';
        $meta['message'] = isset($data['message']) ? $data['message'] : $this->session->flashdata('message');
        $meta['error'] = isset($data['error']) ? $data['error'] : $this->session->flashdata('error');
        $meta['warning'] = isset($data['warning']) ? $data['warning'] : $this->session->flashdata('warning');
        $meta['info'] = $this->site->getNotifications();
        $meta['events'] = $this->site->getUpcomingEvents();
        $meta['ip_address'] = $this->input->ip_address();
        $meta['Owner'] = $data['Owner'];
        $meta['Admin'] = $data['Admin'];
        $meta['Supplier'] = $data['Supplier'];
        $meta['Customer'] = $data['Customer'];
        $meta['Settings'] = $data['Settings'];
        $meta['dateFormats'] = $data['dateFormats'];
        $meta['assets'] = $data['assets'];
        $meta['GP'] = $data['GP'];
        $meta['qty_alert_num'] = $this->site->get_total_qty_alerts();
        $meta['exp_alert_num'] = $this->site->get_expiring_qty_alerts();
        $meta['shop_sale_alerts'] = SHOP ? $this->site->get_shop_sale_alerts() : 0;
        $meta['shop_payment_alerts'] = SHOP ? $this->site->get_shop_payment_alerts() : 0;
        $this->load->view('includes/header', $meta);
        $this->load->view($this->theme . $page, $data);
        $this->load->view('includes/sidebar',$page, $data);
        $this->load->view('includes/footer');

    }
  }

class Admin_Controller extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
  }
}

class Public_Controller extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
  }
}
