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
        $page_data['page_name']  = 'home';
        $page_data['page_title'] = get_phrase('home');
        $this->load->view('frontend/index2', $page_data);
        
    }

    function voucehrDetail()
    {
        $page_data['page_name']  = 'voucehrDetails';
        $page_data['page_title'] = get_phrase('voucehr_details');
       
        $this->load->view('frontend/index2', $page_data);
    }
    
    function loginPage()
    {
        // if ($this->session->userdata('user_login') != 1)
        //     redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'login';
        $page_data['page_title'] = get_phrase('login');
       
        $this->load->view('frontend/login', $page_data);
    }

    function login()
    {
        $page_data['page_name']  = 'login';
        $page_data['page_title'] = get_phrase('login');
       
        $this->load->view('frontend/login2', $page_data);
    }
    
    function register()
    {
        if($this->input->post())
        {
            print_r("expression");
            exit;
        }
        $page_data['page_name']  = 'login';
        $page_data['page_title'] = get_phrase('login');
       
        $this->load->view('frontend/login', $page_data);
    }

    function privacy()
    {
        $page_data['page_name']  = 'privacy';
        $page_data['page_title'] = get_phrase('privacy');
       
        $this->load->view('frontend/privacy', $page_data);   
    }
    
    function test()
    {
        $page_data['page_name']  = 'test';
        $page_data['page_title'] = get_phrase('test');
        
        $this->load->view('frontend/index2', $page_data);  
    }

    /* FUNCTION: Setting Frontend Language */
    function set_language($lang)
    {
        $this->session->set_userdata('language', $lang);
        // $page_data['page_name'] = "home";
        // recache();
        // redirect(base_url() . 'frontend/index2/', 'refresh');
        $page_data['page_name']  = 'test';
        $page_data['page_title'] = get_phrase('test');
       

        $this->load->view('frontend/index2', $page_data);
    }

    /* FUNCTION: Setting Frontend currency */
    function set_currency($currency)
    {
        $this->session->set_userdata('currency', $currency);
        // recache();
        $page_data['page_name']  = 'test';
        $page_data['page_title'] = get_phrase('test');
        $this->load->view('frontend/index2', $page_data);
    }

    function privacypolicy()
    {
        $page_data['page_name']  = 'privacypolicy';
        $this->load->view('frontend/index2', $page_data);
    }

    function faq()
    {
        $page_data['page_name']  = 'faq';
        $this->load->view('frontend/index2', $page_data);
    }

    function blogs()
    {
        $page_data['page_name']  = 'blogs';
        $this->load->view('frontend/index2', $page_data);
    }

    function blog_description()
    {
        $page_data['page_name']  = 'blog_description';
        $this->load->view('frontend/index2', $page_data);
    }

    function testimonials()
    {
        $page_data['page_name']  = 'testimonials';
        $this->load->view('frontend/index2', $page_data);
    }

   

    function aboutus()
    {
        $page_data['page_name']  = 'aboutus';
        $this->load->view('frontend/index2', $page_data);
    }

    function cart()
    {
        $page_data['page_name']  = 'cart';
        $this->load->view('frontend/index2', $page_data);   
    }


    // My account
     function myaccount()
    {
        $page_data['page_name']  = 'myaccount';
        $this->load->view('frontend/index2', $page_data);
    }

    function used_voucher()
    {
        $page_data['page_name']  = 'used_voucher';
        $this->load->view('frontend/index2', $page_data);   
    }

    function mlm()
    {
        $page_data['page_name']  = 'mlm';
        $this->load->view('frontend/index2', $page_data);
        // http://jsfiddle.net/vVmcC/4/
        // https://jsfiddle.net/api/post/library/pure/
    }

    function logout()
    {
        $page_data['page_name']  = 'home';
        $this->load->view('frontend/index2', $page_data);
    }
}