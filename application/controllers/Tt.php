<?php
 
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Tt extends CI_Controller { 
 
     /**
      * Index Page for this controller.
      *
      * Maps to the following URL
      * 		http://example.com/index.php/welcome
      * 	- or -
      * 		http://example.com/index.php/welcome/index
      * 	- or -
      * Since this controller is set as the default controller in
      * config/routes.php, it's displayed at http://example.com/
      *
      * So any other public methods not prefixed with an underscore will
      * map to /index.php/welcome/<method_name>
      * @see https://codeigniter.com/user_guide/general/urls.html
      */
    public function __construct() {
        parent::__construct();
        $this->load->model('masters_model');
        $this->load->helper(array('form', 'html', 'file', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('javascript');
        $this->load->library('email');
//		session_start();
        $session_data = sessionData();
        $data['session_data'] = $session_data;
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url(), 'refresh');
        } else if ($this->session->userdata('role') != "TT") {
            redirect(base_url(), 'refresh');
        }
    }

    public function approve_form()    
    {
        $this->load->view('tt/approve_form');
 
    }  

    public function scored_form(){
        $this->load->view('tt/scored_form');
    }
 
    public function doc_approved_form()    
    { 
        $postData = $this->input->post();
        $data['parlour_name'] ="";
        $data = $this->masters_model->get_sh_doc_approved_log($postData,'user_information',$data);
        echo json_encode($data);   
    }

    public function scored_form_list()    
    { 
        $postData = $this->input->post();
        $data = $this->masters_model->get_scored_log($postData,'user_information');
        echo json_encode($data);   
    }

    //  form_approval

    public function form_approval(){
        $id = $this->input->post('id', TRUE);
      
        $data['assess_score'] = $this->input->post('assess_score', TRUE);
        $data['parlour_name'] = $this->input->post('parlour_name', TRUE);
        // $data['date_of_visit'] = $this->input->post('visit_date', TRUE);

        $data['date_of_visit'] =  date( 'Y-m-d', strtotime( $this->input->post('visit_date') ) );
        $data['tt_remarks'] = $this->input->post('remarks', TRUE);

        $update=$this->masters_model->updates('user_information', $data, 'id', $id);

        $result = array(
			"response" => "success",
		);
		echo json_encode($result);
    }
     

    // total count //
    public function get_details_count(){
        $emp_no = $this->session->userdata('emp_no');
        $approve_tt['sh_ct_doc_approve']="Approved";
        $approve_tt['tteam_id'] ="$emp_no";
        $approve_tt['parlour_name'] ="";
        $tt_approve_details = $this->masters_model->total_count($approve_tt,'user_information');

        $scored_tt['tteam_id']="$emp_no";
        $scored_form_count = $this->masters_model->total_count2($scored_tt,'user_information','parlour_name');

        $data = array(
            "tt_approve_details" => $tt_approve_details,
            "scored_form_count" => $scored_form_count
        );

        echo json_encode($data);

    }



}