<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        
        if ($this->crud_model->admin_open_ip()) {
            redirect(base_url(). 'errors/error_permission', 'refresh');
        }

        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {
   
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');

        if ($this->session->userdata('staff_login') == 1)
            redirect(base_url() . 'staff/dashboard', 'refresh');

        $this->load->view('backend/login');
    }

    //Ajax login function 
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            // $response['redirect_url'] = '';
            $response['redirect_url'] = 'dashboard';
        }

        //Replying ajax request with validation response
        echo json_encode($response);
    }

    //Validating login from ajax request
    function validate_login($email = '', $password = '') {
        $credential = array('email' => $email, 'password' => $password);


        // Checking login credential for admin
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
            return 'success';
        }

         // Checking login credential for teacher
        $query = $this->db->get_where('staff', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('staff_login', '1');
            $this->session->set_userdata('staff_id', $row->staff_id);
            $this->session->set_userdata('login_user_id', $row->staff_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'staff');
            return 'success';
        }

        return 'invalid';
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function ajax_forgot_password()
    {
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["email"];
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('admin' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('admin' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        // Checking credential for student
        $query = $this->db->get_where('student' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'student';
            $this->db->where('email' , $email);
            $this->db->update('student' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
      
        // send new password to user email  
        $this->email_model->password_reset_email($new_password , $reset_account_type , $email);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }


    // frontend login 
    public function pro() 
    {   
        // $this->template->set_error_view("error/login_error.php");
        // $this->template->set_layout("layout/login_layout.php");
        if ($this->crud_model->check_block_ip()) {
            // $this->session->set_flashdata('logout_notification', '');
            echo "You have been blocked from this site!";
            exit;
            // redirect(base_url(), 'refresh');
            // $this->template->error(lang("error_26"));
        }

        $config = $this->config->item("cookieprefix");
        if ($this->user->loggedin) {
            // $this->session->set_flashdata('logout_notification', 'You have been blocked from this site!');
            echo "You are already logged in!";
            exit; 
            // $this->template->error(lang("error_27"));
        }
        
        $email = $this->input->post("email", true);
        $pass = $this->common->nohtml($this->input->post("pass", true));
        $remember = $this->input->post("remember", true);
        
        // if($this->settings->info->login_protect) {
        if($this->settings->info[21]->description) {
            // Check user for 5 login attempts
            $s = $this->crud_model->get_login_attempts($_SERVER['REMOTE_ADDR'], $email, (15*60));
            if($s->num_rows() > 0) { 
                $s = $s->row();
                if($s->count >=5) {
                    echo "You have attempted to login too many times! Please wait 15 minutes before trying again.";
                    exit;
                }
            }
        }

        if (empty($email) || empty($pass)) {
            echo "You are missing some details!";
            exit;
        }

        $login = $this->crud_model->getUserByEmail($email);
        if ($login->num_rows() == 0) {
            $login = $this->crud_model->getUserByUsername($email);
            if($login->num_rows() == 0) {
                $this->login_protect($email);
                echo "Invalid Login Details!";
                exit;
                
            }
        }
        $r = $login->row();
        $userid = $r->ID;
        $email = $r->email;

        $phpass = new PasswordHash(12, false);
        // print_r($phpass);
        // exit;
        if (!$phpass->CheckPassword($pass, $r->password)) {
            $this->login_protect($email);
            echo "Invalid Login Details!";
            exit;
            // $this->template->error(lang("error_29"));
        }

        // if($this->settings->info->activate_account) 
        // {
        //     if(!$r->active) {
        //         $this->template->error(lang("error_72") . "<a href='".
        //             site_url("register/send_activation_code/" . $r->ID . "/" .
        //              urlencode($r->email)).
        //             "'>".lang("error_73") ."</a> " . lang("error_74"));
        //     }
        // }

        // Generate a token
        $token = rand(1,100000) . $email;
        $token = md5(sha1($token));

        // Store it
        $this->crud_model->updateUserToken($userid, $token);

        // Create Cookies
        if ($remember == 1) {
            $ttl = 3600*24*31;
        } else {
            $ttl = 3600*24*31;
        }

        setcookie($config . "un", $email, time()+$ttl, "/");
        setcookie($config . "tkn", $token, time()+$ttl, "/");

        redirect(base_url());
    }

    private function login_protect($email) 
    {
        if($this->settings->info[21]->description) {
            // Add Count
            $s = $this->crud_model->get_login_attempts($_SERVER['REMOTE_ADDR'], $email, (15*60));
            if($s->num_rows() > 0) {
                $s = $s->row();
                $this->crud_model->update_login_attempt($s->ID, array(
                    "count" => $s->count+1
                    )
                );
            } else {
                $this->crud_model->add_login_attempt(array(
                    "IP" => $_SERVER['REMOTE_ADDR'],
                    "username" => $email,
                    "count" => 1,
                    "timestamp" => time()
                    )
                );
            }
        }
    }

    public function userlogout($hash) 
    {
        // print_r($this->security->get_csrf_hash());
        // exit;
        // $this->template->set_error_view("error/login_error.php");
        $config = $this->config->item("cookieprefix");
        $this->load->helper("cookie");
        if ($hash != $this->security->get_csrf_hash() ) {
            echo "Invalid Hash!";
            exit;
        }
        delete_cookie($config. "un");
        delete_cookie($config. "tkn");
        delete_cookie($config. "provider");
        delete_cookie($config. "oauthid");
        delete_cookie($config. "oauthtoken");
        delete_cookie($config. "oauthsecret");
        $this->session->sess_destroy();
        redirect(base_url());
    }




}
