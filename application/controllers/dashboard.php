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
        $pageModel = new PageModel();
        $pageModel->results = $this->Appointment->get_all();
        foreach ($pageModel->results as $value) {
            $value->first_name = "test";
            $value->last_name = "name";
            $value->eyeTreatments = isset($value->eye_treatments) ? explode(', ', $value->eye_treatments) : array();
        }
        
        
        $this->load->view('pages/home_dashboard', array(
                'pageModel' => $pageModel,

            ));
    }

    public function detail() {
        
    }

    public function add_edit($id = null) {

       $page_model = "";
        $this->load->helper('date');

        
        $this->load->model('Appointment');
          
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //$return = $_POST;
            $post_data = file_get_contents("php://input");
            $request = json_decode($post_data);
            //if add 
            if ($id) {
		//get user from db by id 
		$this->load->model('User');
		$user = $this->User->get($id);
	                    
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
            $appointment->save();
            
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            exit(json_encode(array(
                'success'=> true, 
                'message' => "Saved", 
                'appointment' => $request,

                )));
            }
            $this->load->view('pages/home_dashboard');
        }
    

//            }else{
////                if is edit
////                get Todo from db by id
//                $this->load->model('Todo');
//                $todo = $this->Todo->get($id);
//            }

        
//                    , array(
//                'edit' =>$id != NULL,
//                'appointment' => $appointment,
//            ));
//        }else{
////            if is insert/update
//            $this->_insert_update($todo, $id);
//        }
    

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

    public function view_apptmts() {
      
        $appointments = array();
        $this->load->model('Appointment');
        $rows = $this->Appointment->get_many_by('status', strtoupper($status));     

 //       $this->load->view('pages/list');
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
