<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		$this->load->database();
        
        if ($this->crud_model->admin_open_ip()) {
            redirect(base_url(). 'errors/error_permission', 'refresh');
        }

       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'admin/login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
    }
    
    public function login()
    {
        // redirect(base_url() . 'login');
        $this->load->view('backend/login');
    }

    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE STAFF*****/
    function staff($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            $data['password']    = $this->input->post('password');
            $data['mobile']       = $this->input->post('mobile');
            $data['address']     = $this->input->post('address');
            $data['is_active']     = $this->input->post('is_active');
            $this->db->insert('staff', $data);
            $staff_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $staff_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            // $this->email_model->account_opening_email('staff', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'admin/staff/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            $data['password']    = $this->input->post('password');
            $data['mobile']       = $this->input->post('mobile');
            $data['address']     = $this->input->post('address');
            $data['is_active']     = $this->input->post('is_active');
            
            $this->db->where('staff_id', $param2);
            $this->db->update('staff', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/staff/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_staff_id'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('staff', array('staff_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('staff_id', $param2);
            $this->db->delete('staff');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/staff/', 'refresh');
        }
        
        $page_data['staffs']   = $this->db->get('staff')->result_array();
        $page_data['page_name']  = 'staff';
        $page_data['page_title'] = get_phrase('manage_staff');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CUSTOMER*****/
    function customer($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
            redirect(base_url() . 'admin/customer/', 'refresh');
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
            redirect(base_url() . 'admin/customer/', 'refresh');
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
            redirect(base_url() . 'admin/customer/', 'refresh');
        }
        
        $page_data['customers']   = $this->db->get('customer')->result_array();
        $page_data['page_name']  = 'customer';
        $page_data['page_title'] = get_phrase('manage_customer');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CUSTOMER*****/
    function paidCustomer($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'do_update') {
            $data['is_paid']     = $this->input->post('is_paid');
            
            $this->db->where('customer_id', $param2);
            $this->db->update('customer', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/paidCustomer/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('customer', array('customer_id' => $param2
            ))->result_array();
        }
        
        $page_data['page_name']  = 'paidCustomer';
        $page_data['page_title'] = get_phrase('manage_paidCustomer');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CURRENCY*****/
    function currency($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
            redirect(base_url() . 'admin/currency/', 'refresh');
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
            redirect(base_url() . 'admin/currency/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('customer', array('customer_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('currency_id', $param2);
            $this->db->delete('currency');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/currency/', 'refresh');
        }
        
        $page_data['currencys']   = $this->db->get('currency')->result_array();
        $page_data['page_name']  = 'currency';
        $page_data['page_title'] = get_phrase('manage_currency');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE CATEGORY*****/
    function category($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
            
            redirect(base_url() . 'admin/category/', 'refresh');
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
            redirect(base_url() . 'admin/category/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('category', array('category_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('category_id', $param2);
            $this->db->delete('category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/category/', 'refresh');
        }
        
        $page_data['categories']   = $this->db->get('category')->result_array();
        $page_data['page_name']  = 'category';
        $page_data['page_title'] = get_phrase('manage_category');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE FACILITIES*****/
    function facilities($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['facilities_name']        = $this->input->post('facilities_name');
            $data['is_visible']     = $this->input->post('is_visible');
            $this->db->insert('facilities', $data);
            $facilities_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/facilities_image/' . $facilities_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            
            redirect(base_url() . 'admin/facilities/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['facilities_name']        = $this->input->post('facilities_name');
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('facilities_id', $param2);
            $this->db->update('facilities', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/facilities_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/facilities/', 'refresh');
        } 
        if ($param1 == 'delete') {
            $this->db->where('facilities_id', $param2);
            $this->db->delete('facilities');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/facilities/', 'refresh');
        }
        
        $page_data['categories']   = $this->db->get('facilities')->result_array();
        $page_data['page_name']  = 'facilities';
        $page_data['page_title'] = get_phrase('manage_facilities');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE OUTLETS*****/
    function outlets($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['category_id']        = $this->input->post('category_id');
            $data['sub_category_id']       = $this->input->post('sub_category_id');
            $data['outlets_name']       = $this->input->post('outlets_name');
            $data['short_desc']       = $this->input->post('short_desc');
            $data['long_desc']       = $this->input->post('long_desc');
            $data['facilities']       = $this->input->post('facilities');
            $data['facilities_icon']       = $this->input->post('facilities_icon');
            $data['country_id']       = $this->input->post('country_id');
            $data['state_id']       = $this->input->post('state_id');
            $data['city_id']       = $this->input->post('city_id');
            $data['pincode']       = $this->input->post('pincode');
            $data['address']       = $this->input->post('address');
            $data['time_sun']       = $this->input->post('time_sun');
            $data['time_mon']       = $this->input->post('time_mon');
            $data['time_tue']       = $this->input->post('time_tue');
            $data['time_wed']       = $this->input->post('time_wed');
            $data['time_thu']       = $this->input->post('time_thu');
            $data['time_fri']       = $this->input->post('time_fri');
            $data['time_sat']       = $this->input->post('time_sat');
            $data['email']       = $this->input->post('email');
            $data['website']       = $this->input->post('website');
            $data['contact_number']       = $this->input->post('contact_number');
            $data['latitude']       = $this->input->post('latitude');            
            $data['longitude']       = $this->input->post('longitude');            
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            $data['is_visible']     = $this->input->post('is_visible');

            $this->db->insert('outlets', $data);
            $outlets_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/outlets_image/' . $outlets_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            
            redirect(base_url() . 'admin/outlets/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['category_id']        = $this->input->post('category_id');
            $data['sub_category_id']       = $this->input->post('sub_category_id');
            $data['outlets_name']       = $this->input->post('outlets_name');
            $data['short_desc']       = $this->input->post('short_desc');
            $data['long_desc']       = $this->input->post('long_desc');
            $data['facilities']       = $this->input->post('facilities');
            $data['facilities_icon']       = $this->input->post('facilities_icon');
            $data['country_id']       = $this->input->post('country_id');
            $data['state_id']       = $this->input->post('state_id');
            $data['city_id']       = $this->input->post('city_id');
            $data['pincode']       = $this->input->post('pincode');
            $data['address']       = $this->input->post('address');
            $data['time_sun']       = $this->input->post('time_sun');
            $data['time_mon']       = $this->input->post('time_mon');
            $data['time_tue']       = $this->input->post('time_tue');
            $data['time_wed']       = $this->input->post('time_wed');
            $data['time_thu']       = $this->input->post('time_thu');
            $data['time_fri']       = $this->input->post('time_fri');
            $data['time_sat']       = $this->input->post('time_sat');
            $data['email']       = $this->input->post('email');
            $data['website']       = $this->input->post('website');
            $data['contact_number']       = $this->input->post('contact_number');
            $data['latitude']       = $this->input->post('latitude');            
            $data['longitude']       = $this->input->post('longitude'); 
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('outlets_id', $param2);
            $this->db->update('outlets', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/outlets_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/outlets/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('outlets', array('outlets_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('outlets_id', $param2);
            $this->db->delete('outlets');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/outlets/', 'refresh');
        }
        
        $page_data['outlets']   = $this->db->get('outlets')->result_array();
        $page_data['page_name']  = 'outlets';
        $page_data['page_title'] = get_phrase('manage_outlets');
        $this->load->view('backend/index', $page_data);
    }

    /****MANAGE VOUCHER*****/
    function voucher($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['title']       = $this->input->post('title');
            $data['outlets_id']       = $this->input->post('outlets_id');
            $data['category_id']        = $this->input->post('category_id');
            $data['sub_category_id']       = $this->input->post('sub_category_id');
            $data['price']       = $this->input->post('price');
            $data['discount']       = $this->input->post('discount');
            $data['validity']       = $this->input->post('validity');
            $data['short_desc']       = $this->input->post('short_desc');
            $data['long_desc']       = $this->input->post('long_desc');
            $data['terms']       = $this->input->post('terms');
            $data['country_id']       = $this->input->post('country_id');
            $data['state_id']       = $this->input->post('state_id');
            $data['city_id']       = $this->input->post('city_id');
            $data['pincode']       = $this->input->post('pincode');
            $data['address']       = $this->input->post('address');
            $data['latitude']       = $this->input->post('latitude');  
            $data['longitude']       = $this->input->post('longitude');           
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            $data['is_visible']     = $this->input->post('is_visible');

            $this->db->insert('voucher', $data);
            $voucher_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/voucher_image/' . $voucher_id . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            
            redirect(base_url() . 'admin/voucher/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['title']       = $this->input->post('title');
            $data['outlets_id']       = $this->input->post('outlets_id');
            $data['category_id']        = $this->input->post('category_id');
            $data['sub_category_id']       = $this->input->post('sub_category_id');
            $data['price']       = $this->input->post('price');
            $data['discount']       = $this->input->post('discount');
            $data['validity']       = $this->input->post('validity');
            $data['short_desc']       = $this->input->post('short_desc');
            $data['long_desc']       = $this->input->post('long_desc');
            $data['terms']       = $this->input->post('terms');
            $data['country_id']       = $this->input->post('country_id');
            $data['state_id']       = $this->input->post('state_id');
            $data['city_id']       = $this->input->post('city_id');
            $data['pincode']       = $this->input->post('pincode');
            $data['address']       = $this->input->post('address');
            $data['latitude']       = $this->input->post('latitude');  
            $data['longitude']       = $this->input->post('longitude');           
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('voucher_id', $param2);
            $this->db->update('voucher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/voucher_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/voucher/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('voucher', array('voucher_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('voucher_id', $param2);
            $this->db->delete('voucher');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/voucher/', 'refresh');
        }
        
        $page_data['vouchers']   = $this->db->get('voucher')->result_array();
        $page_data['page_name']  = 'voucher';
        $page_data['page_title'] = get_phrase('manage_voucher');
        $this->load->view('backend/index', $page_data);
    }

    function get_category_subcategory($category_id)
    {
        $subcategories = $this->db->get_where('sub_category' , array('category_id' => $category_id, 'is_visible'=> 1 ))->result_array();
        if(empty($subcategories)) echo '<option value="">select</option>';
        else
        {
            foreach ($subcategories as $row) {
                echo '<option value="' . $row['sub_category_id'] . '">' . $row['sub_category_name'] . '</option>';
            }    
        }
        
    }

    function get_country_state($country_id)
    {
        $states = $this->db->get_where('state' , array('country_id' => $country_id, 'is_visible'=> 1 ))->result_array();
        if(empty($states)) echo '<option value="">select</option>';
        else
        {
            foreach ($states as $row) {
                echo '<option value="' . $row['state_id'] . '">' . $row['state_name'] . '</option>';
            }    
        }
        
    }

    function get_state_city($state_id)
    {
        $city = $this->db->get_where('city' , array('state_id' => $state_id, 'is_visible'=> 1 ))->result_array();
        if(empty($city)) echo '<option value="">select</option>';
        else
        {
            foreach ($city as $row) {
                echo '<option value="' . $row['city_id'] . '">' . $row['city_name'] . '</option>';
            }    
        }
        
    }






    /****MANAGE SUB CATEGORY*****/
    function sub_category($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
            
            redirect(base_url() . 'admin/sub_category/', 'refresh');
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
            redirect(base_url() . 'admin/sub_category/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('sub_category', array('sub_category_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('sub_category_id', $param2);
            $this->db->delete('sub_category');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/sub_category/', 'refresh');
        }
        
        $page_data['sub_categories']   = $this->db->get('sub_category')->result_array();
        $page_data['page_name']  = 'sub_category';
        $page_data['page_title'] = get_phrase('manage_sub_category');
        $this->load->view('backend/index', $page_data);
    }
    
    /****MANAGE COUNTRY*****/
    function country($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
        if ($this->session->userdata('admin_login') != 1)
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
        if ($this->session->userdata('admin_login') != 1)
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
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['question']        = $this->input->post('question');
            $data['answer']       = $this->input->post('answer');
            $data['is_visible']     = $this->input->post('is_visible');
            $this->db->insert('faq', $data);
            $faq_id = $this->db->insert_id();
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'admin/faq/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['question']        = $this->input->post('question');
            $data['answer']       = $this->input->post('answer');
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('faq_id', $param2);
            $this->db->update('faq', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/faq/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('faq', array('faq_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('faq_id', $param2);
            $this->db->delete('faq');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/faq/', 'refresh');
        }
        
        $page_data['faqs']   = $this->db->get('faq')->result_array();
        $page_data['page_name']  = 'faq';
        $page_data['page_title'] = get_phrase('manage_faq');
        $this->load->view('backend/index', $page_data);
    }
    
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'admin/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'admin/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
    
    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        if ($param1 == 'do_update') {
			 
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type' , 'text_align');
            $this->db->update('settings' , $data);
			
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated')); 
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected')); 
            redirect(base_url() . 'admin/system_settings/', 'refresh'); 
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'twilio') {

            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'active_service') {

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/sms_settings/', 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'login', 'refresh');
		
		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;	
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'admin/manage_language/', 'refresh');
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
			redirect(base_url() . 'admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			
			redirect(base_url() . 'admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);	
    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'admin/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE EMAIL TEMPLATE***/
    function email_template($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
            redirect(base_url() . 'admin/email_template/', 'refresh');
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
            redirect(base_url() . 'admin/email_template/', 'refresh');
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
            redirect(base_url() . 'admin/email_template/', 'refresh');
        }
        
        $page_data['page_name']  = 'email_template';
        $page_data['page_title'] = get_phrase('manage_email_template');
        $this->load->view('backend/index', $page_data);
    }


    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    
    /******MANAGE PAGES***/
    function pages($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['pages_name']        = $this->input->post('pages_name');
            $data['content']       = $this->input->post('content');
            $data['is_visible']     = $this->input->post('is_visible');
            $this->db->insert('pages', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'admin/pages/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['pages_name']        = $this->input->post('pages_name');
            $data['content']       = $this->input->post('content');
            $data['is_visible']     = $this->input->post('is_visible');
            
            $this->db->where('pages_id', $param2);
            $this->db->update('pages', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/pages/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('pages', array('pages_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('pages_id', $param2);
            $this->db->delete('pages');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/pages/', 'refresh');
        }
        
        $page_data['page_name']  = 'pages';
        $page_data['page_title'] = get_phrase('manage_pages');
        $this->load->view('backend/index', $page_data);
    }

    /******MANAGE SEO META***/
    function seo_meta($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['page_name']        = $this->input->post('page_name');
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            $this->db->insert('seo_meta', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'admin/seo_meta/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['page_name']        = $this->input->post('page_name');
            $data['seo_title']       = $this->input->post('seo_title');
            $data['seo_keyword']       = $this->input->post('seo_keyword');
            $data['seo_desc']       = $this->input->post('seo_desc');
            
            $this->db->where('seo_meta_id', $param2);
            $this->db->update('seo_meta', $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'admin/seo_meta/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('seo_meta', array('seo_meta_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('seo_meta_id', $param2);
            $this->db->delete('seo_meta');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'admin/seo_meta/', 'refresh');
        }
        
        $page_data['page_name']  = 'seo_meta';
        $page_data['page_title'] = get_phrase('manage_seo');
        $this->load->view('backend/index', $page_data);
    }




}