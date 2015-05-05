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
            
            $value->dateTime = strtotime($value->date_time)*1000;
                        
        }
        
//        view home_dashboard and array of values stored in the $pagemodel varible
        $this->load->view('pages/home_dashboard', array(
                'pageModel' => $pageModel,
                
            ));
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
            if(isset ($request->facialTreatments)) {$appointment->facial_treatments = $this->implodeNonNull(", ", $request->facialTreatments);}
            if(isset ($request->bodyTreatments)) {$appointment->body_treatments = $this->implodeNonNull(", ", $request->bodyTreatments);}            
            if(isset ($request->eyeTreatments)) {$appointment->eye_treatments = $this->implodeNonNull(", ", $request->eyeTreatments);}
            if(isset ($request->sprayTanning)) {$appointment->spray_tanning = $this->implodeNonNull(", ", $request->sprayTanning);}
            if(isset ($request->nailTreatments)) {$appointment->nail_treatments = $this->implodeNonNull(", ", $request->nailTreatments);}
            if(isset ($request->waxingTreatments)) {$appointment->waxing_treatments = $this->implodeNonNull(", ", $request->waxingTreatments);}
            if(isset ($request->electrolysis)) {$appointment->electrolysis = $this->implodeNonNull(", ", $request->electrolysis);}
            $appointment->date_time = $request->dateTime; 
//            $date->setTimezone(new DateTimeZone('Pacific/Auckland'));
//            date_format($date, 'dd/mmmm/yy H:i:s');
//            $appointment->date_time = date($date);   
            $appointment = $this->Appointment->get($request->id); 
            
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
                $user->ph_number = $request->phNumber;
                $user->mobile_number = $request->mobilePhone;
                $user->is_admin = false;
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
    public function delete($id) {
        $this->load->model('Appointment');
        if ($this->Appointment->delete($id)) {
            $this->load->library('session');
            $this->session->set_flashdata('success', 'Appointment successfully deleted.');
        } else {
            $this->session->set_flashdata('error', 'There was a problem deleting the Appointment. Please try again.');
        }
//    take back to list
        redirect('/index', 'refresh');
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
