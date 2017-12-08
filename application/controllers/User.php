<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    public function index()
    {
        // redirect(base_url() . 'index.php?user/dashboard', 'refresh');
        $page_data['page_name']  = 'home';
        $page_data['page_title'] = get_phrase('home');
        $this->load->view('frontend/index2', $page_data);
    }
    
    /***STUDENT DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('staff');
       
        $this->load->view('backend/index', $page_data);
    }
    
   
    


}