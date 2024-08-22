<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Mp extends CI_Controller { 
 
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
        } else if ($this->session->userdata('role') != "MP") {
            redirect(base_url(), 'refresh');
        }
    }


    public function franchise_form(){
        //get sates
        $sates = $this->masters_model->get_state('towns_details');
        $data['sates'] = $sates;
        $this->load->view('mp/franchisee_form', $data); 
    } 

    public function user_info() {

        $session_data = sessionData();
		$data['session_data'] = $session_data; 

        // Check Marital status Remark
        if($this->input->post('marital_status') == "Married"){
            $marital = "20";
        }else{
            $marital = "0"; 
        }
 
        // Check Educational Qualification Remark
        if($this->input->post('education_q') == "10th"){
            $edu = "0";
        }elseif($this->input->post('education_q') == "12th"){
            $edu = "10";
        }else{
            $edu = "20";
        }

        // Check Individual Monthly Income Remark
        if($this->input->post('monthly_income') <= "25000"){
            $ind_inco = "20";
        }elseif($this->input->post('monthly_income') > "25000" && $this->input->post('monthly_income') <= "35000"){
            $ind_inco = "10";
        }else{
            $ind_inco = "0";
        }

        // Check Family Monthly Income Remark

        if($this->input->post('family_income') <= "35000"){
            $fam_inco = "10";
        }elseif($this->input->post('family_income') > "35000" && $this->input->post('family_income') <= "50000"){
            $fam_inco = "5";
        }else{
            $fam_inco = "0";
        }

        // Check Residing Year Remark

        $res_year =  date('Y') - $this->input->post('residing_year');

        if($res_year >= "10"){
            $resi = "20";
        }elseif($res_year < "10" && $res_year >= "5"){
            $resi = "10";
        }else{
            $resi = "0";
        }

        // Check Occupation Remark
        if($this->input->post('occupation') == "Employee"){
            $occup = "5";
        }else{
            $occup = "10"; 
        }

        $bd_score = $resi + $fam_inco + $ind_inco + $edu + $marital + $occup;

        $dataa['name'] = $this->input->post('name', TRUE);
        $dataa['email'] = $this->input->post('email', TRUE);
        $dataa['mobile'] = $this->input->post('mobile', TRUE);
        $dataa['whatsapp_no'] = $this->input->post('whatsapp_no', TRUE);
        $dataa['landline'] = $this->input->post('landline', TRUE);
        
        $dataa['gender'] = $this->input->post('gender', TRUE);
        $dataa['marital_status'] = $this->input->post('marital_status', TRUE);
        $dataa['language'] = $this->input->post('language', TRUE);
        $dataa['education'] = $this->input->post('education_q', TRUE);
        $dataa['occupation'] = $this->input->post('occupation', TRUE);
        $dataa['in_mon_income'] = $this->input->post('monthly_income', TRUE);
        $dataa['family_income'] = $this->input->post('family_income', TRUE);
        
        $dataa['shop_sate'] = $this->input->post('shop_sate', TRUE);
        $dataa['shop_city'] = $this->input->post('shop_city', TRUE);
        $dataa['shop_town'] = $this->input->post('shop_town', TRUE);
        $dataa['shop_address'] = $this->input->post('address', TRUE);
        $dataa['pincode'] = $this->input->post('pincode', TRUE);
        $dataa['residing_year'] = $this->input->post('residing_year', TRUE);
        
        $dataa['sourced_by'] = $this->input->post('sourced_by', TRUE);
        $dataa['referred_person'] = $this->input->post('referred_person', TRUE);
        
        $dataa['proof_type'] = $this->input->post('proof', TRUE);
        $dataa['proof_no'] = $this->input->post('proof_no', TRUE);
        $dataa['population'] = $this->input->post('population', TRUE);
        $dataa['town_code'] = $this->input->post('town_code', TRUE);

        $dataa['marital_status_remark'] = $marital;
        $dataa['education_remark'] = $edu ;
        $dataa['in_mon_income_remark'] = $ind_inco;
        $dataa['family_income_remark'] = $fam_inco;
        $dataa['residing_year_remark'] = $resi;
        $dataa['bd_score'] = $bd_score;

        $dataa['status'] = "Saved";
        $dataa['sh_approval'] = "";
        $dataa['ct_review'] = "";
        $dataa['sh_remark'] = "";
        $dataa['created_by'] = $this->session->userdata('emp_no');
        $dataa['approved_by'] = "";

            $last_id = $this->masters_model->insert_data('user_information', $dataa);
            if(!empty($_FILES['image_proof']['name'])){
                
                $config['upload_path'] = APPPATH . '../uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';
                $config['max_size']     = '20000';
                $config['file_name'] = $_FILES['image_proof']['name'];
                  
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('image_proof')){
                // echo("image check");

                    $imageData = $this->upload->data();
                    $uploadImgData['image_proof'] = $imageData['file_name'];
                    $uploadImgData['d_id'] = $last_id;
                    $uploadImgData['status'] = 1;
                }
                if (!empty($uploadImgData)) {
                    // Insert files data into the database
                    $this->masters_model->importData('image_proof', $uploadImgData);
                }
            }

        $this->session->set_flashdata('message', ('Added Successfully!'));
        redirect(base_url('index.php/mp/franchise_form'), 'refresh');
    }


    public function entered_form() {
        $user_information = $this->masters_model->get_mp_form_submitted(); 
        $data['user_information'] = $user_information;
        $this->load->view('mp/entered_form', $data);
    }
 
   

 
    //total count //

    public function get_details_count(){
        
        $emp_no = $this->session->userdata('emp_no');
        $entered_mp['created_by'] = "$emp_no";
        $mp_entered = $this->masters_model->total_count($entered_mp ,'user_information');
        $data = array(
            "mp_entered" => $mp_entered,
        );
        echo json_encode($data);
    }
    
}

