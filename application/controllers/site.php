<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_controller {
    
    function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

		$this->_init();
	}
        
        private function _init() {
        $this->output->set_template('default');

        
//        $this->load->js('assets/themes/default/js/jquery-ui-1.8.16.custom.min.js');
//        
//        //bootstrap
//	$this->load->js('assets/themes/default/js/bootstrap.min.js');
//        $this->load->js('assets/themes/default/js/script.js');
    }
    
    public function index() {

        $this->load->view('pages/home');
    }
    
    public function about_us()
	{
        
		$this->load->view('pages/about_us');
	}

	public function our_treatments()
	{
		$this->load->view('pages/our_treatments');
	}

	public function appointment_form()
	{
//            $this->load->library('form_validation');
//            
//            $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha|xss_clean');
//            $this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha|xss_clean');
//            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|xss_clean');
            
            
            
		$this->load->view('pages/appointment_form');
	}
        
        public function send_email(){
            
        }

	public function contact()
	{
		
		$this->load->view('pages/contact');
	}
    
    
}
