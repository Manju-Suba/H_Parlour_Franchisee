<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sh extends CI_Controller {

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
        } else if ($this->session->userdata('role') != "SH") {
            redirect(base_url(), 'refresh');
        }
    } 

    // public function entered_form() {
    //     $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
    //     $data['rsm_name'] = $rsm_name;

    //     $this->form_validation->set_rules('rsm', 'RSM', 'required');
    //     if ($this->form_validation->run() == FALSE) {

    //         $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
    //         $data['rsm_name'] = $rsm_name;
    //         $user_information = $this->masters_model->get_table_approval_rsmi_log('user_information');
    //         $data['user_information'] = $user_information;
    //         $data['rsm'] =  "";
    //         $data['bdm'] =  "";
    //         $this->load->view('sh/entered_form', $data);  
    //     } else {
    //         $rsm = $this->input->post('rsm', TRUE);

    //         $bdm_name = $this->masters_model->get_bdm('BDM_name', $rsm , 'masters');
    //         $data['bdm_name'] = $bdm_name;

    //         $bdm = $this->input->post('bdm', TRUE);
    //         if($rsm !="" && $bdm !=""){
    //             $user_information = $this->masters_model->get_rsmi_2_filter_log($rsm , $bdm);
    //             $data['user_information'] = $user_information;
    //             $data['rsm'] =  $rsm;
    //             $data['bdm'] =  $bdm;
    //             $this->load->view('sh/entered_form', $data);
              
    //         }elseif($rsm !=""){
    //             $user_information = $this->masters_model->get_rsmi_entered_filter_log($rsm);
    //             $data['user_information'] = $user_information;
    //             $data['rsm'] =  $rsm;
    //             $this->load->view('sh/entered_form', $data);
    //         }else{
    //             $user_information = $this->masters_model->get_table_approval_rsmi_log('user_information');
    //             $data['user_information'] = $user_information;
    
    //             $this->load->view('sh/entered_form', $data); 
    //         }
           
    //     }

    // }

    public function entered_form() {
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;
        $this->load->view('sh/entered_form', $data); 
    }

    public function get_rsmi_entered_list() 
    {
        $rejected['rsmi_approval'] = "Approved";
        $rejected['sh_approval'] = "";
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_approved_list_idhaya_log($postData,'user_information',$rejected);
        echo json_encode($data);   
    }

    public function approved_form() {
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;

        $user_information = $this->masters_model->get_approved_list_sh_log('user_information', 'sh_approval', 'Approved');
        $data['user_information'] = $user_information;
        $this->load->view('sh/approved_form', $data);
    }

    public function get_approved_list() 
    {
        $approval['rsmi_approval'] = "Approved";
        $approval['sh_approval'] = "Approved";
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_approved_list_idhaya_log($postData,'user_information',$approval);
        echo json_encode($data);   
    }

    public function rejected_form() {
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;

        $user_information = $this->masters_model->get_approved_list_sh_log('user_information', 'sh_approval', 'Rejected');
        $data['user_information'] = $user_information;
        $this->load->view('sh/rejected_form', $data); 
    }

    public function get_rejected_list() 
    {
        $rejected['sh_approval'] = "Rejected";
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_approved_list_idhaya_log($postData,'user_information',$rejected);
        echo json_encode($data);   
    }
 
    public function form_approval() {
        $id = $this->input->post('id', TRUE);
        $type = $this->input->post('type', TRUE);
        $remarks = $this->input->post('remarks', TRUE);
        if ($type=="Approved") {
            $data['sh_approval'] = "Approved";
            $data['sh_remark'] = $remarks; 
            $data['status'] = "1";
            $data['ct_review'] = "1";
            $data['approved_by'] = $this->session->userdata('emp_no');
            $this->masters_model->updates('user_information', $data, 'id', $id);


            if ($_FILES['approve_doc']['name'] != '') {

                $this->load->library('upload');
                $image = array();
                $ImageCount = count($_FILES['approve_doc']['name']);
    
                //mkdir(APPPATH. '../uploads/'.$last_id.'/');
                for ($i = 0; $i < $ImageCount; $i++) {
                    $_FILES['file']['name'] = $_FILES['approve_doc']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['approve_doc']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['approve_doc']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['approve_doc']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['approve_doc']['size'][$i];
    
                    // File upload configuration
    
                    $config['upload_path'] = APPPATH . '../approved_doc_uploads/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';
    
                    $new_name = time().'_DOC';
                    $config['file_name'] = $new_name;
                    // Load and initialize upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
    
                    // Upload file to server
                    if ($this->upload->do_upload('file')) {
                        // Uploaded file data
                        $imageData = $this->upload->data();
                        $uploadImgData[$i]['sh_doc_images'] = $imageData['file_name'];
                        $uploadImgData[$i]['d_id'] = $id;
                        $uploadImgData[$i]['status'] = 1;
                    }
                }

                if (!empty($uploadImgData)) {

                    $ii=0;
                    while($ii<count($uploadImgData)){

                        $upload_doc_detail[$ii]['image'] = $uploadImgData[$ii]['sh_doc_images'];
                        $upload_doc_detail[$ii]['d_id'] = $id;
                        $upload_doc_detail[$ii]['status'] = 1;
                        $upload_doc_detail[$ii]['created_at'] = date('Y-m-d H:m:s');

                        $this->masters_model->importImageData('sh_report_img', $upload_doc_detail);
                        $ii++;
                    }
                }
            }

            $result = array(
				"response" => "Nethaji Approved!",
			);
			echo json_encode($result);

        } else if ($type=="Rejected") {
            $data['sh_approval'] = "Rejected"; 
            $data['sh_remark'] = $remarks;
            // $data['status'] = "Saved";
            // $data['ct_review'] = "Saved";
            $this->masters_model->updates('user_information', $data, 'id', $id);
            $result = array(
				"response" => "Nethaji Rejected!",
			);
			echo json_encode($result);
        }
    }

    public function funneled_form_view()
    {
        $user_information = $this->masters_model->get_entered_funneled_form_cc_log('user_information');
        $data['user_information'] = $user_information;
        $this->load->view('sh/funneled_form', $data);
    
    }
   
    public function mt_uploaded_form(){
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;
        $this->load->view('sh/mt_uploaded_form' ,$data);
    }

    public function ct_uploaded_form(){
        $this->load->view('sh/ct_uploaded_form');
    }

    public function ct_doc_uploaded_form()    
    { 
        $postData = $this->input->post();
        $data = $this->masters_model->get_ct_doc_upload_log($postData,'user_information');
        echo json_encode($data);    
    }

    public function onboarding_doc_approved_form(){
        $this->load->view('sh/onboarding_doc_approved_form');
    }

    public function onboarding_doc_approved_list()    
    { 
        $postData = $this->input->post();
        $data = $this->masters_model->get_ct_doc_sh_approved_log($postData,'user_information');
        echo json_encode($data);   
    }

    public function move_doc(){
        $id =  $this->input->post('id');
        $data['sh_ct_doc_approve'] = "Approved";
        $data['tteam_id'] = $this->input->post('tt_choosen', TRUE);
        $update = $this->masters_model->updates('user_information', $data, 'id', $id);     

        $result = array(
			"response" => "success",
		);
		echo json_encode($result);
    
    }
    

