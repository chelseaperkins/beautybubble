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
            //Check email address in database to check if user exsists. 
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
            if(isset ($request->electrolsis)) {$appointment->electrolysis = $this->implodeNonNull(", ", $request->electrolsis);}
            $appointment->date_time = $request->dateTime;
            $this->sendemail($request);                          
            $appointment->save();
            
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            exit(json_encode(array(
                'success'=> true, 
                'message' => "Saved", 
                'appointment' => $request,

                )));
            

        } else {

            $this->load->view('/pages/appointment_form');
        }
    }

    public function sendemail($request) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$return = $_POST;
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            
            $sender_email = isset($request->email) ? $request->email : "";
            $sender_first_name = isset($request->firstName) ? $request->firstName : ""; 
            $sender_last_name = isset($request->lastName) ? $request->lastName : "";
            $date_time = isset($request->dateTime) ? $request->dateTime : "";
            $home_ph = isset($request->phNumber) ? $request->phNumber : "";
            $mobile_ph = isset($request->mobilePhone) ? $request->mobilePhone : "";
            $facial_treatments =isset($request->facialTreatments) ? $this->implodeNonNull(",  ",$request->facialTreatments) : "";
            $eye_treatments = isset($request->eyeTreatments) ? $this->implodeNonNull(",  ",$request->eyeTreatments) : "";
            $body_treatments = isset($request->bodyTreatments) ? $this->implodeNonNull(",  ",$request->bodyTreatments) : "";
            $spray_tanning = isset($request->sprayTanning) ? $this->implodeNonNull(",  ",$request->sprayTanning) : "";
            $nail_treatments = isset($request->nailTreatments) ? $this->implodeNonNull(",  ",$request->nailTreatments) : "";
            $waxing_treatments = isset($request->waxingTreatments) ? $this->implodeNonNull(",  ",$request->waxingTreatments) : "";
            $electrolysis = isset($request->electrolysis) ? $this->implodeNonNull(",  ",$request->electrolysis) : "";
                       
            
            $this->email->from($sender_email, $sender_first_name .' '. $sender_last_name);
            $this->email->to('chelseaperkins6@gmail.com', 'Chelsea');
            $this->email->subject('An appointment has been requested');
            $message = '
            <html>
            <body>
            <p>Appointment details that have been requested,</p>
                <table>
                    <tr>
                        <td>Date and Time:</td>
                        <td>' . $date_time. '</td>
                    </tr>
                    <tr>
                        <td>Client:</td>
                        <td>' . $sender_first_name . '&nbsp;' . $sender_last_name . '</td>
                    </tr>
                    <tr>
                        <td>Client Email Address:</td>
                        <td>' . $sender_email . '</td>
                    </tr>
                    <tr>
                        <td>Home Phone Number:</td>
                        <td>' . $home_ph . '</td>
                    </tr>
                    <tr>
                        <td>Mobile Number:</td>
                        <td>' . $mobile_ph . '</td>
                    </tr>
                    
                    <tr>
                        <td>Facial Treatments:</td>
                        <td>' . $facial_treatments .'</td>
                    </tr>
                    <tr>
                        <td>Eye Treatments:</td>
                        <td>' . $eye_treatments . '</td>
                    </tr>
                    <tr>
                        <td>Body Treatments:</td>
                        <td>' . $body_treatments . '</td>
                    </tr>
                    <tr>
                        <td>Spray Tanning:</td>
                        <td>' . $spray_tanning . '</td>
                    </tr>
                    <tr>
                        <td>Nail Treatments:</td>
                        <td>' . $nail_treatments . '</td>
                    </tr>
                    <tr>
                        <td>Waxing Treatments:</td>
                        <td>' . $waxing_treatments . '</td>
                    </tr>
                    <tr>
                        <td>Electrolysis:</td>
                        <td>' . $electrolysis . '</td>
                    </tr>
                    
                </table>
            </body>
            </html>
            ';
            $this->email->message($message);

            $this->email->send();
        }

        
    }
    
    private function implodeNonNull($sep, $arr) {
        if($arr != null) {
            return implode($sep, $arr);
        }
        return "";
    }

}
