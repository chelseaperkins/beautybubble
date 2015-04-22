<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_controller {

    function __construct() {
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

    public function about_us() {

        $this->load->view('pages/about_us');
    }

    public function our_treatments() {
        $this->load->view('pages/our_treatments');
    }

    public function contact() {

        $sent = false;
        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$return = $_POST;
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            
            $sender_email = $this->input->post('email_address');
            $sender_first_name = $this->input->post('first_name');
            $sender_last_name = $this->input->post('last_name');
            $details = $this->input->post('comments');
            $this->email->from($sender_email, $sender_first_name .' '. $sender_last_name);
            $this->email->to('chelseaperkins6@gmail.com', 'Chelsea');
            $this->email->subject('A message from The Beauty Bubble Beauty Therapy website');
            $message = '
            <html>
            <body>
            <p>A message has been sent from the website contact page</p>
                <table>
                    <tr>
                        <td>Details of message:</td>
                        <td>' . $details . '</td>
                    </tr>
                    <tr>
                        <td>Sender:</td>
                        <td>' . $sender_first_name . '&nbsp;' . $sender_last_name . '</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>' . $sender_email . '</td>
                    </tr>

                </table>
            </body>
            </html>
            ';
            $this->email->message($message);

            
            $sent = $this->email->send();//true;
        }
        $this->load->view('pages/contact',  array(
               'sent' => $sent,
          ));
    }

}
