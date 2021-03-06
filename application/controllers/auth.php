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
        $reg_error = 'Registration error, please try again';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//        set validation rules
            $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]|min_length[5]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|xss_clean');

            if ($this->form_validation->run() == TRUE) {
                $this->load->model('User');
                $user = new User();
                $user->first_name = $this->input->post('first_name');
                $user->last_name = $this->input->post('last_name');
                $user->email = $this->input->post('email');
                $user->password = sha1($this->input->post('password'));
                $user->ph_number = $this->input->post('ph_number');
                $user->mobile_number = $this->input->post('mobile_number');
                $user->is_admin = true;
                $user->is_verified = false;
                $user->save();
                
                //$query = $this->db->get_where('users', array('email' => $user->email), 1, 0);
                
                $this->authorise($user);
                //$this->load->view('pages/log_in', array(
                   // 'email' => $user,
                //));
                redirect('auth/login');
            } else {
                $this->load->view('pages/register', array(
                    'error' => $reg_error,
                ));
            }
        } else {
            $this->load->view('pages/register', array(
                    'error' => $reg_error,
                ));
        }
    }

    private function authorise($user) {
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
        $login_error = "log in error, please try again";
        $email= "";
        $pass= "";
        
        //$return = $_POST;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //        set validation rules
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password','required|min_length[5]|max_length[20]|xss_clean');
            
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
                    'login_error' => $login_error,
                ));
            }       
                
        } else {
            $this->load->view('pages/log_in', array(
                    'login_error' => $login_error,
                ));
        }
    }

   public function validate_user($email, $pass) {
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
//            if($this->details->is_verified == true){
                // Call set_session to set the user's session vars via CodeIgniter
            $this->set_in_session();
            return true;
//            }

        }

        return false;
        
    }

    public function set_in_session() {
// set the user data to the session
$sess_array = array(
            'id' => $this->details->id,
            'first_name' => $this->details->first_name,
            'last_name' => $this->details->last_name,
            'email' => $this->details->email,
            'is_Admin' => true,
            ); 
        $this->session->set_userdata($sess_array);
                        
    }

// Logout from admin page
    public function logout() {
        
// Removing session data
         $sess_array = array(
            'id' => '',
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'is_Admin' => '',
        );
                
        $this->session->unset_userdata($sess_array);
                
        redirect('auth/login', array(
            
           ));
    }

}
