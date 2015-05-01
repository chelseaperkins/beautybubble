<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author chelsea.perkins
 */
class Auth extends CI_controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');

        $this->_init();
    }

    private function _init() {
        $this->output->set_template('simple');
    }

    public function index() {
        $this->load->view('pages/register');
    }

    public function verify() {
        $email_link = $this->input->get('key');

        $auth_data = $this->encrypt->decode($email_link, 'fjskdlf');
        $link_conf = json_decode($auth_data);
        $this->load->model('User');
        $user = new User();
        $row = $user->get($link_conf->id);
        $row->is_verified = true;
        $user->update($row->id, $row);

        $this->load->view('pages/verify');
    }

    public function register() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//        set validation rules
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]|min_length[5]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|xss_clean');

            if ($this->form_validation->run() == TRUE) {
                $this->load->model('User');
                $user = new User();
                $user->first_name = $this->input->post('firstName');
                $user->last_name = $this->input->post('lastName');
                $user->email = $this->input->post('email');
                $user->password = sha1($this->input->post('password'));
                $user->ph_number = $this->input->post('phNumber');
                $user->mobile_number = $this->input->post('mobilePhone');
                $user->is_admin = true;
                $user->is_verified = false;
                $user->save();
                $this->auth($user);
                $this->load->view('pages/log_in', array(
                    'email' => $user,
                ));
            } else {
                $this->load->view('pages/register', array(
                    'error' => "",
                ));
            }
        } else {
            $this->load->view('pages/register');
        }
    }

    private function auth($user) {
        $actlink = base_url('auth/verify'); // set this to the page url
        $encodedVerify = "?key="; // set this to your encoded string
        $auth_data = json_encode(array(
            'id' => $user->id,
            'time' => time(),
        ));
        $hash_data = $this->encrypt->encode($auth_data, 'fjskdlf');

        $this->email->set_newline("\r\n");
        $this->email->from('noreply@beautybubble.co.nz', 'Beauty Bubble website');
        $this->email->to($user->email);

        $this->email->subject('Admin activation email');
        $message = '
    <html>
    <body>
    <p>Please activate your administration account by clicking the link below</p>
        <table>
            <tr>
                <td>Activation link:</td>
                <td>' . $actlink . $encodedVerify . $hash_data . '</td>
            </tr>


        </table>
    </body>
    </html>
    ';
        $this->email->message($message);


        $this->email->send();
    }

//    Login for admin
    public function login() {
        $login_error = 'log in error, please try again';
        //$return = $_POST;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //        set validation rules
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[20]|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                // Load model
                $this->load->model('user');
                $email = $this->input->post('email');
                $pass = $this->input->post('password');
            }
            //Ensure values exist for email and pass, and validate the user
            if ($email && $pass && $this->validate_user($email, $pass)) {
                // If the user is valid, redirect to the dashboard
                 redirect('dashboard');
            } else {
                // Otherwise show the login screen with an error message.
                $this->load->view('pages/log_in', array(
                    'error' => $login_error,
                ));
                }
        } else {
            $this->load->view('pages/log_in');
        }
    }

    function validate_user($email, $pass) {
// Build a query to retrieve the user's details
// based on the received username and password
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', sha1($pass));
        $login = $this->db->get()->result();

// The results of the query are stored in $login.
// If a value exists, then the user account exists and is validated
        if (is_array($login) && count($login) == 1) {
// Set the users details into the $details property of this class
            $this->details = $login[0];
            if($this->details->is_verified == true){
                // Call set_session to set the user's session vars via CodeIgniter
            $this->set_session();
            return true;
            }

        }

        return false;
        
    }

    function set_session() {
// set the user data to the session

        $this->session->set_userdata(array(
            'id' => $this->details->id,
            'email' => $this->details->email,
            'is_Admin' => true,
            )
        );
    }

// Logout from admin page
    public function logout($data) {
        
// Removing session data
        $sess_array = array(
            'id' => '',
            'email' => '',
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        
        redirect('auth/login', array(
            'data' => $data,
           ));
//        $this->load->view('pages/log_in', 
//                
        
    }

}
