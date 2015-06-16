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
        
        $pageModel = new PageModel();
        $this->load->view('pages/home', array(
            'pageModel' => $pageModel,
        ));
    }

    public function our_treatments() {
        $this->load->view('pages/our_treatments');
    }

    private function implodeNonNull($sep, $arr) {
        if ($arr != null && $arr != "" && count($arr) != 0) {
            $res = implode($sep, $arr);
            return $res != "" ? $res : null;
        }
        return null;
    }

}
