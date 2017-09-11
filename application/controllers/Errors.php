<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    //Default function, redirects to logged in user area
    public function index() {
        $this->output->set_status_header('404'); 
        $this->load->view('errors/html/error_404');//loading in custom error view
    }

    public function error_permission()
    {
        $this->output->set_status_header('500'); 
        $this->load->view('errors/html/error_permission');//loading in custom error view   
    }
}
