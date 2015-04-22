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

    public function register() {
        $this->load->view('pages/register');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $data = array(
                
                'email' => $this->input->post('email'),
                'password' => sha1($this->input->post('password')),
                'is_Admin' => $this->input->is_Admin = 1
            );
            $this->db->insert('users', $data);
            return true;
        }
    }

    //    Login for admin
    public function login() {
        $this->load->view('pages/log_in');
        //$return = $_POST;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Load session library
            $this->load->library('session');
            // Load model
            $this->load->model('user');
            $email = $this->input->post('email');
            $pass = $this->input->post('password');

            //Ensure values exist for email and pass, and validate the user
            if ($email && $pass && $this->user->validate_user($email, $pass)) {
                // If the user is valid, redirect to the main view
                $this->load->view('pages/home_dashboard');
            } else {
                // Otherwise show the login screen with an error message.
                $this->show_login(true);
            }
        }
    }

    function validate_user($email, $pass) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('password', sha1($pass));
        $login = $this->db->get()->result();

        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if (is_array($login) && count($login) == 1) {
            // Set the users details into the $details property of this class
            $this->details = $login[0];
            // Call set_session to set the user's session vars via CodeIgniter
            $this->set_session();
            return true;
        }

        return false;
    }

    function set_session() {
        // session->set_userdata is a CodeIgniter function that

        $this->session->set_userdata(array(
            'id' => $this->details->id,
            'name' => $this->details->firstName . ' ' . $this->details->lastName,
            'email' => $this->details->email,
            'is_Admin' => $this->details->is_Admin,
            'isLoggedIn' => true
                )
        );
    }

    // Logout from admin page
    public function logout() {

// Removing session data
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('login_form', $data);
    }

}
