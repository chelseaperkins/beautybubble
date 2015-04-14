<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointments extends CI_Controller {

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
       $this->load->view('pages/appointment_form');
    }

    public function request($id = NULL) {
        
        $this->load->helper('form');
        $this->load->model('Appointment');
        
        $appointment = new Appointment();
        //populate from post
        $appointment->first_name = $this->input->post('first_name');
        $appointment->last_name = $this->input->post('last_name');
        $appointment->email = $this->input->post('email');
        $appointment->ph_number = $this->input->post('ph_number');
        $appointment->mobile_number = $this->input->post('mobile_number');
        $appointment->facial_treatments = $this->input->post('facial_treatments');
        $appointment->eye_treatments = $this->input->post('eye_treatments');
        $appointment->spray_tanning = $this->input->post('spray_tanning');
        $appointment->nail_treatments = $this->input->post('nail_treatments');
        $appointment->waxing_treatments = $this->input->post('waxing_treatments');
        $appointment->electrolysis = $this->input->post('electrolysis');
        $appointment->date = $this->input->post('date');
        $appointment->time = $this->input->post('time');
        $appointment->status = $this->input->post('status');

        // validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array(
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'required|alpha|xss_clean',
            ),
            array(
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'required|alpha|xss_clean',
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|xss_clean',
            ),
            array(
                'field' => 'ph_number',
                'label' => 'Phone Number',
                'rules' => 'required|is_numeric|xss_clean',
            ),
            array(
                'field' => 'mobile_number',
                'label' => 'Mobile Number',
                'rules' => 'required|is_numeric|xss_clean',
            ),
            
            array(
                'field' => 'date_time',
                'label' => 'Appoinment Date',
                'rules' => 'required|callback_date_validation',
            ),
            array(
                'field' => 'date_time',
                'label' => 'Apointment Time',
                'rules' => 'required',
            ),
        ));
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        //if doesn't validate
        if (!$this->form_validation->run()) {
            $this->load->view('pages/appointment_form', array(
                'appointment' => $appointment,
            ));
        } else {//if validates
            $appointment->id = (int) $id;
            $appointment->save($id);
            //add flash and redirect
            $action = "";
            if ($id == null) {
                $action = "added";
            } else {
                $action = "updated";
            }
            redirect('/pages/appointment_form');
        }
    }

    public function email() {
        $this->load->library('email');

        $this->email->from('your@example.com', 'Your Name');
        $this->email->to('someone@example.com');
        $this->email->cc('another@another-example.com');
        $this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();

        echo $this->email->print_debugger();
    }

}
