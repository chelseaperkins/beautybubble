<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class PageModel {
    public $results;
}

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');

        $this->_init();
    }

    private function _init() {
        $this->output->set_template('simple');
    }

    public function index() {
        
        if($this->session->userdata('first_name'))
        {
            // is logged in
                
            $this->load->model('Appointment');
            $this->load->model('User');
    //        Set new model varible
            $pageModel = new PageModel();
    //      Get all appointments from the database
            $pageModel->results = $this->Appointment->get_all();
    //      loop results so that they display appointments by values from database
            foreach ($pageModel->results as $value) {
                $user = $this->User->get($value->user_id);
                $value->first_name = $user->first_name;
                $value->last_name = $user->last_name;
                $value->email = $user->email;

                $value->facialTreatments = isset($value->facial_treatments) ? explode(', ', $value->facial_treatments) : array();
                $value->eyeTreatments = isset($value->eye_treatments) ? explode(', ', $value->eye_treatments) : array();
                $value->bodyTreatments = isset($value->body_treatments) ? explode(', ', $value->body_treatments) : array();
                $value->sprayTanning = isset($value->spray_tanning) ? explode(', ', $value->spray_tanning) : array();
                $value->nailTreatments = isset($value->nail_treatments) ? explode(', ', $value->nail_treatments) : array();
                $value->waxingTreatments = isset($value->waxing_treatments) ? explode(', ', $value->waxing_treatments) : array();
                $value->electrolysis = isset($value->electrolysis) ? explode(', ', $value->electrolysis) : array();
                $local_date = new DateTime($value->date_time, new DateTimeZone('GMT') );
                $local_date->setTimeZone(new DateTimeZone('Pacific/Auckland'));
                // get the time string formated to ISO 8601
                $value->dateTime = $local_date->format(DateTime::ISO8601);

               }
//               get all users from db $pageModel varible to display users(clients) in dashboard
            $pageModel->clients = $this->User->get_all();

    //        view home_dashboard and array of values stored in the $pagemodel varible
            $this->load->view('pages/home_dashboard', array(
                    'pageModel' => $pageModel,

                ));
        }
        else
        {
             redirect('');
        }
        
    }
    
    public function our_treatments() {
        $this->load->view('pages/our_treatments');
    }
   

    public function edit(){
            $page_model = "";
            $this->load->helper('date');
            $this->load->model('Appointment');
            
            
           if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$return = $_POST;         
            
            $post_data = file_get_contents("php://input");
//            create varible to decode data to json and pass in user input data
            $request = json_decode($post_data);
            $appointment = $this->Appointment->get($request->id); 
            if(isset ($request->facialTreatments)) {$appointment->facial_treatments = $this->implodeNonNull(", ", $request->facialTreatments);}
            if(isset ($request->bodyTreatments)) {$appointment->body_treatments = $this->implodeNonNull(", ", $request->bodyTreatments);}            
            if(isset ($request->eyeTreatments)) {$appointment->eye_treatments = $this->implodeNonNull(", ", $request->eyeTreatments);}
            if(isset ($request->sprayTanning)) {$appointment->spray_tanning = $this->implodeNonNull(", ", $request->sprayTanning);}
            if(isset ($request->nailTreatments)) {$appointment->nail_treatments = $this->implodeNonNull(", ", $request->nailTreatments);}
            if(isset ($request->waxingTreatments)) {$appointment->waxing_treatments = $this->implodeNonNull(", ", $request->waxingTreatments);}
            if(isset ($request->electrolysis)) {$appointment->electrolysis = $this->implodeNonNull(", ", $request->electrolysis);}
            $utc_date = new DateTime($request->dateTime, new DateTimeZone('GMT') );
            $appointment->date_time = $utc_date->format('Y-m-d H:i:s'); 
    
            $success = $this->Appointment->update($appointment->id, $appointment);
            
            // send back json
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            exit(json_encode(array(
                'success'=> $success, 
                'message' => "Saved", 
                'appointment' => $request,

                )));
           }
    }
            public function add($id=null){
                $page_model = "";
            $this->load->model('User');
            $this->load->model('Appointment');
             if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$return = $_POST;
                 
            $post_data = file_get_contents("php://input");
                  
//            create varible to decode data to json and pass in user input data
            $request = json_decode($post_data);
            $success = true;
            $message = "Saved";
            // validate data
            $isValid = true;
            if($isValid && isset($request->firstName) == false || preg_match("/^[a-zA-Z]*$/", $request->firstName) == false) {
                $isValid = false;
                $message = "First name is invalid";
            }
            if($isValid && isset($request->lastName) == false || preg_match("/^[a-zA-Z]*$/", $request->lastName) == false) {
                $isValid = false;
                $message = "Last name is invalid";
            }
            if($isValid && isset($request->phNumber) == true && preg_match("/^[+0-9]*$/", $request->phNumber) == false) {
                $isValid = false;
                $message = "Phone number is invalid";
            }
            if($isValid && isset($request->mobileNumber) == true && preg_match("/^[+0-9]*$/", $request->mobileNumber) == false) {
                $isValid = false;
                $message = "Mobile number is invalid";
            }
//            if form is valid, input values into database
            if($isValid) {
            
            
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
                $user->email = $request->email;
                $user->ph_number = isset($request->phNumber) ? $request->phNumber : null;
                $user->mobile_number = isset($request->mobilePhone) ? $request->mobilePhone : null;
                $user->is_admin = false;
                $user->is_verified = false;
                $user->save();
            }
              
                $appointment = new Appointment();
                $appointment->user_id = $user->id;
            if(isset ($request->facialTreatments)) {$appointment->facial_treatments = $this->implodeNonNull(", ", $request->facialTreatments);}
            if(isset ($request->bodyTreatments)) {$appointment->body_treatments = $this->implodeNonNull(", ", $request->bodyTreatments);}            
            if(isset ($request->eyeTreatments)) {$appointment->eye_treatments = $this->implodeNonNull(", ", $request->eyeTreatments);}
            if(isset ($request->sprayTanning)) {$appointment->spray_tanning = $this->implodeNonNull(", ", $request->sprayTanning);}
            if(isset ($request->nailTreatments)) {$appointment->nail_treatments = $this->implodeNonNull(", ", $request->nailTreatments);}
            if(isset ($request->waxingTreatments)) {$appointment->waxing_treatments = $this->implodeNonNull(", ", $request->waxingTreatments);}
            if(isset ($request->electrolysis)) {$appointment->electrolysis = $this->implodeNonNull(", ", $request->electrolysis);} 
            $appointment->date_time = $request->dateTime;
            $appointment->save();
            }
             }         
          
            // send back json
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            exit(json_encode(array(
                'success'=> true, 
                'message' => "Saved", 
                'appointment' => $request,

                )));
    }
                       
    /**
     * Delete Appointment based on id. Status is passed in for redirection to list.
     * @param string $status
     * @param int $id
     */
    public function delete() {
        $this->load->model('Appointment');
        $post_data = file_get_contents("php://input");
        $request = json_decode($post_data);
        $success = false;
        if ($this->Appointment->delete($request->id)) {
            $success = true;
            $this->load->library('session');
            $this->session->set_flashdata('success', 'Appointment successfully deleted.');
        } else {
            $this->session->set_flashdata('error', 'There was a problem deleting the Appointment. Please try again.');
        }
        exit(json_encode(array(
                'success'=> $success, 
                'message' => "Deleted", 
            )));
    }
    
    public function profile() {
        $page_model = "";
            $this->load->model('User');
            
             if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$return = $_POST;
                 
            $post_data = file_get_contents("php://input");
                  
//            create varible to decode data to json and pass in user input data
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
                $user->is_admin = $match->is_admin;
            }else {
                // user does not exist so create
                $user = new User();
                $user->first_name = $request->firstName;
                $user->last_name = $request->lastName;
                $user->email = $request->email;
                $user->is_admin = false;
                $user->save();
            }
           
    }
    // send back json
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            exit(json_encode(array(
                'success'=> true, 
                'message' => "Saved", 
                'appointment' => $request,

                )));
    }
    
    
    private function implodeNonNull($sep, $arr) {
        if($arr != null && $arr != "" && count($arr) != 0) {
            $res = implode($sep, $arr);
            return $res != "" ? $res : null;
        }
        return null;
    }
  }
