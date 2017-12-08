<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller
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
    
    /***default functin, redirects to login page if no staff logged in yet***/
    public function index()
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('staff_login') == 1)
            redirect(base_url() . 'index.php?staff/dashboard', 'refresh');
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
    
   
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        //if($this->session->userdata('staff_login')!=1)redirect(base_url() , 'refresh');
        if ($param1 == 'make_payment') {
            $invoice_id      = $this->input->post('invoice_id');
            $system_settings = $this->db->get_where('settings', array(
                'type' => 'paypal_email'
            ))->row();
            $invoice_details = $this->db->get_where('invoice', array(
                'invoice_id' => $invoice_id
            ))->row();
            
            /****TRANSFERRING USER TO PAYPAL TERMINAL****/
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('no_note', 0);
            $this->paypal->add_field('item_name', $invoice_details->title);
            $this->paypal->add_field('amount', $invoice_details->amount);
            $this->paypal->add_field('custom', $invoice_details->invoice_id);
            $this->paypal->add_field('business', $system_settings->description);
            $this->paypal->add_field('notify_url', base_url() . 'index.php?student/invoice/paypal_ipn');
            $this->paypal->add_field('cancel_return', base_url() . 'index.php?student/invoice/paypal_cancel');
            $this->paypal->add_field('return', base_url() . 'index.php?student/invoice/paypal_success');
            
            $this->paypal->submit_paypal_post();
            // submit the fields to paypal
        }
        if ($param1 == 'paypal_ipn') {
            if ($this->paypal->validate_ipn() == true) {
                $ipn_response = '';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $ipn_response .= "\n$key=$value";
                }
                $data['payment_details']   = $ipn_response;
                $data['payment_timestamp'] = strtotime(date("m/d/Y"));
                $data['payment_method']    = 'paypal';
                $data['status']            = 'paid';
                $invoice_id                = $_POST['custom'];
                $this->db->where('invoice_id', $invoice_id);
                $this->db->update('invoice', $data);

                $data2['method']       =   'paypal';
                $data2['invoice_id']   =   $_POST['custom'];
                $data2['timestamp']    =   strtotime(date("m/d/Y"));
                $data2['payment_type'] =   'income';
                $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
                $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                $this->db->insert('payment' , $data2);
            }
        }
        if ($param1 == 'paypal_cancel') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_cancelled'));
            redirect(base_url() . 'index.php?student/invoice/', 'refresh');
        }
        if ($param1 == 'paypal_success') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
            redirect(base_url() . 'index.php?student/invoice/', 'refresh');
        }
        $student_profile         = $this->db->get_where('student', array(
            'student_id'   => $this->session->userdata('student_id')
        ))->row();
        $student_id              = $student_profile->student_id;
        $page_data['invoices']   = $this->db->get_where('invoice', array(
            'student_id' => $student_id
        ))->result_array();
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('staff_id', $this->session->userdata('staff_id'));
            $this->db->update('staff', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $this->session->userdata('staff_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?staff/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('staff', array(
                'staff_id' => $this->session->userdata('staff_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('staff_id', $this->session->userdata('staff_id'));
                $this->db->update('staff', array('password' => $data['new_password'] ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?staff/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('staff', array('staff_id' => $this->session->userdata('staff_id') ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /* ==================================== ADD / UPDATE / DELETE ========================== */
    /****MANAGE CUSTOMER*****/
    function customer($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['first_name']        = $this->input->post('first_name');
            $data['last_name']        = $this->input->post('last_name');
            $data['email_id']       = $this->input->post('email_id');
            // $data['password']    = $this->input->post('password');
            $data['mobile']       = $this->input->post('mobile');
            $data['address']     = $this->input->post('address');
            $data['is_visible']     = $this->input->post('is_visible');
            $this->db->insert('customer', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?staff/customer/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['first_name']        = $this->input->post('first_name');
            $data['last_name']        = $this->input->post('last_name');
            $data['email_id']       = $this->input->post('email_id');
            // $data['password']    = $this->input->post('password');
            $data['mobile']       = $this->input->post('mobile');
            $data['address']     = $this->input->post('address');
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('customer_id', $param2);
            $this->db->update('customer', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?staff/customer/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_customer_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('customer', array('customer_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('customer_id', $param2);
            $this->db->delete('customer');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?staff/customer/', 'refresh');
        }
        
        $page_data['customers']   = $this->db->get('customer')->result_array();
        $page_data['page_name']  = 'customer';
        $page_data['page_title'] = get_phrase('manage_customer');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CURRENCY*****/
    function currency($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['currency_name']        = $this->input->post('currency_name');
            $data['currency_code']        = $this->input->post('currency_code');
            $data['currency_symbol']       = $this->input->post('currency_symbol');
            $data['currency_value']       = $this->input->post('currency_value');
            $data['last_update']     = date("Y-m-d H:i:s");
            $data['is_visible']     = $this->input->post('is_visible');
            $this->db->insert('currency', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?staff/currency/', 'refresh');
        }
        if ($param1 == 'do_update') {
           $data['currency_name']        = $this->input->post('currency_name');
            $data['currency_code']        = $this->input->post('currency_code');
            $data['currency_symbol']       = $this->input->post('currency_symbol');
            $data['currency_value']       = $this->input->post('currency_value');
            $data['last_update']     = date("Y-m-d H:i:s");
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('currency_id', $param2);
            $this->db->update('currency', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?staff/currency/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('customer', array('customer_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('currency_id', $param2);
            $this->db->delete('currency');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?staff/currency/', 'refresh');
        }
        
        $page_data['currencys']   = $this->db->get('currency')->result_array();
        $page_data['page_name']  = 'currency';
        $page_data['page_title'] = get_phrase('manage_currency');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CATEGORY*****/
    function category($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['category_name']        = $this->input->post('category_name');
            $data['category_desc']       = $this->input->post('category_desc');
            $data['is_visible']     = $this->input->post('is_visible');
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            $this->db->insert('category', $data);
            $category_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/category_image/' . $category_id . '.jpg');
            move_uploaded_file($_FILES['userfile1']['tmp_name'], 'uploads/category_icon_image/' . $category_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            
            redirect(base_url() . 'index.php?staff/category/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['category_name']        = $this->input->post('category_name');
            $data['category_desc']       = $this->input->post('category_desc');
            $data['is_visible']     = $this->input->post('is_visible');
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            
            $this->db->where('category_id', $param2);
            $this->db->update('category', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/category_image/' . $param2 . '.jpg');
            move_uploaded_file($_FILES['userfile1']['tmp_name'], 'uploads/category_icon_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?staff/category/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('category', array('category_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('category_id', $param2);
            $this->db->delete('category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?staff/category/', 'refresh');
        }
        
        $page_data['categories']   = $this->db->get('category')->result_array();
        $page_data['page_name']  = 'category';
        $page_data['page_title'] = get_phrase('manage_category');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE SUB CATEGORY*****/
    function sub_category($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['category_id']        = $this->input->post('category_id');
            $data['sub_category_name']        = $this->input->post('sub_category_name');
            $data['sub_category_desc']       = $this->input->post('sub_category_desc');
            $data['is_visible']     = $this->input->post('is_visible');
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            $this->db->insert('sub_category', $data);
            $sub_category_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sub_category_image/' . $sub_category_id . '.jpg');
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            
            redirect(base_url() . 'index.php?staff/sub_category/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['category_id']        = $this->input->post('category_id');
            $data['sub_category_name']        = $this->input->post('sub_category_name');
            $data['sub_category_desc']       = $this->input->post('sub_category_desc');
            $data['is_visible']     = $this->input->post('is_visible');
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            
            $this->db->where('sub_category_id', $param2);
            $this->db->update('sub_category', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/sub_category_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?staff/sub_category/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('sub_category', array('sub_category_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('sub_category_id', $param2);
            $this->db->delete('sub_category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?staff/sub_category/', 'refresh');
        }
        
        $page_data['sub_categories']   = $this->db->get('sub_category')->result_array();
        $page_data['page_name']  = 'sub_category';
        $page_data['page_title'] = get_phrase('manage_sub_category');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE COUNTRY*****/
    function country($param1 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');

        $this->db->order_by("country_name","ASC");
        $page_data['countries']   = $this->db->get('country')->result_array();
        $page_data['page_name']  = 'country';
        $page_data['page_title'] = get_phrase('manage_country');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE STATE*****/
    function state($param1 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');

        $this->db->order_by("state_name","ASC");
        if(is_numeric($param1))
            $page_data['state']   = $this->db->get_where('state',array('country_id'=>$param1))->result_array();
        else
            $page_data['state']   = $this->db->get('state')->result_array();

        $page_data['country']   = $this->db->get_where('country',array('country_id'=>$param1))->row()->country_name;      
        $page_data['page_name']  = 'state';
        $page_data['page_title'] = get_phrase('manage_state');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CITY*****/
    function city($param1 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');

         $this->db->order_by("city_name","ASC");
        if(is_numeric($param1))
            $page_data['city']   = $this->db->get_where('city',array('state_id'=>$param1))->result_array();
        else
            $page_data['city']   = $this->db->get('city')->result_array();
        
        $page_data['state']   = $this->db->get_where('state',array('state_id'=>$param1))->row()->state_name; 
        $page_data['page_name']  = 'city';
        $page_data['page_title'] = get_phrase('manage_city');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE FAQ's*****/
    function faq($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['question']        = $this->input->post('question');
            $data['answer']       = $this->input->post('answer');
            $data['is_visible']     = $this->input->post('is_visible');
            $this->db->insert('faq', $data);
            $faq_id = $this->db->insert_id();
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?staff/faq/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['question']        = $this->input->post('question');
            $data['answer']       = $this->input->post('answer');
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('faq_id', $param2);
            $this->db->update('faq', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?staff/faq/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('faq', array('faq_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('faq_id', $param2);
            $this->db->delete('faq');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?staff/faq/', 'refresh');
        }
        
        $page_data['faqs']   = $this->db->get('faq')->result_array();
        $page_data['page_name']  = 'faq';
        $page_data['page_title'] = get_phrase('manage_faq');
        $this->load->view('backend/index', $page_data);
    }
    
    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile']  = $param2;  
        }
        if ($param1 == 'update_phrase') {
            $language   =   $param2;
            $total_phrase   =   $this->input->post('total_phrase');
            for($i = 1 ; $i < $total_phrase ; $i++)
            {
                //$data[$language]  =   $this->input->post('phrase').$i;
                $this->db->where('phrase_id' , $i);
                $this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
            }
            redirect(base_url() . 'index.php?staff/manage_language/edit_phrase/'.$language, 'refresh');
        }
        if ($param1 == 'do_update') {
            $language        = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?staff/manage_language/', 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?staff/manage_language/', 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);
            
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?staff/manage_language/', 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            
            redirect(base_url() . 'index.php?staff/manage_language/', 'refresh');
        }
        $page_data['page_name']        = 'manage_language';
        $page_data['page_title']       = get_phrase('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data); 
    }
    
    /******MANAGE EMAIL TEMPLATE***/
    function email_template($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['email_type']        = $this->input->post('email_type');
            $data['email_title']       = $this->input->post('email_title');
            $data['email_subject']    = $this->input->post('email_subject');
            $data['email_body_text']       = $this->input->post('email_body_text');
            $data['email_body_html']     = $this->input->post('email_body_html');
            $data['is_visible']     = $this->input->post('is_visible');
            $this->db->insert('email_template', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?staff/email_template/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['email_type']        = $this->input->post('email_type');
            $data['email_title']       = $this->input->post('email_title');
            $data['email_subject']    = $this->input->post('email_subject');
            $data['email_body_text']       = $this->input->post('email_body_text');
            $data['email_body_html']     = $this->input->post('email_body_html');
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('email_template_id', $param2);
            $this->db->update('email_template', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?staff/email_template/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_email_template_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('email_template', array('email_template_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('email_template_id', $param2);
            $this->db->delete('email_template');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?staff/email_template/', 'refresh');
        }
        
        $page_data['page_name']  = 'email_template';
        $page_data['page_title'] = get_phrase('manage_email_template');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE PAGES***/
    function pages($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['pages_name']        = $this->input->post('pages_name');
            $data['content']       = $this->input->post('content');
            $data['is_visible']     = $this->input->post('is_visible');
            $this->db->insert('pages', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?staff/pages/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['pages_name']        = $this->input->post('pages_name');
            $data['content']       = $this->input->post('content');
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('pages_id', $param2);
            $this->db->update('pages', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?staff/pages/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('pages', array('pages_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('pages_id', $param2);
            $this->db->delete('pages');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?staff/pages/', 'refresh');
        }
        
        $page_data['page_name']  = 'pages';
        $page_data['page_title'] = get_phrase('manage_pages');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE SEO META***/
    function seo_meta($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['page_name']        = $this->input->post('page_name');
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            $this->db->insert('seo_meta', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?staff/seo_meta/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['page_name']        = $this->input->post('page_name');
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            
            $this->db->where('seo_meta_id', $param2);
            $this->db->update('seo_meta', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?staff/seo_meta/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('seo_meta', array('seo_meta_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('seo_meta_id', $param2);
            $this->db->delete('seo_meta');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?staff/seo_meta/', 'refresh');
        }
        
        $page_data['page_name']  = 'seo_meta';
        $page_data['page_title'] = get_phrase('manage_seo');
        $this->load->view('backend/index', $page_data);
    }
    


}