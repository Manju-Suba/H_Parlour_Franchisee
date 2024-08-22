<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ct extends CI_Controller {

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
        $this->load->library('upload');
//		session_start();
        $session_data = sessionData();
        $data['session_data'] = $session_data;
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url(), 'refresh');
        } else if ($this->session->userdata('role') != "CT") {
            redirect(base_url(), 'refresh');
        }
    }

    // public function ct_insertion_form_view() {
    //     $idd = $this->input->post('id', TRUE);
    //     $data['idd'] = $idd;
    //     $this->load->view('ct/ct_insertion_form',$data);
    // }

    public function ct_insertion_form($id) {
        $idd = $id;
        $data['idd'] = $idd;
        // $data['get_user_info'] = $this->masters_model->get_funneled_row_data($id);
        $this->load->view('ct/ct_insertion_form' ,$data);
    } 
 
    public function ct_edit_form($id) {
        $idd = $id;
        $data['idd'] = $idd;
        $data['user_information'] = $this->masters_model->get_funneled_row_data_ct($idd);  
       
        // $data['ct_upload_img'] = $this->masters_model->get_image($idd ,'user_info_id' ,'ct_upload_img'); 
        $this->load->view('ct/ct_edit_form' ,$data);
    }
 

    // public function user_info() {

    //         $area = $this->input->post('area', TRUE);
    //         $age = $this->input->post('age', TRUE);
    //         $business = $this->input->post('business', TRUE);
    //         $family_busi = $this->input->post('family_busi', TRUE);
    //         $business_time = $this->input->post('business_time', TRUE);
    //         $total_score = $area + $age + $business + $family_busi + $business_time ;
        
    //         $data['name'] = $this->input->post('name', TRUE);
    //         $data['email'] = $this->input->post('email', TRUE);
    //         $data['mobile'] = $this->input->post('mobile', TRUE);
    //         $data['whatsapp_no'] = $this->input->post('whatsapp_no', TRUE);
    //         $data['landline'] = $this->input->post('landline', TRUE);
    //         $data['annual_income'] = $this->input->post('annual_income', TRUE);
    //         $data['shop_sate'] = $this->input->post('shop_sate', TRUE);
    //         $data['shop_city'] = $this->input->post('shop_city', TRUE);
    //         $data['shop_town'] = $this->input->post('shop_town', TRUE);
    //         $data['shop_address'] = $this->input->post('address', TRUE);
    //         $data['proof_type'] = $this->input->post('proof', TRUE);
    //         $data['proof_no'] = $this->input->post('proof_no', TRUE);
    //         // $data['image_proof'] = $this->input->post('image_proof', TRUE);
    //         $data['shop_zipcode'] = "";
    //         $data['population'] = $this->input->post('population', TRUE);
    //         $data['town_code'] = $this->input->post('town_code', TRUE);

    //         $data['area'] = $area;
    //         $data['age'] = $age;
    //         $data['business'] = $business;
    //         $data['family_business'] = $family_busi;
    //         $data['business_time'] = $business_time;
    //         $data['score'] = $total_score;

    //         if($this->input->post('save_status')=="1"){
    //             // save clicked
    //             $submit_status_type="Saved";
    //         }
    //         else{
    //             // submit clicked
    //             $submit_status_type=1;
    //         }
    //         $data['status'] = $submit_status_type;
    //         $data['sh_approval'] = "";
    //         $data['ct_review'] = "";
    //         $data['sh_remark'] = "";
    //         $data['created_by'] = $this->session->userdata('mobile');
    //         $data['approved_by'] = "";


    //         $last_id = $this->masters_model->insert_data('user_information', $data);

    //         if(!empty($_FILES['image_proof']['name'])){
               
    //             $config['upload_path'] = APPPATH . '../uploads/';
    //             $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';
    //             $config['max_size']     = '20000';
    //             $config['file_name'] = $_FILES['image_proof']['name'];
                
    //             $this->load->library('upload', $config);
    //             $this->upload->initialize($config);
                
    //             if($this->upload->do_upload('image_proof')){
    //                 $imageData = $this->upload->data();
    //                 $uploadImgData['image_proof'] = $imageData['file_name'];
    //                 $uploadImgData['d_id'] = $last_id;
    //                 $uploadImgData['status'] = 1;
    //             }
    //             if (!empty($uploadImgData)) {
    //                 // Insert files data into the database
    //                 $this->masters_model->importData('image_proof', $uploadImgData);
    //             }
    //         }

    //     $this->session->set_flashdata('message', ('Added Successfully!'));
    //     redirect(base_url('index.php/cc/franchisee_form'));

    // }
 
    public function entered_form() {
        $user_information = $this->masters_model->get_ct_table_submitted(); 
        $data['user_information'] = $user_information;
        $this->load->view('ct/entered_form', $data);
    }
 
    public function update_user_information() {

        $id = $this->input->post('user_id', TRUE);

        $data['a_person']= ( implode(",",$this->input->post('attendee_p')) );

        $data['av_person']= ( implode(",",$this->input->post('attendee_v')) );


        if($this->input->post('takeover_c') == "0"){
            $takeover_c = "10";
        }else{
            $takeover_c = "0"; 
        }

        if($this->input->post('takeover_d') == "Yes"){
            $takeover_d = "10";
        }elseif($this->input->post('takeover_d') == "No"){
            $takeover_d = "0"; 
        }

        if($this->input->post('takeover_e') <= "30"){
            $takeover_e = "10";
        }elseif( ($this->input->post('takeover_e') > "30") && ($this->input->post('takeover_e') < "50") ){
            $takeover_e = "5"; 
        }else{
            $takeover_e = "0";
        }

        if($this->input->post('networth_c') >= "500000"){
            $networth_c = "20";
        }elseif( ($this->input->post('networth_c') > "299999") && ($this->input->post('takeover_e') < "500000") ){
            $networth_c = "10"; 
        }else{
            $networth_c = "0";
        }

        if($this->input->post('investment') == "Own Fund"){
            $investment = "10";
        }elseif($this->input->post('loan_type') == "Partial Loan" ){
            $investment = "5"; 
        }else{
            $investment = "0"; 
        }

        if($this->input->post('experience') == "Yes"){
            $experience = "20";
        }elseif($this->input->post('experience') == "No" ){
            $experience = "0"; 
        }

        if($this->input->post('dairy') == "Yes"){
            $dairy = "20";
        }elseif($this->input->post('dairy') == "No" ){
            $dairy = "0"; 
        }


        $ct_score = $takeover_c + $takeover_d + $takeover_e + $networth_c + $investment + $experience + $dairy;

        //exccess field 
        $data['3a'] = $this->input->post('entrepreneur_a', TRUE);
        $data['3b'] = $this->input->post('entrepreneur_b', TRUE);
        $data['3c'] = $this->input->post('entrepreneur_c', TRUE);
        $data['3d'] = $this->input->post('entrepreneur_d', TRUE);
        $data['3e'] = $this->input->post('entrepreneur_e', TRUE);
        
        $data['franc_emp']= $this->input->post('f_employee', TRUE);
        
        $data['4a'] = $this->input->post('passion_a', TRUE);
        $data['4b'] = $this->input->post('passion_b', TRUE);
        $data['4c'] = $this->input->post('passion_c', TRUE);
        $data['5a'] = $this->input->post('passion_d', TRUE);
        $data['5b'] = $this->input->post('passion_e', TRUE);
        $data['5c'] = $this->input->post('passion_f', TRUE);
        $data['5d'] = $this->input->post('passion_g', TRUE);
        
        
        $data['6a'] = $this->input->post('takeover_a', TRUE);
        $data['6b'] = $this->input->post('takeover_b', TRUE);
        $data['6c'] = $this->input->post('takeover_c', TRUE);
        $data['6d'] = $this->input->post('takeover_d', TRUE);
        $data['6e'] = $this->input->post('takeover_e', TRUE);
        
        $data['7a'] = $this->input->post('networth_a', TRUE);
        $data['7b'] = $this->input->post('networth_b', TRUE);
        $data['7c'] = $this->input->post('networth_c', TRUE);
        
        $data['7aa'] = $this->input->post('networth_aa', TRUE);
        $data['7bb'] = $this->input->post('networth_bb', TRUE);

        
        $data['8a'] = $this->input->post('investment', TRUE);
        $data['8aa'] = $this->input->post('loan_type', TRUE);
        $data['8b'] = $this->input->post('investment_a', TRUE);
        $data['8c'] = $this->input->post('investment_b', TRUE);
        
        $data['8d'] = $this->input->post('investment_c', TRUE);
        
        
        $data['9a'] = $this->input->post('scenarios_to_a', TRUE);
        $data['9b'] = $this->input->post('scenarios_to_b', TRUE);
       
        $data['10a'] = $this->input->post('busi_dev_a', TRUE);
        $data['10b'] = $this->input->post('busi_dev_b', TRUE);
        $data['10c'] = $this->input->post('busi_dev_c', TRUE);
        $data['10d'] = $this->input->post('busi_dev_d', TRUE);
        
        $data['11aa'] = $this->input->post('experience', TRUE);
        
        
        $data['11a'] = $this->input->post('manpower_a', TRUE);
        
        $data['11bb'] = $this->input->post('dairy', TRUE);
        
        
        $data['11b'] = $this->input->post('manpower_b', TRUE);
        $data['11c'] = $this->input->post('manpower_c', TRUE);
        $data['11d'] = $this->input->post('manpower_d', TRUE);
        $data['11e'] = $this->input->post('manpower_e', TRUE);
       
        $data['12a'] = $this->input->post('scenarios_a', TRUE);
        $data['12b'] = $this->input->post('scenarios_b', TRUE);
        $data['12c'] = $this->input->post('scenarios_c', TRUE);
        $data['12d'] = $this->input->post('scenarios_d', TRUE);
        $data['12e'] = $this->input->post('scenarios_e', TRUE);
        $data['12f'] = $this->input->post('scenarios_f', TRUE);
        $data['12g'] = $this->input->post('scenarios_g', TRUE);
        $data['12h'] = $this->input->post('scenarios_h', TRUE);
        $data['12i'] = $this->input->post('scenarios_i', TRUE);
        $data['12j'] = $this->input->post('scenarios_j', TRUE);
        $data['12k'] = $this->input->post('scenarios_k', TRUE);
        $data['12l'] = $this->input->post('scenarios_l', TRUE);
        $data['12m'] = $this->input->post('scenarios_m', TRUE);
        $data['12n'] = $this->input->post('scenarios_n', TRUE);
        $data['12o'] = $this->input->post('scenarios_o', TRUE);
        $data['12p'] = $this->input->post('scenarios_p', TRUE);
        
        
        $data['12q'] = $this->input->post('ct_remark_q', TRUE);
      
        // status 2 mens saved form / status 1 mens saved form
        if($this->input->post('save_status')=="1"){
            // save clicked
            $submit_status_type="Saved"; 
        }
        else{
            // submit clicked
            $submit_status_type=1;
        }
        $data['rsm_approval'] = "";
        $data['sh_approval'] = "";
        $data['ct_review'] = "$submit_status_type";
        $data['ct_score'] = $ct_score;
        $data['status'] = "1";
        $data['sh_remark'] = "";
        $data['rsm_remark'] = "";
        $data['updated_by'] = $this->session->userdata('emp_no');

        $update = $this->masters_model->updates('user_information', $data, 'id', $id);

         // image
         if ($_FILES['image_name']['name'] != '') {

            $this->load->library('upload');
            $image = array();
            $ImageCount = count($_FILES['image_name']['name']);


            //mkdir(APPPATH. '../uploads/'.$last_id.'/');
            for ($i = 0; $i < $ImageCount; $i++) {
                $_FILES['file']['name'] = $_FILES['image_name']['name'][$i];
                $_FILES['file']['type'] = $_FILES['image_name']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['image_name']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['image_name']['error'][$i];
                $_FILES['file']['size'] = $_FILES['image_name']['size'][$i];

                // File upload configuration

                $config['upload_path'] = APPPATH . '../uploads/Ct_Uploaded_Img';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) { 
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgData[$i]['upload_images'] = $imageData['file_name'];
                    $uploadImgData[$i]['user_info_id'] = $id;
                    $uploadImgData[$i]['status'] = 1;
                }
            }
            if (!empty($uploadImgData)) {
                // Insert files data into the database
                $this->masters_model->importImageData('ct_upload_img', $uploadImgData);
            }
        }

        $this->session->set_flashdata('message', ('Updated Successfully!'));
        redirect(base_url('index.php/ct/entered_form'));

    }


    public function update_funnel_user_information() {

        $id = $this->input->post('user_id', TRUE);

        $data['a_person']= ( implode(",",$this->input->post('attendee_p')) );

        $data['av_person']= ( implode(",",$this->input->post('attendee_v')) );


        if($this->input->post('takeover_c') == "0"){
            $takeover_c = "10";
        }else{
            $takeover_c = "0"; 
        }

        if($this->input->post('takeover_d') == "Yes"){
            $takeover_d = "10";
        }elseif($this->input->post('takeover_d') == "No"){
            $takeover_d = "0"; 
        }

        if($this->input->post('takeover_e') <= "30"){
            $takeover_e = "10";
        }elseif( ($this->input->post('takeover_e') > "30") && ($this->input->post('takeover_e') < "50") ){
            $takeover_e = "5"; 
        }else{
            $takeover_e = "0";
        }

        if($this->input->post('networth_c') >= "500000"){
            $networth_c = "20";
        }elseif( ($this->input->post('networth_c') > "299999") && ($this->input->post('takeover_e') < "500000") ){
            $networth_c = "10"; 
        }else{
            $networth_c = "0";
        }

        if($this->input->post('investment') == "Own Fund"){
            $investment = "10";
        }elseif($this->input->post('loan_type') == "Partial Loan" ){
            $investment = "5"; 
        }else{
            $investment = "0"; 
        }

        if($this->input->post('experience') == "Yes"){
            $experience = "20";
        }elseif($this->input->post('experience') == "No" ){
            $experience = "0"; 
        }

        if($this->input->post('dairy') == "Yes"){
            $dairy = "20";
        }elseif($this->input->post('dairy') == "No" ){
            $dairy = "0"; 
        }


        $ct_score = $takeover_c + $takeover_d + $takeover_e + $networth_c + $investment + $experience + $dairy;

        //exccess field 
        $data['3a'] = $this->input->post('entrepreneur_a', TRUE);
        $data['3b'] = $this->input->post('entrepreneur_b', TRUE);
        $data['3c'] = $this->input->post('entrepreneur_c', TRUE);
        $data['3d'] = $this->input->post('entrepreneur_d', TRUE);
        $data['3e'] = $this->input->post('entrepreneur_e', TRUE);
        
        $data['franc_emp']= $this->input->post('f_employee', TRUE);
        
        $data['4a'] = $this->input->post('passion_a', TRUE);
        $data['4b'] = $this->input->post('passion_b', TRUE);
        $data['4c'] = $this->input->post('passion_c', TRUE);
        $data['5a'] = $this->input->post('passion_d', TRUE);
        $data['5b'] = $this->input->post('passion_e', TRUE);
        $data['5c'] = $this->input->post('passion_f', TRUE);
        $data['5d'] = $this->input->post('passion_g', TRUE);
        
        
        $data['6a'] = $this->input->post('takeover_a', TRUE);
        $data['6b'] = $this->input->post('takeover_b', TRUE);
        $data['6c'] = $this->input->post('takeover_c', TRUE);
        $data['6d'] = $this->input->post('takeover_d', TRUE);
        $data['6e'] = $this->input->post('takeover_e', TRUE);
        
        $data['7a'] = $this->input->post('networth_a', TRUE);
        $data['7b'] = $this->input->post('networth_b', TRUE);
        $data['7c'] = $this->input->post('networth_c', TRUE);
        
        $data['7aa'] = $this->input->post('networth_aa', TRUE);
        $data['7bb'] = $this->input->post('networth_bb', TRUE);

        
        $data['8a'] = $this->input->post('investment', TRUE);
        $data['8aa'] = $this->input->post('loan_type', TRUE);
        $data['8b'] = $this->input->post('investment_a', TRUE);
        $data['8c'] = $this->input->post('investment_b', TRUE);
        
        $data['8d'] = $this->input->post('investment_c', TRUE);
        
        
        $data['9a'] = $this->input->post('scenarios_to_a', TRUE);
        $data['9b'] = $this->input->post('scenarios_to_b', TRUE);
       
        $data['10a'] = $this->input->post('busi_dev_a', TRUE);
        $data['10b'] = $this->input->post('busi_dev_b', TRUE);
        $data['10c'] = $this->input->post('busi_dev_c', TRUE);
        $data['10d'] = $this->input->post('busi_dev_d', TRUE);
        
        $data['11aa'] = $this->input->post('experience', TRUE);
        
        
        $data['11a'] = $this->input->post('manpower_a', TRUE);
        
        $data['11bb'] = $this->input->post('dairy', TRUE);
        
        
        $data['11b'] = $this->input->post('manpower_b', TRUE);
        $data['11c'] = $this->input->post('manpower_c', TRUE);
        $data['11d'] = $this->input->post('manpower_d', TRUE);
        $data['11e'] = $this->input->post('manpower_e', TRUE);
       
        $data['12a'] = $this->input->post('scenarios_a', TRUE);
        $data['12b'] = $this->input->post('scenarios_b', TRUE);
        $data['12c'] = $this->input->post('scenarios_c', TRUE);
        $data['12d'] = $this->input->post('scenarios_d', TRUE);
        $data['12e'] = $this->input->post('scenarios_e', TRUE);
        $data['12f'] = $this->input->post('scenarios_f', TRUE);
        $data['12g'] = $this->input->post('scenarios_g', TRUE);
        $data['12h'] = $this->input->post('scenarios_h', TRUE);
        $data['12i'] = $this->input->post('scenarios_i', TRUE);
        $data['12j'] = $this->input->post('scenarios_j', TRUE);
        $data['12k'] = $this->input->post('scenarios_k', TRUE);
        $data['12l'] = $this->input->post('scenarios_l', TRUE);
        $data['12m'] = $this->input->post('scenarios_m', TRUE);
        $data['12n'] = $this->input->post('scenarios_n', TRUE);
        $data['12o'] = $this->input->post('scenarios_o', TRUE);
        $data['12p'] = $this->input->post('scenarios_p', TRUE);
        
        
        $data['12q'] = $this->input->post('ct_remark_q', TRUE);
      
        // status 2 mens saved form / status 1 mens saved form
        if($this->input->post('save_status')=="1"){
            // save clicked
            $submit_status_type="Saved"; 
        }
        else{
            // submit clicked
            $submit_status_type=1;
        }
        $data['rsm_approval'] = "";
        $data['sh_approval'] = "";
        $data['ct_review'] = "$submit_status_type";
        $data['ct_score'] = $ct_score;
        $data['status'] = "1";
        $data['sh_remark'] = "";
        $data['rsm_remark'] = "";
        $data['updated_by'] = $this->session->userdata('emp_no');

        $update = $this->masters_model->updates('user_information', $data, 'id', $id);

         // image
         if ($_FILES['image_name']['name'] != '') {

            $this->load->library('upload');
            $image = array();
            $ImageCount = count($_FILES['image_name']['name']);


            //mkdir(APPPATH. '../uploads/'.$last_id.'/');
            for ($i = 0; $i < $ImageCount; $i++) {
                $_FILES['file']['name'] = $_FILES['image_name']['name'][$i];
                $_FILES['file']['type'] = $_FILES['image_name']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['image_name']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['image_name']['error'][$i];
                $_FILES['file']['size'] = $_FILES['image_name']['size'][$i];

                // File upload configuration

                $config['upload_path'] = APPPATH . '../uploads/Ct_Uploaded_Img';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) { 
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgData[$i]['upload_images'] = $imageData['file_name'];
                    $uploadImgData[$i]['user_info_id'] = $id;
                    $uploadImgData[$i]['status'] = 1;
                }
            }
            if (!empty($uploadImgData)) {
                // Insert files data into the database
                $this->masters_model->importImageData('ct_upload_img', $uploadImgData);
            }
        }

        $this->session->set_flashdata('message', ('Updated Successfully!'));
        redirect(base_url('index.php/ct/funneled_form_view'));

    }


    public function funneled_form_view()
    {
        $this->load->view('ct/funneled_form');
    }

    public function get_all_funneled_data() {
        $postData = $this->input->post();
         
        $data = $this->masters_model->get_ct_funneled_data($postData,'user_information');
        echo json_encode($data); 
    }

    public function ct_updated_form() 
    {
        $this->load->view('ct/ct_updated_form');
    }

    public function get_all_updated_data()    
    {
        $postData = $this->input->post(); 
        
        $data = $this->masters_model->get_ct_updated_data($postData,'user_information');
        echo json_encode($data); 
    }
 
    public function ct_doc_upload() {
        $user_information = $this->masters_model->get_approved_list_sh_log('user_information', 'sh_approval', 'Approved');
        $data['user_information'] = $user_information;
        $this->load->view('ct/sh_approved_form', $data);
    }

    public function post_upload_form() {
        $user_information = $this->masters_model->get_approved_list_tt_log('user_information', 'assess_score', '0');
        $data['user_information'] = $user_information;
        $this->load->view('ct/post_upload_form', $data);
    }

    public function ct_pending_form()    
    {
        $postData = $this->input->post();
        $data = $this->masters_model->get_ct_pending_list($postData,'user_information');
        echo json_encode($data);   
    }

    public function code_created_list()    
    {
        $postData = $this->input->post();
        $data = $this->masters_model->get_ct_code_creation_list($postData,'user_information');
        echo json_encode($data);   
    }

        public function update_ct_code()
    {
        $id = $this->input->post('user_id', TRUE);
        $data['distributor_code'] = $this->input->post('user_code', TRUE);
        $update=$this->masters_model->updates('user_information', $data, 'id', $id);
        $result = array(
			"response" => "success",
		);
		echo json_encode($result);
    }
  
    public function ct_approved_form()      
    {
        $postData = $this->input->post(); 
        $data = $this->masters_model->get_sh_approved_list($postData,'user_information');
        echo json_encode($data);   
    }

    public function post_upload_form_list()     
    {
        $postData = $this->input->post();
        $data = $this->masters_model->post_upload_form_list($postData,'user_information');
        echo json_encode($data);   
    }
    
    public function insert_pre_document(){

        $id =$this->input->post('id_val', TRUE);

        if(!empty($_FILES['sign_agree']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['sign_agree']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('sign_agree')){
                $uploadData = $this->upload->data();
                $sign_agree = $uploadData['file_name'];
            }else{ 
                $sign_agree = 'Nil';
            }
        }else{
            $sign_agree = 'Nil';
        }

        if(!empty($_FILES['profile']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['profile']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('profile')){
                $uploadData = $this->upload->data();
                $profile = $uploadData['file_name'];
            }else{ 
                $profile = 'Nil';
            }
        }else{
            $profile= 'Nil';
        }

        if(!empty($_FILES['challan']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true); 
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['challan']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('challan')){
                $uploadData = $this->upload->data();
                $challan = $uploadData['file_name'];
            }else{ 
                $challan = 'Nil';
            }
        }else{
            $challan = 'Nil';
        }

        if(!empty($_FILES['gst']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['gst']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config); 
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('gst')){
                $uploadData = $this->upload->data();
                $gst = $uploadData['file_name'];
            }else{ 
                $gst = 'Nil';
            }
        }else{
            $gst= 'Nil';
        }


        if(!empty($_FILES['fassai']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['fassai']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('fassai')){
                $uploadData = $this->upload->data();
                $fassai = $uploadData['file_name'];
            }else{ 
                $fassai = 'Nil';
            }
        }else{
            $fassai= 'Nil';
        }


        if(!empty($_FILES['pan']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['pan']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('pan')){
                $uploadData = $this->upload->data();
                $pan = $uploadData['file_name'];
            }else{ 
                $pan = 'Nil';
            }
        }else{
            $pan= 'Nil';
        }

        if(!empty($_FILES['aadhar']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['aadhar']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('aadhar')){
                $uploadData = $this->upload->data();
                $aadhar = $uploadData['file_name'];
            }else{ 
                $aadhar = 'Nil';
            }
        }else{
            $aadhar= 'Nil';
        }

        if(!empty($_FILES['current_acc']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['current_acc']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('current_acc')){
                $uploadData = $this->upload->data();
                $current_acc = $uploadData['file_name'];
            }else{ 
                $current_acc = 'Nil';
            }
        }else{
            $current_acc= 'Nil';
        } 

        if(!empty($_FILES['retail_outlet']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['retail_outlet']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('retail_outlet')){
                $uploadData = $this->upload->data();
                $retail_outlet = $uploadData['file_name'];
            }else{ 
                $retail_outlet = 'Nil';
            }
        }else{
            $retail_outlet= 'Nil';
        } 

        if(!empty($_FILES['asset_img']['name'])){
            $upload_path= APPPATH . '../uploads/Asset_and_Team';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['asset_img']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('asset_img')){
                $uploadData = $this->upload->data();
                $asset_img = $uploadData['file_name'];
            }else{ 
                $asset_img = 'Nil';
            }
        }else{
            $asset_img = 'Nil';
        }

        if(!empty($_FILES['team_img']['name'])){
            $upload_path= APPPATH . '../uploads/Asset_and_Team';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            } 
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['team_img']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('team_img')){
                $uploadData = $this->upload->data();
                $team_img = $uploadData['file_name'];
            }else{ 
                $team_img = 'Nil';
            }
        }else{ 
            $team_img= 'Nil';
        }

        $uploadPostData['user_info_id']=$this->input->post('id_val', TRUE);
        $uploadPostData['asset_img']=$asset_img;
        $uploadPostData['team_img']=$team_img;

        $post_insert = $this->masters_model->importData('post_documents', $uploadPostData);

        $uploadImgData['user_info_id']=$this->input->post('id_val', TRUE);
        $uploadImgData['signed_agree']=$sign_agree;
        $uploadImgData['profile']=$profile;
        $uploadImgData['challan']=$challan;
        $uploadImgData['gst']=$gst;
        $uploadImgData['fassai']=$fassai;
        $uploadImgData['pan']=$pan;
        $uploadImgData['aadhar']=$aadhar;
        $uploadImgData['current_acc']=$current_acc;  
        $uploadImgData['retail_outlet']=$retail_outlet;  
  
        $insert = $this->masters_model->importData('pre_documents', $uploadImgData);

        if ($sign_agree !="Nil" && $profile !="Nil" && $challan !="Nil" && $gst!="Nil" && $fassai !="Nil" && $pan !="Nil" && $aadhar !="Nil" && $current_acc !="Nil" && $retail_outlet != "Nil"){
           
            $dat['ct_pre_doc_upload'] = "uploaded";
            $this->masters_model->updates('user_information', $dat, 'id', $this->input->post('id_val', TRUE));
        }

        if ( $asset_img !="Nil" && $team_img != "Nil"){
           
            $dat['ct_post_doc_upload'] = "uploaded";
            $this->masters_model->updates('user_information', $dat, 'id', $this->input->post('id_val', TRUE));
        }
 
        if ($insert || $post_insert) {
            $data = array('responce' => "success" ,
            'id' => "$id" );
        }else {
            $data = array('responce' => "error");
        } 

        echo json_encode($data);

    }


    public function update_sh_document(){
       
        $id =$this->input->post('id_val', TRUE);

        if(!empty($_FILES['sign_agree']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['sign_agree']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('sign_agree')){
                $uploadData = $this->upload->data();
                $sign_agree = $uploadData['file_name'];
            }else{ 
                $sign_agree = '';
            }
        }else{
            $sign_agree = '';
        }

        if(!empty($_FILES['profile']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_ext_tolower'] = TRUE;
            $config['file_name'] = $_FILES['profile']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('profile')){
                $uploadData = $this->upload->data();
                $profile = $uploadData['file_name'];
            }else{ 
                $profile = '';
            }
        }else{
            $profile= '';
        }

        if(!empty($_FILES['challan']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_ext_tolower'] = TRUE;
            $config['file_name'] = $_FILES['challan']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('challan')){
                $uploadData = $this->upload->data();
                $challan = $uploadData['file_name'];
            }else{ 
                $challan = '';
            }
        }else{
            $challan = '';
        }

        if(!empty($_FILES['gst']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_ext_tolower'] = TRUE;
            $config['file_name'] = $_FILES['gst']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('gst')){
                $uploadData = $this->upload->data();
                $gst = $uploadData['file_name'];
            }else{ 
                $gst = '';
            }
        }else{
            $gst= '';
        }


        if(!empty($_FILES['fassai']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_ext_tolower'] = TRUE;
            $config['file_name'] = $_FILES['fassai']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('fassai')){
                $uploadData = $this->upload->data();
                $fassai = $uploadData['file_name'];
            }else{ 
                $fassai = '';
            }
        }else{
            $fassai= '';
        }

        if(!empty($_FILES['pan']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['pan']['name'];
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('pan')){
                $uploadData = $this->upload->data();
                $pan = $uploadData['file_name'];
            }else{ 
                $pan = '';
            }
        }else{
            $pan= '';
        }
        if(!empty($_FILES['aadhar']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['aadhar']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('aadhar')){
                $uploadData = $this->upload->data();
                $aadhar = $uploadData['file_name'];
            }else{ 
                $aadhar = '';
            }
        }else{
            $aadhar= '';
        }

        if(!empty($_FILES['current_acc']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['current_acc']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('current_acc')){
                $uploadData = $this->upload->data();
                $current_acc = $uploadData['file_name'];
            }else{ 
                $current_acc = '';
            }
        }else{
            $current_acc= '';
        }

        if(!empty($_FILES['retail_outlet']['name'])){
            $upload_path= APPPATH . '../uploads/shDocument';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['retail_outlet']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('retail_outlet')){
                $uploadData = $this->upload->data();
                $retail_outlet = $uploadData['file_name'];
            }else{ 
                $retail_outlet = '';
            }
        }else{
            $retail_outlet= '';
        }

        if(!empty($_FILES['asset_img']['name'])){
            $upload_path= APPPATH . '../uploads/Asset_and_Team';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['asset_img']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('asset_img')){
                $uploadData = $this->upload->data();
                $asset_img = $uploadData['file_name'];
            }else{ 
                $asset_img = "";
            } 
        }else{
            $asset_img = "";
        }

        if(!empty($_FILES['team_img']['name'])){
            $upload_path= APPPATH . '../uploads/Asset_and_Team';
            if(!is_dir($upload_path)){
                mkdir($upload_path,0777,true);
            }
            $config['upload_path'] = "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = $_FILES['team_img']['name'];
            
            //Load upload library and initialize configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('team_img')){
                $uploadData = $this->upload->data();
                $team_img = $uploadData['file_name'];
            }else{ 
                $team_img = "";
            }
        }else{
            $team_img= "";
        }

        $uploadImgData['user_info_id']=$this->input->post('id_val', TRUE);
        $uploadpostData['user_info_id']=$this->input->post('id_val', TRUE);

        if($asset_img !=""){
            $uploadpostData['asset_img']= $asset_img;
            $update = $this->masters_model->updates('post_documents', $uploadpostData ,'user_info_id' ,$id);
        }
        if($team_img !=""){
            $uploadpostData['team_img']= $team_img;
            $update = $this->masters_model->updates('post_documents', $uploadpostData ,'user_info_id' ,$id);
        }

        if($sign_agree !=""){
            $uploadImgData['signed_agree'] = $sign_agree;
            $update = $this->masters_model->updates('pre_documents', $uploadImgData ,'user_info_id' ,$id);
        }
        if($profile !=""){
            $uploadImgData['profile'] = $profile;
            $update = $this->masters_model->updates('pre_documents', $uploadImgData ,'user_info_id' ,$id);
        }
        if($challan !=""){
            $uploadImgData['challan'] = $challan;
            $update = $this->masters_model->updates('pre_documents', $uploadImgData ,'user_info_id' ,$id);
        }
        if($gst !=""){
            $uploadImgData['gst'] = $gst;
            $update = $this->masters_model->updates('pre_documents', $uploadImgData ,'user_info_id' ,$id);
        }
        if($fassai !=""){
            $uploadImgData['fassai'] = $fassai;
            $update = $this->masters_model->updates('pre_documents', $uploadImgData ,'user_info_id' ,$id);
        }
        if($pan !=""){
            $uploadImgData['pan'] = $pan; 
            $update = $this->masters_model->updates('pre_documents', $uploadImgData ,'user_info_id' ,$id);
        }
        if($aadhar !=""){
            $uploadImgData['aadhar'] = $aadhar;
            $update = $this->masters_model->updates('pre_documents', $uploadImgData ,'user_info_id' ,$id);
        }
        if($current_acc !=""){
            $uploadImgData['current_acc'] = $current_acc;  
            $update = $this->masters_model->updates('pre_documents', $uploadImgData ,'user_info_id' ,$id);
        }
        if($retail_outlet !=""){
            $uploadImgData['retail_outlet'] = $retail_outlet;  
            $update = $this->masters_model->updates('pre_documents', $uploadImgData ,'user_info_id' ,$id);
        }


        $val = $this->masters_model->get_table_row_condition('pre_documents','user_info_id',$id);
        $sign = $val[0]['signed_agree'];
        $pro = $val[0]['profile'];
        $chal = $val[0]['challan'];
        $gs = $val[0]['gst'];
        $fas = $val[0]['fassai'];
        $pa = $val[0]['pan'];
        $aadh = $val[0]['aadhar'];
        $sh = $val[0]['current_acc'];
        $retail = $val[0]['retail_outlet'];
        
       
        if ($sign!="Nil" && $pro !="Nil" && $chal !="Nil" && $gs!="Nil" && $fas !="Nil" && $pa !="Nil" && $aadh !="Nil" && $sh !="Nil" && $retail != "Nil"){
        //    print_r("uploaded");
            $dat['ct_pre_doc_upload'] = "uploaded";
            $this->masters_model->updates('user_information', $dat, 'id', $id);
        }

        $post_val = $this->masters_model->get_table_row_condition('post_documents','user_info_id',$id);
        $asset = $post_val[0]['asset_img'];
        $team = $post_val[0]['team_img'];

        if($asset !="Nil" && $team !="Nil"){
            $Udat['ct_post_doc_upload'] = "uploaded";
            $this->masters_model->updates('user_information', $Udat, 'id', $id);
        }

        if ($update) {
            $data = array('responce' => "success" ,
            'id' => "$id" );
        } else {
            $data = array('responce' => "error");
        }
       
        echo json_encode($data);

    }

    // public function move_doc(){
	// 	$id =  $this->input->post('id');
    //     $data['ct_pre_doc_upload'] = "uploaded";
    //     $update = $this->masters_model->updates('user_information', $data, 'id', $id);     

    //     if ($update) {
    //         $data = array('responce' => "success" ,
    //         'id' => "$id" );
    //         // $data = array('responce' => "success" );
    //     } else {
    //         $data = array('responce' => "error");
    //     }
    //     echo json_encode($data);

    // } 

    // public function insert_post_document(){

    //     $id =$this->input->post('id_val', TRUE);

    //     if(!empty($_FILES['asset_img']['name'])){
    //         $upload_path= APPPATH . '../uploads/Asset_and_Team';
    //         if(!is_dir($upload_path)){
    //             mkdir($upload_path,0777,true);
    //         }
    //         $config['upload_path'] = "$upload_path";
    //         $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';
    //         $config['max_size']     = '20000';
    //         $config['file_name'] = $_FILES['asset_img']['name'];
            
    //         //Load upload library and initialize configuration
    //         $this->load->library('upload',$config);
    //         $this->upload->initialize($config);
            
    //         if($this->upload->do_upload('asset_img')){
    //             $uploadData = $this->upload->data();
    //             $asset_img = $uploadData['file_name'];
    //         }else{ 
    //             $asset_img = 'Nil';
    //         }
    //     }else{
    //         $asset_img = 'Nil';
    //     }

    //     if(!empty($_FILES['team_img']['name'])){
    //         $upload_path= APPPATH . '../uploads/Asset_and_Team';
    //         if(!is_dir($upload_path)){
    //             mkdir($upload_path,0777,true);
    //         } 
    //         $config['upload_path'] = "$upload_path";
    //         $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';
    //         $config['max_size']     = '20000';
    //         $config['file_name'] = $_FILES['team_img']['name'];
            
    //         //Load upload library and initialize configuration
    //         $this->load->library('upload',$config);
    //         $this->upload->initialize($config);
            
    //         if($this->upload->do_upload('team_img')){
    //             $uploadData = $this->upload->data();
    //             $team_img = $uploadData['file_name'];
    //         }else{ 
    //             $team_img = 'Nil';
    //         }
    //     }else{
    //         $team_img= 'Nil';
    //     }

    //     $uploadImgData['user_info_id']=$this->input->post('id_val', TRUE);
    //     $uploadImgData['asset_img']=$asset_img;
    //     $uploadImgData['team_img']=$team_img;

    //     $insert = $this->masters_model->importData('post_documents', $uploadImgData);

    //     if ($team_img !="Nil" && $asset_img !="Nil") {
    //         $dat['ct_post_doc_upload'] = "uploaded";
    //         $this->masters_model->updates('user_information', $dat, 'id', $id);
    //     }

    //     if ($insert) {
    //         $data = array('responce' => "success" ,
    //         'id' => "$id" );
    //         // $data = array('responce' => "success" );
    //     } else {
    //         $data = array('responce' => "error");
    //     }
    //     echo json_encode($data);

    // }


    // public function update_post_doc(){

    //     $id =$this->input->post('id_val', TRUE);

    //     if(!empty($_FILES['asset_img']['name'])){
    //         $upload_path= APPPATH . '../uploads/Asset_and_Team';
    //         if(!is_dir($upload_path)){
    //             mkdir($upload_path,0777,true);
    //         }
    //         $config['upload_path'] = "$upload_path";
    //         $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';
    //         $config['file_name'] = $_FILES['asset_img']['name'];
            
    //         //Load upload library and initialize configuration
    //         $this->load->library('upload',$config);
    //         $this->upload->initialize($config);
            
    //         if($this->upload->do_upload('asset_img')){
    //             $uploadData = $this->upload->data();
    //             $asset_img = $uploadData['file_name'];
    //         }else{ 
    //             $asset_img = "";
    //         } 
    //     }else{
    //         $asset_img = "";
    //     }

    //     if(!empty($_FILES['team_img']['name'])){
    //         $upload_path= APPPATH . '../uploads/Asset_and_Team';
    //         if(!is_dir($upload_path)){
    //             mkdir($upload_path,0777,true);
    //         }
    //         $config['upload_path'] = "$upload_path";
    //         $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';
    //         $config['file_name'] = $_FILES['team_img']['name'];
            
    //         //Load upload library and initialize configuration
    //         $this->load->library('upload',$config);
    //         $this->upload->initialize($config);
            
    //         if($this->upload->do_upload('team_img')){
    //             $uploadData = $this->upload->data();
    //             $team_img = $uploadData['file_name'];
    //         }else{ 
    //             $team_img = "";
    //         }
    //     }else{
    //         $team_img= "";
    //     }

    //     if($asset_img !=""){
    //         $uploadImgData['asset_img']= $asset_img;
    //         $update = $this->masters_model->updates('post_documents', $uploadImgData ,'user_info_id' ,$id);
    //     }
    //     if($team_img !=""){
    //         $uploadImgData['team_img']= $team_img;
    //         $update = $this->masters_model->updates('post_documents', $uploadImgData ,'user_info_id' ,$id);
    //     }
    //     if ($update) {
    //         $dat['ct_post_doc_upload'] = "uploaded";

    //         $this->masters_model->updates('user_information', $dat, 'id', $id);

    //         // $data = array('responce' => "success" );
    //         $data = array('responce' => "success" ,
    //         'id' => "$id" );
    //     } else {
    //         $data = array('responce' => "error");
    //     }

    //     echo json_encode($data);

    // } 

    public function login_type() {
        $this->load->view('ct/login_type');
    }

    public function location_table() {
        $this->load->view('ct/location_table');
    }

    public function final_locations() {
        $this->load->view('ct/final_locations');
    }

    // public function get_location_table(){ 
    //     $postData = $this->input->post();
    //     $data = $this->masters_model->get_location_table_ct($postData,'locations');
    //     echo json_encode($data); 
    // }
 
   

    public function approval_locations(){
        $id =  $this->input->post('app_reg_id');
        $data['approval_locations'] =  $this->input->post('type');
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['remark'] =  $this->input->post('remarks');
        $this->masters_model->update_locations('locations','id',$id,$data);
        $data = array('res' => "success" );
        echo json_encode($data);
    }

    // public function get_image(){
    //     $id =  $this->input->post('id');
    //     $image = $this->masters_model->get_image($id,'id','locations');
    //     $imgs="";
    //     foreach($image as $img){
    //         $imgs.='<a target="blank" href="../../uploads/place_review_image/'.$img->place_review_image.'"><img src="../../uploads/place_review_image/'.$img->place_review_image.'" width="400" class="img-thumbnail" height="120"/>';
    //     }
    //     $data = array('res' => "success",'img'=>$imgs);
    //     echo json_encode($data);
    // }
   

    // public function edit_location(){
    //     $id = $this->input->post('id');
       
    //     $locations = $this->masters_model->get_location($id,'id','locations');
    //     $states = $this->masters_model->get_location($locations[0]->state_id,'id','states');
    //     $state = $states[0]->name;
    //     $cities = $this->masters_model->get_location( $locations[0]->city_id,'id','cities');
    //     $city = $cities[0]->name;
    //     $towns = $this->masters_model->get_location($locations[0]->town_id,'id','towns');
    //     $town = $towns[0]->name;
    //     echo json_encode(array("res"=>'success','loc'=>$locations,'city'=>$city,'town'=>$town,'state'=>$state));
    // }

    // public function update_location(){
    //     $id = $this->input->post('edit_id');
       
    //     $save_data['morning'] = $this->input->post('morning');
    //     $save_data['afternoon'] = $this->input->post('afternoon');
    //     $save_data['evening'] = $this->input->post('evening');
    //     $save_data['updated_at'] = date("Y-m-d H:i:s");
    //     $save_data['review_date'] = date("Y-m-d H:i:s");

    //     if($save_data['afternoon'] !=""){
    //         if($save_data['evening'] !="" ){
    //             if( ($save_data['afternoon'] < $save_data['evening']) && ($save_data['morning'] < $save_data['afternoon'])){
    //                 $this->masters_model->update_locations('locations','id',$id,$save_data);
    //                 $response ='success';
        
    //             }else{
    //                 $response ='error1';
    //             }
    //         }elseif($save_data['afternoon'] > $save_data['morning']){
    //             $this->masters_model->update_locations('locations','id',$id,$save_data);
    //             $response ='success';
    //         }else{
    //             $response ='error2';
    //         }
    //     }else{
    //         $this->masters_model->update_locations('locations','id',$id,$save_data);
    //         $response ='success';

    //     }
    //     if(!empty($_FILES['place_review_image']['name'])){
    //         $upload_path = APPPATH . '../uploads/place_review_image';
    //         if(!is_dir($upload_path)){
    //             mkdir($upload_path, 0777, true);
    //         }
    //         $config['upload_path'] =  "$upload_path";
    //         $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';
    //         $config['max_size']     = '20000';
    //         $config['file_name'] = time();
            
    //         $this->load->library('upload',$config);
    //         $this->upload->initialize($config);
            
    //         if($this->upload->do_upload('place_review_image')){
    //             $uploadData = $this->upload->data();
    //             $path1 = $_FILES['place_review_image']['name'];
    //             $ext = pathinfo($path1, PATHINFO_EXTENSION);
    //             $picture = time().'.'.$ext;
    //         }
    //         $save_data['place_review_image'] = $picture;
    //         $this->masters_model->update_locations('locations','id',$id,$save_data);

    //     }
           
    //     echo json_encode(array("res"=>$response));
    // }

     
    public function completedform_table() {
        $user_information = $this->masters_model->get_table_approval_ct_log('user_information');
        $locations = $this->masters_model->get_completed_shop_table_ct();
        $data['locations'] = $locations;
        $this->load->view('ct/completedform_table', $data);
    }


    public function mt_uploaded_form(){
        $this->load->view('ct/mt_uploaded_form');
    }

    
