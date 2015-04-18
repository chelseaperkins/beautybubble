<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointments extends CI_Controller {

    function __construct() {
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
        $page_model = "";
        $this->load->helper('date');

        $this->load->model('User');
        $this->load->model('Appointment');
        
  
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$return = $_POST;
            $post_data = file_get_contents("php://input");
            $request = json_decode($post_data);
            
            $query = $this->db->get_where('users', array('email' => $request->email), 1, 0);
            if($query->num_rows > 0) {
                // get the first row from the results
                $user = new User();
                $match = reset($query->result());
                $user->id = $match->id;
                $user->first_name = $match->first_name;
                $user->last_name = $match->last_name;
                $user->email = $match->email;
                $user->ph_number = $match->ph_number;
                $user->mobile_number = $match->mobile_number;
                $user->is_admin = $match->is_admin;
            }else {
                // user does not exist so create
                $user = new User();
                $user->first_name = $request->firstName;
                $user->last_name = $request->lastName;
                $user->email =$request->email;
                $user->ph_number = $request->phNumber;
                $user->mobile_number = $request->mobilePhone;
                $user->is_admin = false;
                $user->save();
            }
                        
            $appointment = new Appointment();
            $appointment->user_id = $user->id;
            if(isset ($request->facialTreatments)) {
                $appointment->facial_treatments = $this->implodeNonNull(", ", $request->facialTreatments);
            }
            if(isset ($request->bodyTreatments)) {$appointment->body_treatments = $this->implodeNonNull(", ", $request->bodyTreatments);}            
            if(isset ($request->eyeTreatments)) {$appointment->eye_treatments = $this->implodeNonNull(", ", $request->eyeTreatments);}
            if(isset ($request->sprayTanning)) {$appointment->spray_tanning = $this->implodeNonNull(", ", $request->sprayTanning);}
            if(isset ($request->nailTreatments)) {$appointment->nail_treatments = $this->implodeNonNull(", ", $request->nailTreatments);}
            if(isset ($request->waxingTreatments)) {$appointment->waxing_treatments = $this->implodeNonNull(", ", $request->waxingTreatments);}
            if(isset ($request->electrolsis)) {$appointment->electrolysis = $this->implodeNonNull(", ", $request->electrolsis);}
            
            $appointment->date_time = $request->dateTime;     
            
            $appointment->save();

            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            exit( json_encode(array(
                'success'=> true, 
                'message' => "Saved", 
                'appointment' => $request,

                )));

        } else {

            $this->load->view('/pages/appointment_form');
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
    
    private function implodeNonNull($sep, $arr) {
        if($arr != null) {
            return implode($sep, $arr);
        }
        return "";
    }

}
