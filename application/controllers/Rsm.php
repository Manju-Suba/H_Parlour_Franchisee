<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rsm extends CI_Controller {

   
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
        } else if ($this->session->userdata('role') != "RSM") {
            redirect(base_url(), 'refresh');
        }
    }  
  
    public function entered_form() {
        $user = $this->session->userdata('emp_no');
        $bdm_emp_no = $this->masters_model->DISTINCT_table2( 'masters' ,'BDM_emp_no', 'BDM_name', $user);
        $data['bdm_emp_no'] = $bdm_emp_no;

        $this->form_validation->set_rules('bdm', 'BDM', 'required');
        if ($this->form_validation->run() == FALSE) {
           
            $user_information = $this->masters_model->get_table_approval_ct_log('user_information');
            $data['user_information'] = $user_information;
            $this->load->view('rsm/entered_form', $data);
        } else {
            $bdm = $this->input->post('bdm', TRUE);
            $array['ct_review'] = '1';
            $val ="";
            $user_information = $this->masters_model->get_rsm_filter_log($bdm ,'rsm_approval',$val ,$array);
            $data['user_information'] = $user_information;
            $data['bdm'] =  $bdm;
            $this->load->view('rsm/entered_form', $data);
        }
      
       
    }

    public function approved_form() {

        $user = $this->session->userdata('emp_no');
        $bdm_emp_no = $this->masters_model->DISTINCT_table2( 'masters' ,'BDM_emp_no', 'BDM_name', $user);
        $data['bdm_emp_no'] = $bdm_emp_no;

        $this->form_validation->set_rules('bdm', 'BDM', 'required');
        if ($this->form_validation->run() == FALSE) {
           
            $user_information = $this->masters_model->get_approved_list_rsm_log('user_information', 'rsm_approval', 'Approved');
            $data['user_information'] = $user_information;
            $this->load->view('rsm/approved_form', $data);  
        } else {

            $bdm = $this->input->post('bdm', TRUE);
            $array['ct_review'] ="1";
            $user_information = $this->masters_model->get_rsm_filter_log($bdm ,'rsm_approval' ,'Approved' ,$array);
            $data['user_information'] = $user_information;
            $data['bdm'] =  $bdm;
            $this->load->view('rsm/approved_form', $data);
        }
      
    }

    public function rejected_form() {
        $user = $this->session->userdata('emp_no');
        $bdm_emp_no = $this->masters_model->DISTINCT_table2( 'masters' ,'BDM_emp_no', 'BDM_name', $user);
        $data['bdm_emp_no'] = $bdm_emp_no;

        $this->form_validation->set_rules('bdm', 'BDM', 'required');
        if ($this->form_validation->run() == FALSE) {
            $user_information = $this->masters_model->get_approved_list_rsm_log('user_information', 'rsm_approval', 'Rejected');
            $data['user_information'] = $user_information;
            $this->load->view('rsm/rejected_form', $data); 
        } else {

            $bdm = $this->input->post('bdm', TRUE);
            $array['ct_review'] ="Saved";
            $user_information = $this->masters_model->get_rsm_filter_log($bdm ,'rsm_approval' ,'Rejected' ,$array);
            $data['user_information'] = $user_information;
            $data['bdm'] =  $bdm;
            $this->load->view('rsm/rejected_form', $data); 
        }
    }
 
    public function form_approval() {
        $id = $this->input->post('id', TRUE);
        $type = $this->input->post('type', TRUE);
        $remarks = $this->input->post('remarks', TRUE);
        if ($type=="Approved") {
            $data['rsm_approval'] = "Approved";
            $data['rsm_remark'] = $remarks; 
            $data['status'] = "1";
            $data['ct_review'] = "1";
            $data['rsm_app_by'] = $this->session->userdata('emp_no');
            $this->masters_model->updates('user_information', $data, 'id', $id);
            $result = array(
				"response" => "Approved!",
			);
			echo json_encode($result);

        } else if ($type=="Rejected") {
            $data['rsm_approval'] = "Rejected"; 
            $data['rsm_remark'] = $remarks;
            $data['status'] = "Saved";
            $data['ct_review'] = "Saved";
            $this->masters_model->updates('user_information', $data, 'id', $id);
            $result = array(
				"response" => "Rejected!",
			);
			echo json_encode($result);
        }
    }

    public function get_details(){
        $val ="";
        $ct_entered_details = $this->masters_model->rsm_filter_count( 'rsm_approval',$val ,'ct_review' , '1');

        $rsm_approved_details = $this->masters_model->rsm_filter_count('rsm_approval' ,'Approved' ,'ct_review','1');

        $rsm_rejected_details = $this->masters_model->rsm_filter_count('rsm_approval' ,'Rejected','ct_review' ,'Saved');

        $data = array(
            "ct_entered_details" => $ct_entered_details,
            "rsm_approved_details" => $rsm_approved_details,
            "rsm_rejected_details" => $rsm_rejected_details,
        );
        echo json_encode($data);

    }


