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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$return = $_POST;
            $post_data = file_get_contents("php://input");
//            create varible to encode data to json and pass in user input data
            $request = json_decode($post_data);
            $success = true;
            $message = "Saved";
            // validate data
            $isValid = true;
            if ($isValid && isset($request->firstName) == false || preg_match("/^[a-zA-Z]*$/", $request->firstName) == false) {
                $isValid = false;
                $message = "First name is invalid";
            }
            if ($isValid && isset($request->lastName) == false || preg_match("/^[a-zA-Z]*$/", $request->lastName) == false) {
                $isValid = false;
                $message = "Last name is invalid";
            }
            if ($isValid && isset($request->phNumber) == true && preg_match("/^[-+0-9]*$/", $request->phNumber) == false) {
                $isValid = false;
                $message = "Phone number is invalid";
            }
            if ($isValid && isset($request->mobileNumber) == true && preg_match("/^[-+0-9]*$/", $request->mobileNumber) == false) {
                $isValid = false;
                $message = "Mobile number is invalid";
            }
//            if form is valid, input values into database
            if ($isValid) {

                //Check email address in database to check if user exsists. 
                $query = $this->db->get_where('users', array('email' => $request->email), 1, 0);
                if ($query->num_rows > 0) {
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
                } else {
                    // user does not exist so create
                    $user = new User();
                    $user->first_name = $request->firstName;
                    $user->last_name = $request->lastName;
                    $user->email = $request->email;
                    $user->ph_number = isset($request->phNumber) ? $request->phNumber : null;
                    $user->mobile_number = isset($request->mobilePhone) ? $request->mobileNumber : null;
                    $user->is_admin = false;
                    $user->is_verified = false;
                    $user->save();
                }

                $appointment = new Appointment();
                $appointment->user_id = $user->id;

                if (isset($request->facialTreatments)) {
                    $appointment->facial_treatments = $this->implodeNonNull(", ", $request->facialTreatments);
                }
                if (isset($request->bodyTreatments)) {
                    $appointment->body_treatments = $this->implodeNonNull(", ", $request->bodyTreatments);
                }
                if (isset($request->eyeTreatments)) {
                    $appointment->eye_treatments = $this->implodeNonNull(", ", $request->eyeTreatments);
                }
                if (isset($request->sprayTanning)) {
                    $appointment->spray_tanning = $this->implodeNonNull(", ", $request->sprayTanning);
                }
                if (isset($request->nailTreatments)) {
                    $appointment->nail_treatments = $this->implodeNonNull(", ", $request->nailTreatments);
                }
                if (isset($request->waxingTreatments)) {
                    $appointment->waxing_treatments = $this->implodeNonNull(", ", $request->waxingTreatments);
                }
                if (isset($request->electrolysis)) {
                    $appointment->electrolysis = $this->implodeNonNull(", ", $request->electrolysis);
                }
                // The JSON date from the postdata is in UTC 
                // so no need to convert from local time to UTC before putting into the database
                $appointment->date_time = $request->dateTime;
//                $this->sendemail($request);
                $appointment->save();
                $request->id = $appointment->id;
            } else {
                $success = false;
            }

            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            exit(json_encode(array(
                'success' => $success,
                'message' => $message,
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
//           Create varibles for values in email message
            $sender_email = isset($request->email) ? $request->email : "";
            $sender_first_name = isset($request->firstName) ? $request->firstName : "";
            $sender_last_name = isset($request->lastName) ? $request->lastName : "";
            $local_date = new DateTime($request->dateTime, new DateTimeZone('GMT'));
            $local_date->setTimeZone(new DateTimeZone('Pacific/Auckland'));
            // get the time string formated to RSS
            $request->dateTime = $local_date->format(DateTime:: RSS);
            $date_time = isset($request->dateTime) ? $request->dateTime : "";
            $home_ph = isset($request->phNumber) ? $request->phNumber : "";
            $mobile_ph = isset($request->mobilePhone) ? $request->mobilePhone : "";
            $facial_treatments = isset($request->facialTreatments) ? $this->implodeNonNull(",  ", $request->facialTreatments) : "";
            $eye_treatments = isset($request->eyeTreatments) ? $this->implodeNonNull(",  ", $request->eyeTreatments) : "";
            $body_treatments = isset($request->bodyTreatments) ? $this->implodeNonNull(",  ", $request->bodyTreatments) : "";
            $spray_tanning = isset($request->sprayTanning) ? $this->implodeNonNull(",  ", $request->sprayTanning) : "";
            $nail_treatments = isset($request->nailTreatments) ? $this->implodeNonNull(",  ", $request->nailTreatments) : "";
            $waxing_treatments = isset($request->waxingTreatments) ? $this->implodeNonNull(",  ", $request->waxingTreatments) : "";
            $electrolysis = isset($request->electrolysis) ? $this->implodeNonNull(",  ", $request->electrolysis) : "";


            $this->email->from($sender_email, $sender_first_name . ' ' . $sender_last_name);
            $this->email->to('chelseaperkins6@gmail.com', 'Chelsea');
            $this->email->subject('An appointment has been requested');
            $message = '
            <html>
            <body>
            <p>These are the appointment details that have been requested,</p>
                <table>
                    <tr>
                        <td>Date and Time:</td>
                        <td>' . $date_time . '</td>
                    </tr>
                    <tr>
                        <td>Client:</td>
                        <td>' . $sender_first_name . '&nbsp;' . $sender_last_name . '</td>
                    </tr>
                    <tr>
                        <td>Client Email Address:</td>
                        <td>' . $sender_email . '</td>
                    </tr>
                                       
                    ';
            if ($home_ph != null) {
                $message = $message .
                        '<tr>
                        <td>Home Phone Number:</td>
                        <td>' . $home_ph . '</td>
                    </tr>';
            }
            if ($mobile_ph != null) {
                $message = $message .
                        '<tr>
                        <td>Mobile Number:</td>
                        <td>' . $mobile_ph . '</td>
                    </tr>';
            }
            if ($facial_treatments != null) {
                $message = $message .
                        '<tr>
                        <td>Facial Treatments:</td>
                        <td>' . $facial_treatments . '</td>
                    </tr>';
            }
            if ($eye_treatments != null) {
                $message = $message .
                        '<tr>
                        <td>Eye Treatments:</td>
                        <td>' . $eye_treatments . '</td>
                    </tr>';
            }

            if ($body_treatments != null) {
                $message = $message .
                        '<tr>
                        <td>Body Treatments:</td>
                        <td>' . $body_treatments . '</td>
                    </tr>';
            }
            if ($spray_tanning != null) {
                $message = $message .
                        '<tr>
                        <td>Spray Tanning:</td>
                        <td>' . $spray_tanning . '</td>
                    </tr>';
            }
            if ($nail_treatments != null) {
                $message = $message .
                        '<tr>
                        <td>Nail Treatments:</td>
                        <td>' . $nail_treatments . '</td>
                    </tr>';
            }
            if ($waxing_treatments != null) {
                $message = $message .
                        '<tr>
                        <td>Waxing Treatments:</td>
                        <td>' . $waxing_treatments . '</td>
                    </tr>';
            }
            if ($electrolysis != null) {
                $message = $message .
                        '<tr>
                        <td>Electrolysis:</td>
                        <td>' . $electrolysis . '</td>
                    </tr>';
            }
            $message = $message . ' 
                </table>
            </body>
            </html>
            ';
            $this->email->message($message);

            $this->email->send();
        }
    }

    private function implodeNonNull($sep, $arr) {
        if ($arr != null) {
            return implode($sep, $arr);
        }
        return "";
    }

}