// total count //
    public function get_details_count()
    {
        $emp_no = $this->session->userdata('emp_no');
        $entered_cc['cluster_id'] = "$emp_no";
        $entered_cc['status'] = "1";
        $entered_cc['ct_review'] = "";
        $cc_entered_details = $this->masters_model->total_count($entered_cc ,'user_information');

        $verified_ct['ct_review'] = "1";
        $verified_ct['cluster_id'] = "$emp_no";
        $ct_verified_details = $this->masters_model->total_count($verified_ct ,'user_information');

        $funnel_ct['ct_review'] = "Saved";
        $funnel_ct['cluster_id'] = "$emp_no";
        $ct_funnel_details = $this->masters_model->total_count($funnel_ct ,'user_information');

        $upload_ct['sh_approval'] = "Approved";
        $upload_ct['cluster_id'] = "$emp_no";
        $ct_upload_details = $this->masters_model->total_count($upload_ct ,'user_information');

        $upload_mt['mt_upload'] = "uploaded";
        $mt_upload_details = $this->masters_model->total_count($upload_mt ,'user_information');

        $rejected_sa['sa_app'] = "Rejected";
        $sa_rejected = $this->masters_model->total_count2($rejected_sa ,'user_information','sa_remark');

        $data = array(
            "cc_entered_details" => $cc_entered_details,
            "ct_verified_details" => $ct_verified_details,
            "ct_funnel_details" => $ct_funnel_details,
            "ct_upload_details" => $ct_upload_details,
            "mt_upload_details" => $mt_upload_details,
            "sa_rejected_count" => $sa_rejected,
        );
        echo json_encode($data);

    }

    
    ///////////////////


   
}