// total count //
    public function get_details_count()
    {
        $entered_ct['ct_review'] = "1";
        $entered_ct['rsm_approval'] = "Approved";
        $entered_ct['rsmi_approval'] = "Approved";
        $entered_ct['sh_approval'] = "";
        $entered_ct['approved_by'] = "";
        $ct_entered_details = $this->masters_model->total_count($entered_ct ,'user_information');

        $approved_sh['sh_approval'] = "Approved";
        $sh_approved_details = $this->masters_model->total_count($approved_sh ,'user_information');

        $rejected_sh['sh_approval'] = "Rejected";
        $sh_rejected_details = $this->masters_model->total_count($rejected_sh ,'user_information');

        $upload_ct['ct_pre_doc_upload'] = "uploaded";
        $upload_ct['ct_post_doc_upload'] = "uploaded";
        $upload_ct['sh_ct_doc_approve'] = "";
        $ct_uploaded_details = $this->masters_model->total_count($upload_ct ,'user_information');

        $onboard_sh['sh_ct_doc_approve'] = "Approved";
        $onboarding_dcount = $this->masters_model->total_count($onboard_sh ,'user_information');


        $upload_mt['mt_upload'] = "uploaded";
        $mt_upload_details = $this->masters_model->total_count($upload_mt ,'user_information');

        $funnel_cc['status'] = "Saved";
        $cc_funnel_details = $this->masters_model->total_count1($funnel_cc ,'user_information');

        $rejected_sa['sa_app'] = "Rejected";
        $sa_rejected = $this->masters_model->total_count2($rejected_sa ,'user_information','sa_remark');

        $data = array(
            "ct_entered_details" => $ct_entered_details,
            "sh_approved_details" => $sh_approved_details,
            "sh_rejected_details" => $sh_rejected_details,
            "ct_uploaded_details" => $ct_uploaded_details,
            "onboarding_dcount" => $onboarding_dcount,
            "mt_uploaded_details" => $mt_upload_details,
            "cc_funnel_details" => $cc_funnel_details,
            "sa_rejected_count" => $sa_rejected,

        );
        echo json_encode($data);

    }


    // LOCATION WORK

    public function login_type() {
        $this->load->view('sh/login_type');
    }

    public function completed_location() {
        $this->load->view('sh/completed_location');
    }

    public function get_completed_location(){
        $postData = $this->input->post();
        $approval['idhaya_approval'] = "Approved";
        $val="";
        $data = $this->masters_model->get__approved_location($postData,'locations','approval_locations',$val ,$approval);
        echo json_encode($data); 
    }

    public function final_locations() {
        $this->load->view('sh/final_locations');
    }

    public function get_final_locations(){
        $postData = $this->input->post();
        $data['approval_locations'] = "Approved";
        $data = $this->masters_model->get_completed_location($postData,'locations' ,'approval_locations', 'Approved');
        echo json_encode($data); 
    }

    public function future_prospects() {
        $this->load->view('sh/future_prospects');
    }
 
    public function get_future_prospects(){
        $postData = $this->input->post();
        $data = $this->masters_model->get_future_prospects($postData,'locations');
        echo json_encode($data); 
    }

    public function approval_locations(){
        $id =  $this->input->post('app_reg_id');
        $type = $this->input->post('type');
        $data['approval_locations'] =  $type;
        $data['remark'] =  $this->input->post('remarks');
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->masters_model->update_locations('locations','id',$id,$data);
        
        if($type == "Approved"){
            $data = array('res' => "success" );
        }else{
            $data = array('res' => "hold" );
        }
        
        echo json_encode($data);
    }

    public function get_location_count(){

        $location['status'] = "Active";
        $location['idhaya_approval'] = "Approved";
        $location['approval_locations'] = "";
        $completed_location = $this->masters_model->total_count_rep2($location ,'locations');

        $final_location['status'] = "Active";
        $final_location['approval_locations'] = "Approved";
        $final_location_count = $this->masters_model->total_count_rep2($final_location ,'locations');

        $rej_location['status'] = "Active";
        $rej_location['approval_locations'] = "Rejected";
        $rejected_location_count = $this->masters_model->total_count_rep2($rej_location ,'locations');

        $data = array(
            "completed_location_count" => $completed_location,
            "final_location_count" => $final_location_count,
            "rejected_location_count" => $rejected_location_count,
        );

        echo json_encode($data);

    }


    ///////////////////



}
