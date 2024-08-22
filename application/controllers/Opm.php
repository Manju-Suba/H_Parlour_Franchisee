<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Opm extends CI_Controller {

   
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
        } else if ($this->session->userdata('role') != "OM") {
            redirect(base_url(), 'refresh');
        } 
    }   
 
    public function entered_form() {
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;

        $user_information = $this->masters_model->get_table_approval_rsm_log('user_information');
        $data['user_information'] = $user_information;
        $this->load->view('opm/rsm_entered_form', $data);
    }

    public function approved_form() {
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;

        $user_information = $this->masters_model->get_approved_list_sh_log('user_information', 'rsmi_approval', 'Approved');
        $data['user_information'] = $user_information;
        $this->load->view('opm/approved_form', $data);
    }
 
    public function rejected_form() {
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;
        
        $user_information = $this->masters_model->get_approved_list_sh_log('user_information', 'rsmi_approval', 'Rejected');
        $data['user_information'] = $user_information;
        $this->load->view('opm/rejected_form', $data); 
    }
 
    public function form_approval() {
        $id = $this->input->post('id', TRUE);
        $type = $this->input->post('type', TRUE);
        $remarks = $this->input->post('remarks', TRUE);
        if ($type=="Approved") {
            $data['opm_approval'] = "Approved";
            $data['opm_remark'] = $remarks; 
            $this->masters_model->updates('user_information', $data, 'id', $id);
            $result = array(
				"response" => "Approved!",
			);
			echo json_encode($result);

        } else if ($type=="Rejected") {
            $data['opm_approval'] = "Rejected"; 
            $data['opm_remark'] = $remarks;
            $this->masters_model->updates('user_information', $data, 'id', $id);
            $result = array(
				"response" => "Rejected!",
			);
			echo json_encode($result);
        }
    }

    // total count //
    public function get_details_count()
    {
        $entered_opm['rsm_approval'] = "Approved";
        $entered_opm['opm_approval'] = "";
        $rsm_entered_form_count = $this->masters_model->total_count($entered_opm ,'user_information');

        $approved_opm['rsm_approval'] = "Approved";
        $approved_opm['opm_approval'] = "Approved";
        $opm_approved_details = $this->masters_model->total_count($approved_opm ,'user_information');

        $rejected_opm['rsm_approval'] = "Approved";
        $rejected_opm['opm_approval'] = "Rejected";
        $opm_rejected_details = $this->masters_model->total_count($rejected_opm ,'user_information');

       
        $data = array(
            "rsm_entered_form_count" => $rsm_entered_form_count,
            "opm_approved_details" => $opm_approved_details,
            "opm_rejected_details" => $opm_rejected_details,

        );
        echo json_encode($data);

    }

////

    public function get_approved_list() 
    {
        $rsmi_approval['rsm_approval'] = "Approved";
        $rsmi_approval['opm_approval'] = "Approved";
        $rsmi_rejected['rsmi_approval'] = "";
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_approved_list_idhaya_log($postData,'user_information',$rsmi_approval);
        echo json_encode($data);   
    }

    public function get_rejected_list() 
    {
        $rsmi_approval['rsm_approval'] = "Approved";
        $rsmi_rejected['opm_approval'] = "Rejected";
        $rsmi_rejected['rsmi_approval'] = "";
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_approved_list_idhaya_log($postData,'user_information',$rsmi_rejected);
        echo json_encode($data);   
    }

     public function get_entered_list() 
    {
        $rsmi['rsmi_approval'] = "";
        $rsmi['rsm_approval'] = "Approved";
        $rsmi['opm_approval'] = "";
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_approved_list_idhaya_log($postData,'user_information',$rsmi);
        echo json_encode($data);   
    }

    public function login_type() {
        $this->load->view('opm/login_type');
    }
  
    public function completed_location() { 
        $this->load->view('opm/rep_completed_location');
    }

    public function get_completed_location(){
        $postData = $this->input->post();
        $val="";
        $data = $this->masters_model->get_completed_location($postData,'locations','om_approval',$val);
        echo json_encode($data); 
    }

    public function approval_locations(){
        $id =  $this->input->post('app_reg_id');
        $type = $this->input->post('type', TRUE);
        $remarks = $this->input->post('remarks', TRUE);
        $rsm = $this->input->post('rsm_choosen', TRUE);

        if ($type=="Approved") {
            $data['om_approval'] = $type;
            $data['om_remark'] = $remarks; 
            $data['allocate_rsm'] = $this->input->post('rsm_choosen', TRUE);
            $this->masters_model->update_locations('locations','id',$id,$data);


            if(!empty($_FILES['approve_doc']['name'])){
                $upload_path = APPPATH . '../uploads/OM_approved_doc_uploads';
                if(!is_dir($upload_path)){
                    mkdir($upload_path, 0777, true);
                }
                $config['upload_path'] =  "$upload_path";
                $config['allowed_types'] = '*';
                $config['max_size']     = '20000';
                $config['file_name'] = time().'_Doc';
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('approve_doc')){
                    $uploadData = $this->upload->data();
                    $path1 = $_FILES['approve_doc']['name'];
                    $ext = pathinfo($path1, PATHINFO_EXTENSION);
                    $picture = time().'.'.$ext;
                }
                $save_after['om_doc'] = $picture;
                $this->masters_model->update_locations('locations','id',$id,$save_after);
    
            }
            $result = array(
				"response" => "Approved!",
			);
			echo json_encode($result);

        } else if ($type=="Rejected") {
            $data['om_approval'] = $type; 
            $data['om_remark'] = $remarks;
            $this->masters_model->update_locations('locations','id',$id,$data);
            $result = array(
				"response" => "Rejected!",
			);
			echo json_encode($result);
        }
    }


    public function approved_location(){
        $this->load->view('opm/approved_location');
    }

    public function get_approved_locations(){
        $postData = $this->input->post();
        $data = $this->masters_model->get_completed_location($postData,'locations','om_approval','Approved');
        echo json_encode($data); 
    }

    public function rejected_location(){
        $this->load->view('opm/rejected_location');
    }

    public function get_rejected_locations(){
        $postData = $this->input->post();
        $data = $this->masters_model->get_completed_location($postData,'locations','om_approval','Rejected');
        echo json_encode($data); 
    }



    public function get_location_count(){

        $rep_location['om_approval'] = "";
        $completed_location_rep = $this->masters_model->total_count_rep2($rep_location ,'locations');

        $om_app_location['om_approval'] = "Approved";
        $app_location_om = $this->masters_model->total_count_rep2($om_app_location ,'locations');

        $om_rej_location['om_approval'] = "Rejected";
        $rej_location_om = $this->masters_model->total_count_rep2($om_rej_location ,'locations');

        $data = array(
            "completed_location_rep" => $completed_location_rep,
            "app_location_om" => $app_location_om,
            "rej_location_om" => $rej_location_om,
        );

        echo json_encode($data);

    }

}