//  LOCATION WORK

    public function login_type() {
        $this->load->view('rsm/login_type');
    }

    public function om_approved_location(){
        $this->load->view('rsm/om_approved_location');
    }

    public function get_om_app_location(){
        $user = $this->session->userdata('emp_no');
        $postData = $this->input->post();
        $om['om_approval'] = "Approved";
        $om['allocate_rsm'] = $user; 
        $val="";
        $data = $this->masters_model->get__approved_location($postData,'locations','rsm_loc_approval',$val ,$om);
        echo json_encode($data); 
    }

    public function approval_locations(){
        $id =  $this->input->post('app_reg_id');
        $type = $this->input->post('type', TRUE);
        $remarks = $this->input->post('remarks', TRUE);

        if ($type=="Approved") {
            $data['rsm_loc_approval'] = $type;
            $data['rsm_loc_remark'] = $remarks; 
            $this->masters_model->update_locations('locations','id',$id,$data);


            if(!empty($_FILES['approve_doc']['name'])){
                $upload_path = APPPATH . '../uploads/RSM_approved_doc_uploads';
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
                $save_after['rsm_loc_doc'] = $picture;
                $this->masters_model->update_locations('locations','id',$id,$save_after);
    
            }
            $result = array(
				"response" => "Approved!",
			);
			echo json_encode($result);

        } else if ($type=="Rejected") {
            $data['rsm_loc_approval'] = $type; 
            $data['rsm_loc_remark'] = $remarks;
            $this->masters_model->update_locations('locations','id',$id,$data);
            $result = array(
				"response" => "Rejected!",
			);
			echo json_encode($result);
        }
    }

    public function approved_location(){
        $this->load->view('rsm/approved_location');
    }

    public function get_approved_locations(){

        $user = $this->session->userdata('emp_no');
        $postData = $this->input->post();
        $om['allocate_rsm'] = $user;
        $data = $this->masters_model->get__approved_location($postData,'locations','rsm_loc_approval','Approved' ,$om);
        // $data = $this->masters_model->get_completed_location($postData,'locations','rsm_loc_approval','Approved');
        echo json_encode($data); 
    }

    public function rejected_location(){
        $this->load->view('rsm/rejected_location');
    }

    public function get_rejected_locations(){
        $user = $this->session->userdata('emp_no');
        $postData = $this->input->post();
        $om['allocate_rsm'] = $user;
        $data = $this->masters_model->get__approved_location($postData,'locations','rsm_loc_approval','Rejected' ,$om);
        // $data = $this->masters_model->get_completed_location($postData,'locations','rsm_loc_approval','Rejected');
        echo json_encode($data); 
    }



    public function get_location_count(){
        $user = $this->session->userdata('emp_no');
        $om_com_location['allocate_rsm'] = $user;
        $om_com_location['rsm_loc_approval'] = "";
        $completed_location_om = $this->masters_model->total_count_rep2($om_com_location ,'locations');

        $app_location['om_approval'] = "Approved";
        $app_location['allocate_rsm'] = $user;
        $app_location['rsm_loc_approval'] = "Approved";
        $app_location_rsm = $this->masters_model->total_count_rep2($app_location ,'locations');

        $rej_location['om_approval'] = "Approved";
        $rej_location['allocate_rsm'] = $user;
        $rej_location['rsm_loc_approval'] = "Rejected";
        $rejected_location_rsm = $this->masters_model->total_count_rep2($rej_location ,'locations');

        $data = array(
            "completed_location_om" => $completed_location_om,
            "app_location_rsm" => $app_location_rsm,
            "rejected_location_rsm" => $rejected_location_rsm,
        );

        echo json_encode($data);

    }

}
