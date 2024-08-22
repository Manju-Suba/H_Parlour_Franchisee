<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cidhaya extends CI_Controller {

   
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
        } else if ($this->session->userdata('role') != "IDHAYA") {
            redirect(base_url(), 'refresh');
        } 
    }   
 
    public function entered_form() {
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;

        $user_information = $this->masters_model->get_table_approval_rsm_log('user_information');
        $data['user_information'] = $user_information;
        $this->load->view('idhaya/rsm_entered_form', $data);
    }

    public function approved_form() {
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;

        $user_information = $this->masters_model->get_approved_list_sh_log('user_information', 'rsmi_approval', 'Approved');
        $data['user_information'] = $user_information;
        $this->load->view('idhaya/approved_form', $data);
    }
 
    public function rejected_form() {
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;
        
        $user_information = $this->masters_model->get_approved_list_sh_log('user_information', 'rsmi_approval', 'Rejected');
        $data['user_information'] = $user_information;
        $this->load->view('idhaya/rejected_form', $data); 
    }
 
    public function form_approval() {
        $id = $this->input->post('id', TRUE);
        $type = $this->input->post('type', TRUE);
        $remarks = $this->input->post('remarks', TRUE);
        if ($type=="Approved") {
            $data['rsmi_approval'] = "Approved";
            $data['rsmi_remark'] = $remarks; 
            $data['status'] = "1";
            $data['ct_review'] = "1";
            $this->masters_model->updates('user_information', $data, 'id', $id);
            $result = array(
				"response" => "Approved!",
			);
			echo json_encode($result);

        } else if ($type=="Rejected") { 
            $data['rsmi_approval'] = "Rejected"; 
            $data['rsmi_remark'] = $remarks;
            $this->masters_model->updates('user_information', $data, 'id', $id);
            $result = array(
				"response" => "Rejected!",
			);
			echo json_encode($result);
        }
    }


    public function login_type() {
        $this->load->view('idhaya/login_type');
    }
  
    public function location_table() {
        $this->load->view('idhaya/location_table');
    }

    public function completed_location() {
        $this->load->view('idhaya/completed_location');
    }

    // total count //
    public function get_details_count()
    {
        $entered_rsmi['ct_review'] = "1";
        $entered_rsmi['rsm_approval'] = "Approved";
        $entered_rsmi['opm_approval'] = "Approved";
        $entered_rsmi['rsmi_approval'] = "";
        $rsm_entered_details = $this->masters_model->total_count($entered_rsmi ,'user_information');

        $approved_rsmi['rsmi_approval'] = "Approved";
        $idhaya_approved_details = $this->masters_model->total_count($approved_rsmi ,'user_information');

        $rejected_rsmi['rsmi_approval'] = "Rejected";
        $idhaya_rejected_details = $this->masters_model->total_count($rejected_rsmi ,'user_information');

       
        $data = array(
            "rsm_entered_details" => $rsm_entered_details,
            "idhaya_approved_details" => $idhaya_approved_details,
            "idhaya_rejected_details" => $idhaya_rejected_details,

        );
        echo json_encode($data);

    }

////

    public function get_approved_list() 
    {
        $rsmi_approval['rsm_approval'] = "Approved";
        $rsmi_approval['opm_approval'] = "Approved";
        $rsmi_approval['rsmi_approval'] = "Approved";
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_approved_list_idhaya_log($postData,'user_information',$rsmi_approval);
        echo json_encode($data);   
    }

    public function get_rejected_list() 
    {
        $rsmi_approval['rsm_approval'] = "Approved";
        $rsmi_approval['opm_approval'] = "Approved";
        $rsmi_rejected['rsmi_approval'] = "Rejected";
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_approved_list_idhaya_log($postData,'user_information',$rsmi_rejected);
        echo json_encode($data);   
    }

     public function get_entered_list() 
    {
        $rsmi['rsmi_approval'] = "";
        $rsmi['rsm_approval'] = "Approved";
        $rsmi['opm_approval'] = "Approved";
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_approved_list_idhaya_log($postData,'user_information',$rsmi);
        echo json_encode($data);   
    } 

    public function get_completed_location(){
        $postData = $this->input->post();
        $approval['rsm_loc_approval'] = "Approved";
        $val="";
        $data = $this->masters_model->get__approved_location($postData,'locations','idhaya_approval',$val ,$approval);
        echo json_encode($data); 
    }

    public function approval_locations(){
        $id =  $this->input->post('app_reg_id');
        $type = $this->input->post('type');
        $data['idhaya_approval'] =  $type;
        $data['idhaya_remark'] =  $this->input->post('remarks');
        $this->masters_model->update_locations('locations','id',$id,$data);
        if($type == "Approved"){
            $data = array('res' => "success" );
        }else{
            $data = array('res' => "hold" );
        }
        
        echo json_encode($data);
    }


    public function approved_location(){
        $this->load->view('idhaya/approved_location');
    }

    public function rejected_location(){
        $this->load->view('idhaya/rejected_location');
    }

    public function final_locations(){
        $this->load->view('idhaya/final_location');
    }

    public function get_approved_locations(){ 
        $postData = $this->input->post();
        $data = $this->masters_model->get_completed_location($postData,'locations','idhaya_approval','Approved');
        echo json_encode($data); 
    }

    public function get_rejected_locations(){
        $postData = $this->input->post();
        $data = $this->masters_model->get_completed_location($postData,'locations','idhaya_approval','Rejected');
        echo json_encode($data); 
    }

    public function get_final_locations(){
        $postData = $this->input->post();
        $data['approval_locations'] = "Approved";
        $data = $this->masters_model->get_completed_location($postData,'locations' ,'approval_locations', 'Approved');
        echo json_encode($data); 
    }

    

    public function get_location_count(){

        $location['rsm_loc_approval'] = "Approved";
        $location['idhaya_approval'] = "";
        $completed_location_idhaya = $this->masters_model->total_count_rep2($location ,'locations');

        $app_location['rsm_loc_approval'] = "Approved";
        $app_location['idhaya_approval'] = "Approved";
        $capp_location_count = $this->masters_model->total_count_rep2($app_location ,'locations');

        $idhaya_rej_location['idhaya_approval'] = "Rejected";
        $crej_location_count = $this->masters_model->total_count_rep2($idhaya_rej_location ,'locations');

        $final_location['idhaya_approval'] = "Approved";
        $final_location['approval_locations'] = "Approved";
        $final_location_rsmi = $this->masters_model->total_count_rep2($final_location ,'locations');

        $data = array(
            "completed_location_rsmi" => $completed_location_idhaya,
            "capp_location_count" => $capp_location_count,
            "crej_location_count" => $crej_location_count,
            "final_location_rsmi" => $final_location_rsmi,
        );
        echo json_encode($data);
    }



}
