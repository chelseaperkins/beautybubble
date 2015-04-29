<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

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

        $this->load->view('pages/home_dashboard');
    }

    public function detail() {
        
    }

    public function add_edit() {

//        $this->load->helper('form');
//        $this->load->model('todo');
//
//        $todo = new Todo();
//            is add/edit
//        if (!$this->input->post()) {
////                if is add
//            if ($id === NULL) {
////                    populate with defaults
//            $todo->title = '';
//            $todo->due_on = '';
//            $todo->priority = '';
//	    $todo->comment = '';
//	    $todo->created_on = '';
//	    $todo->last_modified_on = '';
//	    $todo->due_on = '';
//	    $todo->status = '';
//	    $todo->deleted = '';
//            }else{
////                if is edit
////                get Todo from db by id
//                $this->load->model('Todo');
//                $todo = $this->Todo->get($id);
//            }

        $this->load->view('pages/add_edit');
//                    , array(
//                'edit' =>$id != NULL,
//                'todo' => $todo,
//            ));
//        }else{
////            if is insert/update
//            $this->_insert_update($todo, $id);
//        }
    }

    /**
     * Private method to insert or update a Todo depending on whether an id is specified.
     * @param Todo $todo
     * @param int $id
     */
    private function _insert_update($todo, $id) {
        //populate from post
        $todo->title = $this->input->post('title');
        $todo->description = $this->input->post('description');
        // validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required',
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required',
            ),
        ));
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        //if doesn't validate
        if (!$this->form_validation->run()) {
            $this->load->view('pages/add_edit', array(
                'edit' => $id != null,
                'todo' => $todo,
            ));
        } else {//if validates
            $todo->id = (int) $id;
            //hard-code a few values not in the form
            $todo->priority = 1;
            $todo->comment = "my comment";
            $todo->created_on = "2015-01-01";
            $todo->last_modified_on = "2015-01-01";
            $todo->due_on = "2015-01-01";
            $todo->status = "DONE";
            $todo->deleted = 0;
            $todo->save($id);
            //add flash and redirect
            $action = "";
            if ($id == null) {
                $action = "added";
            } else {
                $action = "updated";
            }
//	    $this->session->set_flashdata('success', 'TODO successfully ' . $action);
            redirect('/todos/status/' . strtolower($todo->status), 'refresh');
        }
    }

    public function status() {
//        $status
//        $this->load->helper('url');
//        $this->load->library('table');
//        $todos = array();
//        $this->load->model('Todo');
//        $rows = $this->Todo->get_many_by('status', strtoupper($status));
//        foreach ($rows as $row) {
//            $todos[] = array(
//                $row->title,
//                $row->due_on,
//                $row->priority,
//                $row->description,
//                $row->status,
//               anchor('todos/add_edit/'.$row->id,'Edit').' | '.anchor('todos/delete/'.$status.'/'.$row->id,'Delete'),
//            );
//        }


        $this->load->view('pages/list');
//                , array(
//           'status' => $status,
//            'todos' => $todos,
//        ));
    }

    /**
     * Delete Todo based on id. Status is passed in for redirection to list.
     * @param string $status
     * @param int $id
     */
    public function delete($status, $id) {
        $this->load->model('Todo');
        if ($this->Todo->delete($id)) {
            $this->load->library('session');
            $this->session->set_flashdata('success', 'TODO successfully deleted.');
        } else {
            $this->session->set_flashdata('error', 'There was a problem deleting the TODO. Please try again.');
        }
//    take back to list
        redirect('/todos/status/' . $status, 'refresh');
    }

    public function example_3() {
//		$this->load->section('sidebar', 'ci_simplicity/sidebar');
        $this->load->view('pages/change-status');
    }

    public function example_4() {
        $this->output->unset_template();
        $this->load->view('pages/list');
    }

    public function comments() {
        echo 'Look at this!';
    }

}
