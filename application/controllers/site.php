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
       
	public function contact()
	{
		
		$this->load->view('pages/contact');
	}
    
    
}
