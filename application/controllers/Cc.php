<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cc extends CI_Controller {

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
        } else if ($this->session->userdata('role') != "CC") {
            redirect(base_url(), 'refresh');
        }
    }


    public function send_mail($data) {

        // print_r($data['name']);
        // exit;
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            // 'smtp_port' => 465,
            'smtp_port' => 587,
            'smtp_user' => 'manjusubramaniyan2402@gmail.com', // change it to yours
            'smtp_pass' => 'rvqmskqtpetrdbkb', // change it to yours
            'mailtype' => 'html',
            'smtp_crypto' => 'tls',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'send_multipart' => FALSE
        );
        $this->email->initialize($config);

        $user = $this->session->userdata('username');
        $message = '<h3>New Franchise Added Successfully!</h3>
                    <p>One New Franchise added by "'.$user.'"</p>
                    <p>Frc Basic Details :</p>
                    <div class="row"><b>Frc Name :</b><span>'.$data['name'].'</span></div>
                    <div class="row"><b>Mobile No. :</b><span>'.$data['mobile'].'</span></div>
                    <div class="row"><b>Email ID :</b><span>'.$data['email'].'</span></div>

                    <p><b>Note :</b>This is an auto-generated mail. Please do not reply. </p>
                    <h4>Regards:</h4>
                    <p>'.$user.' </p>';

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('manjusubramaniyan2402@gmail.com'); // change it to yours
        $this->email->to('manjusubramaniyan2402@gmail.com');// change it to yours
        // $this->email->cc('3168@cavinkare.com');
        // $this->email->bcc('lakshminarayanan@hemas.in');
        $this->email->subject('Franchisee Alert!');
        $this->email->message($message);
        if($this->email->send()){
            $this->session->set_flashdata('message', ('Email Send Successfully.'));
        }else{
            $this->session->set_flashdata('error', ('You have encountered an error!'));
            show_error($this->email->print_debugger());
        }
    }

    //email part over//


    public function franchisee_form() {
        //get sates
        $sates = $this->masters_model->get_state('towns_details');
        $data['sates'] = $sates;
        $year = date('Y');
        $data['year'] = $year;
        $this->load->view('cc/franchisee_form', $data); 
    }
 
    public function entered_form() {
        $user_information = $this->masters_model->get_cc_table_submitted(); 
        $data['user_information'] = $user_information;
        $this->load->view('cc/entered_form', $data);
    }

    public function get_funneled_row_data()
    {
        # code...
		$id =  $this->input->post('id');
        $data['row'] = $this->masters_model->get_funneled_row_data($id);
        

        $sates = $this->masters_model->get_state('towns_details');
        $data['sates'] = $sates;

        $city = $this->masters_model->getCities($data['row'][0]->shop_sate);
        $data['city_set'] = $city;

        $town = $this->masters_model->getTowns($data['row'][0]->shop_city);
        $data['town_set'] = $town;

        //get distribution
        $area = $this->masters_model->get_additioanl_info('additional_info', 'Should be in the same area');
        $data['area'] = $area;
        //get Business
        $age = $this->masters_model->get_additioanl_info('additional_info', 'Age criteria 30 to 35 yrs');
        $data['age'] = $age;
        //get Capacity
        $business = $this->masters_model->get_additioanl_info('additional_info', 'Should not do any other Employeement & milk & other business');
        $data['business'] = $business;
        //get Soil
        $family_busi = $this->masters_model->get_additioanl_info('additional_info', 'Should consider as a first income and family business');
        $data['family_busi'] = $family_busi;
        //get Vehicle
        $business_time = $this->masters_model->get_additioanl_info('additional_info', 'Willing to work 24/7, 365days . Business timing : 5am to 10pm');
        $data['business_time'] = $business_time;

        echo json_encode($data);   

    } 

    public function funneled_form_view()
    {
        $this->load->view('cc/funneled_form');
    }

    public function customer_entered_form()
    {
        $this->load->view('cc/customer_entered_form');
    }

    public function customer_funneled_form()
    {
        $this->load->view('cc/customer_funneled');
    } 
 
    public function get_all_funneled_data()     
    {
        $postData = $this->input->post();
        $data = $this->masters_model->get_all_funneled_data($postData,'user_information');
        echo json_encode($data);  
    }
  
    public function get_all_customer_data()    
    { 
        $postData = $this->input->post();
        $data = $this->masters_model->get_customer_entered_data($postData,'user_information');
        echo json_encode($data); 
    }  
    

    public function get_customer_funnel_data()    
    {
        $postData = $this->input->post();
        $data = $this->masters_model->get_customer_funnel_data($postData,'user_information');
        echo json_encode($data); 
    }

    public function user_info() {
      
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
            $edu  = "10";
        }else{
            $edu  = "20";
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
        
        if($this->input->post('relation') == "Wife"){
            $data['relationship_remark'] = "20";
        }else{
            $data['relationship_remark'] = "0";
        }

        if( $this->input->post('expect_income') <= "25000" ){
            $data['expect_income_remark'] = "10";
        }else{
            $data['expect_income_remark'] = "0";
        }

        if( $this->input->post('expect_income1') <= "45000" ){
            $data['expect_income_remark1'] = "10";
        }else{
            $data['expect_income_remark1'] = "0";
        }

        $area = $this->input->post('area', TRUE);
        $age = $this->input->post('age', TRUE);
        $business = $this->input->post('business', TRUE);
        $family_busi = $this->input->post('family_busi', TRUE);
        $business_time = $this->input->post('busi_time', TRUE);
        $management = $this->input->post('pro_management', TRUE);
        $relation = $data['relationship_remark'];
        $expect_income_remark = $data['expect_income_remark'];
        $expect_income_remark1 = $data['expect_income_remark1'];

        $frc_score = $area + $age + $business + $family_busi + $business_time + $management + $relation + $expect_income_remark +$expect_income_remark1;
    
        $data['name'] = $this->input->post('name', TRUE);
        $data['email'] = $this->input->post('email', TRUE);
        $data['mobile'] = $this->input->post('mobile', TRUE);
        $data['whatsapp_no'] = $this->input->post('whatsapp_no', TRUE);
        $data['landline'] = $this->input->post('landline', TRUE);
        
        $data['gender'] = $this->input->post('gender', TRUE);
        $data['marital_status'] = $this->input->post('marital_status', TRUE);
        $data['language'] = $this->input->post('language', TRUE);
        $data['education'] = $this->input->post('education_q', TRUE);
        $data['occupation'] = $this->input->post('occupation', TRUE);
        $data['in_mon_income'] = $this->input->post('monthly_income', TRUE);
        $data['family_income'] = $this->input->post('family_income', TRUE);
        
        $data['shop_sate'] = $this->input->post('shop_sate', TRUE);
        $data['shop_city'] = $this->input->post('shop_city', TRUE);
        $data['shop_town'] = $this->input->post('shop_town', TRUE);
        $data['shop_address'] = $this->input->post('address', TRUE);
        $data['pincode'] = $this->input->post('pincode', TRUE);
        $data['residing_year'] = $this->input->post('residing_year', TRUE);
        
        $data['sourced_by'] = $this->input->post('sourced_by', TRUE);
        $data['referred_person'] = $this->input->post('referred_person', TRUE);

        $data['proof_type'] = $this->input->post('proof', TRUE);
        $data['proof_no'] = $this->input->post('proof_no', TRUE);
        $data['population'] = $this->input->post('population', TRUE);
        $data['town_code'] = $this->input->post('town_code', TRUE);

        $data['area'] = $area;
        $data['area_remark'] = $this->input->post('area_remark', TRUE);
        $data['any_remark1'] = $this->input->post('if_any_remark1', TRUE);
        
        $data['age'] = $age;
        $data['age_remark'] = $this->input->post('age_remark', TRUE);
        $data['any_remark2'] = $this->input->post('if_any_remark2', TRUE);
        
        $data['business'] = $business;
        $data['business_remark'] = $this->input->post('business_remark', TRUE);
        $data['any_remark3'] = $this->input->post('if_any_remark3', TRUE);
        
        $data['family_business'] = $family_busi;
        $data['fb_remark'] = $this->input->post('family_busi_remark', TRUE);
        $data['any_remark4'] = $this->input->post('if_any_remark4', TRUE);
            
        $data['business_time'] = $business_time;
        $data['time_remark'] = $this->input->post('time_remark', TRUE);
        $data['any_remark5'] = $this->input->post('if_any_remark5', TRUE);

        $data['management'] = $management;
        $data['manage_remark'] = $this->input->post('pro_manage_remark', TRUE);
        $data['any_remark6'] = $this->input->post('if_any_remark6', TRUE);
        
        $data['relationship'] = $this->input->post('relation', TRUE);
        $data['sperson_age'] = $this->input->post('sperson_age', TRUE);
        $data['any_remark7'] = $this->input->post('if_any_remark7', TRUE);
        
        $data['expect_income'] = $this->input->post('expect_income', TRUE);
        $data['expect_income1'] = $this->input->post('expect_income1', TRUE);
        $data['any_remark8'] = $this->input->post('if_any_remark8', TRUE);
        $data['cluster_id'] = $this->input->post('cluster_id', TRUE);
        
        $data['marital_status_remark'] = $marital;
        $data['education_remark'] = $edu ;
        $data['in_mon_income_remark'] = $ind_inco;
        $data['family_income_remark'] = $fam_inco;
        $data['residing_year_remark'] = $resi;
        $data['occup_remark'] = $occup;

        $data['frc_score'] = $frc_score;
        $data['bd_score'] = $bd_score;

            if($this->input->post('save_status')=="1"){
                // save clicked
                $submit_status_type="Saved";
            }
            else{
                // submit clicked
                $submit_status_type=1;
            }
            $data['status'] = $submit_status_type;
            $data['sh_approval'] = "";
            $data['rsm_approval'] = "";
            $data['ct_review'] = "";
            $data['ct_pre_doc_upload'] = "";
            $data['sh_remark'] = "";
            $data['rsm_remark'] = "";
            $data['created_by'] = $this->session->userdata('emp_no');
            $data['approved_by'] = "";

            $last_id = $this->masters_model->insert_data('user_information', $data);

            if(!empty($_FILES['image_proof']['name'])){
               
                $config['upload_path'] = APPPATH . '../uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']     = '20000';
                $config['file_name'] = $_FILES['image_proof']['name'];
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                // echo("check");
                
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

            if($submit_status_type == 1){
                $this->send_mail($data);
            }

            $this->session->set_flashdata('message', ('Added Successfully!'));
            redirect(base_url('index.php/cc/franchisee_form'));

        // $this->load->view('index.php/cc/franchisee_form');
    }

    public function update_user_information() {


        $this->form_validation->set_rules('area','area' ,'required');
        $this->form_validation->set_rules('age', 'age', 'required');
        $this->form_validation->set_rules('business', 'business','required');
        $this->form_validation->set_rules('family_busi', 'family_busi','required');
        $this->form_validation->set_rules('busi_time','busi_time', 'required');
        $this->form_validation->set_rules('pro_management','pro_management', 'required');
        $this->form_validation->set_rules('relation','relation', 'required');
        $this->form_validation->set_rules('expect_income','expect_income', 'required');
        $this->form_validation->set_rules('expect_income1','expect_income1', 'required');
        $this->form_validation->set_rules('cluster_id','cluster_id', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('msg', 'All the fields are required!');
            //$this->load->view('login');
            $result = array(
                "response" => "false",
            );
        }
        else {

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

            // Check Relationship Remark
            if($this->input->post('relation') == "Wife"){
                $data['relationship_remark'] = "20";
            }else{
                $data['relationship_remark'] = "0";
            }

            // Check Expect income Remark
            if( $this->input->post('expect_income') <= "25000" ){
                $data['expect_income_remark'] = "10";
            }else{
                $data['expect_income_remark'] = "0";
            }

            if( $this->input->post('expect_income1') <= "45000" ){
                $data['expect_income_remark1'] = "10";
            }else{
                $data['expect_income_remark1'] = "0";
            }

            // echo "<pre>";print_r($_post);exit;
            $id = $this->input->post('id', TRUE);
            $area = $this->input->post('area', TRUE);
            $age = $this->input->post('age', TRUE);
            $business = $this->input->post('business', TRUE);
            $family_busi = $this->input->post('family_busi', TRUE);
            $business_time = $this->input->post('busi_time', TRUE);
            $management = $this->input->post('pro_management', TRUE);
            $relation = $data['relationship_remark'];
            $expect_income_remark = $data['expect_income_remark'];
            $expect_income_remark1 = $data['expect_income_remark1'];

            $frc_score = $area + $age + $business + $family_busi + $business_time + $management + $relation + $expect_income_remark +$expect_income_remark1;
             

            $data['name'] = $this->input->post('name', TRUE);
            $data['email'] = $this->input->post('email', TRUE);
            $data['mobile'] = $this->input->post('mobile', TRUE);
            $data['whatsapp_no'] = $this->input->post('whatsapp_no', TRUE);
            $data['landline'] = $this->input->post('landline', TRUE);
            
            $data['gender'] = $this->input->post('gender', TRUE);
            $data['marital_status'] = $this->input->post('marital_status', TRUE);
            $data['language'] = $this->input->post('language', TRUE);
            $data['education'] = $this->input->post('education_q', TRUE);
            $data['occupation'] = $this->input->post('occupation', TRUE);
            $data['in_mon_income'] = $this->input->post('monthly_income', TRUE);
            $data['family_income'] = $this->input->post('family_income', TRUE);
            
            $data['shop_sate'] = $this->input->post('shop_sate', TRUE);
            $data['shop_city'] = $this->input->post('shop_city', TRUE);
            $data['shop_town'] = $this->input->post('shop_town', TRUE);
            $data['shop_address'] = $this->input->post('address', TRUE);
            $data['pincode'] = $this->input->post('pincode', TRUE);
            $data['residing_year'] = $this->input->post('residing_year', TRUE);

            $data['sourced_by'] = $this->input->post('sourced_by', TRUE);
            $data['referred_person'] = $this->input->post('referred_person', TRUE);
            
            $data['population'] = $this->input->post('population', TRUE);
            $data['town_code'] = $this->input->post('town_code', TRUE);

            $data['area'] = $area;
            $data['area_remark'] = $this->input->post('area_remark', TRUE);
            $data['any_remark1'] = $this->input->post('if_any_remark1', TRUE);
            
            $data['age'] = $age;
            $data['age_remark'] = $this->input->post('age_remark', TRUE);
            $data['any_remark2'] = $this->input->post('if_any_remark2', TRUE);
        
            $data['business'] = $business;
            $data['business_remark'] = $this->input->post('business_remark', TRUE);
            $data['any_remark3'] = $this->input->post('if_any_remark3', TRUE);
        
            $data['family_business'] = $family_busi;
            $data['fb_remark'] = $this->input->post('family_busi_remark', TRUE);
            $data['any_remark4'] = $this->input->post('if_any_remark4', TRUE);
            
            $data['business_time'] = $business_time;
            $data['time_remark'] = $this->input->post('time_remark', TRUE);
            $data['any_remark5'] = $this->input->post('if_any_remark5', TRUE);

            $data['management'] = $management;
            $data['manage_remark'] = $this->input->post('pro_manage_remark', TRUE);
            $data['any_remark6'] = $this->input->post('if_any_remark6', TRUE);
            
            $data['relationship'] = $this->input->post('relation', TRUE);
            $data['sperson_age'] = $this->input->post('sperson_age', TRUE);
            $data['any_remark7'] = $this->input->post('if_any_remark7', TRUE);
            
            $data['expect_income'] = $this->input->post('expect_income', TRUE);
            $data['expect_income1'] = $this->input->post('expect_income1', TRUE);
            $data['any_remark8'] = $this->input->post('if_any_remark8', TRUE);
            $data['cluster_id'] = $this->input->post('cluster_id', TRUE);

            $data['marital_status_remark'] = $marital;
            $data['education_remark'] = $edu ;
            $data['in_mon_income_remark'] = $ind_inco;
            $data['family_income_remark'] = $fam_inco;
            $data['residing_year_remark'] = $resi;
            $data['occup_remark'] = $occup;

            $data['frc_score'] = $frc_score;
            $data['bd_score'] = $bd_score; 

            // status 2 mens saved form / status 1 mens saved form
            if($this->input->post('save_status')=="1"){
                // save clicked
                $submit_status_type="Saved";
            }
            else{
                // submit clicked
                $submit_status_type=1;
            }
            $data['status'] = "$submit_status_type";
            $data['sh_approval'] = "";
            $data['rsm_approval'] = "";
            $data['ct_review'] = "";
            $data['ct_pre_doc_upload'] = "";
            $data['sh_remark'] = "";
            $data['rsm_remark'] = "";
            $data['updated_by'] = $this->session->userdata('emp_no');

            $update=$this->masters_model->updates('user_information', $data, 'id', $id);

            if($submit_status_type == 1){
                $this->send_mail($data);
            }

            $result = array(
                "response" => "success",
            );
        }

        echo json_encode($result);
    }

    function getcities() { 
        $json = array();
        $stateID = $this->input->post('stateID', TRUE);
        $json = $this->masters_model->getCities($stateID);
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    function gettowns() {
        $json = array();
        $cityID = $this->input->post('cityID', TRUE);
        $json = $this->masters_model->getTowns($cityID);
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    function getzip() {
        $json = array();
        $townID = $this->input->post('townID', TRUE);
        $json = $this->masters_model->getZip_code($townID);
        echo json_encode($json);
    }

    function get_population() {
        $json = array();
        $townID = $this->input->post('townID', TRUE);
        $json = $this->masters_model->get_population($townID);
        echo json_encode($json);
    }
    
 // total number of shop entered and saved funel details------

    public function get_details()
    {
        $emp_no = $this->session->userdata('emp_no');
        $entered_cc['created_by'] = "$emp_no";
        $entered_cc['status'] = "1";
        $cc_entered_details = $this->masters_model->total_count($entered_cc ,'user_information');

        $funnel_cc['status'] = "saved";
        $funnel_cc['created_by'] = "$emp_no";
        $cc_funnel_details = $this->masters_model->total_count($funnel_cc ,'user_information');

        $entered_cus['user_information.status'] = "1";
        $cus_entered_details = $this->masters_model->total_count_bd($entered_cus ,'user_information');

        $funnel_cus['user_information.status'] = "saved";
        $cus_funnel_details = $this->masters_model->total_count_bd($funnel_cus ,'user_information');

        $data = array(
            "cc_entered_details" => $cc_entered_details,
            "cc_funnel_details" => $cc_funnel_details,
            "cus_entered_details" => $cus_entered_details,
            "cus_funnel_details" => $cus_funnel_details,
        );
        echo json_encode($data);

    }

    ///////////////////
}
